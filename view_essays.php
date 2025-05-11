<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        .essay-link {
            color: blue; /* Essay link color */
            text-decoration: underline; /* Underline for links */
            cursor: pointer; /* Pointer cursor on hover */
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
                    <?php foreach ($filteredEssays as $index => $essay): ?>
                        <li>
                            <a href="essay_detail.php?court=<?php echo urlencode($court); ?>&index=<?php echo $index; ?>" class="essay-link">
                                <?php echo nl2br(htmlspecialchars($essay)); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <a href="index.html" class="button">Back to Home</a> <!-- Updated back button -->
    </div>
</body>
</html>