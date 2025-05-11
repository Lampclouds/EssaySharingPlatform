<?php
// submitEssay.php

// Start the session to store court information
session_start();

// Check if the essay is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the essay and court from the form submission
    $essay = $_POST['essay'];
    $court = $_SESSION['court'] ?? 'Unknown Court'; // Get court from session or default

    // Here you would typically save the essay to a database
    // For demonstration, we'll just save it to a text file
    $filename = 'essays.txt'; // File to store essays
    $entry = "Court: $court\nEssay: $essay\n\n"; // Format the entry

    // Append the essay to the file
    file_put_contents($filename, $entry, FILE_APPEND);

    // Redirect to the view essays page
    header("Location: view_essays.php?court=" . urlencode($court));
    exit();
} else {
    // If not a POST request, redirect back to the essay writer
    header("Location: essay_writer.html");
    exit();
}
?>