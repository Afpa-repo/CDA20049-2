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

// Declare global variables
   let inputs = $('.ingredientQte input'); // All ingredient input inside DOM (JQUERY OBJECT)
   let initNbPerson = parseInt($(".inputNbPerson").val()); // Save initial value of number of person

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
   let name =  $('#qte b');
   console.log(name);

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

