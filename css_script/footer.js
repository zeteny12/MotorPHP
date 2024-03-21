window.addEventListener('load', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var menuParam = urlParams.get('menu');
    var footer = document.querySelector('.footer');

    if (menuParam === 'Rolunk') {
        footer.style.position = 'absolute';
    } else if (menuParam === 'Felhasznalo') {
        footer.style.position = 'absolute';
    } else if (menuParam === 'Bejelentkezes') {
        footer.style.position = 'absolute';
    } 
});
