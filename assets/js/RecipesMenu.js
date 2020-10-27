/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import '../styles/RecipesMenu.scss';
import 'materialize-css';
import 'materialize-css/dist/css/materialize.css';
import 'jquery';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

//Manage redirection to details pages after clicking on a card
//$(".card").click(function () {console.log(this.children('p'))});

//Manage pagination active status

$(".pagination li.waves-effect").click(function (){
    $(this).toggleClass('active');
    $(this).siblings('li').removeClass('active');
});

/*
$(document).ready(function(){
    $('.pinned-bottom').pushpin(
        {
            top : 0,
            offset: 500
        }
    );
});
*/