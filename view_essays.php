 <div class="navbar">
    <a href="index.html">Home</a>
    <a href="court_selection_write.html">Write</a>
    <a href="court_selection_read.html">Read Essays</a>
</div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to fetch essays by court
function fetchEssaysByCourt($court) {
    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "your_database_name"); // Update with your actual database name

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch essays for the selected court
    $sql = "SELECT id, title FROM essays WHERE court = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $court);
    $stmt->execute();
    $result = $stmt->get_result();

    $essays = [];
    while ($row = $result->fetch_assoc()) {
        $essays[] = $row;
    }

    // Close the connection
    $stmt->close();
    $conn->close();

    return $essays;
}

// Get the selected court from the query parameter
$court = $_GET['court'] ?? 'Unknown Court';
$essays = fetchEssaysByCourt($court);

// Display the essays
echo "<h2>Essays for $court</h2>";
if (empty($essays)) {
    echo "<p>No essays found for this court.</p>";
} else {
    echo "<ul>";
    foreach ($essays as $essay) {
        echo "<li><a href='essay_detail.php?id={$essay['id']}'>{$essay['title']}</a></li>"; // Link to the essay detail
    }
    echo "</ul>";
}
?>