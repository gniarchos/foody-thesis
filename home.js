function showTheme() {

    var welcome = document.getElementById('h1-welcome');
    var time_choices = document.getElementById('daytime-choices');
    var fname = document.getElementById('fname').innerHTML;
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

    if (hour >= 20 || hour < 5) 
    {
        welcome.innerHTML = "Good Night " + fname + "!";
        time_choices.innerHTML = "Night Suggestions:";
    } 
    else if (hour >= 13)
    {
        welcome.innerHTML = "Good Evening " + fname + "!";
        time_choices.innerHTML = "Evening Suggestions:";
    }
    else
    {
        welcome.innerHTML = "Good Morning " + fname + "!";
        time_choices.innerHTML = "Morning Suggestions:";
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

var counter = sessionStorage.getItem('streak_category');
var prev_categ = sessionStorage.getItem('prev_categ');

var alert_info = document.getElementById("alert-info");
var close_alert = document.getElementsByClassName("close")[0];
var alert_title = document.getElementById("alert-title");
var alert_subtitle = document.getElementById("subtitle");
var best_souvlaki = document.getElementById("div-best-souvlaki");
var best_pizza = document.getElementById("div-best-pizza");
var best_coffee = document.getElementById("div-best-coffee");
var best_burger = document.getElementById("div-best-burger");
var best_cocktail = document.getElementById("div-best-cocktail");


if (counter == "3")
{
    if (prev_categ == "Souvlaki")
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#x1F924; We noticed you are looking for Souvlaki!";
        alert_subtitle.innerHTML = "We picked for you the best stores of this category:";

        best_souvlaki.style.display = "block";
        best_pizza.style.display = "none";
        best_coffee.style.display = "none";
        best_burger.style.display = "none";
        best_cocktail.style.display = "none";

        close_alert.onclick = function() {
            sessionStorage.setItem('streak_category', 0);
            alert_info.style.display = "none";
        }
    }
    else if (prev_categ == "Pizza")
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#x1F924; We noticed you are looking for Pizza!";
        alert_subtitle.innerHTML = "We picked for you the best stores of this category:";

        best_souvlaki.style.display = "none";
        best_pizza.style.display = "block";
        best_coffee.style.display = "none";
        best_burger.style.display = "none";
        best_cocktail.style.display = "none";

        close_alert.onclick = function() {
            sessionStorage.setItem('streak_category', 0);
            alert_info.style.display = "none";
        }
    }
    else if (prev_categ == "Coffee")
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#9749; We noticed you are looking for Coffee!";
        alert_subtitle.innerHTML = "We picked for you the best stores of this category:";

        best_souvlaki.style.display = "none";
        best_pizza.style.display = "none";
        best_coffee.style.display = "block";
        best_burger.style.display = "none";
        best_cocktail.style.display = "none";

        close_alert.onclick = function() {
            sessionStorage.setItem('streak_category', 0);
            alert_info.style.display = "none";
        }
    }
    else if (prev_categ == "Burger")
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#x1F924; We noticed you are looking for Burger!";
        alert_subtitle.innerHTML = "We picked for you the best stores of this category:";

        best_souvlaki.style.display = "none";
        best_pizza.style.display = "none";
        best_coffee.style.display = "none";
        best_burger.style.display = "block";
        best_cocktail.style.display = "none";

        close_alert.onclick = function() {
            sessionStorage.setItem('streak_category', 0);
            alert_info.style.display = "none";
        }
    }
    else if (prev_categ == "Cocktail")
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#x1F942; We noticed you are looking for Cocktail!";
        alert_subtitle.innerHTML = "We picked for you the best stores of this category:";

        best_souvlaki.style.display = "none";
        best_pizza.style.display = "none";
        best_coffee.style.display = "none";
        best_burger.style.display = "none";
        best_cocktail.style.display = "block";

        close_alert.onclick = function() {
            sessionStorage.setItem('streak_category', 0);
            alert_info.style.display = "none";
        }
    }
}


function SearchFunction() 
{
    var sel = document.getElementById("option-search");
    var num_sel = sel.value;

    if (num_sel == 1)
    {
    let input = document.getElementById('searchbar').value
    input = input.toLowerCase();
    let store_name = document.getElementsByClassName('a-name');
    let store_img = document.getElementsByClassName('store-img');
    let store_cat = document.getElementsByClassName('p-categ');
    let stars_num = document.getElementsByClassName('a-stars');
    let store_stars = document.getElementsByClassName('store-stars');
    let list = document.getElementsByClassName('myUL');
    let match = false;
    
        
    for (i = 0; i < store_name.length; i++) 
    { 
        if (!store_name[i].innerHTML.toLowerCase().includes(input)) {
            store_name[i].style.display="none";
            store_img[i].style.display="none";
            store_cat[i].style.display="none";
            stars_num[i].style.display="none";
            store_stars[i].style.display="none";
            list[i].style.display="none";
        }
        else {
            match = true;
            store_name[i].style.display="list-item"; 
            store_img[i].style.display="list-item";
            store_cat[i].style.display="list-item";
            stars_num[i].style.display="list-item";  
            store_stars[i].style.display="list-item";
            list[i].style.display="list-item"; 
        }
    }

    if (match == false) 
    {
        document.querySelector(".div-nostore").style.display = 'list-item';
        
    } 
    else 
    {
        document.querySelector(".div-nostore").style.display = 'none';
    }

    }
    else
    {
        let input = document.getElementById('searchbar').value
        input=input.toLowerCase();
        let store_name = document.getElementsByClassName('a-name');
        let store_img = document.getElementsByClassName('store-img');
        let store_cat = document.getElementsByClassName('p-categ');
        let stars_num = document.getElementsByClassName('a-stars');
        let store_stars = document.getElementsByClassName('store-stars');
        let list = document.getElementsByClassName('myUL');
        let match = false;
        
        
        for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.toLowerCase().includes(input)) {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else {
                match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }

        if (match == false) 
        {
        document.querySelector(".div-nostore").style.display = 'list-item';
        } 
        else 
        {
        document.querySelector(".div-nostore").style.display = 'none';
        }

    }
} 

function FilterCategFunction(category) 
{

    let store_name = document.getElementsByClassName('a-name');
    let store_img = document.getElementsByClassName('store-img');
    let store_cat = document.getElementsByClassName('p-categ');
    let stars_num = document.getElementsByClassName('a-stars');
    let store_stars = document.getElementsByClassName('store-stars');
    let list = document.getElementsByClassName('myUL');

    // console.log(category);

    if (category == "1")
    {
    var cat="Souvlaki";      

    for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.includes(cat)) 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else 
            {
                // match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }
    }
    else if (category == "2")
    {
    var cat="Pizza";

    for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.includes(cat)) 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else 
            {
                // match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }
    }
    else if (category == "3")
    {
    var cat="Coffee";

    for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.includes(cat)) 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else 
            {
                // match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }
    }
    else if (category == "4")
    {
    var cat="Burger";

    for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.includes(cat)) 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else 
            {
                // match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }
    }
    else if (category == "5")
    {
    var cat="Cocktail";

    for (i = 0; i < store_cat.length; i++) 
        { 
            if (!store_cat[i].innerHTML.includes(cat)) 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
            }
            else 
            {
                // match = true;
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item"; 
            }
        }
    }
    else
    {
    //show all
    for (i = 0; i < store_cat.length; i++) 
    { 
        store_name[i].style.display="list-item"; 
        store_img[i].style.display="list-item";
        store_cat[i].style.display="list-item";
        stars_num[i].style.display="list-item";  
        store_stars[i].style.display="list-item";
        list[i].style.display="list-item";
    }
    }

}


function FilterStarsFunction(stars) 
{

    let store_name = document.getElementsByClassName('a-name');
    let store_img = document.getElementsByClassName('store-img');
    let store_cat = document.getElementsByClassName('p-categ');
    let stars_num = document.getElementsByClassName('a-stars');
    let store_stars = document.getElementsByClassName('store-stars');
    let list = document.getElementsByClassName('myUL');

    if (stars == "1")
    {   

        for (i = 0; i < stars_num.length; i++) 
        { 
            if (stars_num[i].innerHTML >= 1.0 && stars_num[i].innerHTML <= 1.9) 
            {
            store_name[i].style.display="list-item"; 
            store_img[i].style.display="list-item";
            store_cat[i].style.display="list-item";
            stars_num[i].style.display="list-item";  
            store_stars[i].style.display="list-item";
            list[i].style.display="list-item"; 
            document.querySelector(".div-nostore").style.display = 'none';
            }
            else 
            {
            store_name[i].style.display="none";
            store_img[i].style.display="none";
            store_cat[i].style.display="none";
            stars_num[i].style.display="none";
            store_stars[i].style.display="none";
            list[i].style.display="none";
            // document.querySelector(".div-nostore").style.display = 'list-item';
                
            }
        }
    }
    else if (stars == "2")
    {   

        for (i = 0; i < stars_num.length; i++) 
        { 
            if (stars_num[i].innerHTML >= 2.0 && stars_num[i].innerHTML <= 2.9) 
            {
            store_name[i].style.display="list-item"; 
            store_img[i].style.display="list-item";
            store_cat[i].style.display="list-item";
            stars_num[i].style.display="list-item";  
            store_stars[i].style.display="list-item";
            list[i].style.display="list-item";
            document.querySelector(".div-nostore").style.display = 'none';
            }
            else 
            {
            store_name[i].style.display="none";
            store_img[i].style.display="none";
            store_cat[i].style.display="none";
            stars_num[i].style.display="none";
            store_stars[i].style.display="none";
            list[i].style.display="none";
            // document.querySelector(".div-nostore").style.display = 'list-item';
                
            }
        }
    }
    else if (stars == "3")
    {   

        for (i = 0; i < stars_num.length; i++) 
        { 
            if (stars_num[i].innerHTML >= 3.0 && stars_num[i].innerHTML <= 3.9)
            {
            store_name[i].style.display="list-item"; 
            store_img[i].style.display="list-item";
            store_cat[i].style.display="list-item";
            stars_num[i].style.display="list-item";  
            store_stars[i].style.display="list-item";
            list[i].style.display="list-item"; 
            document.querySelector(".div-nostore").style.display = 'none';
            }
            else 
            {
            store_name[i].style.display="none";
            store_img[i].style.display="none";
            store_cat[i].style.display="none";
            stars_num[i].style.display="none";
            store_stars[i].style.display="none";
            list[i].style.display="none";
            // document.querySelector(".div-nostore").style.display = 'list-item';
                
            }
        }
    }
    else if (stars == "4")
    {   

        for (i = 0; i < stars_num.length; i++) 
        { 
            if (stars_num[i].innerHTML >= 4.0 && stars_num[i].innerHTML <= 4.6)
            {
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item";
                document.querySelector(".div-nostore").style.display = 'none';
            }
            else 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
                // document.querySelector(".div-nostore").style.display = 'list-item';
            }
        }
    }
    else if (stars == "5")
    {   

        for (i = 0; i < stars_num.length; i++) 
        { 
            if (stars_num[i].innerHTML >= 4.7) 
            {
                store_name[i].style.display="list-item"; 
                store_img[i].style.display="list-item";
                store_cat[i].style.display="list-item";
                stars_num[i].style.display="list-item";  
                store_stars[i].style.display="list-item";
                list[i].style.display="list-item";
                document.querySelector(".div-nostore").style.display = 'none';
            }
            else 
            {
                store_name[i].style.display="none";
                store_img[i].style.display="none";
                store_cat[i].style.display="none";
                stars_num[i].style.display="none";
                store_stars[i].style.display="none";
                list[i].style.display="none";
                // document.querySelector(".div-nostore").style.display = 'list-item';
                    
            }
        }
    }
    else if (stars == "0")
    {
        //show all
        for (i = 0; i < store_cat.length; i++) 
        { 
        store_name[i].style.display="list-item"; 
        store_img[i].style.display="list-item";
        store_cat[i].style.display="list-item";
        stars_num[i].style.display="list-item";  
        store_stars[i].style.display="list-item";
        list[i].style.display="list-item";
        }
    }

}

function FilterClearFunction()
{
    let store_name = document.getElementsByClassName('a-name');
    let store_img = document.getElementsByClassName('store-img');
    let store_cat = document.getElementsByClassName('p-categ');
    let stars_num = document.getElementsByClassName('a-stars');
    let store_stars = document.getElementsByClassName('store-stars');
    let list = document.getElementsByClassName('myUL');

    //show all
    for (i = 0; i < store_name.length; i++) 
    { 
        store_name[i].style.display="list-item"; 
        store_img[i].style.display="list-item";
        store_cat[i].style.display="list-item";
        stars_num[i].style.display="list-item";  
        store_stars[i].style.display="list-item";
        list[i].style.display="list-item";
    }

    //clear radio buttons
    document.getElementById("cat_1").checked = false;
    document.getElementById("cat_2").checked = false;
    document.getElementById("cat_3").checked = false;
    document.getElementById("cat_4").checked = false;
    document.getElementById("cat_5").checked = false;
    document.getElementById("5").checked = false;
    document.getElementById("4").checked = false;
    document.getElementById("3").checked = false;
    document.getElementById("2").checked = false;
    document.getElementById("1").checked = false;

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
window.onresize = function() 
{
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
            