<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Dictionary Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('logo/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            background-color: #fff; 
            padding-top: 50px;
            margin-bottom: 60px; 
            padding-bottom: 100px;
            padding-top: 100px;
        }

        .container {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            color: #435d56;
        }

        h2 {
            color: #007bff;
        }

        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-container img {
            max-width: 50%; 
            max-height: 200px; 
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        h3 {
            color: #28a745;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 8px;
        }

        #edit {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        #edit:hover {
            text-decoration: underline;
        }

        #btn-back{
            margin-left: 45px;
            position: fixed;
            top: 30px;
            left: 200px;
            z-index: 9999;
            color: #435d56;
            border-radius: 50%;
            padding: 15px;
            padding-left: 20px;
            padding-right: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.10);
            background-color: #fff;
            transition: background-color 0.3s;
        }
        #btn-back:hover{
            background-color: #435d56;
            color: #fff;
        }


        .show-more-btn {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.show-more-btn:hover {
    text-decoration: underline;
}

.show-more-btn:active {
    color: #0056b3; /* Change the color on active state if needed */
}

    </style>
</head>

<body>
<?php include("navbar.php");?>

<a id='btn-back' href="display_plants.php" class="btn fixed-top-btn">
    <i class="fas fa-arrow-left"></i>
</a>
<div class="container mt-3">
    
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $jsonData = file_get_contents('plant_json.json');
        $data = json_decode($jsonData, true);

        if (isset($data['herb'])) {
            $plants = is_array($data['herb']) ? $data['herb'] : array_values($data['herb']);
            usort($plants, function($a,$b) {return strnatcasecmp($a['name'],$b['name']);});

            if ($id >= 0 && $id < 70) { 
                $plant = $plants[$id];

                echo '<div class="plant-details">';
                echo '<h2> What is ' . $plant['name'] . ' ? </h2>';
                
                if (isset($plant['images']) && is_array($plant['images'])) {
                    foreach ($plant['images'] as $image) {
                        echo '<img src="' . $image . '" class="img-fluid" alt="' . $plant['name'] . '">';
                    }
                }

               echo '<h4 class="bold-text"><br><strong>Description: </strong></h4>' ;
                echo '<p>' . $plant['descrip'] . '</p>';

            
              // Container for kingdom details (initially hidden)
             // echo '<div class="kingdom-details-container" style="display: none;"></div>';
              



                echo '<h4 class="bold-text"><br><strong> Benifits :</strong></h4>';
                echo '<ul>';
                if (isset($plant['benefits']) && is_array($plant['benefits'])) {
                    foreach ($plant['benefits'] as $benefit) {
                        echo '<li>' . $benefit . '</li>';
                    }
                } else {
                    echo '<li>' . $plant['benefits'] . '</li>';
                }
                echo '</ul>';

                echo '<h4 class="bold-text"><br><strong> Side Effects:</strong></h4>';
                echo '<ul>';
                if (isset($plant['side']) && is_array($plant['side'])) {
                    foreach ($plant['side'] as $sideEffect) {
                        echo '<li>' . $sideEffect . '</li>';
                    }
                } else {
                    echo '<li>' . $plant['side'] . '</li>';
                }
                echo '</ul>';

                // More Info link
               // echo '<a href="#" onclick="showKingdomDetails(\''.urlencode($plant['name']).'\')" class="btn btn-primary">More Info</a>';
               echo '<span class="show-more-btn" onclick="showKingdomDetails(\''.urlencode($plant['name']).'\')">Show More</span>';
                echo '</div>';
          
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">';
                echo 'Invalid plant ID.';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">';
            echo 'Invalid JSON data. The "herb" key is missing.';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">';
        echo 'Missing plant ID.';
        echo '</div>';
    }
    ?>
    <br>
    <br>
    <h3>Comments:</h3>
    <?php
    if (isset($plant['comments']) && is_array($plant['comments']) && count($plant['comments']) > 0) {
        echo "<ul>";
        foreach ($plant['comments'] as $comment) {
            echo "<li><b>{$comment['user']}</b> said: {$comment['text']} - {$comment['timestamp']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No comments yet.</p>";
    }
    ?>
    <h3>Comments:</h3>
    <form method="post" action="process_comment.php">
        <?php
        $plantName = $plant['name'];
        str_replace(" ", "+", $plantName);
        ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="plant_name" value="<?php echo $plantName ?>">
        <textarea name="comment" placeholder="Add your comment..." rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit Comment" name="plantDetailComment">
    </form>

    <!-- Add the JavaScript code -->
    <script>
        
function showKingdomDetails(plantName) {
    // Check if the kingdom details container already exists
    var kingdomDetailsContainer = document.querySelector('.kingdom-details-container');

    // If it exists, toggle its visibility
    if (kingdomDetailsContainer) {
        var isVisible = kingdomDetailsContainer.style.display === 'block';
        kingdomDetailsContainer.style.display = isVisible ? 'none' : 'block';
    } else {
        // Use AJAX to fetch the kingdom details if the container doesn't exist
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Append the fetched data below the More Info button and description
                var plantDetailsContainer = document.querySelector('.plant-details');
                kingdomDetailsContainer = document.createElement("div");
                kingdomDetailsContainer.className = 'kingdom-details-container'; // Add a class for easy identification
                kingdomDetailsContainer.innerHTML = this.responseText;
                plantDetailsContainer.appendChild(kingdomDetailsContainer);
            }
        };

        // Make an AJAX request to kingdom_details.php with the plant_name parameter
        xhttp.open("GET", "kingdom_details.php?plant_name=" + plantName, true);
        xhttp.send();
    }
}


    </script>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
