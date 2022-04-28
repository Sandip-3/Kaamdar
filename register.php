<?php 
  require_once 'database.php';
  $username = $phone = $gender = $address = $name = '';
  $err = [];
  if(isset($_POST['submit'])){
  	if(isset($_POST['name']) && !empty($_POST['name'])){
  		$name = $_POST['name'];
  	}else{
  		$err['name'] = 'Enter Name';
  	}
  	if(isset($_POST['username']) && !empty($_POST['username'])){
  		$username = $_POST['username'];
  	}else{
  		$err['username'] = 'Enter Username';
  	}
  	if(isset($_POST['password']) && !empty($_POST['password'])){
  		$password = $_POST['password'];
  	}else{
  		$err['password'] = 'Enter Password';
  	}

    if(isset($_POST['gender']) && !empty($_POST['gender'])){
  		$gender = $_POST['gender'];
  	}else{
  		$err['gender'] = 'Select Gender';
  	}

     if(isset($_POST['address']) && !empty($_POST['address'])){
  		$address = $_POST['address'];
  	}else{
  		$err['address'] = 'Enter Address';
  	}

  	if(isset($_POST['phone']) && !empty($_POST['phone'])){
  		$phone= $_POST['phone'];
  	}else{
  		$err['phone'] = 'Enter Phone';
  	}
  	if(count($err) == 0){
  		try{
  			$connection = mysqli_connect(HOST,USERNAME,PASSWORD,DB_NAME);
  			$register = "insert into users(name,username,password,address,phone,gender)values('$name','$username','$password','$address','$phone','$gender')";
  			if($connection->query($register)){
              header('location:index.php');
  			}else{
  				$errmsg = 'Registration Failed';
  			}

  		}catch(Exception $e){
  			die('Database Error:'.''.'Code:'. $e->getcode().$e->getmessage());
  		}
  	}

  }
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User</title>
	<link rel="stylesheet" type="text/css" href="Style/register.css">
</head>
<body>
	<?php if(isset($errmsg)){ ?>
		<span id="errmsg"><?php echo $errmsg ?></span>
	<?php } ?>
</body>
<div>
	<fieldset>
		<h1>Registration</h1>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<label for="name">Name:</label>
		<input class="input_tag" type="text" name="name" value="<?php echo $name ?>">
		<span><?php
           if(isset($err['name'])){
           	echo $err['name'];
           }
	     ?></span><br>

	     <label for="username">Username:</label>
		<input class="input_tag" type="text" name="username" value="<?php echo $username ?>">
		<span><?php
           if(isset($err['username'])){
           	echo $err['username'];
           }
	     ?></span><br>

		<label for="password">Password:</label>
		<input class="input_tag" type="password" name="password">
		<span><?php
           if(isset($err['password'])){
           	echo $err['password'];
           }
	     ?></span><br>

		<label for="phone">Phone:</label>
		<input class="input_tag" type="text" name="phone" value="<?php echo $phone ?>">
		<span><?php
           if(isset($err['phone'])){
           	echo $err['phone'];
           }
	     ?></span><br>

		<label for="address">Address:</label>
		<input class="input_tag" type="text" name="address" value="<?php echo $address ?>">
		<span><?php
           if(isset($err['address'])){
           	echo $err['address'];
           }
	     ?></span><br>
    <label>Gender</label>
	  <input type="radio" name="gender" value="M" <?php echo (isset($gender)&& $gender == 'M')?'checked':'' ?>> Male
	  <input type="radio" name="gender" value="F" <?php echo (isset($gender)&& $gender == 'Failed')?'checked':'' ?> >Female 
	  <input type="radio" name="gender" value="O" <?php echo (isset($gender)&& $gender == 'O')?'checked':'' ?>>Others
	  <span><?php
           if(isset($err['gender'])){
           	echo $err['gender'];
           }
	     ?></span>  
    <br>

		<input id="register" class="button_r" type="submit" name="submit" value="Register">
    <input id="reset" class="button_r" type="reset" name="reset" value="Reset">
    <a href="index.php"><input id="back" class="button_r" type="button" name="back" value ="Back"></a>
		</form>
		</fieldset>
	</div>

</body>
</html>