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

  //get category from link
  $categ = $_GET["categ"];
  $store_name = $_GET["store_name"];
  $store_name_fixed = str_replace("'", "\'", $_GET["store_name"]);
  $age = $user_data['age'];

  if ($categ == "Pizza")
  {
    $sql = "select * from pizza ORDER BY categ"; 
    $res =  mysqli_query($con,$sql);
  }
  else if ($categ == "Souvlaki")
  {
    $sql = "select * from souvlaki ORDER BY categ"; 
    $res =  mysqli_query($con,$sql);
  }
  else if ($categ == "Coffee")
  {
    $sql = "select * from coffee ORDER BY categ"; 
    $res =  mysqli_query($con,$sql);
  }
  else if ($categ == "Burger")
  {
    $sql = "select * from burger ORDER BY categ"; 
    $res =  mysqli_query($con,$sql);
  }
  else if ($categ == "Cocktail")
  {
    $sql = "select * from cocktail ORDER BY categ"; 
    $res =  mysqli_query($con,$sql);
  }

  $st = "SELECT min_order FROM stores WHERE store_name = '$store_name_fixed'";
  $rsl = mysqli_query($con, $st);
  $row = mysqli_fetch_array($rsl);
  $min = $row['min_order'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Foody | <?php echo $store_name; ?> - Menu</title>
  <link rel="icon" href="images/tab_icon.png">
  <link rel="stylesheet" href="menu.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer type="text/javascript" src="menu.js"></script>
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

  <button class="mobile-cart-toggle" onclick="ShowCartMenu()"></button>
  
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
        
    </ul>
  </div>
</nav>

<p hidden> The category is <span id="category" ><?php echo $categ; ?></span> </p>
<p hidden> The store is <span id="store"><?php echo $store_name; ?></span> </p>
<p hidden> Users age is <span id="age"><?php echo $age; ?></span></p>
<p id="age" hidden> <?php echo $age; ?></p>

<div id="alert-info" class="alert-info">

  <!-- Alert info -->
  <div class="details-alert">
    <span class="close">&times;</span>
    <p id="alert-title" class="alert-title"></p>
    <p id="cart" class="info-text"></p>
    <p id="minimum" class="info-text"></p>
    <p id="remaining" class="info-text"></p>
    <p id="adults-reason" class="info-text"></p>
    <p id="adults-remove" class="info-text"></p>
  </div>

</div>

<!-- *********** BANNER ******************** -->

<div class="fixed-div-banner">

  <div id="div-menu-banner" class="div-menu-banner">
    
    <div>
      <h1 class="h1-store-name"> <?php echo $store_name; ?> </h1>

      <div class="div-store-info">
        <img class="img-info-store" src='images/info-light.png'>
        <p id="min-order" hidden><?php echo $min ?></p>
        <h3 class="h3-min-order"> Min. Order:  <?php echo $min ?> €</h3>
        <p class="a-reviews">  </p>
        <img class="img-reviews-store" src='images/reviews-store.png'>
        <a class="a-reviews" href="./store_reviews.php?categ=<?php echo $categ ?>&store_name=<?php echo $store_name ?>"> Reviews </a>
      </div>
    </div>

  </div>

  <div class="div-menu-categ" align="center">
    <?php
        if ($categ == "Pizza" || $categ == "Souvlaki" || $categ == "Burger")
        {
          echo '
          <div class="div-btn-1">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,10)"> Starters </button>
          </div>
          <div class="div-btn-2">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,700)"> Main Dishes </button>
          </div>
          <div class="div-btn-3">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,1400)"> Drinks </button>
          </div>';   
        }
        else if ($categ == "Coffee")
        {
          echo '
          <div class="div-btn-1">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,10)"> Hot Drinks </button>
          </div>
          <div class="div-btn-2">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,700)"> Cold Drinks </button>
          </div>
          <div class="div-btn-3">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,1200)"> Snacks </button>
          </div>';
        }
        else if ($categ == "Cocktail")
        {
          echo '
          <div class="div-btn-1">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,10)"> Wines & Beers </button>
          </div>
          <div class="div-btn-2">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,1300)"> Cocktails </button>
          </div>
          <div class="div-btn-3">
            <button class="button-categ" type="button" id="button" name="addorder" onclick="scrollToItems(0,2400)"> Snacks </button>
          </div>';
        }
    ?>

  </div>

</div>

<!-- *********** CART ******************** -->

<div data-visible="false" id="div-your-order" class="div-your-order">

  <h1 class="h1-your-order"> YOUR ORDER </h1>

</div>

<div id="div-cart-title" class="div-cart-title">

  <h2 class="h2-items-title"> CART </h2>

</div>

<div id="container-all" class="container-all">

  <div id="div-cart" class="div-cart">

    <h3 id="h3-empty-cart" class="h3-empty-cart"> ** Your cart is empty ** </h3>

    <div class="fixed-table">
      <table id="dynamic-table" class="dynamic-table">
        <tr>
          <th hidden>ID</th>
          <th class="table-items">ITEMS</th>
          <th class="table-quantity">QUANTITY</th>
          <th class="table-price">PRICE</th>
          <th class="table-remove"> </th>
          <th hidden>Adults</th>
          <th hidden>TIME</th>
        </tr>
      </table>
    </div>

    <div class="div-total-price">
      <div id="suggestions" class="suggestions"> </div>
      <span class="span-order">Total:</span>
      <span class="span-order" id="total-price">0,00</span>
      <span class="span-order">€</span>
      <span hidden>Time:</span>
      <span id="total-order-time" hidden>0</span>

    </div>


    <div class="div-send-order">
      <form method="post">
        <button class="button-send-order" type="button" onclick="SendOrder()" name="send" > Send Order </button>
      </form>
    </div>

  </div>

  <div class="container-menu">
    
    <div id="div-menu" class="div-menu" align="center">

      <?php
          $a = 0;
          $b = 0;
          $c = 0;
          while ($menu_data = $res->fetch_assoc()) 
          {       
              if (strcmp($menu_data['categ'],"1") == 0)
              {
                if ($a == 0)
                {
                  echo '<h2 id="cat_title_1" class="cat_title_1"> </h2>';
                  $a=1;
                }
                  echo '
                    <div id="div-first-category" class="div-first-category">
                      <div class="div-items" id="'.$menu_data['id'].'">
                        <div class="div-firstcat-col1">
                          <p class="item-name" id="item-name">'.$menu_data['name'].'</p>';
                          if ($categ == "Coffee")
                          {
                            echo '
                            <div class="sugar-container">
                              <div class="radio-filter">
                                <div>
                                  <input type="radio" name="filter" value="1" id="cat_1">
                                  <label for="cat_1"> Σκέτος</label><br>
                                </div>
                                <div>
                                  <input type="radio" name="filter" value="2" id="cat_2">
                                  <label for="cat_2"> Μέτριος</label><br>
                                </div>
                                <div>
                                  <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="3" id="cat_3">
                                  <label for="cat_3"> Γλυκός</label><br>
                                </div>
                              </div>
                            </div>';
                          }
                          else
                          {
                            echo '<div class="desc-container">
                            <p class="item-desc">'.$menu_data['description'].'</p>
                          </div>';
                          }

                          if ($categ == "Coffee")
                          {
                            echo '
                            <div class="popup-desc" onclick="ShowDetails_Coffee('.$menu_data['id'].')">
                              <p class="p-info">'.$menu_data['name'].' <img id="img-info" class="img-info" src="images/info-light.png" alt="info"> </p>
                              <div class="popuptext-sugar" id="popuptext-sugar">
                                <div class="radio-filter info-radio">
                                  <div>
                                    <input type="radio" name="filter" value="1" id="cat_1">
                                    <label for="cat_1"> Σκέτος</label>
                                  </div>
                                  <div>
                                    <input type="radio" name="filter" value="2" id="cat_2">
                                    <label for="cat_2"> Μέτριος</label>
                                  </div>
                                  <div>
                                    <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="3" id="cat_3">
                                    <label for="cat_3"> Γλυκός</label>
                                  </div>
                                </div>
                                <br /> Χρόνος Παρασκευής: '.$menu_data['time'].'\'
                              </div>
                            </div>';
                          }
                          else
                          {
                            echo '
                            <div class="popup-desc" onclick="ShowDetails('.$menu_data['id'].')">
                              <p class="p-info">'.$menu_data['name'].' <img id="img-info" class="img-info" src="images/info-light.png" alt="info"> </p>
                              <span class="popuptext" id="popuptext">'.$menu_data['description'].' <br /><br /> Χρόνος Παρασκευής: '.$menu_data['time'].'\'</span>
                            </div>';
                          }

                          echo '
                          <div class="time-container">
                            <span class="item-time">Χρόνος Παρασκευής: </span> 
                            <span id="time" class="time" >'.$menu_data['time'].'\'</span>
                            <p id="adults_only" hidden>'.$menu_data['adults_only'].'</p>
                          </div>
                          
                        </div>
                        <div class="div-firstcat-col2">
                          <p class="item-price" id="price">'.$menu_data['price'].' €</p>
                          <div class="buttons-container">
                            <div id="div-addtoorder" class="div-addtoorder">
                              <button class="button-order" type="button" id="button-order" name="addorder" onclick="AddToOrder('.$menu_data['id'].')"><img src="images/basket-add.png" alt="basket">  Add to order </button>
                            </div>
                            <div id="div-buttons-quantity" class="div-buttons-quantity">
                              <a id="minus" class="minus-item" onclick="RemoveItems('.$menu_data['id'].')"><img src="images/minus-quantity.png" alt="minus"></a>
                              <input type="number" class="input-quantity" id="quantity-input" value="1" name="quantity" min="1" readonly >
                              <a id="add" class="plus-item" onclick="AddItems('.$menu_data['id'].')"><img src="images/add-quantity.png" alt="add"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                    </div>';
              }
              else if (strcmp($menu_data['categ'],"2") == 0)
              {
                if ($b == 0)
                {
                  echo '<h2 id="cat_title_2" class="cat_title_2"> </h2>';
                  $b=1;
                }
                  echo '
                  <div id="div-second-category" class="div-first-category">
                    <div class="div-items" id="'.$menu_data['id'].'">
                      <div class="div-firstcat-col1">
                        <p class="item-name" id="item-name">'.$menu_data['name'].'</p>';
                        if ($categ == "Coffee")
                          {
                            echo '
                            <div class="sugar-container">
                              <div class="radio-filter">
                                <div>
                                  <input type="radio" name="filter" value="1" id="cat_1">
                                  <label for="cat_1"> Σκέτος</label><br>
                                </div>
                                <div>
                                  <input type="radio" name="filter" value="2" id="cat_2">
                                  <label for="cat_2"> Μέτριος</label><br>
                                </div>
                                <div>
                                  <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="3" id="cat_3">
                                  <label for="cat_3"> Γλυκός</label><br>
                                </div>
                              </div>
                            </div>';
                          }
                          else
                          {
                            echo '<div class="desc-container">
                            <p class="item-desc">'.$menu_data['description'].'</p>
                          </div>';
                          }

                          if ($categ == "Coffee")
                          {
                            echo '
                            <div class="popup-desc" onclick="ShowDetails_Coffee('.$menu_data['id'].')">
                              <p class="p-info">'.$menu_data['name'].' <img id="img-info" class="img-info" src="images/info-light.png" alt="info"> </p>
                              <div class="popuptext-sugar" id="popuptext-sugar">
                                <div class="radio-filter info-radio">
                                  <div>
                                    <input type="radio" name="filter" value="1" id="cat_1">
                                    <label for="cat_1"> Σκέτος</label>
                                  </div>
                                  <div>
                                    <input type="radio" name="filter" value="2" id="cat_2">
                                    <label for="cat_2"> Μέτριος</label>
                                  </div>
                                  <div>
                                    <input onclick="FilterCategFunction(this.value)" type="radio" name="filter" value="3" id="cat_3">
                                    <label for="cat_3"> Γλυκός</label>
                                  </div>
                                </div>
                                <br /> Χρόνος Παρασκευής: '.$menu_data['time'].'\'
                              </div>
                            </div>';
                          }
                          else
                          {
                            echo '
                            <div class="popup-desc" onclick="ShowDetails('.$menu_data['id'].')">
                              <p class="p-info">'.$menu_data['name'].' <img id="img-info" class="img-info" src="images/info-light.png" alt="info"> </p>
                              <span class="popuptext" id="popuptext">'.$menu_data['description'].' <br /><br /> Χρόνος Παρασκευής: '.$menu_data['time'].'\'</span>
                            </div>';
                          }
                        
                        echo '
                        <div class="time-container">
                          <span class="item-time">Χρόνος Παρασκευής: </span> 
                          <span id="time" class="time" >'.$menu_data['time'].'\'</span>
                          <p id="adults_only" hidden>'.$menu_data['adults_only'].'</p>
                        </div>
                        
                      </div>
                      <div class="div-firstcat-col2">
                        <p class="item-price" id="price">'.$menu_data['price'].' €</p>
                        <div class="buttons-container">
                          <div id="div-addtoorder" class="div-addtoorder">
                            <button class="button-order" type="button" id="button-order" name="addorder" onclick="AddToOrder('.$menu_data['id'].')"><img src="images/basket-add.png" alt="basket">  Add to order </button>
                          </div>
                          <div id="div-buttons-quantity" class="div-buttons-quantity">
                            <a id="minus" class="minus-item" onclick="RemoveItems('.$menu_data['id'].')"><img src="images/minus-quantity.png" alt="minus"></a>
                            <input type="number" class="input-quantity" id="quantity-input" value="1" name="quantity" min="1" readonly >
                            <a id="add" class="plus-item" onclick="AddItems('.$menu_data['id'].')"><img src="images/add-quantity.png" alt="add"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>';


              }
              else if (strcmp($menu_data['categ'],"3") == 0)
              {
                if ($c == 0)
                {
                  echo '<h2 id="cat_title_3" class="cat_title_3"> </h2>';
                  $c=1;
                }
                  echo '
                    <div id="div-third-category" class="div-first-category">
                      <div class="div-items" id="'.$menu_data['id'].'">
                        <div class="div-firstcat-col1">
                          <p class="item-name" id="item-name">'.$menu_data['name'].'</p>
                          <div class="desc-container">
                            <p class="item-desc">'.$menu_data['description'].'</p>
                          </div>
                          <div class="popup-desc" onclick="ShowDetails('.$menu_data['id'].')">
                            <p class="p-info">'.$menu_data['name'].' <img id="img-info" class="img-info" src="images/info-light.png" alt="info"></p>
                            <span class="popuptext" id="popuptext">'.$menu_data['description'].' <br /><br /> Χρόνος Παρασκευής: '.$menu_data['time'].'\'</span>
                          </div>
                          
                          <div class="time-container">
                            <span class="item-time">Χρόνος Παρασκευής: </span> 
                            <span id="time" class="time" >'.$menu_data['time'].'\'</span>
                            <p id="adults_only" hidden>'.$menu_data['adults_only'].'</p>
                          </div>
                          
                        </div>
                        <div class="div-firstcat-col2">
                          <p class="item-price" id="price">'.$menu_data['price'].' €</p>
                          <div class="buttons-container">
                            <div id="div-addtoorder" class="div-addtoorder">
                              <button class="button-order" type="button" id="button-order" name="addorder" onclick="AddToOrder('.$menu_data['id'].')"><img src="images/basket-add.png" alt="basket">  Add to order </button>
                            </div>
                            <div id="div-buttons-quantity" class="div-buttons-quantity">
                              <a id="minus" class="minus-item" onclick="RemoveItems('.$menu_data['id'].')"><img src="images/minus-quantity.png" alt="minus"></a>
                              <input type="number" class="input-quantity" id="quantity-input" value="1" name="quantity" min="1" readonly >
                              <a id="add" class="plus-item" onclick="AddItems('.$menu_data['id'].')"><img src="images/add-quantity.png" alt="add"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                    </div>';
              }
              

          }
          

      ?>

    </div>

  </div>

</div>

</body>
</html>