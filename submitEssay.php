<div class="navbar">
    <a href="index.html">Home</a>
    <a href="court_selection_write.html">Write</a>
    <a href="court_selection_read.html">Read Essays</a>
</div>
<?php
// Assuming you have a function to save essays
function saveEssay($court, $title, $content) {
    // Connect to your database
    $conn = new mysqli("localhost", "username", "password", "database_name");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO essays (court, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $court, $title, $content);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the specific reading page for that court
        header("Location: view_essays.php?court=" . urlencode($court));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}

// Get the form data
$court = $_GET['court'];
$title = $_POST['title']; // Assuming you have a title field
$content = $_POST['essay'];

// Save the essay
saveEssay($court, $title, $content);
?>