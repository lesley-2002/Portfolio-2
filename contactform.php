<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_connect";

// Create Connection

$conn = new mysqli($servername, $username, $password, $database);

// Strip data function

function strip_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get from form
$contactmessage = "";
$name = $_POST['name1'];
$email = $_POST['email1'];
$phone = $_POST['phone1'];
$subject = $_POST['subject1'];
$message = $_POST['message1'];
$timestamp = date("d-m-y H:i:s");
$ip_addr = $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name1"])) {
        echo "<span>* Name is required *</span>";
    } else {
        $name = strip_data($_POST["name1"]);
        // Check if name contains letters and white spaces
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $_SESSION['contact-message'] = "Only letters and white spaces allowed";
        }
    }

    if (empty($_POST["email1"])) {
        echo "<span>* E-mail is required *</span>";
    } else {
        $email = strip_data($_POST["email1"]);
        // Check if the email is well formatted
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<span>* Invalid E-mail Format *</span>";
        }
    }

    if (empty($_POST["phone1"])) {
        $phone = "";
    } else {
        $phone = strip_data($_POST["phone1"]);
        // Check if name contains letters and white spaces
        //if (!preg_match("/^[a-zA-Z-' ]*$/", $phone)) {
        //    echo "<p>* Invalid Phone Format *</p>";
        //}
    }

    if (empty($_POST["message1"])) {
        echo "<p>* Message is required *</p>";
    } else {
        $message = strip_data($_POST["message1"]);
    }
}

// Check Connection

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO db_contact(Name, Email, phone, subject, message, date, ip) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $subject, $message, $timestamp, $ip_addr);
    $_SESSION['contact-message'] = "Succesfully send query";
    $stmt->execute();
    $stmt->close();
    $conn->close();
}


?>