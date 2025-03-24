<?php
$servername="localhost";
$username="root";
$password="";
$dbname="admin";

$conn=mysqli_connect($servername,$username,$password,$dbname);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
if(isset($_POST['signup']))
$Email= $_POST['email'];
$pass= $_POST['password'];

$sql="INSERT INTO signup(email,pass) VALUES ('$Email','$pass')";

if (mysqli_query($conn,$sql))
{
    echo header("location:login.php");
} else {
    echo "Error: " . $sql.mysqli_error($conn);
}
{
mysqli_close($conn);
}
?>
