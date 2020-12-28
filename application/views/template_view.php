<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Тестове завдання</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
	</head>
	<body>
		<div id="wrapper">
			<div class="container">
				<div class="row"></div>
				<div class="row">
				<div class="col-md-12">
					<?php include 'application/views/'.$content_view; ?>
				</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<a href="/">Тестове завдання</a> &copy; 2020</a>
		</div>


		<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#tasks_table').DataTable({
					"responsive": true,
					"ordering": true,
					"lengthMenu": [[2, 10, 20, -1], [2, 10, 20, 'Todos']],
					"bLengthChange" : false,
    				"bInfo":false,
    				"searching": false
				});

				function validateEmail(email) {
					const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					return re.test(email);
				}

				$("#addTask").click(function(){
					var name = $("#addName").val();
					var email = $("#addEmail").val();
					var text = $("#addText").val();

					if(name != '' && email != '' && text != ''){
						if (validateEmail(email)) {
							$.post( "../../scripts/add_task.php", { name: name, email: email, text: text })
							.done(function( data ) {
								if(data != ''){
									alert(data);
									location.reload();
								}
							});
						}else{
							alert("Введіть правильний email !!!");
						}
					}else{
						alert("Заповніть всі дані !!!");
					}
				});

				$("#go_login").click(function(){
					var login = $("#login").val();
					var pass = $("#password").val();

					if(login != '' && pass != ''){
						$.post( "../../scripts/login.php", { login: login, pass: pass })
						.done(function( data ) {
							if(data != ''){
								alert(data);
								location.reload();
							}
						});
					}else{
						alert("Заповніть всі дані !!!");
					}
				});

				var id = 0;
				$("table").on("click", ".editTaskRow", function() {
					id = $(this).attr("data-id");
					var listChilds = $(this).closest('tr').children();
					var text = $(listChilds[3]).text();
					var status = $(listChilds[4]).text();

					$("#statusTask").val(status);
					$("#editText").val(text);

					$('#editTaskModal').modal('show');
				});

				$("#saveTask").click(function(){
					var text = $("#editText").val();
					var status = $("#statusTask").val();

					if(text != ''){
						$.post( "../../scripts/edit_task.php", { id: id, text: text, status: status })
						.done(function( data ) {
							if(data != ''){
								alert(data);
								location.reload();
							}
						});
					}else{
						alert("Заповніть всі дані !!!");
					}
				});

				$("#logout").click(function(){
					$.post( "../../scripts/logout.php", function( data ) {
						if(data != ''){
							alert(data);
							location.reload();
						}
					});
				});
			});
		</script>

	</body>
</html>