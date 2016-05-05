<?php ob_start();
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2016-04-20
 * Time: 9:45 AM
 */

$page_title = 'Taco Joints | The Fish Taco Finder';

require_once('header.php');

if (is_numeric($_GET['city_id'])) {
    $city_id = $_GET['city_id'];
    // Get city info
    require('db.php');
    $sql = "SELECT city FROM cities WHERE city_id = :city_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':city_id', $city_id, PDO::PARAM_INT);
    $cmd->execute();
    $city = $cmd->fetch()['city'];

    $conn = null;
} else {
    header('location:default.php');
}

// Connect to the database to get restaurant info
require('db.php');
$sql = "SELECT * FROM restaurants WHERE city_id = :city_id";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':city_id', $city_id, PDO::PARAM_INT);
$cmd->execute();
$restaurants = $cmd->fetchAll();

$conn = null;

echo '<h1>Taco Joints in ' . $city . '</h1>
<table class="table table-striped">
    <thead>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>PDF Menu</th>
        <th>Edit</th>
    </thead>
    <tbody>';

foreach($restaurants as $restaurant){
    echo '<tr>
<td>' . $restaurant['name'] . '</td>
<td>' . $restaurant['address'] . '</td>
<td>' . $restaurant['phone'] . '</td>
<td><a href="menus/' . $restaurant['menu'] . '">Menu</a></td>
<td><a href="edit.php?name=' . $restaurant['name'] . '">Edit</a></td>
</tr>';
}

echo '</tbody>
      </table>';

require_once ('footer.php');

ob_flush(); ?>
