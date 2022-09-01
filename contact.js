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

//  window.location.href = './home.php'
function CheckValid()
{
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    if (subject == "" || message == "")
    {
        alert("Inputs are empty.\n• Enter your subject and your message and try again.");
        return false;
    }
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

    document.body.classList.add("resize-animation-stopper");
    clearTimeout(resizeTimer);

    resizeTimer = setTimeout(() => {
        document.body.classList.remove("resize-animation-stopper");
    }, 400);

}

var user_age = parseInt(document.getElementById("age").innerHTML);
const root = document.documentElement;

//not in mobile
if (window.screen.width > 414) 
{
    if (user_age > 65)
    {
        root.style.setProperty('font-size', '1.2rem');
    }
    
}