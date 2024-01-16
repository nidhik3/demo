<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $industry = isset($_POST["industry"]) ? implode(", ", $_POST["industry"]) : '';
    $city = isset($_POST["city"]) ? $_POST["city"] : '';

    // Query to fetch data based on industry and city
    $sql = "SELECT * FROM dataset WHERE industry LIKE '%$industry%' AND city = '$city'";
    $result = $conn->query($sql);

    // Display data
    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Company Name</th><th>Owner Name</th><th>Industry</th><th>City</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["company_name"]."</td><td>".$row["owner_name"]."</td><td>".$row["industry"]."</td><td>".$row["city"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No matching records found";
    }
}

// Close the database connection
$conn->close();
?>
