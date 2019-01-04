<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "test";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
// echo "Connected successfully";

$query = "select * from images";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_array($result);


set_time_limit(0);
date_default_timezone_set('UTC');
require __DIR__.'/../vendor/autoload.php';
/////// CONFIG ///////
$username = 'nkoccry05';
$password = 'hoangnvh1997';
$debug = true;
$truncatedDebug = false;
//////////////////////
/////// MEDIA ////////
$photoFilename = $row['url'];
$captionText = 'Chtholly';
//////////////////////

$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
try {
    $ig->login($username, $password);
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
    exit(0);
}
try {
    // The most basic upload command, if you're sure that your photo file is
    // valid on Instagram (that it fits all requirements), is the following:
    // $ig->timeline->uploadPhoto($photoFilename, ['caption' => $captionText]);
    // However, if you want to guarantee that the file is valid (correct format,
    // width, height and aspect ratio), then you can run it through our
    // automatic photo processing class. It is pretty fast, and only does any
    // work when the input file is invalid, so you may want to always use it.
    // You have nothing to worry about, since the class uses temporary files if
    // the input needs processing, and it never overwrites your original file.
    
    // Also note that it has lots of options, so read its class documentation!
    $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photoFilename);
    $ig->timeline->uploadPhoto($photo->getFile(), ['caption' => $captionText]);
    echo "Success!";
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
}
?>