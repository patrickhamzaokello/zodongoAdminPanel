const approveOrderBtn = document.querySelectorAll(".createnew");
const sponsorshipform = document.querySelector(".sponserdiv");

const displaySetting = sponsorshipform.style.display;
const btnloader = document.querySelector("#btnloader");

// order action 1- delete, 2 - update
var order_action;

approveOrderBtn.forEach((productCard) => {
  // Make whole card clickable, but only if event target is NOT a specific card action inside <div class="product-card__actions">.
  productCard.addEventListener("click", (e) => {
    if (e.target.closest(".product-card__actions") === null) {
      if (displaySetting == "block") {
        sponsorshipform.style.display = "none";
      } else {
        sponsorshipform.style.display = "grid";
      }
    }
  });
});

$(document).ready(function () {
  $("form").submit(function (event) {

    const endPoint = "processors/process_add_banners.php";


  
    //First name required
    var banner_name = $("input#name").val();

    // last name required
    var banner_number = $("input#number").val();
  
  
    // File upload required
    var formdata = new FormData();
    const inputfile = document.getElementById("file-input-createplaylist");
  
    if (inputfile.files["length"] == 0) {
      $("#error").fadeIn().text("Choose Cover Picture. Use 300 x 300 image");
      return false;
    }
  
    //check image size should be < 3.6M
    if (inputfile.files[0]["size"] > 3620127) {
      $("#error").fadeIn().text("Image is too large. Use 300 x 300 image");
      return false;
    }
  
    //check if file is added
    if (inputfile.files[0]["size"] < 0) {
      $("#error").fadeIn().text("Add Cover Image. Use 300 x 300 image");
      return false;
    }
  
    formdata.append("inputfile", inputfile.files[0]);
    formdata.append(
      "banner_name",
      banner_name.replace(/['"]+/g, "").replace(/[^\w\s]/gi, "")
    );
    formdata.append("banner_number", banner_number);
 
  
    fetch(endPoint, {
      method: "post",
      body: formdata,
    })
      .then((response) => response.json())
      .then((data ) => {
        if (!data .success) {
          console.log("failure" + data );
          $(".sponsormessagediv").html(
            '<div class="alert alert-error">' + data.message + "</div>"
          );
          setTimeout(function () {
            $(".sponsormessagediv").html("");
            sponsorshipform.style.display = "none";
          }, 4000);
        } else {
          console.log("success" + data );
          $(".sponsormessagediv").html(
            '<div class="alert alert-success">' + data.message + "</div>"
          );
          setTimeout(function () {
            $(".sponsormessagediv").html("");
            sponsorshipform.style.display = "none";
          }, 4000);
  
          document.getElementById("approveform").reset();
          window.location.href = "banners.php";
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



