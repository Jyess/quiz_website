/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
require("../css/app.scss");

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const $ = require("jquery");
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require("bootstrap");

require("@fortawesome/fontawesome-free/css/all.min.css");
require("@fortawesome/fontawesome-free/js/all.js");

// require("tempusdominus-bootstrap-4");

// const routes = require("../../public/js/fos_js_routes.json");
// import Routing from "../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js";
//
// Routing.setRoutingData(routes);
// Routing.generate("rep_log_list");

$("#test").on("click", function (event) {
  $("#modal").modal("show");
});

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
