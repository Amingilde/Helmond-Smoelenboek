<?php
// Database connection
$conn = new mysqli("localhost", "root", "Wachtwoord", "personal_website_db");

header('Content-Type: application/json');

$sql = "SELECT * FROM comments ORDER BY id ASC";
$result = $conn->query($sql);

if ($result) {
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            "name" => $row['name'],
            "email" => $row['email'],
            "comment" => $row['comment'],
            "timestamp" => $row['created_at']
        ];
    }
    echo json_encode($comments);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to fetch comments"]);
}

$conn->close();
?>