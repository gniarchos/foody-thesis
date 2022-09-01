<?php 

    session_start();

	include("connection.php");

    check_login($con);

    //if user already logged in go to home.php
    function check_login($con)
    {
        if (isset($_SESSION['user_id']))
        {
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";

            $result = mysqli_query($con,$query);

            if ($result && mysqli_num_rows($result) > 0)
            {
                header("Location: home.php");
                die;
            }
        }
    }

    $error ="";
    $ok = 0;

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		//read from database
		$query = "select * from users where username = '$username' limit 1";
		$result = mysqli_query($con, $query);

		if($result)
		{
			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
					
				if($user_data['password'] == $password)
				{
					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: home.php");
					die;
				}
                else
                {
                    $ok = 1;
                    $error = "Incorrect Username or Password.";
                }
			}
            else
            {
                $ok = 1;
                $error = "Incorrect Username or Password.";
            
            }
		
    		
	    }
    }

?>

<!DOCTYPE html>
<html>
<head >
    <title>Foody | Login </title>
    <link rel="icon" href="images/tab_icon.png">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer type="text/javascript" src="index.js"></script>
    <meta charset="utf-8">

    <!-- delay body load for dark mode -->
  <style>
    body {
      visibility: hidden;
      opacity: 0;
    }
</style>

</head>

<body>

<div class="dark-light" hidden>
    <button id="button-switch" class="drk-lght-button" onclick="SwitchTheme()"><img id="img-switch" class="theme"></button>
</div>


<div class="wrapper">

    <div class="empty-div">

    </div>


    <div class="login-div">

        <div class="logo-div">
            <img class="logo" src="images/foody_logo.png" alt="foody_logo">
        </div>
        <br>
        <div class="div-form">
            <br>
            <label class="label-signin"> LOG IN </label>

            <div>
            <form method="post">
                <br>
                <div>
                <?php
                        if ($ok == 1)
                        {
                        echo '<p class="login_error"> <img style="vertical-align:middle" src="images/info.png"> ';
                        echo $error;
                        echo '</p>';
                        }
                    ?>       
                </div>
                <br>
                <div>
                    <input class="input-login" type="text" name="username" placeholder="Username" required>
                </div>
                <br>
                <div>
                    <input class="input-login" type="password" name="password" placeholder="Password" required>
                </div>
                <br>
                <div >
                    <input class="btn btn:hover" type="submit" value="Login">
                </div>
                <br>
                <div class="signup-link">
                    Not a member? <a href="signup.php">Signup now</a>
                </div>
                <br>
            </form>
            

        </div>
        
    </div>

</div>

</body>
</html>