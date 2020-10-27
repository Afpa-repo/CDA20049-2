/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import 'materialize-css';
import 'materialize-css/sass/materialize.scss';
import '../styles/RecipesMenu.scss';
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

    $(".pagination li.ArrowPrevious").click(function (){
        const list = $(".pagination li.active"); // Get the current active element on the list
        const sizeList = 0 ;

        if ($(".pagination li.waves-effect").index(list) == sizeList) { // Is this the first item in the list?
        }else {
            list.removeClass('active');
            list.prev().addClass('active');
        }
    });

    $(".pagination li.ArrowNext").click(function (){
        const list = $(".pagination li.active"); // Get the current active element on the list
        const sizeList = $(".pagination li.waves-effect").length-1 // Size of the pagination items

        if ($(".pagination li.waves-effect").index(list) == sizeList){ // Is this the last item in the list?
        } else {
            list.removeClass('active');
            list.next().addClass('active');
        }
    });

//Manage category active link status
$(".category li").click(function (){
    $(this).addClass('active');
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