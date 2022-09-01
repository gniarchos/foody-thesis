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

  $id = $_SESSION['user_id'];
  $sql = "SELECT * FROM pending_reviews WHERE user_id = '$id' order by id DESC "; 
  $res =  mysqli_query($con,$sql);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    //something was posted read them
    $store = str_replace("'", "\'", $_POST['store']);
    $stars = $_POST['num-stars'];
    $comments = $_POST['comments'];
    $time_date_review = $_POST['time_date'];

    //save to database
    $query = "insert into reviews (user_id, store_name, stars, comments) values ('$id', '$store', '$stars', '$comments')";
    mysqli_query($con, $query);

    $del = "DELETE FROM pending_reviews WHERE user_id = '$id' AND store_name = '$store' AND time_date = '$time_date_review'";
    mysqli_query($con, $del);

    $st = "SELECT stores.store_name, reviews.store_name, AVG(reviews.stars) FROM stores INNER JOIN reviews WHERE stores.store_name = '$store' AND reviews.store_name='$store'";
    $rsl = mysqli_query($con, $st);
    $row = mysqli_fetch_array($rsl);
    $avg = $row['AVG(reviews.stars)'];
    // echo $avg;

    $one_decimal_stars = number_format($avg, 1);
    echo $one_decimal_stars;

    $sq = "UPDATE stores SET reviews = $one_decimal_stars WHERE store_name = '$store'";
    mysqli_query($con, $sq);

    header('Location: review.php');
    
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | Review Orders</title>
  <link rel="icon" href="./images/tab_icon.png">
  <link rel="stylesheet" href="review.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <script defer type="text/javascript" src="review.js"></script>
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

    <div class="div-review-title">
      <h1 class="h1-review-title"> <img class="img-review" src="images/reviews.png" alt="reviews"> Review your orders </h1>
    </div>

    <div class="div-form">

      <?php

        $count = 0;
        while ($review_data = $res->fetch_assoc()) 
        {   
            $count++;
            echo '
            <form method="post">
              <div id="'.$review_data['id'].'" >
                <div id="btn-collapse" class="btn-collapse" onclick="ShowDetails('.$review_data['id'].')">
                  <h3 id="store-name" class="store-name">'.$review_data['store_name'].'</h3>
                  <input name="store" value="'.$review_data['store_name'].'" hidden />
                  <p class="time-date">'.$review_data['time_date'].'</p>
                  <input name="time_date" value="'.$review_data['time_date'].'" hidden />
                </div> 
                <div class="details">
                  <div class="div-stars">

                    <p id="stars-selected" class="stars-selected">Rate your order:</p><br>
                    <input id="num-stars" name="num-stars" value="0" hidden />
                    <img id="star-1" src="./images/star-unfilled.png" onmouseover="hover(this, '.$review_data['id'].');" onmouseout="unhover('.$review_data['id'].');" onclick="ConfirmStars(this, '.$review_data['id'].')"/>
                    <img id="star-2" src="./images/star-unfilled.png" onmouseover="hover(this, '.$review_data['id'].');" onmouseout="unhover('.$review_data['id'].');" onclick="ConfirmStars(this, '.$review_data['id'].')"/>
                    <img id="star-3" src="./images/star-unfilled.png" onmouseover="hover(this, '.$review_data['id'].');" onmouseout="unhover('.$review_data['id'].');" onclick="ConfirmStars(this, '.$review_data['id'].')"/>
                    <img id="star-4" src="./images/star-unfilled.png" onmouseover="hover(this, '.$review_data['id'].');" onmouseout="unhover('.$review_data['id'].');" onclick="ConfirmStars(this, '.$review_data['id'].')"/>
                    <img id="star-5" src="./images/star-unfilled.png" onmouseover="hover(this, '.$review_data['id'].');" onmouseout="unhover('.$review_data['id'].');" onclick="ConfirmStars(this, '.$review_data['id'].')"/>
                    <br>
                    <textarea class="textarea-review" id="comments" name="comments" rows="8" cols="50" placeholder="Was your order as described?"></textarea>

                    <br><br>
                    <button class="button-submit btn-grad btn-grad:hover" onclick="return CheckValid('.$review_data['id'].')"> Submit </button>
                    <br>

                </div>
              </div>
            </form>';
        }

        if ($count == 0)
        {
          echo "
          <div class='div-no-pendingReviews'>
            <p class='no-pendingReviews'> You don't have any pending reviews.</p>
            <p class='no-pendingReviews'> Make orders and check back later.</p>
          </div>";
        }

      ?>

    </div>
  </div>

</div>

</body>
</html>