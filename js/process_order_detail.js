const productCards = document.querySelectorAll(".cartdetailbutton");
const childinputname = document.querySelector("#childnameinput");
const order_status_id = document.querySelector("#order_status_id");
const sponsorshipform = document.querySelector(".sponserdiv");
const displaySetting = sponsorshipform.style.display;
const btnloader = document.querySelector("#btnloader");
var orderscriptID;

productCards.forEach((productCard) => {

  const childNamegot = productCard.querySelector("#order_id_input").value;
  const order_status_id = productCard.querySelector("#order_status_id").value;


  // Make whole card clickable, but only if event target is NOT a specific card action inside <div class="product-card__actions">.
  productCard.addEventListener("click", (e) => {
    if (e.target.closest(".product-card__actions") === null) {

      if (displaySetting == "block") {
        sponsorshipform.style.display = "none";
      } else {
        sponsorshipform.style.display = "grid";
      }

      childinputname.value = childNamegot;
      order_status_id.value = order_status_id;

    }
  });
});

$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      childname: $("#childnameinput").val(),
      orderstatus: $("#order_status_id").val()
    };


    $.ajax({
      type: "POST",
      url: "processors/process_approve_order.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      if (!data.success) {
        $(".sponsormessagediv").html(
          '<div class="alert alert-success">' + data.message + "</div>"
        );
        setTimeout(function () {
          $(".sponsormessagediv").html("");
          sponsorshipform.style.display = "none";
        }, 3000);

      } else {
        $(".sponsormessagediv").html(
          '<div class="alert alert-success">' + data.message + "</div>"
        );
        setTimeout(function () {
          $(".sponsormessagediv").html("");
          sponsorshipform.style.display = "none";
        }, 3000);

        document.getElementById("approveform").reset();
        window.location.href = "allorders.php";

      }
    });

    event.preventDefault();
  });

  $("form").su
});

function cancelsponsohip() {
  sponsorshipform.style.display = "none";
}

