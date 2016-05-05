<?php
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2016-04-20
 * Time: 10:29 AM
 */
$name = null;
$address = null;
$city_id = null;
$phone = null;
$menu = null;

$name = $_GET['name'];

require ('db.php');
$sql = "SELECT * FROM restaurants WHERE name = :name";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':name', $name, PDO::PARAM_STR);
$cmd->execute();
$restaurant = $cmd->fetchAll();

foreach($restaurant as $info){
    $address = $info['address'];
    $city_id = $info['city_id'];
    $phone = $info['phone'];
    $menu = $info['menu'];
}

$sql = "SELECT * FROM cities";
$cmd = $conn->prepare($sql);
$cmd->execute();
$cities = $cmd->fetchAll();

$conn = null;

$page_title = 'Edit Info for ' . $name . ' | The Fish Taco Finder';

require_once ('header.php');

echo '<h1>Edit Info for ' . $name . '</h1>';
?>


<form method="post" action="update.php" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name" class="col-sm-2">Restaurant</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required />
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-2">Address</label>
        <textarea name="address" id="address" cols="50" required><?php echo $address; ?></textarea>
    </div>
    <div class="form-group">
        <label for="city" class="col-sm-2">City</label>
        <select name="city" id="city">
            <?php
            foreach($cities as $city)
            {
                echo '<option>' . $city['city'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-2">Phone</label>
        <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" required />
    </div>
    <div class="form-group">
        <label for="menu" class="col-sm-2">Menu: <a href="menus/<?php echo $menu; ?>"><?php echo $menu; ?></a> </label>
        <input type="file" name="menu" id="menu">
    </div>
    <input type="hidden" name="current_menu" id="current_menu" value="<?php echo $menu; ?>" />
    <input type="hidden" name="city_id" id="city_id" value="<?php echo $city_id; ?>" />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>