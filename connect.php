<?php
// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
$conn = mysqli_connect($host, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $userPassword = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    $phoneNumber = $_POST["phoneNumber"];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, phoneNumber) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $userPassword, $phoneNumber);

        if ($stmt->execute()) {
            // Redirect to login.html upon successful registration
            header("Location: login.html");
            exit(); // Stop further execution
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
