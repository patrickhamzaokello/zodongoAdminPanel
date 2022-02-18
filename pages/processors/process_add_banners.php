<?php
require "../../config.php";

$db = new Database();
$con = $db->getConnString();

$errors = [];
$data = [];

$target_dir  = '../assets/banners/';
$db_target_dir  = 'assets/banners/';


if (isset($_POST['banner_name']) && isset($_POST['banner_number'])) {

  $name = $_POST['banner_name'];
  $banner_number = $_POST['banner_number'];

  // generating image name
  $formatedname = strip_tags($name);
  $formatedname = str_replace(" ", "_", $formatedname);

  $temp = explode(".", $_FILES["inputfile"]["name"]);

  // setting image new file name
  $postfix = '_' . date('YmdHis') . '_' . str_pad(rand(1, 10000), 5, '0', STR_PAD_LEFT);
  $newfilename = stripslashes($formatedname . '_banner') . $postfix . '.' . end($temp);

  $targetPath = $target_dir . basename($newfilename);
  $db_targetPath = $db_target_dir . basename($newfilename);

  if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $targetPath)) {
    $query = mysqli_query($con, "INSERT INTO `tblbanner`(`name`, `imageUrl`, `status`, `display_order`)VALUES('$name','$db_targetPath',1,$banner_number)");

    $data['success'] = true;
    $data['message'] = 'Banner Added!';
  } else {
    $data['success'] = false;
    $data['message'] = 'Banner not Added';
  }
} else {
  $data['success'] = false;
  $data['message'] = 'Banner not Added';
}

echo json_encode($data);



//getting current page url
function pathUrl($dir = __DIR__)
{

  $root = "";
  $dir = str_replace('\\', '/', realpath($dir));

  //HTTPS or HTTP
  $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

  //HOST
  $root .= '://' . $_SERVER['HTTP_HOST'];

  //ALIAS
  if (!empty($_SERVER['CONTEXT_PREFIX'])) {
    $root .= $_SERVER['CONTEXT_PREFIX'];
    $root .= substr($dir, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT']));
  } else {
    $root .= substr($dir, strlen($_SERVER['DOCUMENT_ROOT']));
  }

  $root .= '/';

  return $root;
}
