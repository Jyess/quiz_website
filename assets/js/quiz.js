// const $ = require("jquery");

function displayOrHideOptionalFields() {
  let selected_option_value = $("#quiz_etat").val(); //valeur de la sélection de l'état du quiz

  //si l'état est privé
  if (selected_option_value === "1") {
    $(".optional").show();
  } else {
    $(".optional").hide();
    $("input[type=datetime-local]").val(""); //reset value si on passe en public
  }
}

$(document).ready(function () {
  //de base tout est caché mais si le user fait une erreur et que l'état était privé, il faut réafficher de suite les fields
  if ($("#quiz_etat")) {
    displayOrHideOptionalFields();
  }

  //quand on change d'état
  $("#quiz_etat").change(function () {
    displayOrHideOptionalFields();
  });

  $(".supprimerQuiz").on("click", function () {
    return confirm("Êtes-vous sûr de vouloir supprimer ce quiz ?");
  });

  $(document).one("click", "#quiz_envoyer", function (e) {
    let $currentButton = $("#quiz_envoyer");
    $currentButton.attr("disabled", true);
    $currentButton.append('<i class="ml-2 fas fa-circle-notch fa-spin">');

    let $submittedForm = $currentButton.closest("form");
    $submittedForm.submit();
  });

  // $(function (e) {
  //   $("#datetimepicker1").datetimepicker({
  //     format: "Y-M-D h:m:s",
  //   });
  //   $("#datetimepicker2").datetimepicker({
  //     useCurrent: false,
  //     format: "Y-M-D h:m:s",
  //   });
  //   $("#datetimepicker1").on("change.datetimepicker", function (e) {
  //     $("#datetimepicker2").datetimepicker("minDate", e.date);
  //     $("#datetimepicker2").find(".bootstrap-datetimepicker-widget").hide();
  //     let dateDebut = $("#datetimepicker2").datetimepicker("viewDate");
  //   });
  //   $("#datetimepicker2").on("change.datetimepicker", function (e) {
  //     $("#datetimepicker1").datetimepicker("maxDate", e.date);
  //     $("#datetimepicker1").find(".bootstrap-datetimepicker-widget").hide();
  //     let dateFin = $("#datetimepicker1").datetimepicker("viewDate");
  //   });

  //   $(document).on("mousedown", function (e) {
  //     var container = $(".bootstrap-datetimepicker-widget");
  //     if (!container.is(e.target) && container.has(e.target).length === 0) {
  //       container.hide();
  //     }
  //   });
  // });
});
