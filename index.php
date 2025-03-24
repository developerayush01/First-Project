<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration
$servername = "sql101.infinityfree.com";
$username = "if0_37651574";
$password = "uktOtw3Ai23wUw";
$dbname = "if0_37651574_admin";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$error = "";

// Get the posted username and password
if (isset($_POST["signup"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email already exists
    $query = "SELECT * FROM signup WHERE Email =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already exists. Please try a different email.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO signup (Email, pass) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $hashed_password);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: login.php"); // Redirect to the login page
        exit;
    }

    $stmt->close();
}
$conn->close();
?>

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
            font-family: 'Poppins', sans-serif;
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
            font-size: 2.5rem;
            font-weight: 700;
            color: black;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: black;
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
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
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-container input[type="email"]:focus,
        .form-container input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
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
            color: black;
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
    <div class="form-container">
        <h2>Sign Up</h2>
        <form action=# method="POST">
            <div class="text">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <br>
                <?php if (!empty($error)) {?>
                    <span style="color:red;"><?php echo $error;?></span>
                <?php }?>
                <br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="submit" value="Sign Up" name="signup">
                <br>
                <br>
            </div>
        </form>
            <p class="center-text">Already have an account? <a href="login.php">Login Here</a></p>
    </div>
</body>
</html>