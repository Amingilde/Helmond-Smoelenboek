<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "Wachtwoord", "personal_website_db");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['comment'], $_POST['name'], $_POST['email']) &&
        !empty($_POST['comment']) &&
        !empty($_POST['name']) &&
        !empty($_POST['email'])
    ) {
        $comment = $conn->real_escape_string($_POST['comment']);
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);

        $sql = "INSERT INTO comments (name, email, comment) VALUES ('$name', '$email', '$comment')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                "status" => "success",
                "id" => $conn->insert_id,
                "name" => $name,
                "email" => $email,
                "comment" => $comment
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
?>