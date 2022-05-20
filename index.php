<?php 

$error= "";
//sambung mysql
$db= mysqli_connect('localhost', 'root' , '', 'to do');

if (isset($_POST['submit'])) {
	$task= $_POST['task'];
	if (empty($task)) {
		$error= "isi dulu listnya!";
	}else{
		mysqli_query($db , "INSERT INTO tasks (task) VALUES ('$task')");
	header('Location: index.php');
	}
}

//hapus tugas di list
if (isset($_GET['del'])) {
	$id= $_GET['del'];
	mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
	header("Location: index.php");
}

//tampilin database
$tasks = mysqli_query($db, "SELECT * FROM tasks");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Produktif-List</title>
</head>
<body>
	<div class="container">
	<link rel="stylesheet" type="text/css" href="style.css">
<div class="todo">
  <h1 calss='judul'>To Do List App</h1>
</div>

<form action="index.php" method="POST">
<?php if (isset($error)):?>
	<p><?= $error ?></p>
<?php endif; ?>
  <input  class="task_input" type="text" name="task">
  <button class="btn" type="submit" name="submit">Tambah</button>
</form>

<table>
	<thead>
		<tr>
		<th>No.</th>
		<th>Task</th>
		<th>del</th>
		</tr>
	</thead>

	<tbody>
		<?php $i= 1;while ($row = mysqli_fetch_array($tasks)): ?>
		<tr>
		<td><?= $i; ?></td>
		<td class="task"><?= $row['task']; ?></td>
		<td class="delete"><a href="index.php?del=<?= $row['id']; ?>">x</a> </td>
		</tr>
		<?php $i++; ?>
		<?php endwhile;  ?>
	</tbody>
</table>

<div class="space"><br></div>
<div class="footer">
	<p>ceritanya ada konteny hehe-</p>
  <h5>Copyright2022©ByArip</h5>
</div>
</div>
</body>
</html>