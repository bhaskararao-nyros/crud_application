<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<?php include('connection.php'); 
//fetch the record to be updated
	if(isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$edit_state = true;
		$fetch = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
		$record = mysqli_fetch_array($fetch);
		$id = $record['id'];
		$name = $record['name'];
		$age = $record['age'];
	}
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD App</title>
</head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
<body>
<h3 class="text-center">Crud on User's Table</h3>
<div class="container-fluid">
	<div class="row">
	  <form action="" method="post" style="padding: 15px;">
	  	Search user: <input type="text" name="searchUser" placeholder="Enter username to search">
	  				<input type="submit" name="submit" value="Search"><br>
	  				<span class="text-danger"><?php echo $searchErr; ?></span>
	  </form>
		<div class="col-md-8">
			<div class="panel panel-default">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><a href="crud.php?sorting=<?=$sort;?>&field=id">User id</a></th>
							<th><a href="crud.php?sorting=<?=$sort;?>&field=name">User name</a></th>
							<th><a href="crud.php?sorting=<?=$sort;?>&field=age">User age</a></th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php while ($row = mysqli_fetch_array($records)) { ?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['age']; ?></td>
							<td><a href="crud.php?edit=<?php echo $row['id']; ?>"><button class="btn btn-primary btn-xs">Edit</button></a></td>
							<td><a href="connection.php?del=<?php echo $row['id']; ?>"><button class="btn btn-danger btn-xs">Delete</button></a></td>
							
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>	<!-- panel ending -->
		</div>  <!-- col-md-8 ending -->
		<div class="col-md-4">
			<div class="panel panel-default rightpanel">
			  <form method="post" action="">
			  	<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label for="User name">Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo $name; ?>">
					<span class="error"><?php echo $nameErr; ?></span>
				</div>
				<div class="form-group">
					<label for="User age">Age</label>
					<input type="text" name="age" class="form-control" placeholder="Enter your age" value="<?php echo $age; ?>">
					<span class="error"><?php echo $ageErr; ?></span>
				</div>
				<?php if ($edit_state == false): ?>
					<button class="btn btn-success" name="insert">Save</button>
				<?php else: ?>
					<button class="btn btn-primary" name="update">Update</button>
				<?php endif ?>
			  </form>
			</div>  <!-- panel ending -->
		</div>  <!-- col-md-4 ending -->			
	</div>  <!-- row ending -->
		<?php if (isset($_SESSION['msg'])): ?>
			<div class="alert alert-success text-center">
				<?php
				echo $_SESSION['msg'];
				?>
			</div>
		<?php endif ?>
</div>  <!-- container-fluid ending -->
</body>
</html>
