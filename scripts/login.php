<?php
	$connect = mysqli_connect('freddy89.mysql.tools', 'freddy89_test', '50l^f-6jYI', 'freddy89_test');
	mysqli_query($connect, "set names 'utf8'");

	$login = mysqli_real_escape_string($connect, $_POST['login']);
	$pass = mysqli_real_escape_string($connect, $_POST['pass']);

	$select = mysqli_query($connect, "SELECT * FROM users WHERE login = '$login' AND password = '$pass'");
	$count = mysqli_num_rows($select);

	if($count > 0){
		session_start();
		$_SESSION['user'] = $login;
		echo "Успішний вхід !!!";
	}else{
		echo "Невірні дані !!!";
	}
?>