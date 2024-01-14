<?php
require("config.php");
session_start();

$username = $_SESSION['username'];

// Check if the user already has a response
$stmt_check = $conn->prepare("SELECT * FROM questionnaire_responses WHERE username = ?");
$stmt_check->bind_param('s', $username);
$stmt_check->execute();
$result = $stmt_check->get_result();
$existing_response = $result->fetch_assoc();
$stmt_check->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question1 = isset($_POST['question1']) ? $_POST['question1'] : '';
    $question2 = isset($_POST['question2']) ? $_POST['question2'] : '';
    $question3 = isset($_POST['question3']) ? $_POST['question3'] : '';
    $question4 = isset($_POST['question4']) ? $_POST['question4'] : '';
    $question5 = isset($_POST['question5']) ? $_POST['question5'] : '';
    $question6 = isset($_POST['question6']) ? $_POST['question6'] : '';
    $question7 = isset($_POST['question7']) ? $_POST['question7'] : '';
    $question8 = isset($_POST['question8']) ? $_POST['question8'] : '';

    if ($existing_response) {
        // If the user has an existing response, update the values for the specific username
        $stmt_update = $conn->prepare("UPDATE questionnaire_responses SET question_1=?, question_2=?, question_3=?, question_4=?, question_5=?, question_6=?, question_7=?, question_8=? WHERE username=?");
        $stmt_update->bind_param('sssssssss', $question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8, $username);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // If the user doesn't have an existing response, insert a new record for the specific username
        $stmt_insert = $conn->prepare("INSERT INTO questionnaire_responses (username, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param('sssssssss', $username, $question1, $question2, $question3, $question4, $question5, $question6, $question7, $question8);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    $conn->close();

    header("Location: show_responses.php");
    exit();
}

// Load existing values into the form fields
$existing_question1 = $existing_response ? $existing_response['question_1'] : '';
$existing_question2 = $existing_response ? $existing_response['question_2'] : '';
// Repeat this for other fields...

// Rest of your HTML code remains unchanged
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Questionnaire - Plant Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
            background-color: #90A495;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        h2 {
            color: #435d56;
            font-weight: 600;
        }

        label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        textarea {
            resize: vertical;
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
        <h2>Plant and Herb Questionnaire</h2>
        <form action="questionnaire.php" method="POST">
            <div class="form-group">
                <label for="question1">Why are you using this app?</label>
                <select class="form-control" id="question1" name="question1" required>
                    <option value="Medicinal purposes">Medicinal purposes</option>
                    <option value="Health improvement">Health improvement</option>
                    <option value="General interest in plants and herbs">General interest in plants and herbs</option>
                </select>
            </div>

            <div class="form-group">
                <label for="question2">What age group do you belong to?</label>
                <select class="form-control" id="question2" name="question2" required>
                    <option value="18-24">18-24</option>
                    <option value="25-34">25-34</option>
                    <option value="35-44">35-44</option>
                    <option value="45-54">45-54</option>
                    <option value="55 and above">55 and above</option>
                </select>
            </div>

            <div class="form-group">
                <label for="question3">Do you have any specific health concerns or conditions?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" value="Yes" required>
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question3" value="No" required>
                    <label class="form-check-label">No</label>
                </div>
            </div>

            <div class="form-group">
                <label for="question4">Are you currently experiencing any specific symptoms like cough or sickness?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" value="Yes" required>
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question4" value="No" required>
                    <label class="form-check-label">No</label>
                </div>
            </div>

            <div class="form-group">
                <label for="question5">If yes, please provide details:</label>
                <textarea class="form-control" id="question5" name="question5" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="question6">How experienced are you with using plants and herbs for wellness?</label>
                <select class="form-control" id="question6" name="question6" required>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <label for="question7">What types of plants or herbs are you particularly interested in?</label>
                <select class="form-control" id="question7" name="question7" required>
                    <option value="Medicinal herbs">Medicinal herbs</option>
                    <option value="Culinary herbs">Culinary herbs</option>
                    <option value="Edible flowers">Edible flowers</option>
                </select>
            </div> -->


            <div class="form-group">
    <label>What types of plants or herbs are you particularly interested in?</label>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="question7" id="medicinalHerbs" value="Medicinal herbs" required>
        <label class="form-check-label" for="medicinalHerbs">Medicinal herbs</label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="question7" id="culinaryHerbs" value="Culinary herbs" required>
        <label class="form-check-label" for="culinaryHerbs">Culinary herbs</label>
    </div>
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="question7" id="edibleFlowers" value="Edible flowers" required>
        <label class="form-check-label" for="edibleFlowers">Edible flowers</label>
    </div>
</div>





            <div class="form-group">
                <label for="question8">Are you looking for information on growing plants and herbs at home?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question8" value="Yes" required>
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question8" value="No" required>
                    <label class="form-check-label">No</label>
                </div>
            </div>

            <button id="btn" type="submit" class="btn btn-primary">SUBMIT</button>
        </form>
    </div>
</body>
</html>
