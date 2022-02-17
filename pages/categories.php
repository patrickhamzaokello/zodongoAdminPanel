<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>Menu</title>
</head>
<?php
require("../config.php");
$db = new Database();
$con = $db->getConnString();

require('../session.php');
require('../queries/statsquery.php');
require('../queries/menutypes.php');
require("../queries/classes/MenuType.php");



?>

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
          <a href="../index">Menu Categories</a>
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
        <a href="allorders" class="menu">
          <p>All Orders</p>
        </a>
        <a href="menuitems" class="menu">
          <p>Menu</p>
        </a>
        <a href="categories" class="menu active">
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

          <?php if ($menuTypesIds) : ?>

            <div class="menuitemscontatiner">


              <?php
              foreach ($menuTypesIds as $row) :
              ?>

                <?php
                $menu = new MenuType($con, $row);
                ?>

                <div class="MenuItemCard">

                  <img src="<?= $menu->getImageCover()  ?>" alt="">

                  <div class="menuitemcarddetail">


                    <div class="menuitemactionbutton">
                      <p>
                        <a href="#" class="product-card__link ">Delete</a>
                      </p>
                      <div class="menuitem-card__actions">
                        <a href="#" target="_blank" class="">Update</a>
                      </div>
                    </div>

                    <h1><?= $menu->getName()  ?></h1>
                    <p class="description"><?= $menu->getDescription()  ?></p>

                    <p class="date"><span>Date Created </span><?= $menu->getCreated()  ?></p>
                    <p class="date"><span>Last Update </span><?= $menu->getModified()  ?></p>

                  </div>

                </div>

              <?php endforeach ?>

            </div>


          <?php else :  ?>
            Working on Getting Menu Categories for You
          <?php endif ?>



        </div>

      </div>


    </div>
  </main>





</body>


</html>