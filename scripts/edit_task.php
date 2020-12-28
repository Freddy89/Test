<?php
	session_start();
	$connect = mysqli_connect('freddy89.mysql.tools', 'freddy89_test', '50l^f-6jYI', 'freddy89_test');
	mysqli_query($connect, "set names 'utf8'");

	$id = mysqli_real_escape_string($connect, $_POST['id']);
	$status = mysqli_real_escape_string($connect, $_POST['status']);
	$text = mysqli_real_escape_string($connect, htmlspecialchars($_POST['text']));

	if($_SESSION['user'] != ''){
		$check_text = mysqli_query($connect, "SELECT * FROM tasks WHERE id = '$id'");
		$get_text = mysqli_fetch_array($check_text);
		if($text != $get_text['text']){
			$update = mysqli_query($connect, "UPDATE tasks SET status = '$status', text = '$text', admin = '1' WHERE id = '$id'");
		}else{
			$update = mysqli_query($connect, "UPDATE tasks SET status = '$status', text = '$text' WHERE id = '$id'");
		}
		if($update == TRUE){
			echo "Дані оновлено !!!";
		}else{
			echo "Дані не оновлено !!!";
		}
	}else{
		echo "Увійдіть під адміном !!!";
	}
?>