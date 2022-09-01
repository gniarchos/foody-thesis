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