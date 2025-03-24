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
function getNextAvailableId($conn) {
    $sql = "SELECT MAX(ID) as id FROM teachers";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['id'] + 1;
}

// Handle form submission to insert a new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = getNextAvailableId($conn); // Use the function to get the next ID
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $age = $_POST['Age'];
    $qualification = $_POST['Qualification'];
    $teach = $_POST['Teaching_Period_Number'];
    $class = $_POST['Classes'];
    $salary = $_POST['Salary'];
    // Insert data into teachers table
    $sql = "INSERT INTO teachers (ID, Name, Address, Age, Qualifications, Teaching_Period_Number, Classes, Salary)
            VALUES ('$id', '$name', '$address', '$age', '$qualification', '$teach', '$class', '$salary')";
    
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
    <title>Add Teacher</title>
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
    <h1>Add Teacher</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="ID" placeholder="ID" required>
        <input type="text" name="Name" placeholder="Name" required>
        <input type="text" name="Address" placeholder="Address" required>
        <input type="text" name="Age" placeholder="Age" required>
        <input type="text" name="Qualification" placeholder="Qualification" required>
        <input type="number" name="Teaching_Period_Number" placeholder="Teaching Period Number" required>
        <input type="text" name="Classes" placeholder="Classes" required>
        <input type="number" name="Salary" placeholder="Salary" required>
        <button type="submit" name="submit">Add Teacher</button>
    </form>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
