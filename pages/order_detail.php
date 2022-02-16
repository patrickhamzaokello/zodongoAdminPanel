
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Order Detail</title>
</head>
<?php
require("../config.php");
$db = new Database();
$con = $db->getConnString();

$orderid = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

require('../session.php');
require('../queries/statsquery.php');
require("../queries/classes/Order.php");
require("../queries/classes/OrderDetails.php");
require("../queries/classes/Menu.php");


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
                    <a href="../index">Order Details</a>
                </div>
            </div>

            <a href="../logout.php">
                <div class="useraccount">Exit</div>
            </a>
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

            <div class="sectionheading">
                <h3 class="sectionlable">Order Details</h3>
                <h6 class="sectionlable">Manage this Order</h6>
            </div>

            <?php
            $order = new Order($con, $orderid);

            ?>


            <div class="orderheading">

                <div class="ordertimediv">
                    <h6>Order time</h6>
                    <h5><?= $order->getOrder_date()  ?></h5>
                </div>
                <div class="ordertimediv">
                    <h6>Address</h6>
                    <h5><?= $order->getOrder_address()[0] ?></h5>
                </div>
                <div class="ordertimediv">
                    <h6>Contact</h6>
                    <h5><?= $order->getOrder_address()[1]  ?></h5>
                </div>
                <div class="ordertimediv">
                    <h6>Username</h6>
                    <h5>Patrick Hamza</h5>
                </div>
                <div class="ordertimediv">
                    <h6>Order No</h6>
                    <h5> ZD416F<?= $order->getOrder_id() ?></h5>
                </div>
                <div class="ordertimediv">
                    <h6>Total Amount (UGX)</h6>
                    <h5><?= number_format($order->getTotal_amount())  ?></h5>
                </div>

            </div>


            <div class="cartdetailbutton">
                <button class="cancelbutton">Cancel Order</button>
                <button class="approvebutton">Approve Order</button>
            </div>

            <div class="small_sectionheading">
                <h3 class="smallsectionlable">Cart Items</h3>
                <h6 class="smallsectionlable">All Cart Items in this Order</h6>
            </div>


            <div class="elements">
                <?php

                $tblorderdetails = array();

                $orderdetailitem = mysqli_query($con, "SELECT order_details_id FROM tblorderdetails WHERE  order_id = " . $orderid . "");

                while ($row = mysqli_fetch_array($orderdetailitem)) {
                    array_push($tblorderdetails, $row['order_details_id']);
                }


                if ($tblorderdetails) :

                ?>

                    <div class="activities">

                        <div class="cartitemcontainer">


                            <?php
                            foreach ($tblorderdetails as $row) :
                            ?>

                                <?php
                                $cartItem = new OrderDetails($con, $row);
                                ?>

                                <div class="cartItem">
                                    <img src="<?= $cartItem->getMenuImage()  ?>" alt="">

                                    <div class="cartItemdetail">
                                        <div class="menutitle"><?= $cartItem->getMenuName()  ?></div>
                                        <div class="menutitle"><span class="cartlabel">Qty</span>X <?= $cartItem->getNo_of_serving()  ?></div>
                                        <div class="menutitle"><span class="cartlabel">Unit Price (Ugx)</span><?= $cartItem->getAmount()  ?> </div>
                                        <div class="menutitle"><span class="cartlabel">Total (Ugx) </span><?= $cartItem->getTotal_amount()  ?> </div>
                                    </div>
                                </div>

                            <?php endforeach ?>

                        </div>




                    </div>

                <?php else :  ?>
                    No Detail exists
                <?php endif ?>

            </div>


        </div>
    </main>


    <script src="../js/processartist.js"></script>



</body>


</html>