<?php
require("config.php");
$db = new Database();
$con = $db->getConnString();

require('session.php');
require('queries/statsquery.php');
require('queries/artist_verified_query.php');
require "queries/classes/Order.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>Admin Dashboard</title>
</head>

<body>
  <header>
    <nav>
      <div class="navigation">
        <img src="images/back.svg" alt="" />
        <img src="images/forward.svg" alt="" />
      </div>

      <div class="currentpage">
        <p>
          <span><a href="index">Home</a></span> /
          <a href="index">Dashboard</a>
        </p>
      </div>

      <div class="search">
        <input class="searchinput" type="text" placeholder="Search..." />
      </div>

      <div class="menu">
        <div class="menuitem">
          <a href="index">Home</a>
        </div>
        <div class="menuitem">
          <a href="messages.php">Messages</a>
        </div>
        <div class="menuitem">
          <a href="notifications.php">Notification</a>
        </div>
        <div class="menuitem">
          <a href="task.php">Task</a>
        </div>
        <div class="menuitem"><a href="help.php">Help</a></div>
      </div>

      <a href="logout.php"><div class="useraccount">Exit</div></a></div>
    </nav>
  </header>
  <main>
    <div class="sidepanel">
      <div class="about">
        <div class="burger">
          <img src="images/logo.svg" alt="logo" />
        </div>
        <div class="title"><?= $login_session ?></div>
      </div>
      <div class="sidemenu">
        <div class="menu active">
          <img src="images/logo.svg" alt="dashboard" />
          <p>Dashboard</p>
        </div>
        <div class="menu">
          <img src="images/report.svg" alt="dashboard" />
          <p>All Orders</p>
        </div>
        <div class="menu">
          <img src="images/message.svg" alt="dashboard" />
          <p>Menu</p>
        </div>
        <div class="menu">
          <img src="images/task.svg" alt="dashboard" />
          <p>Categories</p>
        </div>
        <div class="menu">
          <img src="images/settings.svg" alt="dashboard" />
          <p>Banners</p>
        </div>
      </div>
    </div>
    <div class="mainpanel">
      <div class="statistics">
        <div class="card">
          <div class="stats">
            <p class="label">Orders</p>
            <p class="number"><?= $totalActiveOrders ?></p>
          </div>
          <div class="illustration">
            <img src="images/asset1.svg" alt="" />
          </div>
        </div>

        <div class="card">
          <div class="stats">
            <p class="label">Menu</p>
            <p class="number"><?= $totalMenuActive ?></p>
          </div>
          <div class="illustration">
            <img src="images/asset1.svg" alt="" />
          </div>
        </div>
        <div class="card">
          <div class="stats">
            <p class="label">Categories</p>
            <p class="number"><?= $totalMenuType ?></p>
          </div>
          <div class="illustration">
            <img src="images/asset1.svg" alt="" />
          </div>
        </div>
        <div class="card">
          <div class="stats">
            <p class="label">Users</p>
            <p class="number"><?= $total_customers ?></p>
          </div>
          <div class="illustration">
            <img src="images/asset1.svg" alt="" />
          </div>
        </div>
        <div class="card">
          <div class="stats">
            <p class="label">Preparing</p>
            <p class="number"><?= $orderPreparing ?></p>
          </div>
          <div class="illustration">
            <img src="images/asset1.svg" alt="" />
          </div>
        </div>
      </div>

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

                
                  <p class="artistlable">Order No <span><?= $order->getOrder_id()  ?> </span></p>
                  <p class="artistlable">Date Added <span><?= $order->getOrder_date()  ?> </span></p>
                  <p class="artistlable">Address <span><?= $order->getOrder_address()  ?> </span></p>
                  <p class="artistlable">Address <span><?= $order->getOrder_address()  ?> </span></p>

                  <div>
                  <p class="artistlable">Tag <span><?= $order->getProcessed_by()  ?> </span></p>
                  <p class="artistlable">Status <span><?= $order->getOrder_status()  ?> </span></p>
                  </div>
                
                  <p class="artistlable">Total Amount <span><?= $order->getTotal_amount()  ?> </span></p>


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


  <script src="processartist.js"></script>



</body>


</html>