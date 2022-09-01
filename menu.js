function showTheme() 
{
    // Check Local Storage then apply dark theme if it's active

    // var darkMode = localStorage.getItem('darkMode');
    

    const date = new Date();
    const hour = date.getHours();

    if (hour <= 5 || hour >= 20) 
    {
        localStorage.setItem('darkMode', 'enabled');
        document.body.classList.toggle('dark');

        var elms = document.querySelectorAll("#img-info");

        for(var i = 0; i < elms.length; i++) 
        {
            elms[i].src ="images/info-dark.png";
        }
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
    var banner = document.getElementById("div-menu-banner");
    var title_1 = document.getElementById("cat_title_1");
    var title_2 = document.getElementById("cat_title_2");
    var title_3 = document.getElementById("cat_title_3");

    var counter = sessionStorage.getItem('streak_category');
    var prev_categ = sessionStorage.getItem('prev_categ');

    if (categ == "Souvlaki")
    {
        title_1.innerText = "Starters";
        title_2.innerText = "Main Dishes";
        title_3.innerText = "Drinks";
        banner.style.backgroundImage="url(./images/souvlaki-blurred.jpg)";

        if (prev_categ == "Souvlaki")
        {
            counter++;
            sessionStorage.setItem('streak_category', counter);
        }
        else
        {
            prev_categ = "Souvlaki";
            sessionStorage.setItem('prev_categ', prev_categ);

            counter = 1;
            sessionStorage.setItem('streak_category', counter);

        }

    }
    else if (categ == "Pizza")
    {
        title_1.innerText = "Starters";
        title_2.innerText = "Main Dishes";
        title_3.innerText = "Drinks";
        banner.style.backgroundImage ="url(./images/pizza-blurred.jpg)";

        if (prev_categ == "Pizza")
        {
            counter++;
            sessionStorage.setItem('streak_category', counter);
        }
        else
        {
            prev_categ = "Pizza";
            sessionStorage.setItem('prev_categ', prev_categ);

            counter = 1;
            sessionStorage.setItem('streak_category', counter);

        }
    
    }
    else if (categ == "Coffee")
    {
        title_1.innerText = "Hot Drinks";
        title_2.innerText = "Cold Drinks";
        title_3.innerText = "Snacks";
        banner.style.backgroundImage ="url(./images/coffee-blurred.jpg)";

        if (prev_categ == "Coffee")
        {
            counter++;
            sessionStorage.setItem('streak_category', counter);
        }
        else
        {
            prev_categ = "Coffee";
            sessionStorage.setItem('prev_categ', prev_categ);

            counter = 1;
            sessionStorage.setItem('streak_category', counter);

        }
    
    }
    else if (categ == "Burger")
    {
        title_1.innerText = "Starters";
        title_2.innerText = "Main Dishes";
        title_3.innerText = "Drinks";
        banner.style.backgroundImage ="url(./images/burger-blurred.jpg)";

        if (prev_categ == "Burger")
        {
            counter++;
            sessionStorage.setItem('streak_category', counter);
        }
        else
        {
            prev_categ = "Burger";
            sessionStorage.setItem('prev_categ', prev_categ);

            counter = 1;
            sessionStorage.setItem('streak_category', counter);

        }
    
    }
    else if (categ == "Cocktail")
    {
        title_1.innerText = "Wines & Beers";
        title_2.innerText = "Cocktails";
        title_3.innerText = "Snacks";
        banner.style.backgroundImage ="url(./images/cocktail_1.jpg)";
        banner.style.backgroundPosition ="top";

        if (prev_categ == "Cocktail")
        {
            counter++;
            sessionStorage.setItem('streak_category', counter);
        }
        else
        {
            prev_categ = "Cocktail";
            sessionStorage.setItem('prev_categ', prev_categ);

            counter = 1;
            sessionStorage.setItem('streak_category', counter);

        }
    }
}

function scrollToItems(x,y) 
{
    window.scrollTo(x,y);
}

function AddItems(id) 
{
    var value = parseInt(document.getElementById(id).querySelector("#quantity-input").value);

    value++;
    document.getElementById(id).querySelector("#quantity-input").value = value;

    var table = document.getElementById('dynamic-table');

    for (var i = 0, row; row = table.rows[i]; i++) 
    {
        for (var j = 0, col; col = row.cells[j]; j++) 
        {
            if (j == 1)
            {
                if (row.cells[0].innerHTML == id)
                {
                    row.cells[2].innerHTML = value;

                    var orig_price = parseFloat(document.getElementById(id).querySelector("#price").innerHTML.replace(",", ".")).toFixed(2);
                    var new_price = (orig_price * value).toFixed(2);
                    row.cells[3].innerHTML = new_price.replace(".", ",")+" €";
                    
                    var orig_time = parseInt(document.getElementById(id).querySelector("#time").innerHTML);
                    var new_time = orig_time * value;
                    row.cells[5].innerHTML = new_time;

                }
            }  
        }  
    }

    UpdateTotalPrice();
    UpdateOrderTime();

}

function RemoveItems(id) 
{
    var value = parseInt(document.getElementById(id).querySelector("#quantity-input").value);

    value--;
    if (value < 1)
    {
        document.getElementById(id).querySelector("#quantity-input").value = 1;
    }
    else
    {
        document.getElementById(id).querySelector("#quantity-input").value = value;
    }

    var table = document.getElementById('dynamic-table');

    for (var i = 0, row; row = table.rows[i]; i++) 
    {
        for (var j = 0, col; col = row.cells[j]; j++) 
        {
            if(j == 1)
            {
                if (row.cells[0].innerHTML == id)
                {
                    var orig_price = parseFloat(document.getElementById(id).querySelector("#price").innerHTML.replace(",", ".")).toFixed(2);
                    var orig_time = parseInt(document.getElementById(id).querySelector("#price").innerHTML);

                    if (value < 1)
                    {
                        row.cells[2].innerHTML = 1;
                        row.cells[3].innerHTML = orig_price.replace(".", ",")+" €";
                        row.cells[5].innerHTML = orig_time;
                    }
                    else
                    {
                        row.cells[2].innerHTML = value;

                        if (row.cells[0].innerHTML == id)
                        {
                            row.cells[2].innerHTML = value;
                            
                            var price = parseFloat(row.cells[3].innerHTML.replace(",", ".")).toFixed(2); 
                            var new_price = (price - orig_price).toFixed(2);
                            row.cells[3].innerHTML = new_price.replace(".", ",")+" €";

                            var time = parseInt(row.cells[5].innerHTML); 
                            var new_time = time - orig_time;
                            row.cells[5].innerHTML = new_time;


                        }

                    }
                }
            }  
        }  
    }

    UpdateTotalPrice();
    UpdateOrderTime();


}

//no adults only item
var adults = 0;

function AddToOrder(id)
{
    //based of div id get elements
    var quantity =  document.getElementById(id).querySelector("#quantity-input");

    var div_addToCart =  document.getElementById(id).querySelector("#div-addtoorder");
    var div_buttonsQuantity = document.getElementById(id).querySelector("#div-buttons-quantity");

    var table = document.getElementById('dynamic-table');
    table.style.display = "inline-table";

    var msg_empty = document.getElementById('h3-empty-cart');
    msg_empty.style.display = "none";
    // msg_empty.style.visibility = "hidden";

    div_addToCart.style.opacity = "0";
    div_addToCart.style.visibility = "hidden";

    div_buttonsQuantity.style.opacity = "1";
    div_buttonsQuantity.style.visibility = "visible";

    var item_name = document.getElementById(id).querySelector("#item-name").innerHTML;
    var item_quantity = quantity.value;
    var item_price = document.getElementById(id).querySelector("#price").innerHTML;
    var time = document.getElementById(id).querySelector("#time").innerHTML;
    var adults_only = document.getElementById(id).querySelector("#adults_only").innerHTML;

    var user_age = parseInt(document.getElementById("age").innerHTML);

    if (adults_only == 1)
    {
        if (user_age < 18)
        {
            adults++;
        }
    }

    // var table = document.getElementById("dynamic-table");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);

    cell1.innerHTML = id;
    cell2.innerHTML = item_name;
    cell3.innerHTML = item_quantity;
    cell4.innerHTML = item_price;
    cell5.innerHTML = "<button class='delete-item' onclick='RemoveFromCart()';><img src='images/delete-item.png' alt='delete-item'></button>";
    cell6.innerHTML = time;
    cell7.innerHTML = adults_only;

    var suggest = document.getElementById("suggestions");
    var categ = document.getElementById('category').innerHTML;

    if (categ == "Souvlaki" || categ == "Pizza" || categ == "Burger")
    {
        if (item_name != "Coca-Cola" && item_name != "Coca-Cola zero") 
        {
            suggest.style.display = "block";
            suggest.innerHTML = `<span class='text-suggest'> Did you forget to add a Coca-Cola? </span> <img onclick='AddSuggestion("12")' id='img-info' class='img-suggest' src='images/add-suggest-light.png' alt='info'>`;
        }
        else
        {
            suggest.className = "suggestions-end";
        }
    }
    else if (categ == "Coffee")
    {
        if (item_name != "Cupcake") 
        {
            suggest.style.display = "block";
            suggest.innerHTML = `<span class='text-suggest'> Did you forget to add a Cupcake? </span> <img onclick='AddSuggestion("13")' id='img-info' class='img-suggest' src='images/add-suggest-light.png' alt='info'>`;
        }
        else
        {
            suggest.className = "suggestions-end";
        }
    }
    else if (categ == "Cocktail")
    {
        if (item_name != "Pop Corn") 
        {
            suggest.style.display = "block";
            suggest.innerHTML = `<span id='text-suggest'> Did you forget to add a Pop Corn? </span> <img onclick='AddSuggestion("18")' id='img-info' class='img-suggest' src='images/add-suggest-light.png' alt='info'>`;
        }
        else
        {
            suggest.className = "suggestions-end";
        }
    }

    UpdateTotalPrice();
    UpdateOrderTime();

}

function AddSuggestion(id_suggest) 
{

    // var suggest = document.getElementById("suggestions");
    var suggest = document.getElementById("suggestions");
    suggest.className = 'suggestions-end';

    var table = document.getElementById("dynamic-table");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    // var item_id = "12";

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);

    if (id_suggest == "12")
    {
        // coca-cola
        var div_addToCart =  document.getElementById("12").querySelector("#div-addtoorder");
        var div_buttonsQuantity = document.getElementById("12").querySelector("#div-buttons-quantity");

        div_addToCart.style.opacity = "0";
        div_addToCart.style.visibility = "hidden";

        div_buttonsQuantity.style.opacity = "1";
        div_buttonsQuantity.style.visibility = "visible";

        cell1.innerHTML = "12";
        cell2.innerHTML = "Coca-Cola";
        cell3.innerHTML = "1";
        cell4.innerHTML = "1,30 €";
        cell5.innerHTML = "<button class='delete-item' onclick='RemoveFromCart()';><img src='images/delete-item.png' alt='delete-item'></button>";
        cell6.innerHTML = "0";
    }
    else if (id_suggest == "13")
    {
        // cupcake
        var div_addToCart =  document.getElementById("13").querySelector("#div-addtoorder");
        var div_buttonsQuantity = document.getElementById("13").querySelector("#div-buttons-quantity");

        div_addToCart.style.opacity = "0";
        div_addToCart.style.visibility = "hidden";

        div_buttonsQuantity.style.opacity = "1";
        div_buttonsQuantity.style.visibility = "visible";

        cell1.innerHTML = "13";
        cell2.innerHTML = "Cupcake";
        cell3.innerHTML = "1";
        cell4.innerHTML = "1,80 €";
        cell5.innerHTML = "<button class='delete-item' onclick='RemoveFromCart()';><img src='images/delete-item.png' alt='delete-item'></button>";
        cell6.innerHTML = "3";
    }
    else if (id_suggest == "18")
    {
        // pop corn
        var div_addToCart =  document.getElementById("18").querySelector("#div-addtoorder");
        var div_buttonsQuantity = document.getElementById("18").querySelector("#div-buttons-quantity");

        div_addToCart.style.opacity = "0";
        div_addToCart.style.visibility = "hidden";

        div_buttonsQuantity.style.opacity = "1";
        div_buttonsQuantity.style.visibility = "visible";

        cell1.innerHTML = "18";
        cell2.innerHTML = "Pop Corn";
        cell3.innerHTML = "1";
        cell4.innerHTML = "1,50 €";
        cell5.innerHTML = "<button class='delete-item' onclick='RemoveFromCart()';><img src='images/delete-item.png' alt='delete-item'></button>";
        cell6.innerHTML = "0";
    }

    UpdateTotalPrice();
    UpdateOrderTime();

}

function RemoveFromCart()
{ 
// event.target will be the input element.
var td = event.target.parentNode; 
var tr = td.parentNode.parentNode; // the row to be removed
var item_id = td.parentNode.parentNode.cells[0].innerHTML; // id of item

var suggest = document.getElementById("suggestions");

tr.parentNode.removeChild(tr);

// var items = document.getElementById("div-first-category").children;

var div_addToCart =  document.getElementById(item_id).querySelector("#div-addtoorder");
var div_buttonsQuantity = document.getElementById(item_id).querySelector("#div-buttons-quantity");

var adult_only_check = document.getElementById(item_id).querySelector("#adults_only").innerHTML;
var user_age = parseInt(document.getElementById("age").innerHTML);

if (adult_only_check == 1)
{
    if (user_age < 18)
    {
    if (adults == 0)
    {
        adults = 0;
    }
    else
    {
        adults--;
    }
    }
}

div_addToCart.style.opacity = "1";
div_addToCart.style.visibility = "visible";

div_buttonsQuantity.style.opacity = "0";
div_buttonsQuantity.style.visibility = "hidden";

var x = document.getElementById("dynamic-table").rows.length;

if (x == 1)
{
    var write_total = document.getElementById("total-price");
    write_total.innerHTML = "0,00";

    var write_time = document.getElementById("total-order-time");
    write_time.innerHTML = "0";

    var msg_empty = document.getElementById('h3-empty-cart');
    msg_empty.style.display = "block";

    var table = document.getElementById('dynamic-table');
    table.style.display = "none";

    suggest.className = 'suggestions-end';

}
else
{
    UpdateTotalPrice();
    UpdateOrderTime();
}

}

function UpdateTotalPrice() 
{
var table = document.getElementById('dynamic-table');
var total = 0.00;

for (var i = 0, row; row = table.rows[i]; i++) 
{
    for (var j = 0, col; col = row.cells[j]; j++) 
    {
    if(j == 3 &&  i != 0)
    {
    
        var price = parseFloat(row.cells[3].innerHTML.replace(",", "."));
        
        total = total + price; 
        var write_total = document.getElementById("total-price");
        write_total.innerHTML = (total.toFixed(2)).replace(".", ","); 
        
        }
    
    }  
}
}

function UpdateOrderTime()
{
var table = document.getElementById('dynamic-table');
var order_time = 0;

for (var i = 0, row; row = table.rows[i]; i++) 
{
    for (var j = 0, col; col = row.cells[j]; j++) 
    {
    if(j == 5 &&  i != 0)
    {
    
        var time = parseInt(row.cells[5].innerHTML);
        
        
        order_time = order_time + time; 
        var write_time = document.getElementById("total-order-time");

        if(order_time > 60)
        {
            var hours = (order_time / 60);
            var rhours = Math.floor(hours);
            var minutes = (hours - rhours) * 60;
            var rminutes = Math.round(minutes); 
            write_time.innerHTML = rhours + " hour(s) and " + rminutes;
        }
        else 
        {
            write_time.innerHTML = order_time; 
        }
        
        }
    
    }  
}
}

var OrderHasBeenSent = 0;

function SendOrder()
{

    var x = document.getElementById("dynamic-table").rows.length;
    var order_time = document.getElementById("total-order-time").innerHTML;
    var total_price = document.getElementById("total-price").innerHTML;
    var min = parseFloat(document.getElementById("min-order").innerHTML).toFixed(2);

    var alert_info = document.getElementById("alert-info");

    var close_alert = document.getElementsByClassName("close")[0];

    var alert_title = document.getElementById("alert-title");
    var text_min = document.getElementById("minimum");
    var text_remain = document.getElementById("remaining");
    var text_cart = document.getElementById("cart");
    var text_adults_reason = document.getElementById("adults-reason");
    var text_adults_remove = document.getElementById("adults-remove");

    var float_price = parseFloat(total_price.replace(",", "."));
    var alert_info = document.getElementById("alert-info");

    var user_age = parseInt(document.getElementById("age").innerHTML);

    if (x == 1)
    {
        alert_info.style.display = "block";
        alert_title.innerHTML = "&#x1F610; Something went wrong!";
        text_cart.innerHTML = "• Add items in cart and try again.";
        text_remain.innerHTML = "";
        text_min.innerHTML = "";
        text_adults_reason.innerHTML = "";
        text_adults_remove.innerHTML = "";
        
        close_alert.onclick = function() {
            alert_info.style.display = "none";
        };
    }
    else 
    {
        if (float_price < min)
        {
            var remain = parseFloat(min - float_price).toFixed(2);

            alert_info.style.display = "block";
            alert_title.innerHTML = "&#x1F610; Something went wrong!";
            text_cart.innerHTML = "";
            text_min.innerHTML = "• Make order over "+ min.replace(".", ",") +" € and try again.";
            text_remain.innerHTML = "• You need additional "+ remain.replace(".", ",") +" € for minimum order.";
            text_adults_reason.innerHTML = "";
            text_adults_remove.innerHTML = "";
            
            close_alert.onclick = function() {
                alert_info.style.display = "none";
            };
        }
        else
        { 
            if (user_age <= 18 && adults > 0)
            {
                alert_info.style.display = "block";
                text_cart.innerHTML = "";
                text_min.innerHTML = "";
                text_remain.innerHTML = "";
                alert_title.innerHTML = "&#x1F51E; Alcohol drink detected in your cart";
                text_adults_reason.innerHTML = "• 18+ only";
                text_adults_remove.innerHTML = "• Remove any alcohol drinks and try again.";
                
                close_alert.onclick = function() {
                    alert_info.style.display = "none";
                };
            }
            else
            {
                OrderHasBeenSent = 1;

                var category= document.getElementById("category").innerHTML;
                var store= document.getElementById("store").innerHTML;

                var today_date = new Date();
                var date = today_date.getDate()+'-'+(today_date.getMonth()+1)+'-'+today_date.getFullYear();

                var today_time = new Date();
                var time = today_time.getHours() + ":" + today_time.getMinutes() + ":" + today_time.getSeconds();

                if (order_time <= 10)
                {
                    order_time = 15;
                    window.location.href = './order.php?categ='+category+"&store="+store+"&total_price="+total_price+"&order_time="+order_time+"&time="+time+"&date="+date;
                }
                else
                {
                    window.location.href = './order.php?categ='+category+"&store="+store+"&total_price="+total_price+"&order_time="+order_time+"&time="+time+"&date="+date;
                }
            }

        }
    }
}

var count = 0;

function ShowDetails(id)
{
    var popup = document.getElementById(id).querySelector("#popuptext");

    if (popup.style.visibility === "hidden" || popup.style.visibility === "")
    {
        popup.style.visibility = "visible";
        popup.style.opacity = "1";

    }
    else
    {
        popup.style.visibility = "hidden";
        popup.style.opacity = "0";

    }

}

function ShowDetails_Coffee(id)
{
    var popup_sugar = document.getElementById(id).querySelector("#popuptext-sugar");


    if (popup_sugar.style.visibility === "hidden" || popup_sugar.style.visibility === "")
    {
        popup_sugar.style.visibility = "visible";
        popup_sugar.style.opacity = "1";
    }
    else
    {
        popup_sugar.style.visibility = "hidden";
        popup_sugar.style.opacity = "0";
    }


}



var cart = document.getElementById("div-your-order");
var background = document.querySelector(".blurred-background");

function ShowCartMenu()
{
const vis_cart = cart.getAttribute('data-visible');

if (vis_cart == "false") 
{
    cart.setAttribute('data-visible', 'true');
    document.getElementsByClassName('div-cart')[0].style.display = "block";
    document.getElementsByClassName('div-your-order')[0].style.display = "block";
    document.getElementsByClassName('div-cart-title')[0].style.display = "block";
    background.style.visibility ="visible";
}
else
{
    cart.setAttribute('data-visible', 'false');
    document.getElementsByClassName('div-cart')[0].style.display = "none";
    document.getElementsByClassName('div-your-order')[0].style.display = "none";
    document.getElementsByClassName('div-cart-title')[0].style.display = "none";
    background.style.visibility ="hidden";
}

}

//confirm for leaving page
window.onbeforeunload = confirmExit;
function confirmExit()
{

if (OrderHasBeenSent == 0)
{
    return "Message";
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
    }
    else 
    {
        ul_nav.setAttribute('data-visible', 'false');
        background.style.visibility ="hidden";
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

    if (window.innerWidth > 1360) 
    {
        //not in mobile
        if (window.screen.width > 414) 
        {
        cart.setAttribute('data-visible', 'false');
        document.getElementsByClassName('div-cart')[0].style.display = "block";
        document.getElementsByClassName('div-your-order')[0].style.display = "block";
        document.getElementsByClassName('div-cart-title')[0].style.display = "block";
        background.style.visibility ="visible";
        }

    }
};

var user_age = parseInt(document.getElementById("age").innerHTML);
const root = document.documentElement;

//not in mobile
if (window.screen.width > 414) 
{
    if (user_age > 65)
    {
        root.style.setProperty('font-size', '1.2rem');
        root.style.setProperty('--older', '0px');
        root.style.setProperty('--order-older', '5px');
        root.style.setProperty('--desc-older', '20px');
        
      
    }
    
}
