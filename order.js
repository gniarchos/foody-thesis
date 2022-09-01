function showTheme() 
{
    // Check Local Storage then apply dark theme if it's active
    const date = new Date();
    const hour = date.getHours();

    if (hour <= 5 || hour >= 20) 
    {
        localStorage.setItem('darkMode', 'enabled');
        document.body.classList.toggle('dark');
    } 
    else
    {
        localStorage.setItem('darkMode', null);
        document.body.classList.remove('dark');
    }

}

function showContent() 
{
    document.body.style.visibility = 'visible';
    document.body.style.opacity = 1;
}
  
window.addEventListener('DOMContentLoaded', function () 
{
    showTheme();
    showContent();
});

function ClearStorage()
{
    sessionStorage.clear();
    window.location.href = './logout.php';
    
}


function check_category()
{
    var categ = document.getElementById('category').innerHTML;
    var banner = document.getElementById("div-sideImage");
    var order_color = document.getElementById("div-order-title");

    if (categ == "Souvlaki")
    {
        banner.style.backgroundImage="url(./images/order-souvlaki.jpg)";
        order_color.style.backgroundColor = "#D3B484";
    }
    else if (categ == "Pizza")
    {
        banner.style.backgroundImage ="url(./images/order-pizza.jpg)";
        order_color.style.backgroundColor = "#C78C60";
    }
    else if (categ == "Coffee")
    {
        banner.style.backgroundImage ="url(./images/order-coffee.jpg)";
        order_color.style.backgroundColor = "#362918";
    }
    else if (categ == "Burger")
    {
        banner.style.backgroundImage ="url(./images/order-burger.jpg)";
        order_color.style.backgroundColor = "#0F0F0F";      
    }
    else if (categ == "Cocktail")
    {
        banner.style.backgroundImage ="url(./images/order-cocktail.jpg)";
        order_color.style.backgroundColor = "#B6C4CE";   
    }
}

function ShowNavMenu() 
{
    document.getElementsByClassName('hidden-menu-container')[0].style.display = "flex";
    document.getElementsByClassName('div-button-menu')[0].style.display = "none";

}

function CloseNavMenu() 
{
    document.getElementsByClassName('hidden-menu-container')[0].style.display = "none"; 
    document.getElementsByClassName('div-button-menu')[0].style.display = "block";
}

var button_nav = document.getElementsByClassName("mobile-nav-toggle");
var ul_nav = document.getElementById("navbar-links");
var background = document.querySelector(".blurred-background");

function SlideOutMenu()
{
    const visibility = ul_nav.getAttribute('data-visible');

    if (visibility == "false") 
    {
        ul_nav.setAttribute('data-visible', 'true');
        background.style.visibility ="visible";
        background.style.opacity ="1";
    }
    else 
    {
        ul_nav.setAttribute('data-visible', 'false');
        background.style.visibility ="hidden";
        background.style.opacity ="0";
    }
}

let resizeTimer;
window.onresize = function() {

    // var side_image = document.getElementById("div-sideImage");

    document.body.classList.add("resize-animation-stopper");
    clearTimeout(resizeTimer);

    resizeTimer = setTimeout(() => {
        document.body.classList.remove("resize-animation-stopper");
    }, 400);

}

var side_image = document.getElementById("div-sideImage");

if (window.screen.width <= 414) 
{ 
    var categ = document.getElementById('category').innerHTML;

    if (categ == "Souvlaki")
    {
    side_image.style.backgroundPosition = "top -100px left";
    }
    else if (categ == "Pizza")
    {
    side_image.style.backgroundPosition = "top -400px right";
    }
    else if (categ == "Coffee")
    {
    side_image.style.backgroundPosition = "top -235px left";
    }
    else if (categ == "Burger")
    {
    side_image.style.backgroundPosition = "top -30px left";
    }
    else if (categ == "Cocktail")
    {
    side_image.style.backgroundPosition = "bottom"; 
    }   

}

var user_age = parseInt(document.getElementById("age").innerHTML);
const root = document.documentElement;

//not in mobile
if (window.screen.width > 414) 
{
    if (user_age > 65)
    {
        root.style.setProperty('font-size', '1.2rem');
        root.style.setProperty('--remind-older', '120px');
        root.style.setProperty('--button-older', '-130px');
        root.style.setProperty('--ready-older', '-145px');
        root.style.setProperty('--readyval-older', '-155px');
        
        
    }
    
}
