<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<?php 
session_start();
	//Initilization of variables
	$name = "";
	$age = "";
	$nameErr = "";
	$ageErr = "";
	$searchErr = "";	
	$edit_state = false;
	$field = 'id';
	$sort = 'ASC';


	//connect to database
	$db = mysqli_connect('localhost','root','root','crud');

	//INSERT DATA INTO DATABASE
	if(isset($_POST['insert'])) {
		$name = $_POST['name'];
		$age = $_POST['age'];

		if(empty($name)) {
			$nameErr = "Enter your name";
		}
		elseif (empty($age)) {
			$ageErr = "Enter your age";
		}
		else {
			$query = "INSERT INTO users(name, age) VALUES ('$name', '$age')";
			mysqli_query($db, $query);
			$_SESSION['msg'] = "User saved successfully....!";
			header('location: crud.php');
		}
	}

	//UPDATE USER FROM DATABASE
	if(isset($_POST['update'])) {
		$name = $_POST['name'];
		$age = $_POST['age'];
		$id = $_POST['id'];

		if(empty($name)) {
			$nameErr = "Name is required";
		}
		elseif(empty($age)) {
			$ageErr = "age is required";
		}
		else {
			mysqli_query($db, "UPDATE users SET name='$name', age='$age' WHERE id=$id");
			$_SESSION['msg'] = "<p class='text-info'>User updated successfully.......!</p>";
			header('location: crud.php');
		}
		
	}

	//DELETE USER FROM DATABASE
	if(isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM users WHERE id=$id");
		$_SESSION['msg'] = "<p class='text-danger'>User deleted successfully.....!</p>";
		header('location: crud.php');
	}

	//DISPLAY DATA FROM THE DATABASE WITH SORTING
	if(isset($_GET['field']) && isset($_GET['sorting']))
	{
		if($_GET['field']=='id') { 
		  if($_GET['sorting']=='DESC') {

		  	$field = "id";
		    $sort = 'ASC';
		  }else{
	  		$field = "id";
	    	$sort = 'DESC';
		  }
		}
		if($_GET['field']=='name') { 
		  if($_GET['sorting']=='DESC') {

		  	$field = "name";
		    $sort = 'ASC';
		  }else{
	  		$field = "name";
	    	$sort = 'DESC';
		  }
		}
		if($_GET['field']=='age') { 
		  if($_GET['sorting']=='DESC') {

		  	$field = "age";
		    $sort = 'ASC';
		  }else{
	  		$field = "age";
	    	$sort = 'DESC';
		  }
		}
	}

	$query = "SELECT id,name,age FROM users ORDER BY $field $sort";
	$records = mysqli_query($db, $query);

	//SEARCHING REQUIRED DATA
	if(!empty($_REQUEST['searchUser'])) {
		$searchItem = $_REQUEST['searchUser'];
		$records = mysqli_query($db, "SELECT * FROM users WHERE name LIKE '".$searchItem."'");
	}
	else {
		$searchErr = "You must enter usename to search valid user";
	}
 ?>

