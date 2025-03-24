<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "sql101.infinityfree.com";
$username = "if0_37651574";
$password = "uktOtw3Ai23wUw";
$dbname = "if0_37651574_admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to delete a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    if (isset($_POST['roll_no'])) {
        $roll_no = $_POST['roll_no'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM class_1 WHERE Roll_no = ?");
        $stmt->bind_param("s", $roll_no);

        // Execute the statement
         if ($stmt->execute() === TRUE) {
            // Reorder the roll numbers
            $conn->query("SET @count = 0");
            $conn->query("UPDATE class_1 SET Roll_no = @count:= @count + 1");
            $conn->query("ALTER TABLE class_1 AUTO_INCREMENT = 1");

            // Perform JavaScript redirection
            echo "<script>alert('Student record deleted successfully.');
                  window.location.href = 'class1.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: roll_no is not set.";
    }
}

// Handle search form submission
$search_query = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search_query = $_GET['search_query'];
}

// Handle form submission to add a new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $address = $_POST['address'];
    $father_name = $_POST['father_name'];
    $contact_no = $_POST['contact_no'];
    $total_fees = $_POST['total_fees'];
    $cleared_fees = $_POST['cleared_fees'];

    // Function to generate a new roll number
    function generate_new_roll_number($conn) {
        $new_roll_no = generate_unique_roll_number(); // Implement your logic to generate a unique roll number
        
        // Check if the new_roll_no already exists
        $stmt_check = $conn->prepare("SELECT Roll_no FROM class_1 WHERE Roll_no = ?");
        $stmt_check->bind_param("s", $new_roll_no);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // If still exists (very unlikely), recursively call until a unique one is found
            $new_roll_no = generate_new_roll_number($conn);
        }

        return $new_roll_no;
    }

    // Check if Roll_no already exists
    $stmt_check = $conn->prepare("SELECT Roll_no FROM class_1 WHERE Roll_no = ?");
    $stmt_check->bind_param("s", $roll_no);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Roll_no already exists, generate a new one
        $roll_no = generate_new_roll_number($conn);
    }

    // Insert the student record
    $stmt_insert = $conn->prepare("INSERT INTO class_1 (Name, Roll_no, Address, Father_name, Contact_no, Total_fees, Cleared_Fees)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sssssss", $name, $roll_no, $address, $father_name, $contact_no, $total_fees, $cleared_fees);

    if ($stmt_insert->execute() === TRUE) {
        // Redirect or show success message
        echo "<script>alert('Student record added successfully.');
              window.location.href = 'class1.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Class 1</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .roboto-thin {
  font-family: "Roboto", sans-serif;
  font-weight: 100;
  font-style: normal;
}

.roboto-light {
  font-family: "Roboto", sans-serif;
  font-weight: 300;
  font-style: normal;
}

.roboto-regular {
  font-family: "Roboto", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.roboto-medium {
  font-family: "Roboto", sans-serif;
  font-weight: 500;
  font-style: normal;
}

.roboto-bold {
  font-family: "Roboto", sans-serif;
  font-weight: 700;
  font-style: normal;
}

.roboto-black {
  font-family: "Roboto", sans-serif;
  font-weight: 900;
  font-style: normal;
}

.roboto-thin-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 100;
  font-style: italic;
}

.roboto-light-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 300;
  font-style: italic;
}

.roboto-regular-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 400;
  font-style: italic;
}

.roboto-medium-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 500;
  font-style: italic;
}

.roboto-bold-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 700;
  font-style: italic;
}

.roboto-black-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 900;
  font-style: italic;
}
body
{
    background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url("pexels-enginakyurt-2943603.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    overflow-x: hidden;
}
        .navbar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)), url("a-pattern-with-faint-icons-representing-school-ele-CiCnJIJsQeuxkCZ5v-Ht4Q-ADgZ22XASwy07QYn9iCEPg.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 20px;
            border-right: 1px solid #ddd;
        }
        .navbar a, .dropdown a {
            display: block;
            color: white;
            background-color: #4CAF50;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin: 10px;
            border-radius: 5px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 14px 16px;
            text-decoration: none;
            text-align: left;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .content {
            margin-left: 220px;
            width: calc(100% - 220px);
            padding: 20px;
        }
        .container {
            margin-left: 200px;
            padding: 20px;
            width: 85vw;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
       .h2
        {
            margin-left: 50%;
            box-sizing: border-box;
            text-align: right;
            width: fit-content;
            height: fit-content;
            transform: translate(-50%,0);
            color: white;
    border-radius: 5px;
    font-family: Roboto;
        }
        .search-box {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right:5vw; 

        }
        .search-box input[type="text"] {
            padding: 5px;
            font-size: 16px;
            margin-right: 15px;
            border: none;
            border-radius: 10px;
        }
        .search-box button {
            padding: 5px 10px;
            font-size: 16px;
            margin-right:5px;
            cursor: pointer;
        }
        .table-container {
            align-items: center;
            margin-left: 50%;
            transform: translate(-50%,0);
            padding: 0;
            width: 95%;
            max-width: 95%;
        }
        table {
            font-family: poppins;
            font-weight:450;
            font-size:20px;
            width: 100%;
            border-collapse: collapse;
            border-bottom:1px solid black;
            justify-content: center;
            text-align: center;
            background: transparent;
            border-radius: 5p%;
        }
        table td {
            padding: 12px;
            background: #f2f2f2;
            border-bottom: 1px solid #ddd;
            width: fit-content;
        }
        th {
            background-color: #4CAF50;
            color: white;
            height: 50px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
        }
        .edit-button {
            background-color: #4CAF50;
            border: none;
            color: white; 
            padding: 10px 20px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 16px; 
            margin: 4px 2px; 
            cursor: pointer; 
            border-radius: 8px; 
        }
        .edit-button:hover
        {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            transition: 0.4s ease;
        }
        button.delete {
            background-color: #f44336;
        }
        button.delete:hover
        {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            transition: 0.4s ease;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="Group selector.html">Home</a>
        <div class="dropdown">
            <a href="#" class="aa">Classes</a>
            <div class="dropdown-content">
                <a href="class1.php">Class 1</a>
                <a href="class2.php">Class 2</a>
                <a href="class3.php">Class 3</a>
                <a href="class4.php">Class 4</a>
                <a href="class5.php">Class 5</a>
                <a href="class6.php">Class 6</a>
                <a href="class7.php">Class 7</a>
                <a href="class8.php">Class 8</a>
                <a href="class9.php">Class 9</a>
                <a href="class10.php">Class 10</a>
            </div>
        </div>
        <a href="add_student.php">Add New Student</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="header">
            <div class="h2">
            <h1>Class 1</h2>
            </div>
            <form method="GET" action="" class="search-box">
                <input type="text" name="search_query" placeholder="Search by Name" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Address</th>
                    <th>Father's Name</th>
                    <th>Contact No</th>
                    <th>Total Fees</th>
                    <th>Cleared Fees</th>
                    <th>Remaining Fees</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Fetch and display student records based on search query
                $sql = "SELECT Name, Roll_no, Address, Father_name, Contact_no, Total_fees, Cleared_Fees, (Total_fees - Cleared_Fees) AS Remaining_Fees FROM class_1";
                if (!empty($search_query)) {
                    $sql .= " WHERE Name LIKE ?";
                }
                $sql .= " ORDER BY Roll_no ASC";  // Add this line to order by Roll_no in ascending order
                $stmt = $conn->prepare($sql);
                if (!empty($search_query)) {
                    $search_param = "%" . $search_query . "%";
                    $stmt->bind_param("s", $search_param);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Roll_no']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Father_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Contact_no']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Total_fees']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Cleared_Fees']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Remaining_Fees']) . "</td>";
                        echo "<td>
                                <form method='GET' action='update_form1.php' style='display:inline;'>
                                    <input type='hidden' name='roll_no' value='" . htmlspecialchars($row['Roll_no']) . "'>
                                    <button class='edit-button' type='submit' name='edit'>Edit</button>
                                </form>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='roll_no' value='" . htmlspecialchars($row['Roll_no']) . "'>
                                    <button class='delete' type='submit' name='delete'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
