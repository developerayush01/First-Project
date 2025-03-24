<!DOCTYPE html>
<html>
<head>
    <title>Update Teacher</title>
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
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Update Teacher</h1>

 <?php
            // Database connection
            $servername = "localhost";
            $username = "root";  // Replace with your actual username
            $password = "";  // Replace with your actual password
            $dbname = "admin";    // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "SELECT * FROM teachers WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <div class="form-container">
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                Name: <input type="text" name="Name" value="<?php echo htmlspecialchars($row['Name']); ?>" required><br>
                Address: <input type="text" name="Address" value="<?php echo htmlspecialchars($row['Address']); ?>" required><br>
                Qualifications: <input type="text" name="Qualifications" value="<?php echo htmlspecialchars($row['Qualifications']); ?>" required><br>
                Teaching Period Number: <input type="text" name="Teaching_Period_Number" value="<?php echo htmlspecialchars($row['Teaching_Period_Number']); ?>" required><br>
                Classes: <input type="text" name="Classes" value="<?php echo htmlspecialchars($row['Classes']); ?>" required><br>
                Salary: <input type="text" name="Salary" value="<?php echo htmlspecialchars($row['Salary']); ?>" required><br>
                <input type="submit" name="update" value="Update">
            </form>
        </div>

        <?php
    } else {
        echo "No record found";
    }
}

if (isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['Name']);
    $address = $conn->real_escape_string($_POST['Address']);
    $qualifications = $conn->real_escape_string($_POST['Qualifications']);
    $teaching_period_number = $conn->real_escape_string($_POST['Teaching_Period_Number']);
    $classes = $conn->real_escape_string($_POST['Classes']);
    $salary = $conn->real_escape_string($_POST['Salary']);

    $sql = "UPDATE teachers SET 
            Name='$name', 
            Address='$address', 
            Qualifications='$qualifications', 
            Teaching_Period_Number='$teaching_period_number', 
            Classes='$classes', 
            Salary='$salary' 
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        if ($stmt->execute() === TRUE) {
        echo "<script>alert('Student record updated successfully.');
              window.location.href = 'teachers update.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
}
?>
</body>
</html>
