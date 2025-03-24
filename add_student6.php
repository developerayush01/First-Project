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

// Handle form submission to insert a new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $address = $_POST['address'];
    $father_name = $_POST['father_name'];
    $contact_no = $_POST['contact_no'];
    $total_fees = $_POST['total_fees'];
    $cleared_fees = $_POST['cleared_fees'];
    
    $sql = "INSERT INTO class_6 (Name, Roll_no, Address, Father_name, Contact_no, Total_fees, Cleared_Fees)
            VALUES ('$name', '$roll_no', '$address', '$father_name', '$contact_no', '$total_fees', '$cleared_fees')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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
    <h1>Add Student</h1>
    <div class="form-container">
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="roll_no" placeholder="Roll no" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="father_name" placeholder="Father Name" required>
        <input type="text" name="contact_no" placeholder="Contact No" required>
        <input type="number" name="total_fees" placeholder="Total Fees" required>
        <input type="number" name="cleared_fees" placeholder="Cleared Fees" required>
        <button type="submit" name="submit">Add Student</button>
    </form>
</div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>