const approveOrderBtn = document.querySelectorAll(".approvebutton_parent");
const cancelORderBTn = document.querySelectorAll(".cancebutton_parent");
const cardinput_id = document.querySelector("#bannername");

const createnewBTN = document.querySelectorAll(".createnew");
const sponsorshipform = document.querySelector(".sponserdiv");

const deleteorder_info = document.querySelector(".deleteorder");
const approveorderform_info = document.querySelector(".approveorderform");

const displaySetting = sponsorshipform.style.display;
const btnloader = document.querySelector("#btnloader");

// order action 1- create 2- update, 3 - delete
var order_action;

createnewBTN.forEach((productCard) => {
  // Make whole card clickable, but only if event target is NOT a specific card action inside <div Functions="product-card__actions">.
  productCard.addEventListener("click", (e) => {
    if (e.target.closest(".product-card__actions") === null) {
      if (displaySetting == "block") {
        sponsorshipform.style.display = "none";
      } else {
        sponsorshipform.style.display = "grid";
      }

      order_action = 1;
      $("#error").hide();
    }
  });
});

approveOrderBtn.forEach((productCard) => {
  const childNamegot = productCard.querySelector(".cardID").value;

  // Make whole card clickable, but only if event target is NOT a specific card action inside <div Functions="product-card__actions">.
  productCard.addEventListener("click", (e) => {
    if (e.target.closest(".product-card__actions") === null) {
      if (displaySetting == "block") {
        sponsorshipform.style.display = "none";
      } else {
        sponsorshipform.style.display = "grid";
        deleteorder_info.style.display = "none";
        approveorderform_info.style.display = "block";
      }

      cardinput_id.value = childNamegot;
      order_action = 2;
      $("#error").hide();

    }
  });
});

cancelORderBTn.forEach((cancelbtn) => {
  const childNamegot = cancelbtn.querySelector(".cardID").value;

  // Make whole card clickable, but only if event target is NOT a specific card action inside <div Functions="product-card__actions">.
  cancelbtn.addEventListener("click", (e) => {
    if (e.target.closest(".product-card__actions") === null) {
      if (displaySetting == "block") {
        sponsorshipform.style.display = "none";
        deleteorder_info.style.display = "none";
      } else {
        sponsorshipform.style.display = "grid";
        deleteorder_info.style.display = "block";
        approveorderform_info.style.display = "none";
      }

      cardinput_id.value = childNamegot;

      order_action = 3;
      $("#error").hide();

    }
  });
});

$(document).ready(function () {
  $("form").submit(function (event) {
    const endPoint = "processors/process_add_categories.php";
    var formdata = new FormData();
    var banner_id = $("input#bannername").val();

    if (order_action != 3) {
      var banner_name = $("input#name").val();
      var banner_number = $("input#number").val();

      // File upload required
      const inputfile = document.getElementById("file-input-createplaylist");

      if (inputfile.files["length"] == 0) {
      $("#error").fadeIn().text("Choose Cover Picture. Use 300 x 300 image");

        setTimeout(function () {
          $("#error").hide();
        }, 2000);
        return false;
      }

      //check image size should be < 3.6M
      if (inputfile.files[0]["size"] > 3620127) {
        $("#error").fadeIn().text("Image is too large. Use 300 x 300 image");
        setTimeout(function () {
          $("#error").hide();
        }, 2000);
        return false;
      }

      //check if file is added
      if (inputfile.files[0]["size"] < 0) {
        $("#error").fadeIn().text("Add Cover Image. Use 300 x 300 image");

        setTimeout(function () {
          $("#error").hide();
        }, 2000);
        return false;
      }

      formdata.append("inputfile", inputfile.files[0]);
      formdata.append(
        "banner_name",
        banner_name.replace(/['"]+/g, "").replace(/[^\w\s]/gi, "")
      );
      formdata.append("banner_number", banner_number);


      if (order_action == 2) {
        formdata.append("banner_id", banner_id);
      }
    } else {
      formdata.append("banner_id", banner_id);
    }

    formdata.append("order_action", order_action);
    console.log("banner_id" + banner_id);

    fetch(endPoint, {
      method: "post",
      body: formdata,
    })
      .then((response) => response.json())
      .then((data) => {
        if (!data.success) {
          console.log("failure" + data);
          $(".sponsormessagediv").html(
            '<div Functions="alert alert-error">' + data.message + "</div>"
          );
          setTimeout(function () {
            $(".sponsormessagediv").html("");
            sponsorshipform.style.display = "none";
          }, 4000);
        } else {
          console.log("success" + data);
          $(".sponsormessagediv").html(
            '<div Functions="alert alert-success">' + data.message + "</div>"
          );
          setTimeout(function () {
            $(".sponsormessagediv").html("");
            sponsorshipform.style.display = "none";
          }, 4000);

          document.getElementById("approveform").reset();
          window.location.href = "categories.php";
        }
      })
      .catch(console.error);

    event.preventDefault();
  });

  $("form").su;
});

function cancelsponsohip() {
  sponsorshipform.style.display = "none";
}
