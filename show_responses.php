<?php
require("config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$stmt_fetch = $conn->prepare("SELECT * FROM questionnaire_responses WHERE username = ?");
$stmt_fetch->bind_param('s', $username);
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();
$stmt_fetch->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Previous Questionnaire Responses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add any additional styles you need -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #5C8374;
            color: white;
            padding: 20px;
            margin-bottom: 100px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            margin-top: 50px;
        }

        .card {
            background-color: #90A495;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .card-header {
            background-color: #435d56;
            color: white;
            font-weight: bold;
        }

        .card-body {
            color: #435d56;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #435d56;
        }

       
        button{
            margin-block-end: end;
        }
        #btn {
            font-weight: 700;
            border-radius: 15px;    
            background-color: #435d56;
            color: #fff;
            padding: 15px 30px;
            margin-left: 85%;
            
        }

        #btn:hover {
            background-color: #3C704E;
        }
        #submitButton{
            display: block;
            margin-top: 10px;
            margin-right: 0;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Previous Questionnaire Responses</h2>
        <?php
        while ($row = $result->fetch_assoc()) {
            for ($i = 1; $i <= 8; $i++) {
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo "Question $i: ";
                echo htmlspecialchars(getQuestionText($i));
                echo '</div>';
                echo '<div class="card-body">';
                echo htmlspecialchars($row["question_$i"]);
                echo '</div>';
                echo '</div>';
            }
            echo "<hr>";
        }
        ?>
        <div class="btn-container ">
        <a href="show_questionnaire.php" class="btn btn-primary">Edit</a>
            <a href="thank_you.php" class="btn btn-primary">Next</a>
        </div>
    </div>
</body>
</html>

<?php
function getQuestionText($questionNumber) {
    // Modify this function to return the text of each question based on the question number.
    switch ($questionNumber) {
        case 1:
            return 'Why are you using this app?';
        case 2:
            return 'What age group do you belong to?';
        case 3:
            return 'Do you have any specific health concerns or conditions?';
        case 4:
            return 'Are you currently experiencing any specific symptoms like cough or sickness?';
        case 5:
            return 'If yes, please provide details';
        case 6:
            return 'How experienced are you with using plants and herbs for wellness?';
        case 7:
            return 'What types of plants or herbs are you particularly interested in?';
        case 8:
            return 'Are you looking for information on growing plants and herbs at home?';
        default:
            return '';
    }
}
?>
