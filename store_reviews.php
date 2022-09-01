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

  //get category from link
  $categ = $_GET["categ"];
  $store_name = $_GET["store_name"];

  $store_name_fixed = str_replace("'", "\'", $_GET["store_name"]);

  $que = "SELECT reviews FROM stores WHERE store_name = '$store_name_fixed'";
  $res = mysqli_query($con,$que);
  $row = mysqli_fetch_array($res);
  $stars = $row['reviews'];

//   $rev = "SELECT * FROM reviews WHERE store_name = '$store_name'";
  $rev = "SELECT reviews.id, reviews.user_id, reviews.store_name, reviews.stars, reviews.comments, users.username FROM reviews INNER JOIN users WHERE users.user_id = reviews.user_id AND reviews.store_name = '$store_name_fixed' ORDER BY reviews.id DESC";
  $rsl = mysqli_query($con,$rev);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | <?php echo $store_name ?> - Reviews</title>
  <link rel="icon" href="./images/tab_icon.png">
  <link rel="stylesheet" href="store_reviews.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="store_reviews.js"></script>
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
      <li><a href="./profile.php">Profile</a></li>
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

<div class="container">

  <div class="div-sideImage">
  
  </div>

    <div class="wrapper">

        <?php
            echo'
            <div class="div-review-title">
                <h1 class="h1-store-title"> <img class="img-review" src="images/store_reviews.png" alt="store_reviews"> '.$store_name.' </h1>

                <div class="circle-container">
                    <div class="div-circle">
                        <img class="img-stars" src="images/star.png" alt="star"><br>
                        <p class="stars"> '.$stars.' </p>
                    </div>
                </div>

            </div>';
        ?>

        <br>
        <h2 class="h2-reviews-title"> Reviews </h2>
        <div class="div-form">

            <div class="div-reviews">
                <?php
                    $count = 0;
                    while ($review_data = $rsl->fetch_assoc()) 
                    {   
                        $count++;
                        echo '
                        <div id="'.$review_data['id'].'" >
                            <div class="item-review">
                                <div class="div-username-img">
                                    <img class="user-img" src="images/other.png"> <span class="user-name">'.$review_data['username'].'</span>
                                </div>
                                
                                <div class="div-stars">
                                <span class="user-stars">'.$review_data['stars'].'</span> <img class="user-stars-img" src="images/star.png">
                                </div>';

                                if(strcmp($review_data['comments'],"") == 0)
                                {
                                    echo '
                                    <div class="div-comments">
                                        <p class="user-comments user-no-comments"> No comments </p>
                                    </div>';
                                }
                                else
                                {
                                    echo '
                                    <div class="div-comments">
                                        <p class="user-comments">'.$review_data['comments'].'</p>
                                    </div>';
                                }
                            
                            echo'
                            </div>
                        </div> ';
                    }

                ?>
            </div>

            <div class="div-counter-comments">
                <?php echo '<p class="counter"> Based on '.$count.' reviews </p>' ?>
            </div>
        </div>
    
    </div>

</div>

</body>
</html>