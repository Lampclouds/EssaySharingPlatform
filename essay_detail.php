<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Get the court and index from the query parameters
$court = $_GET['court'] ?? 'Unknown Court';
$index = $_GET['index'] ?? 0;

// Read the essays from the file
$essays = file('essays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$essay = $essays[$index] ?? 'Essay not found.';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essay Detail</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .container {
            width: 80%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Essay for <?php echo htmlspecialchars($court); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($essay)); ?></p>
        <a href="view_essays.php?court=<?php echo urlencode($court); ?>" class="button">Back to Essays</a>
    </div>
</body>
</html>