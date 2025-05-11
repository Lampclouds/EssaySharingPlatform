<?php
// view_essays.php

// Start the session to retrieve court information
session_start();

// Get the court from the query parameter
$court = $_GET['court'] ?? 'Unknown Court';

// Read the essays from the file
$essays = file('essays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$filteredEssays = array_filter($essays, function($entry) use ($court) {
    return strpos($entry, "Court: $court") !== false; // Filter essays by court
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essays for <?php echo htmlspecialchars($court); ?></title>
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
        <h1>Essays for <?php echo htmlspecialchars($court); ?></h1>
        <div>
            <?php if (empty($filteredEssays)): ?>
                <p>No essays submitted for this court yet.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($filteredEssays as $essay): ?>
                        <li><?php echo nl2br(htmlspecialchars($essay)); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <a href="essay_writer.html?court=<?php echo urlencode($court); ?>">Back to Essay Writer</a>
    </div>
</body>
</html>