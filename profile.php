<?php
require("config.php");
require("navbar.php");

session_start();
if (!isset($_SESSION["username"]) && !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit();
}
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$username = $_SESSION["username"];

$userStmt = $pdo->prepare("SELECT firstname, lastname, email, image, gender FROM user WHERE username = ?");
$userStmt->execute([$username]);
$userInfo = $userStmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['view_user_blogs'])) {
    $_SESSION['viewing_user_blogs'] = true;
} else {
    $_SESSION['viewing_user_blogs'] = false;
}

if ($_SESSION['viewing_user_blogs']) {
    $stmt = $pdo->prepare("SELECT * FROM post WHERE userName = ?");
    $stmt->execute([$username]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM post WHERE userName = ? AND userName = ?");
    $stmt->execute([$username, $_SESSION['username']]);
}

$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile and Blogs</title>
    <style>
        body{
            padding: 100px;
        }
        .card {
            opacity: 0.9; 
            padding: 15px;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function(){
            $("#inputFirstName").hide();
            $("#inputLastName").hide();
            $("#inputEmail").hide();
            $("#save").hide();

            $("#edit").click(function(e) {
                e.preventDefault();

                $("#readFirstName").toggle();
                $("#readLastName").toggle();
                $("#readEmail").toggle();

                $("#inputFirstName").toggle();
                $("#inputLastName").toggle();
                $("#inputEmail").toggle();

                $("#save").toggle();
                $(this).toggle();
            });

            $("#save").click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Confirm Changes',
                    text: 'Are you sure you want to save these changes?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "profile_edit.php",
                            method: "post",
                            data: {
                                firstname: $("#inputFirstName").val(),
                                lastname: $("#inputLastName").val(),
                                email: $("#inputEmail").val()
                            },
                            success: function(result) {
                                Swal.fire({
                                    title: 'Changes Saved!',
                                    text: result,
                                    icon: 'success',
                                    timer: 2000,
                                    timerProgressBar: true
                                });

                                $("#readFirstName").show();
                                $("#readLastName").show();
                                $("#readEmail").show();

                                $("#inputFirstName").hide();
                                $("#inputLastName").hide();
                                $("#inputEmail").hide();

                                $("#edit").show();
                                $("#save").hide();

                                setInterval('location.reload(true)', 100);
                            }
                        });
                    }
                });
            })
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Logout',
                text: 'Are you sure you want to logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>
</head>
<body>
    <?php include("bg.php"); ?>

    <div class="card">
        <div class="card-body" style="color: black;">
            <h2 id="userProfile">User Profile:</h2>
            <?php if ($userInfo): ?>
                <p>
                    <b>Username: </b>
                    <span id="username"><?php echo $username; ?></span>
                </p>
                <p>
                    <b>First Name: </b>
                    <span id="readFirstName"><?php echo $userInfo['firstname']; ?></span>
                    <input type="text" name="firstname" id="inputFirstName" value="<?php echo $userInfo['firstname']; ?>" size=25 style="display:none;">
                </p>
                <p>
                    <b>Last Name: </b>
                    <span id="readLastName"><?php echo $userInfo['lastname']; ?></span>
                    <input type="text" name="lastname" id="inputLastName" value="<?php echo $userInfo['lastname']; ?>" size=25 style="display:none;">
                </p>
                <p>
                    <b>Email: </b>
                    <span id="readEmail"><?php echo $userInfo['email']; ?></span>
                    <input type="email" name="email" id="inputEmail" value="<?php echo $userInfo['email']; ?>" size=25 style="display:none;">
                </p>
                <p>
                    <b>Sex: </b>
                    <?php echo isset($userInfo['gender']) ? $userInfo['gender'] : 'Not specified'; ?>
                </p>
                <?php if (!empty($userInfo['image'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userInfo['image']); ?>" alt="Profile Picture" class="img-fluid mb-2">
                <?php endif; ?>
            <?php else: ?>
                <p>User profile not found.</p>
            <?php endif; ?>
            <div class="btn-container">
                <a id="edit" class="btn btn-secondary">Edit</a>
                <a id="save" class="btn btn-success">Save</a>
                <a href="#" onclick="confirmLogout()" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="color: black;">
            <h2>Posts:</h2>
            <?php if (count($blogs) > 0): ?>
                <div class="row justify-content-center">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3><a href="view_blog.php?blogID=<?php echo $blog['blogID']; ?>"><?php echo $blog['blog_title']; ?></a></h3>
                                    <?php if (!empty($blog['blog_pic'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents($blog['blog_pic'])); ?>" alt="Blog Image" class="img-fluid mb-2">
                                    <?php endif; ?>
                                    <p><b>Content: </b><?php echo $blog['blog_content']; ?></p>
                                    <p><b>Filed Under: </b><?php echo $blog['blog_cat']; ?> Date: <?php echo $blog['dateTime_created']; ?></p>
                                    
                                    <form action="delete_blog.php" method="post" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        <input type="hidden" name="blogID" value="<?php echo $blog['blogID']; ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No post available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
