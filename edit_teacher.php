<?php
// Connect to the database
$servername = "sql101.infinityfree.com";
$username = "if0_37651574";
$password = "uktOtw3Ai23wUw";
$dbname = "if0_37651574_admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Fetch the teacher details
$sql = "SELECT * FROM teachers WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["Name"];
    $subject = $row["Subject"];
} else {
    echo "No results found for ID: $id";
    exit;
}
$stmt->close();

// Handle form submission to update a teacher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    
    $sql = "UPDATE teachers SET Name=?, Subject=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $subject, $id);
    
    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher</title>
</head>
<body>
    <h1>Edit Teacher</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
        <label for="subject">Subject:</label>
        <input type="text" name="subject" value="<?php echo htmlspecialchars($subject); ?>" required><br>
        <button type="submit" name="update">Update Teacher</button>
    </form>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
