<?php
$verifiedArtistarray = array();

$artistQuery = mysqli_query($con, "SELECT order_id FROM tblorder WHERE  order_status = 1 ORDER BY `tblorder`.`order_date` DESC ");

while ($row = mysqli_fetch_array($artistQuery)) {

    array_push($verifiedArtistarray, $row['order_id']);

}
