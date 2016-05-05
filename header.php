<?php
/**
 * Created by PhpStorm.
 * User: devon
 * Date: 2016-04-20
 * Time: 9:16 AM
 */
// Connect to DB and get list of cities to populate the navigation bar
require ('db.php');
$sql = "SELECT * FROM cities";
$cmd = $conn->prepare($sql);
$cmd->execute();
$cities = $cmd->fetchAll();

// Close the connection
$conn = null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title><?php echo $page_title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<header>
    <nav class="navbar navbar-default">
        <h1><a href="default.php" class="navbar-brand"><i class="fa fa-binoculars" aria-hidden="true"></i>  The Fish Taco Finder</a></h1>
        <ul class="nav navbar-nav navbar-right">
        <?php
        foreach($cities as $city){
            echo '<li><a href="taco-joints.php?city_id=' . $city['city_id'] . '">' . $city['city'] . '</a></li>';
        }
        ?>
        </ul>
    </nav>
</header>
<main>