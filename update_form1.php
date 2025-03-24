<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Initialize variables
$name = $roll_no = $address = $father_name = $contact_no = $total_fees = $cleared_fees = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit'])) {
    $roll_no = $_GET['roll_no'];

    // Fetch the student details
    $sql = "SELECT * FROM class_1 WHERE Roll_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["Name"];
        $address = $row["Address"];
        $father_name = $row["Father_name"];
        $contact_no = $row["Contact_no"];
        $total_fees = $row["Total_fees"];
        $cleared_fees = $row["Cleared_Fees"];
    } else {
        echo "No results found for Roll no: $roll_no";
        exit;
    }
    $stmt->close();
}

// Handle form submission to update a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $father_name = $_POST['father_name'];
    $contact_no = $_POST['contact_no'];
    $total_fees = $_POST['total_fees'];
    $cleared_fees = $_POST['cleared_fees'];
    
    $sql = "UPDATE class_1 SET Name=?, Address=?, Father_name=?, Contact_no=?, Total_fees=?, Cleared_Fees=? WHERE Roll_no=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdds", $name, $address, $father_name, $contact_no, $total_fees, $cleared_fees, $roll_no);
    
     if ($stmt->execute() === TRUE) {
        echo "<script>alert('Student record updated successfully.');
              window.location.href = 'class1.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-container {
            max-width: 30%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="submit"],
        .form-container button[type="submit"] {
            width: 90%;
            padding: 2%;
            margin-bottom: 10px;
            margin-left: 50%;
            transform: translate(-50%,0);
            border: 1px solid grey;
            border-radius: 5px;
        }

        .form-container input[type="submit"],
        .form-container button[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover,
        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Update Student</h1>
    <div class="form-container">
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="text" name="roll_no" placeholder="Roll no" value="<?php echo htmlspecialchars($roll_no); ?>" readonly>
            <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>" required>
            <input type="text" name="father_name" placeholder="Father Name" value="<?php echo htmlspecialchars($father_name); ?>" required>
            <input type="text" name="contact_no" placeholder="Contact No" value="<?php echo htmlspecialchars($contact_no); ?>" required>
            <input type="number" name="total_fees" placeholder="Total Fees" value="<?php echo htmlspecialchars($total_fees); ?>" required>
            <input type="number" name="cleared_fees" placeholder="Cleared Fees" value="<?php echo htmlspecialchars($cleared_fees); ?>" required>
            <button type="submit" name="update">Update Student</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
