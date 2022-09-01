<?php 

  session_start();
	include("connection.php");
	
	$user_data = check_login($con);

  function check_login($con)
  {
    if (isset($_SESSION['user_id']))
    {
      $id = $_SESSION['user_id'];
      $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

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

  $sql = "SELECT * FROM stores ORDER BY RAND();"; 
  $res =  mysqli_query($con,$sql);

  $city = $user_data['city'];

  $one = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T1 WHERE store_category = 'Souvlaki' ORDER BY reviews DESC LIMIT 2;";
  $svk =  mysqli_query($con,$one);

  $two = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T2 WHERE store_category = 'Pizza' ORDER BY reviews DESC LIMIT 2;";
  $pzz =  mysqli_query($con,$two);

  $three = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T3 WHERE store_category = 'Coffee' ORDER BY reviews DESC LIMIT 2;";
  $cfe =  mysqli_query($con,$three);

  $four = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T3 WHERE store_category = 'Burger' ORDER BY reviews DESC LIMIT 2;";
  $brg =  mysqli_query($con,$four);

  $five = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T3 WHERE store_category = 'Cocktail' ORDER BY reviews DESC LIMIT 2;";
  $ctl =  mysqli_query($con,$five);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | Online Delivery </title>
  <link rel="icon" href="images/tab_icon.png">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="home.js"></script>
  <meta charset="utf-8">
</head>

<!-- delay body load for dark mode -->
<style>
  body {
    visibility: hidden;
    opacity: 0;
  }
</style>

<body>

<nav class="navbar">
  <div class="logo-div"> <a href="home.php"> <img class="logo" src="images/foody_logo_navbar.png" alt="foody_logo" /> </a> </div>

  <!-- user's first name hidden -->
  <p id="fname" hidden> <?php echo $user_data['fname']; ?></p>
  <p id="age" hidden> <?php echo $user_data['age']; ?></p>

  <div class="blurred-background">

  </div>

  <button class="mobile-nav-toggle" onclick="SlideOutMenu()"></button>
  
  <div data-visible="false" id="navbar-links" class="navbar-links">
    <ul>
      <li><a href="./review.php">Reviews</a></li>
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

<div id="alert-info" class="alert-info">

  <!-- Alert info -->
  <div class="details-alert">
    <span class="close">&times;</span>
    <p id="alert-title" class="alert-title"></p>
    <p id="subtitle" class="alert-subtitle"></p>

    <div id="div-best-souvlaki">
      <?php
        
        while ($best_store = $svk->fetch_assoc()) 
        {
          echo '
            <div class="div-best-store" >
              <span>
                <a href="menu.php?categ='.$best_store['store_category'].'&store_name='.$best_store['store_name'].'"" class="store-name">'.$best_store['store_name'].'</a>
                <p class="store-categ">'.$best_store['store_category'].'</p>
                <p class="store-stars">'.$best_store['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
              </span>
              
            </div>
          ';
        }
      ?>
    </div>

    <div id="div-best-pizza">
      <?php
        while ($best_store = $pzz->fetch_assoc()) 
        {
          echo '
            <div class="div-best-store" >
              <span>
                <a href="menu.php?categ='.$best_store['store_category'].'&store_name='.$best_store['store_name'].'"" class="store-name">'.$best_store['store_name'].'</a>
                <p class="store-categ">'.$best_store['store_category'].'</p>
                <p class="store-stars">'.$best_store['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
              </span>
              
            </div>
          ';
        }
      ?>
      </div>

      <div id="div-best-coffee">
        <?php
        while ($best_store = $cfe->fetch_assoc()) 
        {
          echo '
            <div class="div-best-store" >
              <span>
                <a href="menu.php?categ='.$best_store['store_category'].'&store_name='.$best_store['store_name'].'"" class="store-name">'.$best_store['store_name'].'</a>
                <p class="store-categ">'.$best_store['store_category'].'</p>
                <p class="store-stars">'.$best_store['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
              </span>
              
            </div>
          ';
        }

        ?>
      </div>

      <div id="div-best-burger">
        <?php
        while ($best_store = $brg->fetch_assoc()) 
        {
          echo '
            <div class="div-best-store" >
              <span>
                <a href="menu.php?categ='.$best_store['store_category'].'&store_name='.$best_store['store_name'].'"" class="store-name">'.$best_store['store_name'].'</a>
                <p class="store-categ">'.$best_store['store_category'].'</p>
                <p class="store-stars">'.$best_store['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
              </span>
              
            </div>
          ';
        }

        ?>
      </div>

      <div id="div-best-cocktail">
        <?php
        while ($best_store = $ctl->fetch_assoc()) 
        {
          echo '
            <div class="div-best-store" >
              <span>
                <a href="menu.php?categ='.$best_store['store_category'].'&store_name='.$best_store['store_name'].'"" class="store-name">'.$best_store['store_name'].'</a>
                <p class="store-categ">'.$best_store['store_category'].'</p>
                <p class="store-stars">'.$best_store['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
              </span>
              
            </div>
          ';
        }

        ?>
      </div>
      
  </div>

</div>

<div class="div-all">

  <div id="container-stores-filters" class="container-stores-filters">

    <div id="div-category" class="div-category">
      <h3 class="h3-titles"> Filter Category:</h3>

      <div class="radio-filter">
        <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="1" id="cat_1">
        <label for="cat_1"> Souvlaki</label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="2" id="cat_2">
        <label for="cat_2"> Pizza</label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="3" id="cat_3">
        <label for="cat_3"> Coffee</label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="4" id="cat_4">
        <label for="cat_4"> Burger</label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="5" id="cat_5">
        <label for="cat_5"> Cocktail</label><br><br>
      </div>

      <h3 class="h3-titles"> Filter Stars:</h3>

      <div class="radio-filter">
        <input onclick="FilterStarsFunction(this.value)" type="radio" name="filter" value="5" id="5">
        <label for="5"><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'></label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterStarsFunction(this.value)" type="radio" name="filter" value="4" id="4">
        <label for="4"><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'></label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterStarsFunction(this.value)" type="radio" name="filter" value="3" id="3">
        <label for="3"><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'></label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterStarsFunction(this.value)" type="radio" name="filter" value="2" id="2">
        <label for="2"><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'></label><br>
      </div>
      <div class="radio-filter">
        <input onclick="FilterStarsFunction(this.value)" type="radio" name="filter" value="1" id="1">
        <label for="1"><img style=' height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle' src='images/star.png'></label> <br>
      </div>

      <br>
      <button class="button-clear" type="button" value="clear" name="clear" onclick="FilterClearFunction()"> Clear Filters </button>

    </div>

    <div class="stores-list" align="center">

      <?php
        $count = 0;
    
        while ($store_data = $res->fetch_assoc()) 
        {

          if (strcmp($store_data['store_address'],$user_data['city']) == 0)
          {
            echo '<ul class="myUL">
              <li class="li-block">
                <img class="store-img" src="'.$store_data['store_image'].'">
                <a class="a-name" href="menu.php?categ='.$store_data['store_category'].'&store_name='.$store_data['store_name'].'">'.$store_data['store_name'].'</a><br>
                <p class="p-categ">• '.$store_data['store_category'].' • Min. Order '.$store_data['min_order'].'  €</p><br>
                ';
                if ($store_data['reviews'] == 0)
                {
                  echo '<a class="a-stars"> - </a> <img class="store-stars" src="images/star.png"> 

                    </li>        
                  </ul>';
                }
                else
                {
                  echo '<a class="a-stars" href="./store_reviews.php?categ='.$store_data['store_category'].'&store_name='.$store_data['store_name'].'"> '.$store_data['reviews'].'</a> <img class="store-stars" src="images/star.png"> 

                    </li>        
                  </ul>';
                }
            echo '<div class="div-nostore">
            
            <h3 class="h3-no-result"> Sorry, no results.</h3>
            
            </div>';
            $count++;
      
          }
          
        }
      
      ?> 

    </div>

    <div class="div-suggestions">

      <div id="div-suggested" class="div-suggested">

        <h3 id="daytime-choices" class="h3-titles"></h3>

        <?php 

          $time = date('H'); 
          
          if ($time >= 20 || ($time >= 0 && $time <= 4))
          {
            $que = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T1 WHERE store_category = 'Souvlaki' OR store_category = 'Burger' OR store_category = 'Pizza' OR store_category = 'Cocktail' ORDER BY RAND() LIMIT 3";
            $tm =  mysqli_query($con,$que);
            
            while ($store_info = $tm->fetch_assoc()) 
            {
              echo '
                <div class="div-suggest-store" "id="'.$store_info['id'].'">
                  <span>
                    <a href="menu.php?categ='.$store_info['store_category'].'&store_name='.$store_info['store_name'].'"" class="store-name">'.$store_info['store_name'].'</a>
                    <p class="store-categ">'.$store_info['store_category'].'</p>
                    <p class="store-stars">'.$store_info['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
                  </span>
                  
                
                </div>
              ';
            }
          }
          else if ($time >= 13 && $time <= 16)
          {
            $que = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T1 
                    WHERE store_category = 'Souvlaki' OR store_category = 'Burger'
                    ORDER BY RAND() LIMIT 3";
            $tm =  mysqli_query($con,$que);
            
            while ($store_info = $tm->fetch_assoc()) 
            {
              echo '
                <div class="div-suggest-store" "id="'.$store_info['id'].'">
                  <span>
                    <a href="menu.php?categ='.$store_info['store_category'].'&store_name='.$store_info['store_name'].'"" class="store-name">'.$store_info['store_name'].'</a>
                    <p class="store-categ">'.$store_info['store_category'].'</p>
                    <p class="store-stars">'.$store_info['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
                  </span>
                  
                
                </div>
              ';
            }
          }
          else if ($time >= 5 && $time <= 12)
          {
            $que = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T1 
                    WHERE store_category = 'Coffee' 
                    ORDER BY RAND() LIMIT 3";
            $tm =  mysqli_query($con,$que);

            while ($store_info = $tm->fetch_assoc()) 
            {
              echo '
                <div class="div-suggest-store" "id="'.$store_info['id'].'">
                  <span>
                    <a href="menu.php?categ='.$store_info['store_category'].'&store_name='.$store_info['store_name'].'"" class="store-name">'.$store_info['store_name'].'</a>
                    <p class="store-categ">'.$store_info['store_category'].'</p>
                    <p class="store-stars">'.$store_info['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
                  </span>
                  
                
                </div>
              ';
              }
            
          }
          else if ($time >= 17 && $time <= 19)
          {
            $que = "SELECT * FROM (SELECT * FROM stores WHERE store_address = '$city') T1 
                    WHERE store_category = 'Coffee' OR  store_category = 'Cocktail' 
                    ORDER BY RAND() LIMIT 3";
            $tm =  mysqli_query($con,$que);

            while ($store_info = $tm->fetch_assoc()) 
            {
              echo '
                <div class="div-suggest-store" "id="'.$store_info['id'].'">
                  <span>
                    <a href="menu.php?categ='.$store_info['store_category'].'&store_name='.$store_info['store_name'].'"" class="store-name">'.$store_info['store_name'].'</a>
                    <p class="store-categ">'.$store_info['store_category'].'</p>
                    <p class="store-stars">'.$store_info['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
                  </span>
                  
                
                </div>
              ';
            }

          }
          
        ?>

      </div>

      <div class="div-foryou">

        <h3 class="h3-titles"> For You:</h3>
        
        <?php

          $username = $user_data['username'];
          $city = $user_data['city'];


          if (strcmp($user_data['favorite_categ'],"") == 0)
          {
            echo '<div class="div-suggest-store">';
            echo '<p class="store-name"> No enough data yet.</p>';
            echo '<p> Make orders and check back later.</p>';
            echo '</div>';
          }
          else 
          {
            $quer = "SELECT * FROM stores INNER JOIN users WHERE users.username = '$username' AND stores.store_category = users.favorite_categ AND stores.store_address = '$city' ORDER BY RAND() LIMIT 2";
            $fy =  mysqli_query($con,$quer);
            
            while ($store_details = $fy->fetch_assoc()) 
            {
              if (strcmp($store_details['store_address'],$user_data['city']) == 0)
              {
                echo '
                  <div class="div-suggest-store" "id="'.$store_details['id'].'">
                    <span>
                      <a href="menu.php?categ='.$store_details['store_category'].'&store_name='.$store_details['store_name'].'"" class="store-name">'.$store_details['store_name'].'</a>
                      <p class="store-categ">'.$store_details['store_category'].'</p>
                      <p class="store-stars">'.$store_details['reviews'].' <img style=" height: 20px; width: 20px; margin-bottom:3px; vertical-align:middle" src="images/star.png"> </p>  
                    </span>
                    
                  
                  </div>
                ';
              }
            }
          }
        ?>

      </div>


    </div>

    

  </div>

  <div class="top-div">
    <div>
      <h1 id="h1-welcome" class="h1-welcome"></h1>
      <h3 class="h3-subtitle"> Find your favorite stores here.</h3>
    </div>

    <div id="cities-container" class="cities-container">
      <?php

        if (strcmp($user_data['city'],"Athens") == 0)
        {        
          echo "<h2 id='numstores' class='h2-stores-found'>".$count." stores in Athens</h2>";
        }
        else if (strcmp($user_data['city'],"Thessaloniki") == 0)
        {
           echo" <h2 id='numstores' class='h2-stores-found'>".$count." stores in Thessaloniki</h2>";
        }
      
      ?>
    </div>

    <div class="search-container">
    <div class="div-select">
          <select class="select-search" name="option-search" id="option-search">
            <option disabled value="">Select filter...</option>
            <option selected value="1">By Store</option>
            <option value="2">By Category</option>
          </select>
      </div>
      
      <div class="div-search">
        <input class="search-input" id="searchbar" onkeyup="SearchFunction()" type="text" placeholder="Search here...">
      </div>

      
    </div>

  </div>

</div>

</body>
</html>
