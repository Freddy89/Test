<?php
	$connect = mysqli_connect('freddy89.mysql.tools', 'freddy89_test', '50l^f-6jYI', 'freddy89_test');
	mysqli_query($connect, "set names 'utf8'");
	session_start();
?>
<div class="row">
	<?php
		if($_SESSION['user'] == ''){
	?>
	<div class="col-md-2">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Вхід</button>
	</div>
	<?php }else{ ?>
	<div class="col-md-2">
		<?php echo $_SESSION['user']; ?>
		<button id="logout" type="button" class="btn btn-success">Вихід</button>
	</div>
	<?php } ?>
	<div class="col-md-8"></div>
	<div class="col-md-2">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">Додати задачу</button>
	</div>
</div>
<div class="row" style="margin-top: 10px;">
	<div class="col-md-12">
		<table id="tasks_table" class="table table-bordered table-striped" style="width:100%;">
			<thead>
				<tr>
					<th>#</th>
					<th>Ім'я</th>
					<th>Email</th>
					<th>Текст</th>
					<th>Статус</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;

					$select = mysqli_query($connect, "SELECT * FROM tasks");
					while($get = mysqli_fetch_array($select))
					{
						$i++
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $get['name']; ?></td>
							<td><?php echo $get['email']; ?></td>
							<td><?php echo $get['text']; ?></td>
							<td><?php echo $get['status']; ?></td>
							<td>
								<?php
									if($_SESSION['user'] != ''){
										?>
										<button data-id="<?php echo $get[id]; ?>" type="button" class="btn btn-primary editTaskRow">Редагувати</button>
										<?php
									}
									if($get['admin'] == '1'){
											echo "<br><b>Відредаговано адміном</b>";
										}
								?>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addTaskLabel">Додати задачу</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label><b>Ім'я</b></label>
					<input id="addName" class="form-control" type="text" placeholder="Введіть ім'я">
				</div>
				<div class="form-group">
					<label><b>Email</b></label>
					<input id="addEmail" class="form-control" type="text" placeholder="Введіть email">
				</div>
				<div class="form-group">
					<label><b>Текст</b></label>
					<textarea id="addText" class="form-control" placeholder="Введіть текст" height="200"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
				<button id="addTask" class="btn btn-primary">Зберегти</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editTaskModal">Редагувати задачу</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label><b>Статус</b></label>
					<select id="statusTask" class="form-control">
						<option value="Створено">Створено</option>
						<option value="Виконано">Виконано</option>
					</select>
				</div>
				<div class="form-group">
					<label><b>Текст</b></label>
					<textarea id="editText" class="form-control" placeholder="Введіть текст" height="200"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
				<button id="saveTask" class="btn btn-primary">Зберегти</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="loginModalLabel">Вхід</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label><b>Логін</b></label>
					<input id="login" class="form-control" type="text" placeholder="Введіть ім'я">
				</div>
				<div class="form-group">
					<label><b>Пароль</b></label>
					<input id="password" class="form-control" type="text" placeholder="Введіть email">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
				<button id="go_login" class="btn btn-primary">Вхід</button>
			</div>
		</div>
	</div>
</div>