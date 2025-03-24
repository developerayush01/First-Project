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

// Handle form submission to delete a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    if (isset($_POST['roll_no'])) {
        $roll_no = $_POST['roll_no'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM class_7 WHERE Roll_no = ?");
        $stmt->bind_param("s", $roll_no);

          if ($stmt->execute() === TRUE) {
            // Reorder the roll numbers
            $conn->query("SET @count = 0");
            $conn->query("UPDATE class_7 SET Roll_no = @count:= @count + 1");
            $conn->query("ALTER TABLE class_7 AUTO_INCREMENT = 1");

            echo "<script>alert('Student record deleted and roll numbers updated.');
                  window.location.href = 'class7.php';</script>";
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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Class Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
body
{
    background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url("pexels-enginakyurt-2943603.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
            border-radius: 5%;
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
            <a href="#">Classes</a>
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
        <a href="add_student7.php">Add New Student</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="header">
        <div class="h2">
            <h1>Class 7</h2>
            </div>
            <div class="search-box">
                <form method="GET" action="">
                    <input type="text" name="search_query" placeholder="Search by name..." value="<?php echo isset($search_query) ? htmlspecialchars($search_query) : ''; ?>">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Address</th>
                    <th>Father Name</th>
                    <th>Contact No</th>
                    <th>Total Fees</th>
                    <th>Cleared Fees</th>
                    <th>Remaining Fees</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Fetch and display student records based on search query
                $sql = "SELECT Name, Roll_no, Address, Father_name, Contact_no, Total_fees, Cleared_Fees, (Total_fees - Cleared_Fees) AS Remaining_Fees FROM class_7";
                if (!empty($search_query)) {
                    $sql .= " WHERE Name LIKE ?";
                }
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
                                <form method='GET' action='update_form7.php' style='display:inline;'>
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
