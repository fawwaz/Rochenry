<?php
session_start();

$data = json_decode(implode('', file('php://input')), true);
 
$image = explode(',', $data['imageData']);
$image_meta = explode(';', $image[0]);
 
$image_b64 = $image[1];
 
// File handling
 
if ($image_meta[0] === 'data:image/jpeg') {
    $filename = sha1($image_b64) . '.jpg';
    $_SESSION['imgType'] = 'image/jpeg';
} else if ($image_meta[0] === 'data:image/png') {
    $filename = sha1($image_b64) . '.png';
    $_SESSION['imgType'] = 'image/png';
}
$handle = fopen(dirname(__FILE__) . '/uploads/' . $filename, 'wb+');

$_SESSION['imgName'] = $filename;
    
fwrite($handle, base64_decode($image_b64));
fclose($handle);
 
header('Content-Type: application/json');
echo json_encode(array('filename' => '/uploads/' . $filename));
 