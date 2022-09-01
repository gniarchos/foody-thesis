<?php
 
  session_start();
  include("connection.php");
  
  $user_data = check_login($con);


    function check_login($con)
    {

      if(isset($_SESSION['user_id']))
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

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        header("Location: home.php");

    }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Foody | Contact Us</title>
  <link rel="icon" href="./images/tab_icon.png"/>
  <link rel="stylesheet" href="contact.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer type="text/javascript" src="contact.js"></script>
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
      <li><a href="./profile.php">Profile</a></li>
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

<div class="container">

  <div id="div-sideImage" class="div-sideImage">

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12575.63943043662!2d23.6748072!3d38.002563!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbe82f5519cbcb53d!2sUniversity%20of%20West%20Attica!5e0!3m2!1sen!2sgr!4v1638202670331!5m2!1sen!2sgr" 
      scrolling="auto" allowtransparency="true" name="main" width="864" height="830" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>

  </div>

  <div class="wrapper">

    <div class="div-contact-title">
        <h1 class="h1-contact-title"> <img class="img-contact" src="images/contact.png" alt="contact"> Contact Us </h1><br>
    </div>

    <div class="div-form">

      <h2 class="h2-subtitle-contact"> Have a question? Need help? Let us know! </h2>

      <div class="info">
        <p class="text-mail"> <img class="img-info" src="images/mail.png" alt="mail"> ice@uniwa.gr </p>
        <p class="text-address"> <img class="img-info" src="images/map-pin.png" alt="pin"> Agiou Spiridonos 28, Egaleo </p>
      </div>
    
      <form method="post">
      <div class="div-subject">
          <div class="div-labels">

            <label class="label-edit" for="subject">Subject</label>

          </div>

          <div class="div-inputs">

            <input class="input-subject" type="input" name="subject" id="subject" placeholder="Subject" required><br>

          </div>  
      </div>

      <div class="div-message">
          <div class="div-labels">

            <label class="label-edit" for="email">Message</label>

          </div>

          <div class="div-inputs">

              <textarea class="textarea-review" id="message" name="message" rows="8" cols="50" placeholder="Message" require></textarea><br>

          </div>  
      </div>
        
      <br>
      <button class="button-submit btn-grad btn-grad:hover" onclick="return CheckValid()"> Submit </button>
      <br>
    
    </div>

    </form>
    
         

  </div>

</div>

</body>
</html>
