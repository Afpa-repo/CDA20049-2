import 'materialize-css';
import 'materialize-css/sass/materialize.scss';
import '../styles/RecipesIngredientsMenu.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import 'jquery';
import 'jquery-ui/ui/widgets/autocomplete.js';
import 'jquery-ui/themes/base/all.css';

import $ from 'jquery';

// Declare global variable
let listName = '' ;

/*
    Filter recipes category using AJAX request
*/

    // Manage AJAX request when selecting a specific category on left menu
    $(".category li").click(function () {
        let idCategory = $(this).attr('id'); // Get the ID of the selected category in menu
        let requestCategory = $.ajax({
            url: "AJAXCategoryID",
            method: "POST",
            async: true,
            data: {idCategory: idCategory}
            });

        requestCategory.done(function (serverData) {
            console.log(serverData);
            $('#contentAJAX').html(serverData); //Select and change the HTML content of the #contentAJAX div
        });

        requestCategory.fail(function () {
            alert("Request failed");
        });
    });


/*
    Autocomplete search with JQUERY-UI
*/

    // Function using AJAX request to list all known recipes/ingredients from database. Will be used for autocomplete search later
        function RecipeListAJAX(){
            let listAJAX = $.ajax({
                url: "AJAXListName",
                method: "POST",
                async: false,
            });

            // Get value from server if the request succeed
            listAJAX.done(function(serverData){
                listName = serverData;
            });

            // Error message if the request failed
            listAJAX.fail(function(){
                alert("Request RecipeListAJAX failed");
            });

            return listName;
        }

    // Save list of recipes/ingredients name as a global variable by calling the AJAX Request
    listName = RecipeListAJAX();

    // Declare empty array witch could receive element for recipe list
    let selectionData ;

    //Get URL of the current page
    let url = $(location).attr('href');

    if( url.search('recipes') !== -1){ // Check if current page is recipes
        selectionData =  [];

        // Rearrange data to fill with no error the completion data array
        listName.forEach(function(index,element){
            selectionData.push(listName[element].name+ ' / ' + listName[element].author); // Concatenation here with the two attribute of the JSON
            return selectionData;
        })
    } else { // If it's not, so it's ingredients. We don't need to rearrange data from listName
        selectionData = listName;
    }

    // Use the JQUERY UI autocomplete method on searchbar input field
        $('#search').autocomplete({
            minLength:0, // Only begin when at least 2 character are entered in search input
            delay : 0, // Set zero delay before showing result cause it's using local data

            source: function( request, response ) {
                let matcher = new RegExp( "^.*" + $.ui.autocomplete.escapeRegex( request.term ), "i" ); // Define Regex to only show matching element as possible solution
                response( $.grep( selectionData, function( item ){ // Finds the elements of an array which satisfy a filter function, in this case, the Regex applyed to the recipeList. The original array is not affected.
                    return matcher.test( item );
                }) );
            }
        });