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

      if ($result && mysqli_num_rows($result) > 0)
      {
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
      }
    }

    //redirect to login
    header("Location: index.php");
    die;

  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | <?php echo $user_data['username'] ?> - Profile</title>
  <link rel="icon" href="./images/tab_icon.png">
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="profile.js"></script>
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
          <a href="editprofile.php">Edit Profile</a>
          <a style="cursor:pointer;" onclick="ClearStorage()">Logout</a>
          </div>
        </div>
        </li>
    </ul>
  </div>
</nav>

<p id="age" hidden> <?php echo $user_data['age']; ?></p>

<div class="div-container" align="center">

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
        <button class="button-edit" type="button" id="button" name="edit" onclick="location.href='editprofile.php'"> Edit Profile </button>
    </div>
    
  </div>

  <div class="div2">
    <div class="div2-table">
      <table>
        <tr>
          <th> First Name: </th>
          <td>
            <?php
              if(strcmp($user_data['fname'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['fname'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Last Name: </th>
          <td>
            <?php
              if(strcmp($user_data['lname'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['lname'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Email: </th>
          <td>
            <?php
              if(strcmp($user_data['email'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['email'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Address: </th>
          <td>
            <?php
              if(strcmp($user_data['address'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['address'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Age: </th> 
          <td>
            <?php
              if(strcmp($user_data['age'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['age'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Favorite Category: </th>
          <td>
            <?php
              if(strcmp($user_data['favorite_categ'],"") == 0)
                {

                  echo "-";
                }
                else
                {
                  echo $user_data['favorite_categ'];
                }
            ?>
          </td>
        </tr>
        <tr>
          <th> Orders #: </th>
          <td> 
          <?php  
                if(strcmp($user_data['orders'],0) == 0)
                {
                  echo "No orders yet.";
                }
                else
                {
                  echo $user_data['orders'];
                }
            ?> 
          </td>
        </tr>
        <tr>
          <th> Latest Profile Update: </th>
          <td>
            <?php
              if(strcmp($user_data['date'],"") == 0)
                {
                  echo "-";
                }
                else
                {
                  echo $user_data['date'];
                }
            ?>
          </td>
        </tr>

      </table>
    </div>
    

  </div>

</div>

</body>
</html>
