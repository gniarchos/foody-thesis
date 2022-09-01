<?php
 
  session_start();
  include("connection.php");
 
  $user_data = check_login($con);

  function check_login($con)
  {

    if (isset($_SESSION['user_id']))
    {
      $id = $_SESSION['user_id'];
      $query = "select * from users where user_id = '$id' limit 1";

      $result = mysqli_query($con,$query);
      if($result && mysqli_num_rows($result) > 0)
      {

          $user_data = mysqli_fetch_assoc($result);
          return $user_data;
      }
    }

    //redirect to login
    header("Location: login.php");
    die;

  }

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted read them
    $id=$_SESSION['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $pieces = explode(', ', $address);
    $city_name = array_pop($pieces);

    //save to database
    $query = "UPDATE users SET username = '$username', fname = '$fname', lname = '$lname', password = '$password', email = '$email', gender = '$gender', age = $age, city = '$city_name', address = '$address' WHERE user_id = '$id'";

    mysqli_query($con, $query);

    header("Location: profile.php");
    die;

  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | <?php echo $user_data['username'] ?> - Edit Profile</title>
  <link rel="icon" href="./images/tab_icon.png">
  <link rel="stylesheet" href="editprofile.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="editprofile.js"></script>
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

<nav class="navbar">
  <div class="logo-div"> <a href="home.php"> <img class="logo" src="images/foody_logo_navbar.png" alt="foody_logo" /> </a> </div>

  <div class="blurred-background">

  </div>

  <button class="mobile-nav-toggle" onclick="SlideOutMenu()"></button>
  
  <div data-visible="false" id="navbar-links" class="navbar-links">
    <ul>
      <li><a href="./home.php">Home</a></li>
      <li><a href="./review.php">Reviews</a></li>
      <li><a href="./contact.php">Contact</a></li>
      <li class="hidden-li"><a style="cursor:pointer;" onclick="ClearStorage()">Logout</a></li>
      <div class="dropdown">
            <a class="dropbtn">
              <?php
                if(strcmp($user_data['gender'],"Male") == 0)
                  {
                    echo "<img style='height:22px; margin-top: -3px; vertical-align:middle' src='images/man.png'>";
                    echo "<span class='span-user'>";
                    echo '&nbsp;'; 
                    echo $user_data['username'];
                    echo "</span>";
                  }
                  else if(strcmp($user_data['gender'],"Female") == 0)
                  {
                    echo "<img style='height:22px; margin-top: -3px; vertical-align:middle' src='images/woman.png'>";
                    echo "<span>";
                    echo '&nbsp;'; 
                    echo $user_data['username'];
                    echo "</span>";
                  }
                  else
                  {
                    echo "<img style='height:22px; margin-top: -3px; vertical-align:middle' src='images/other.png'>";
                    echo "<span>";
                    echo '&nbsp;'; 
                    echo $user_data['username'];
                    echo "</span>";
                  }
              ?>
            </a>
          <div class="dropdown-content">
          <a href="profile.php">Profile</a>
          <!-- <a href="editprofile.php">Edit Profile</a> -->
          <a style="cursor:pointer;" onclick="ClearStorage()">Logout</a>
          </div>
        </div>
        </li>
    </ul>
  </div>
</nav>

<p id="age" hidden> <?php echo $user_data['age']; ?></p>

<div class="div-container" align="center">

  <form method="post">
    <div class="div1">

      <div>
        <?php
          if(strcmp($user_data['gender'],"Male") == 0)
            {
              echo "<img style='height:125px;' src='images/man.png' alt='img_man'>";
            }
            else if(strcmp($user_data['gender'],"Female") == 0)
            {
              echo "<img style='height:125px;' src='images/woman.png' alt='img_woman'>";
            }
            else
            {
              echo "<img style='height:125px;' src='images/other.png' alt='img_other'>";
            }
        ?>
      </div>
      <div>
        <h2 class="h2-username"> <?php echo "&nbsp;"; echo $user_data['username']; ?> </h2>
      </div>
      <div >
        <label class="label-gender"> <?php echo "&nbsp;"; echo $user_data['gender']; ?> </label>
      </div>
      <br>
      <div>
        <input class="button-submit btn-grad btn-grad:hover " type="submit" onclick="return CheckValid()" value="Update Profile">
      </div>
      
    </div>

    <div class="div2">
      
      <div class="wrapper">

        <div class="div-labels">

          <label class="label-edit" for="fname">First Name*</label>

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="fname" type="text" name="fname" value="<?php echo $user_data['fname']; ?>" placeholder="Enter your first name" required><br>

        </div>

      </div>

      <div class="wrapper">

        <div class="div-labels">

          <label class="label-edit" for="lname">Last Name*</label>

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="lname" type="text" name="lname" value="<?php echo $user_data['lname']; ?>" placeholder="Enter your last name" required><br>

        </div>

      </div>

      <div class="wrapper">

        <div class="div-labels">

          <label class="label-edit" for="username">Username*</label>

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="username" type="text" pattern="[A-Za-z,_]{6,}" name="username" value="<?php echo $user_data['username']; ?>" placeholder="Enter your username (at least 6 characters)" required><br>

        </div>

      </div>
  
      <div class="wrapper">

        <div div class="div-labels">

          <label class="label-edit" for="age">Age*</label>

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="age" type="number" min="15" max="110" name="age" value="<?php echo $user_data['age']; ?>" placeholder="Enter your age" required><br>

        </div>

      </div>

      <div class="wrapper">

        <div div class="div-labels">

          <label class="label-edit" for="address">Address*</label> 

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="address" type="text" name="address" pattern="^.+ (Athens|Thessaloniki)$" value="<?php echo $user_data['address']; ?>" placeholder="Poseidonos 28, Egaleo, Athens or Thessaloniki" required><br>
        
        </div>

      </div>

      <div class="wrapper">

        <div div class="div-labels">

          <label class="label-edit" for="email">Email*</label>

        </div>

        <div class="div-inputs">

          <input class="input-edit" id="email" type="email" name="email" value="<?php echo $user_data['email']; ?>" placeholder="Enter your email" required><br>

        </div>

      </div>

      <div class="wrapper">

        <div div class="div-labels">

          <label class="label-edit" for="gender">Gender*</label>

        </div>

        <div class="div-inputs">

          <select name="gender" id="gender" placeholder="Select input . . . " required>

            <?php

              if(strcmp($user_data['gender'],"Male") == 0)
              {
                echo "<option hidden value=''>Select gender...</option>";
                echo "<option selected value='Male'>Male</option>";
                echo "<option value='Female'>Female</option>";
                echo "<option value='Other'>Other</option>";
              }
              else if(strcmp($user_data['gender'],"Female") == 0)
              {
                echo "<option hidden value=''>Select gender...</option>";
                echo "<option value='Male'>Male</option>";
                echo "<option selected value='Female'>Female</option>";
                echo "<option value='Other'>Other</option>";
              }
              else if(strcmp($user_data['gender'],"Other") == 0)
              {
                echo "<option hidden value=''>Select gender...</option>";
                echo "<option value='Male'>Male</option>";
                echo "<option value='Female'>Female</option>";
                echo "<option selected value='Other'>Other</option>";
              }

            ?>

          </select>

        </div>

      </div>

      <div class="wrapper">

        <div div class="div-labels">

          <label class="label-edit" for="password">Password*</label>

        </div>

        <div class="div-inputs">

          <input id="old_pass" value="<?php echo $user_data['password']; ?>" hidden>
          <input class="input-edit" id="password" type="password" name="password" placeholder="Enter your password" required><br>

        </div>

      </div>

    </div>

  </form>

</div>

</body>
</html>
