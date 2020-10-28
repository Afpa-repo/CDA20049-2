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
    $(".pagination li.ArrowPrevious").click(function (){
        const activeItem = $(".pagination li.active"); // Get the current active element on the list
        const sizeList = 0 ;

        if ($(".pagination li.waves-effect").index(activeItem) == sizeList) { // Is this the first item in the list?
        }else {
            activeItem.removeClass('active');
            activeItem.prev().addClass('active');
        }
    });

    $(".pagination li.ArrowNext").click(function (){
        const activeItem = $(".pagination li.active"); // Get the current active element on the list
        const sizeList = $(".pagination li.waves-effect").length-1 ;// Size of the pagination items

        if ($(".pagination li.waves-effect").index(activeItem) == sizeList){ // Is this the last item in the list?
        } else {
            activeItem.removeClass('active');
            activeItem.next().addClass('active');
        }
    });

    $(".pagination li").click(function(){

        if ($(this).hasClass('waves-effect')){  // If it's a link to a page number then switch the active one
            $(this).addClass('active');
            $(this).siblings('li').removeClass('active');
        }

        const activeItem = $(".pagination li.active"); // Get the current active element on the list
        const activeItemIndex = $(".pagination li.waves-effect").index(activeItem); //Get the index of the current active element
        const sizeList = $(".pagination li.waves-effect").length-1 ;// Size of the pagination items

        if (activeItemIndex == sizeList){ // If on the last item of the list?
            $(".pagination li.ArrowNext").addClass('disable');
            $(".pagination li.ArrowPrevious").removeClass('disable');
        } else if (activeItemIndex == 0) { // If on the first item of the list?
            $(".pagination li.ArrowNext").removeClass('disable');
            $(".pagination li.ArrowPrevious").addClass('disable');
        } else {
            $(".pagination li.ArrowNext").removeClass('disable');
            $(".pagination li.ArrowPrevious").removeClass('disable');
        }
    })

//Manage category active link status
$(".category li").click(function (){
    $(this).addClass('active');
    $(this).siblings('li').removeClass('active');
});