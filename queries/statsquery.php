<?php
//get number of totalMenuActive
$totalMenuActive_sql = mysqli_query($con, "SELECT COUNT(*) as totalMenuActive from tblmenu where menu_status = 2");
$row = mysqli_fetch_array($totalMenuActive_sql);
$totalMenuActive = $row['totalMenuActive'];

//get number of orderPreparing
$orderPreparing_sql = mysqli_query($con, "SELECT COUNT(*) as orderPreparing from tblorder where order_status = 2");
$row = mysqli_fetch_array($orderPreparing_sql);
$orderPreparing = $row['orderPreparing'];

//get number of total_customers 
$total_customers_sql = mysqli_query($con, "SELECT COUNT(*) as total_customers FROM tblcustomer WHERE userRole = 1 ");
$row = mysqli_fetch_array($total_customers_sql);
$total_customers = $row['total_customers'];

//get number of totalMenuType 
$totalMenuType_sql = mysqli_query($con, "SELECT COUNT(*) as totalMenuType FROM tblmenutype");
$row = mysqli_fetch_array($totalMenuType_sql);
$totalMenuType = $row['totalMenuType'];

//get number of totalActiveOrders 
$totalActiveOrders_sql = mysqli_query($con, "SELECT COUNT(*) as totalActiveOrders FROM tblorder WHERE order_status = 1");
$row = mysqli_fetch_array($totalActiveOrders_sql);
$totalActiveOrders = $row['totalActiveOrders'];


