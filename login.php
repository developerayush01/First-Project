<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('School.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: black;
            font-size: 1.2rem;
        }

        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="submit"] {
            width: 80%;
            padding: 12px;
            margin-bottom: 15px;
            margin-top: 5px;
            border: 1px solid black;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: black;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-container input[type="email"]:focus,
        .form-container input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.3);
            border: 1px solid #007bff;
            outline: none;
        }

        .form-container input[type="submit"] {
            background-color: rgba(0, 123, 255, 0.7);
            width: 30%;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 5px;
            font-size: 1.2rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: rgba(0, 123, 255, 1);
        }

        .error {
            color: #f44336;
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .text {
            text-align: center;
        }

        .center-text {
            text-align: center;
            font-size: 1rem;
            color: white;
            font-weight: 400;
        }

        a {
            color: rgba(0, 123, 255, 0.9);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: rgba(0, 123, 255, 1);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Configuration
    $servername = "sql101.infinityfree.com";
$username = "if0_37651574";
$password = "uktOtw3Ai23wUw";
$dbname = "if0_37651574_admin";// Enter your database password here

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

    // Get the posted username and password
    if (isset($_POST["submit"])) {
        $Email = $_POST["email"];
        $pass = $_POST["password"];
        // Query to retrieve the hashed password from the database
        $query = "SELECT pass FROM signup WHERE Email =?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die('Query failed: '. $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['pass'];
            // Verify the password
            if (password_verify($pass, $hashed_password)) {
                header("Location: Group selector.html");
                exit;
            } else {
                $error = 'Username not found or wrong password';
            }
        } else {
            $error = 'Username not found or wrong password';
        }
        $stmt->close();
    }
    $conn->close();
    ?>
    <div class="form-container">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
            <div class="text">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br>
                                <?php if (isset($error)) {?>
                    <span class="error"><?php echo $error;?></span>
                <?php }?>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>                
                <input type="submit" value="Login" name="submit">
            </div>
        </form>
    </div>
</body>
</html>