<?php

require("config.php");
session_start();

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$username = $_SESSION["username"];

$updateStatement = "UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE username = '$username'";

if ($conn -> query($updateStatement)) {
    echo "Profile details have been updated.";
} else {
    echo "Error updating profile details.";
}