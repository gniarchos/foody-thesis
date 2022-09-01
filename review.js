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

function ShowDetails(id)
{
    var coll = document.getElementById(id).querySelector("#btn-collapse");


    var item_name = document.getElementById(id).querySelector("#store-name");
    item_name.classList.toggle("selected");

    var content = coll.nextElementSibling;
    if (content.style.maxHeight)
    {
        content.style.maxHeight = null;
        coll.style.backgroundColor = "var(--divs-color)";
        coll.style.borderBottom = "2px solid #0092b3";
    } 
    else 
    {
        content.style.maxHeight = content.scrollHeight + "px";
        coll.style.backgroundColor = "var(--rating-form)";
        coll.style.borderBottom = "none";
    } 

}

function hover(star, review_id)
{
    if(star.id == "star-2") 
    {
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
    }
    else if(star.id == "star-3") 
    {
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
    }
    else if(star.id == "star-4") 
    {
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-filled.png');
    }
    else if(star.id == "star-5") 
    {
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-filled.png');
    }
    else 
    {
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
    }

}

function unhover(review_id) 
{
    document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-unfilled.png');
    document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-unfilled.png');
    document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-unfilled.png');
    document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-unfilled.png');
    document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-unfilled.png');
    }

    function ConfirmStars(star, review_id)
    {
    if(star.id == "star-2") 
    {
        // document.getElementById(review_id).querySelector("#stars-selected").style.visibility = "visible";
        // document.getElementById(review_id).querySelector("#stars-selected").style.display = "block";
        document.getElementById(review_id).querySelector("#stars-selected").innerHTML = "OK!";
        document.getElementById(review_id).querySelector("#num-stars").value = "2";

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseout');

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseover');
        
        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-unfilled.png');
    }
    else if(star.id == "star-3") 
    {
        document.getElementById(review_id).querySelector("#stars-selected").style.visibility = "visible";
        document.getElementById(review_id).querySelector("#stars-selected").innerHTML = "GOOD!";
        document.getElementById(review_id).querySelector("#num-stars").value = "3";

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseout');

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseover');

        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-unfilled.png');
    }
    else if(star.id == "star-4") 
    {
        document.getElementById(review_id).querySelector("#stars-selected").style.visibility = "visible";
        document.getElementById(review_id).querySelector("#stars-selected").innerHTML = "GREAT!";
        document.getElementById(review_id).querySelector("#num-stars").value = "4";

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseout');

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseover');

        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-unfilled.png');
    }
    else if(star.id == "star-5") 
    {
        document.getElementById(review_id).querySelector("#stars-selected").style.visibility = "visible";
        document.getElementById(review_id).querySelector("#stars-selected").innerHTML = "AWESOME!";
        document.getElementById(review_id).querySelector("#num-stars").value = "5";

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseout');

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseover');

        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-filled.png');
    }
    else 
    {
        document.getElementById(review_id).querySelector("#stars-selected").style.visibility = "visible";
        document.getElementById(review_id).querySelector("#stars-selected").innerHTML = "BAD!";
        document.getElementById(review_id).querySelector("#num-stars").value = "1";

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseout');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseout');

        document.getElementById(review_id).querySelector("#star-1").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-2").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-3").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-4").removeAttribute('onmouseover');
        document.getElementById(review_id).querySelector("#star-5").removeAttribute('onmouseover');

        document.getElementById(review_id).querySelector("#star-1").setAttribute('src', './images/star-filled.png');
        document.getElementById(review_id).querySelector("#star-2").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-3").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-4").setAttribute('src', './images/star-unfilled.png');
        document.getElementById(review_id).querySelector("#star-5").setAttribute('src', './images/star-unfilled.png');
    }
}

function CheckValid(review_id)
{
    var stars_clicked = document.getElementById(review_id).querySelector("#num-stars").value;

    if (stars_clicked == "0")
    {
        alert("Review can't be submited.\n• You should rate at least with 1 star to submit your review.");
        return false;
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