<?php
session_start();

//cek cookie
if (isset($_COOKIE['wkwk']) && isset($_COOKIE['awokwok'])) {
	$id = $_COOKIE['wkwk'];
	$key = $_COOKIE['awokwok'];

	//ambil username dari id
	$result = mysqli_query($con, "SELECT username FROM security WHERE username = $id");

	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if ($key === $row["password"]) {
		$_SESSION['login'] = true;
	}
}

if(isset($_SESSION["login"])){
	header("Location: index.php");
	exit;
}

require 'dbconnect.php';

if ( isset($_POST["login"]) ) {

	$username=$_POST["username"];
	$password=$_POST["password"];

	$result = mysqli_query($con, "SELECT * FROM security WHERE username = '$username'");

	//cek username
	if (mysqli_num_rows($result) === 1){

		//cek password
		$row = mysqli_fetch_assoc($result);
		if( $password == $row["password"]){
			//set session
			$_SESSION["login"] = true;

			$_SESSION["name"] = $row["username"];

			//cek ingat saya
			if (isset($_POST['ingat'])) {
				//buat cookie
				setcookie('wkwk', $row['username'], time() + 1800);
				setcookie('awokwok', $row['password'], time() + 1800);
			}

			header("Location: index.php");
			exit;
		}
	}
}
?>
