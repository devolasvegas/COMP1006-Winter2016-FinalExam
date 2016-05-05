<?php ob_start();
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2016-04-20
 * Time: 11:06 AM
 */

$page_title = "Saving Your Changes . . .";

require_once ('header.php');

$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$city_id = $_POST['city_id'];
$phone = $_POST['phone'];
$ok = true;

if (!empty($_FILES['menu']['name'])) {
    $menu = $_FILES['menu']['name'];

    // get and check type
    $type = $_FILES['menu']['type'];

    if (($type == 'application/pdf')) {
        // save the file - valid type
        $final_name = $menu;
        $tmp_name = $_FILES['menu']['tmp_name'];
        move_uploaded_file($tmp_name, "images/$final_name");
    }
    else {
        echo 'Menu Must Be a PDF<br >';
        $ok = false;
    }
}
else {
    // if the user didn't upload a new logo, grab the existing logo name if there is one
    if (!empty($_POST['current_menu'])) {
       $final_name = $_POST['current_menu'];
    }
}

if($ok){
    require ('db.php');
    $sql = "UPDATE restaurants SET name = :name, address = :address, city_id = :city_id, phone = :phone WHERE name = :name";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':name', $name, PDO::PARAM_STR);
    $cmd->bindParam(':address', $address, PDO::PARAM_STR);
    $cmd->bindParam(':city_id', $city_id, PDO::PARAM_INT);
    $cmd->bindParam(':phone', $phone, PDO::PARAM_STR);
    $cmd->execute();

    $conn = null;

    header('location:taco-joints.php?city_id='. $city_id);
} else {
    header('location:edit.php');
}


ob_flush(); ?>