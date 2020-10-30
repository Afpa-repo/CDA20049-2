/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import 'materialize-css';
import 'materialize-css/sass/materialize.scss';
import '../styles/RecipesIngredientsMenu.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import 'jquery';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

//Manage redirection to details pages after clicking on a card
//$(".card").click(function () {console.log(this.children('p'))});

//Manage category active link status
$(".category li").click(function (){
    $(this).addClass('active');
    $(this).siblings('li').removeClass('active');
});