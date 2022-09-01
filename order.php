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

    //get data from link
    $total_price = $_GET["total_price"];
    $order_time = $_GET["order_time"];
    $time = $_GET["time"];
    $date = $_GET["date"];
    $store = $_GET["store"];
    $categ = $_GET["categ"];

    $id = $_SESSION['user_id'];

    $time_date = "$time $date";

    $q = "SELECT * FROM pending_reviews WHERE user_id ='".$id."'";
    $ans = $con->query($q);
    $found = 0;

    while ($row = $ans->fetch_assoc()) 
    {   
      if ($row["user_id"] == $id && $row["store_name"] == $store && $row["time_date"] == $time_date)
      {
        $found = 1;
      }
    }

    if ($found == 0)
    {
      //add to pending reviews the order
      $store_fixed= str_replace("'", "\'", $store);
      $ins = "insert into pending_reviews (user_id,store_name,time_date) values ('$id','$store_fixed','$time_date')";
      mysqli_query($con, $ins);
    }

    $qu = "SELECT user_id, order_time_date FROM users WHERE user_id ='".$id."'";
    $rsl = $con->query($qu);
    $found_order = 0;

    while ($td = $rsl->fetch_assoc()) 
    {   
      if ($td["user_id"] == $id && $td["order_time_date"] == $time_date)
      {
        $found_order = 1;
      }
    }

    if ($found_order == 0)
    {
      //update orders 
      $upd_orders = "UPDATE users SET orders = orders + 1, order_time_date = '$time_date' WHERE user_id = '$id'";
      mysqli_query($con, $upd_orders);
    
      if ($categ == "Pizza")
      {
        $sql = "UPDATE users SET pizza = pizza + 1 WHERE user_id = '$id'"; 
        $res =  mysqli_query($con,$sql);
      }
      else if ($categ == "Souvlaki")
      {
        $sql = "UPDATE users SET souvlaki = souvlaki + 1 WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
      }
      else if ($categ == "Coffee")
      {
        $sql = "UPDATE users SET coffee = coffee + 1 WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
      }
      else if ($categ == "Burger")
      {
        $sql = "UPDATE users SET burger = burger + 1 WHERE user_id = '$id'"; 
        $res =  mysqli_query($con,$sql);
      }
      else if ($categ == "Cocktail")
      {
        $sql = "UPDATE users SET cocktail = cocktail + 1 WHERE user_id = '$id'"; 
        $res =  mysqli_query($con,$sql);
      }

      if ($user_data['souvlaki'] > $user_data['pizza'] && $user_data['souvlaki'] > $user_data['burger'] && $user_data['souvlaki'] > $user_data['coffee'] && $user_data['souvlaki'] > $user_data['cocktail'])
      {
        $sql = "UPDATE users SET favorite_categ = 'Souvlaki' WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
        // echo "MORE ORDRES: Souvlaki";
      }
      else if ($user_data['pizza'] > $user_data['souvlaki'] && $user_data['pizza'] > $user_data['burger'] && $user_data['pizza'] > $user_data['coffee'] && $user_data['pizza'] > $user_data['cocktail'])
      {
        $sql = "UPDATE users SET favorite_categ = 'Pizza' WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
        // echo "MORE ORDRES: Pizza";
      }
      else if ($user_data['burger'] > $user_data['souvlaki'] && $user_data['burger'] > $user_data['pizza'] && $user_data['burger'] > $user_data['coffee'] && $user_data['burger'] > $user_data['cocktail'])
      {
        $sql = "UPDATE users SET favorite_categ = 'Burger' WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
        // echo "MORE ORDRES: Burger";
      }
      else if ($user_data['coffee'] > $user_data['souvlaki'] && $user_data['coffee'] > $user_data['burger'] && $user_data['coffee'] > $user_data['pizza'] && $user_data['coffee'] > $user_data['cocktail'])
      {
        $sql = "UPDATE users SET favorite_categ = 'Coffee' WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
        // echo "MORE ORDRES: Coffee";
      }
      else if ($user_data['cocktail'] > $user_data['souvlaki'] && $user_data['cocktail'] > $user_data['burger'] && $user_data['cocktail'] > $user_data['pizza'] && $user_data['cocktail'] > $user_data['coffee'])
      {
        $sql = "UPDATE users SET favorite_categ = 'Cocktail' WHERE user_id = '$id'";  
        $res =  mysqli_query($con,$sql);
        // echo "MORE ORDRES: Cocktail";
      }
    }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Foody | Order Details</title>
  <link rel="icon" href="./images/tab_icon.png">
  <link rel="stylesheet" href="order.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="order.js"></script>
  <meta charset="utf-8">

    <!-- delay body load for dark mode -->
<style>
  body {
    visibility: hidden;
    opacity: 0;
  }
</style>

</head>

<body onload="check_category()">

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
      <li class="hidden-li"><a href="./profile.php">Profile</a></li>
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

<p hidden> The category is <span id="category" ><?php echo $categ; ?></span> </p>
<p id="age" hidden> <?php echo $user_data['age']; ?></p>

<div class="container">

  <div id="div-sideImage" class="div-sideImage">
  
  </div>

  <div class="wrapper">

    <div id="div-order-title" class="div-order-title">
      <h1 class="h1-order-title"> <img class="img-store" src="images/store.png" alt="store"> Order Details </h1>
    </div>

    <div class="div-form">
    
      <h3 class="h3-subtitle"> Your order has been sent successfully. </h3>
      <p class="store"><?php echo $store; ?></p>
      <p class="time">Date & Time: <?php echo ''.$date.' '.$time.''; ?></p>
      <p class="address"> Delivery Address:</p>
      <p class="addr"> <?php echo $user_data['address'] ?></p>
      <p class="price">Total Price</p>
      <p class="price-value"><?php echo $total_price; ?> €</p>
      <p class="ready">Ready in about</p>
      <p class="ready-value"><?php echo $order_time; ?> minutes</p>
      <p class="remind-review"> &#x270E; Don't forget to review your order <a class="link-review" href="./review.php">here.</a></p>
      
      <br>
      <a class="button-submit btn-grad btn-grad:hover" href="./home.php">Back Home </a>
      <br>     

    </div>
  </div>

</div>

</body>
</html>
