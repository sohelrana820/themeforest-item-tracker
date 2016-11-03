<?php
/**
 * @Author: Sohel Rana <sohelrana820>
 * @Author URI: http://blog.sohelrana.me
 * @description: Returning an image as response by php.
 */

$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$url = "http://freegeoip.net/json/$ip";
$ch  = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
$data = curl_exec($ch);
curl_close($ch);

if ($data) {
    $location = json_decode($data);
    $lat = $location->latitude;
    $lon = $location->longitude;
    $sun_info = date_sun_info(time(), $lat, $lon);
}
$time = date('M d, Y H:i A');

$counter = 0;
$file = fopen("data.csv","r");
while(! feof($file)){
    $ar=fgetcsv($file);
    $counter++;
}

$handle = fopen('data.csv', 'a+');
fputcsv($handle, array($counter, $time, $ip, $location->city, $location->country_name, $lon, $lon));
fclose($handle);

// Open the image file with binary mood
$image = './mobile_friendly_checking.png';
$fp = fopen($image, 'rb');

// send the right headers
header("Content-Type: image/png");
header("Content-Length: " . filesize($image));

// dumping the image and the stop the script
fpassthru($fp);
exit;
