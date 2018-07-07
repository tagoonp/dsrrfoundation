<?php
session_start();
include "../../database/database.class.php";
$db = new database();
$db->connect();


$ds          =  DIRECTORY_SEPARATOR;  //1
$main = 'images';
$storefolder = 'profile';
// $storefolder_tmp = 'profile_tmp';

$destination_part = dirname(dirname(dirname(__FILE__))).$ds.$main.$ds.$storefolder.$ds;

if(isset($_FILES)){
  if (!empty($_FILES)) {

      $tempFile = $_FILES['file']['tmp_name'];          //3

      $rstring = generateRandomString(5);
      $newName =  date('Y-m-d')."_".$rstring."_".$_FILES['file']['name'];

      // $targetFile =  $storefolder. $_FILES['file']['name'];   //5
      // $targetFile =  $storefolder.$newName;   //5
      $targetFile = $destination_part.$newName;

      //Resize image ti thampnail
      // $images = $_FILES['file']['tmp_name'];
      // $new_images = "Thumbnails_".date('Y-m-d')."_".$rstring."_".$_FILES['file']['name'];
			// // copy($_FILES["fileUpload"]["tmp_name"][$i],"MyResize/".$_FILES["fileUpload"]["name"][$i]);
			// $width=300; //*** Fix Width & Heigh (Autu caculate) ***//
			// $size=GetimageSize($images);
			// $height=round($width*$size[1]/$size[0]);
			// $images_orig = ImageCreateFromJPEG($images);
			// $photoX = ImagesX($images_orig);
			// $photoY = ImagesY($images_orig);
			// $images_fin = ImageCreateTrueColor($width, $height);
			// ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
			// ImageJPEG($images_fin,$storefolder_tmp.$new_images);
			// ImageDestroy($images_orig);
			// ImageDestroy($images_fin);

      if(move_uploaded_file($tempFile,$targetFile)){
        // $strSQL = "INSERT INTO ".$prefix."picture VALUE ('','".$newName."','".$new_images."','".$al_id."')";
        // $resultInsert = $db->insert($strSQL,false,true);
        $strSQL = "UPDATE tb_student SET std_picture = '".$newName."' WHERE std_id = '".$_SESSION['sisSessuser']."'";
        $resultUpdate = $db->update($strSQL,false,true);
      }
  }else {
    # code...
    print "v1";
  }
}else {
  # code...
  print "v2";
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>
