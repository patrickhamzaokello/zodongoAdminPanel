<?php
require("../config.php");
$db = new Database();
$con = $db->getConnString();

require('../session.php');
require('../queries/statsquery.php');
require('../queries/artist_verified_query.php');
require("../queries/classes/Order.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>Orders</title>
</head>

<body>
  <header>
    <nav>

    <div class="currentpage">
        <p>
          <span><a href="../index">Admin /</a></span>
          <a href="../index"><?= $login_session ?></a>
        </p>
      </div>

      <div class="menu">
        <div class="menuitem">
          <a href="../index">Zodongo Foods Admin Panel</a>
        </div>
      </div>

      <a href="../logout.php">
        <div class="useraccount">Exit</div>
      </a></div>
    </nav>
  </header>
  <main>
    <div class="sidepanel">
      <div class="about">
        <div class="title">Zodongo Foods</div>
      </div>
      <div class="sidemenu">
        <a href="../index" class="menu">
          <p>Dashboard</p>
        </a>
        <a href="allorders" class="menu active">
          <p>All Orders</p>
        </a>
        <a href="menuitems" class="menu">
          <p>Menu</p>
        </a>
        <a href="categories" class="menu">
          <p>Categories</p>
        </a>
        <a href="banners" class="menu">
          <p>Banners</p>
        </a>
      </div>
    </div>
    <div class="mainpanel">

      <div class="elements">

        <div class="activities">

          <?php if ($verifiedArtistarray) : ?>

            <div class="childrencontainer">


              <?php
              foreach ($verifiedArtistarray as $row) :
              ?>

                <?php
                $order = new Order($con, $row);
                ?>

                <div class="product-card">
                  <h4 class="orderID" style="display: none;"><?= $order->getOrder_id() ?></h4>

                  <p class="artistlable">Order No <span class="ordervalue"> ZD416F<?= $order->getOrder_id()  ?> </span></p>
                  <p class="artistlable">Date Added <span class="ordervalue"><?= $order->getOrder_date()  ?> </span></p>
                  <div class="addresslayout">
                    <p class="artistlable">Address <span class="ordervalue"><?= $order->getOrder_address()[0]  ?> </span></p>
                    <p class="artistlable">Contact <span class="ordervalue"><?= $order->getOrder_address()[1]  ?> </span></p>

                  </div>
                  <p class="artistlable">Tag <span class="ordervalue"><?= $order->getProcessed_by()  ?> </span> <span class="artistlable">Status <span class="ordervalue"><?= $order->getOrder_status()  ?></span> </span></p>
                  <p class="artistlable">Total Amount (UGX) <span class="ordervalue"><?= number_format($order->getTotal_amount())  ?> </span></p>


                  <input type="hidden" name="artistid" value="<?= $order->getOrder_id() ?>">


                  <p class="linkss">
                    <a href="#" class="product-card__link btn btn-primary my-2">Details</a>
                  </p>
                  <div class="product-card__actions">
                    <a href="#" target="_blank" class="btn btn-primary my-2  sponsorbutton">Cancel</a>
                  </div>
                </div>

              <?php endforeach ?>

            </div>


          <?php else :  ?>
            Working on Getting Featured Music Artists Curated for You
          <?php endif ?>



        </div>

      </div>

      <div class="sponserdiv">
        <div class="sponsorshipform">
          <div class="sponsormessagediv">

          </div>
          <form action="processartist_db.php" method="POST">

            <div class="form-group">
              <input id="childnameinput" type="text" name="childname" class="form-control" placeholder="Child`s Name" disabled>
            </div>
            <div class="form-group">
              <input type="text" id="name" name="name" class="form-control" placeholder="Sponsor`s Name" required>
            </div>
            <div class="form-group">
              <input type="text" id="email" name="email" class="form-control" placeholder="Sponsor`s Email" required>
            </div>
            <div class="form-group">
              <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount in $" required>
            </div>

            <div class="form-group">
              <textarea name="sponsormessage" id="sponsormessage" cols="30" rows="5" class="form-control" placeholder="Message" spellcheck="false" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send" style="width: 100% !important;" class="sponsorchildnowbtn">
            </div>
            <div class="form-group">
              <button type="reset" id="cancelbtn" style="background: #959595;border: none;padding: 10px 20px;width: 100%;color: white;" onclick="cancelsponsohip()">Cancel </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </main>


  <script src="../js/processartist.js"></script>



</body>


</html>