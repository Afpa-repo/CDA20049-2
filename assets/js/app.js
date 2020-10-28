/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import '../styles/app.scss';
import 'materialize-css';
import 'materialize-css/dist/css/materialize.css';
import 'jquery';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
$(document).ready(function(){
    $(".dropdown-trigger").dropdown();
    $('.sidenav').sidenav();
});