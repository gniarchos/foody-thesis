<?php

    session_start();
    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted read them
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        // $string = '​Sim-only 500 ​| Internet 2500';
        $pieces = explode(', ', $address);
        $city_name = array_pop($pieces);

        // echo $city_name;

        // die;

        //save to database
        $query = "insert into users (fname,lname,username,password,email,address,city,age,gender) values ('$fname','$lname','$username','$password','$email','$address','$city_name','$age','$gender')";

        mysqli_query($con, $query);

        // echo '<script>alert("Successful! Processing...")</script>';

        header("Location: success.html");
        die;

    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Foody | SignUp</title>
    <link rel="icon" href="./images/tab_icon.png">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer type="text/javascript" src="signup.js"></script>
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

<div class="wrapper-all">

    <div class="empty-div">

    </div>


    <div class="container"> 
        <div class="logo-div">
            <img class="logo" src="images/foody_logo.png" alt="foody_logo">
        </div>
        <br>
        <div class="div-form">
            <br>
            <div class="signup">
                <label > SIGN UP </label>
            </div>
            <form method="post">
                <br>
                <div class="wrapper">
                    <div class="div-inputs">
                        <label class="label-signup" for="fname">First Name*</label><br>
                        <input class="input-signup" id="fname" type="text" name="fname" placeholder="Enter your first name" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="lname">Last Name*</label><br>
                        <input class="input-signup" id="lname" type="text" name="lname" placeholder="Enter your last name" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="username">Username*</label><br>
                        <input class="input-signup" id="username" type="text" pattern="[0-9A-Za-z,_]{6,}" name="username" placeholder="Enter your username (at least 6 characters)" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="password">Password*</label><br>
                        <input class="input-signup" id="password" type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="age">Age*</label><br>
                        <input class="input-signup" id="age" type="number" min="15" max="110" name="age" placeholder="Enter your age" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="address">Address*</label><br> 
                        <input class="input-signup" id="address" type="text" name="address" pattern="^.+ (Athens|Thessaloniki)$" placeholder="Poseidonos 28, Egaleo, Athens/Thessaloniki" required>
                    </div>
                    <div class="div-inputs">
                        <label class="label-signup" for="email">Email*</label><br>
                        <input class="input-signup" id="email" type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="div-inputs">
                    <label class="label-signup" for="gender">Select your gender:*</label><br>
                        <select name="gender" id="gender" placeholder="Select input . . . " required>
                            <option hidden value="">Select gender...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <br>
                <div >
                    <input class="btn btn:hover " type="submit" value="Sign Up">
                </div>
                <br>
                <div class="signin-link">
                    Already a member? <a href="index.php">Login here</a>
                </div>
                <br>
            </form>
            
        </div>

    </div>

</div>

</body>
</html>