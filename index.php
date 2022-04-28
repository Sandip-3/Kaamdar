<?php 
require_once 'database.php';
  session_start();
  if(isset($_SESSION['username'])){
  	header('location:home.php');
  }

  if(isset($_COOKIE['username'])){
  	$_SESSION['username'] = $_COOKIE['username'];
  	header('location:home.php');
 }

 $err = []; 
 if(isset($_POST['login'])){
 	if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])){
 		  $username = $_POST['username']; 
 	     } else{
 	     	$err['username'] = 'Enter your Username.'; 
 	     }

 	if(isset($_POST['password']) && !empty($_POST['password'])){
 		$password = $_POST['password'];
 	}else{
 		$err['password'] = 'Enter your Password.';
 	}

 	if(count($err) == 0)
  	{
    
  	try{
  		$connect = mysqli_connect(HOST,USERNAME,PASSWORD,DB_NAME);
  		$query = " select *from users where username ='$username' && password = '$password'; ";
  		$result = $connect->query($query);
  		print_r($result);
  		if($result-> num_rows == 1){
        $admin = $result-> fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $admin['name'];
        header('location:home.php');
      }
    }catch(Exception $e){
    	die('Database Error' . 'Code:' . $e->getCode() . $e->getMessage());
    }

  }

 }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Style/login.css">
</head>
<body>
	<div>
	<fieldset>
	<form  method="post" action=" <?php echo $_SERVER['PHP_SELF'] ?>">
		<h1>Login</h1>
		<label for="username">Username:</label>
		<input class="input_tag" type="text" name="username" value="<?php echo isset($username)?$username:''; ?>" placeholder="Enter Username">
		<?php 
         if(isset($err['username'])){ ?>
         	<span class="error"> <?php echo $err['username']; ?></span>
        <?php } ?>
		<br>

		<label for="password">Password:</label>
		<input type="password" name="password" class="input_tag" placeholder="Enter Password" >
		<?php 
         if(isset($err['password'])){ ?>
         	<span class="error"> <?php echo $err['password']; ?></span>
        <?php } ?>
		<br>
		<input type="checkbox" name="remember" value="remember" id="rem_me">Remember me
		<br>
		<p>Not a member ? <a href="register.php"> Sign up</a></p>
		<br>

	    <input type="submit" name="login" value="login" id="btn_l">

		
	</form>
	</fieldset>
</div>

</body>
</html>

