<!DOCTYPE html>
<html>
<head>
    <title>Redirect Button</title>
</head>
<body>
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
<div id="update-form">
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
                <input type="text" name="roll_no" placeholder="Roll no" value="<?php echo $roll_no; ?>" readonly>
                <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required>
                <input type="text" name="father_name" placeholder="Father Name" value="<?php echo $father_name; ?>" required>
                <input type="text" name="contact_no" placeholder="Contact No" value="<?php echo $contact_no; ?>" required>
                <input type="number" name="total_fees" placeholder="Total Fees" value="<?php echo $total_fees; ?>" required>
                <input type="number" name="cleared_fees" placeholder="Cleared Fees" value="<?php echo $cleared_fees; ?>" required>
                <button type="submit" name="update">Update Student</button>
            </form>
        </div>
        <?php } ?>
        </body>
        </html>