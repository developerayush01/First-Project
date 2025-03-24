<!DOCTYPE html>
<html>
<head>
    <title>Teachers List</title>
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
            justify-content:center;
            text-align:center;
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
                <a href="add new teacher.php">Add Teacher</a>
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
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="header">
        <div class="h2">
            <h1>Teachers List</h1>
            </div>
            <div class="search-box">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by name">
                    <button type="submit">Search</button>
                </form>
                </div>
            </div>
        
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Qualifications</th>
                    <th>Age</th>
                    <th>Teaching Period Number</th>
                    <th>Classes</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
                <?php
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

                $sql = "SELECT * FROM teachers";
                if (isset($_GET['search'])) {
                    $search = $conn->real_escape_string($_GET['search']);
                    $sql .= " WHERE Name LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Address"] . "</td>";
                        echo "<td>" . $row["Qualifications"] . "</td>";
                        echo "<td>" . $row["Age"] . "</td>";
                        echo "<td>" . $row["Teaching_Period_Number"] . "</td>";
                        echo "<td>" . $row["Classes"] . "</td>";
                        echo "<td>" . $row["Salary"] . "</td>";
                        echo "<td>
                                <a href='teacher update.php?id=" . $row["ID"] . "' class='edit-button'>Edit</a> 
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row["ID"] . "'>
                                    <button class='delete' type='submit' name='delete'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
