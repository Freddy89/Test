<?php
	$connect = mysqli_connect('freddy89.mysql.tools', 'freddy89_test', '50l^f-6jYI', 'freddy89_test');
	mysqli_query($connect, "set names 'utf8'");

	$name = mysqli_real_escape_string($connect, $_POST['name']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$text = mysqli_real_escape_string($connect, htmlspecialchars($_POST['text']));

	$insert = mysqli_query($connect, "INSERT INTO tasks (name,email,text,status) VALUES ('$name','$email','$text','Створено')");
	if($insert == TRUE){
		echo "Успішно створено !!!";
	}else{
		echo "Задача не створена !!!";
	}
?>