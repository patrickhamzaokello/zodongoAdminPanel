<?php
$menuTypesIds = array();

$menuTypes_sql = mysqli_query($con, "SELECT id FROM tblmenutype  ORDER BY  `tblmenutype`.`name` ASC ");

while ($row = mysqli_fetch_array($menuTypes_sql)) {

    array_push($menuTypesIds, $row['id']);

}
