<?php
$conn=mysqli_connect("localhost","root","","vadmin");
// session_start();

if(isset($_POST['register']))
{
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	// echo $repassword;
	// echo $password;

	// $repassword=$_POST['repassword'];
	// if ($password==$repassword) {
	// 	// header("Location:register.php?q=6");
	// }
  	$sql_e = "SELECT * FROM admin WHERE email='$email'";
  	$res_e = mysqli_query($conn, $sql_e);
  	if(mysqli_num_rows($res_e) > 0)
  	{
		header("Location:register.php?q=6");  		
  	}else{
	
	$query="INSERT INTO `admin`(`name`, `phone`, `email`, `password`) VALUES ('$name','$phone','$email','$password')";
	$res=mysqli_query($conn,$query);
	if ($res){
		 header("Location:login.php");
	}
}
}
elseif (isset($_POST['login'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];	
	$query="SELECT * FROM `admin` WHERE email='$email' AND password='$password'";
	$res=mysqli_query($conn,$query);
	$post=mysqli_fetch_all($res);
	if($post)
	{
		session_start();
		echo $email;
		$_SESSION['email']=$email;
		
		$_SESSION['password']=$password;
		
		header("Location:tables.php?q=0");
	}
	else
	{
		
		 header("Location:login.php?q=1");
	}
}
elseif(isset($_POST['contact']))
{
		echo "HELLO";
	$date=date("d-m-Y G:i:s");
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$query="INSERT INTO `contact`(`name`, `email`, `phone`, `message`,`date`) VALUES ('$name','$email','$phone','$message','$date')";
	$res=mysqli_query($conn,$query);
	if ($res) {
		header("Location:../contact.php?q=3");
		# code...
	}
	else
	{
		echo "string";
	}
	
}
elseif(isset($_POST['index_contact']))
{
	$date=date("d-m-Y G:i:s");
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$query="INSERT INTO `contact`(`name`, `email`, `phone`, `message`,`date`) VALUES ('$name','$email','$phone','$message','$date')";
	$res=mysqli_query($conn,$query);
	if ($res) {
		header("Location:../index.php?q=3");
		# code...
	}

}elseif ($_GET['q']==5) {
	session_destroy();
	session_unset();
	header("Location:index.php");
}

?>