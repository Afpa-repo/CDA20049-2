/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import 'materialize-css';
import 'materialize-css/sass/materialize.scss';
import '../styles/RecipesDetails.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import 'jquery';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

// Initialize materialize components
$(document).ready(function(){
   $('.modal').modal(); // Use of modals in page
});

// Declare global variables
   let inputs = $('.ingredientQte input'); // All ingredient input inside DOM (JQUERY OBJECT)
   let initNbPerson = parseInt($(".inputNbPerson").val()); // Save initial value of number of person
   let modal = $('#statusAdd'); // Link to the only one modal on the page
   let message = modal.children('.modal-content').children('p').first(); // Link to the paragraph of the modal
   let messageHelp = modal.children('.modal-content').children('p#help'); // Link to the span of the modal

// Save initial value of ingredient quantity in an array
   let QteForOne = [];

   inputs.each(function (index) {
      QteForOne[index] = parseInt($(this).val()) / initNbPerson; //Save Qte for each ingredient for only one person rounded
   });


// Declare function initializing update of inputs value on change of nbPerson
 function nbPersonChange(){
    let nbPersonValue = parseInt($(".inputNbPerson").val()); // Save value of number of person

    if(!isNaN(nbPersonValue)) { // No trigger if not a number
      inputs.each(function (index) {
         let inputValue = QteForOne[index] * nbPersonValue;
         $(this).val(inputValue);
      });
   }
   return nbPersonValue;
}

$( document ).ready(function() {
   // Handle update of ingredient quantity on nbrPerson change
   $('.recipeNbPerson').bind('change keyup',nbPersonChange);
});

// Handle ingredient quantity via button
$('.ingredientQte .btnLess,.ingredientQte .btnMore').click(function(){
   let parentDiv = $(this).parent('div');
   let input = parentDiv.children('input');
   let value = parseInt(input.val());

/*   let name =  $('#qte b');
   console.log(name);*/


   if($(this).hasClass('btnMore')){
      value = value + 1;
      input.val(value);
      // name.text(value);
   } else{
      if(value !== 0){ // Check quantity is equal to 0
         value = value - 1;
         input.val(value);
      // name.text(value);
      }
   }
});

// Handle number of person via button
$('.recipeNbPerson .btnLess, .recipeNbPerson .btnMore').click(function(){
   let input = $('.inputNbPerson');
   let nbPersonValue = parseInt($(".inputNbPerson").val()); // Save value of number of person

   if($(this).hasClass('btnMore')){
      nbPersonValue = nbPersonValue + 1;
      input.val(nbPersonValue)
   } else{
      if(nbPersonValue !== 0){ // Check quantity is equal to 0
         nbPersonValue = nbPersonValue - 1;
         input.val(nbPersonValue);
      }
   }

   nbPersonChange(); // Change input value of each ingredient
});


// Add unique item with quantity to $_SESSION
$('.btnCart').click(function(){

   // Get data from page
      const id = $(this).parent('div').children("input[name='id']").val();
      const quantity = $(this).parent('div').parent('div').children('div .ingredientQte').children('input').val();

    if(isNaN(quantity) || quantity == 0){ //Check if quantity is not equal to zero OR if it's not a number

        // Edit the modal to display success / error
        message.html('<p style="font-weight: bold; color: orange"><i class="fas fa-info" style="margin-right: 10px"></i>Ingredient with a quantity equal to zero or NAN has been ignored.</p> ');

    } else {
        // Send data to server via AJAX
        let addProductRequest = $.ajax({
            url: "/cart/add",
            method: "POST",
            async: true,
            data: {id: id, quantity:quantity}
        });

        // Edit the modal to display success / error
        addProductRequest.done(function () {
            message.html('<p style="font-weight: bold; color: green"><i class=\"fas fa-check\" style="margin-right: 10px"></i>The ingredient has been added to your cart.</p> ');
        });

        addProductRequest.fail(function () {
            message.html('<p style="font-weight: bold; color: red"><i class="fas fa-times" style=\"margin-right: 10px\"></i>An error occurred. Please check your cart.</p>');
        });
    }

   // Open the modal
   const instance = M.Modal.getInstance(modal);
   instance.open();

});


// Add all items with quantity to $_SESSION
$('#btnCartTotal').click(function(){

   // Initialize a counter error
      let countError = 0;

   // Loop through all ingredient of the recipe
      inputs.each(function () {
        // Get data from page fot each ingredient
            const id = $(this).parent('div').parent('div').children('div .ingredientData').children("input[name='id']").val();
            const quantity = $(this).parent('div').parent('div').children('div .ingredientQte').children('input').val();

            if(isNaN(quantity) || quantity == 0) { //Check if quantity is not equal to zero OR if it's not a number

                // Edit the modal to display success / error
                messageHelp.html('<p style="font-weight: bold; color: orange"><i class="fas fa-info" style="margin-right: 10px"></i>Ingredient(s) with a quantity equal to zero or NAN has been ignored.</p> ');

            }else {

                // Send data to server via AJAX
                    let addProductRequest = $.ajax({
                        url: "/cart/add",
                        method: "POST",
                        async: true,
                        data: {id: id, quantity:quantity}
                    });

                    addProductRequest.fail(function () {
                        countError++;
                    });


                // Edit the modal to display success / error
                if (countError > 0){
                    message.html('<p style="font-weight: bold; color: red"><i class="fas fa-times" style=\"margin-right: 10px\"></i>At least one error occurred. Please check your cart.</p>');
                } else {
                    message.html('<p style="font-weight: bold; color: green"><i class=\"fas fa-check\" style="margin-right: 10px"></i>All ingredient has been added to your cart.</p> ');
                }
            }

            // Open the modal
              const instance = M.Modal.getInstance(modal);
              instance.open();
      });
});