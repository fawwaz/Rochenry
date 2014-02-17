<?php
$data = json_decode(implode('', file('php://input')), true);
var_dump($data);

$image = explode(',', $data['imageData']);
$image_b64 = $image[1];

// File handling
$filename = 'upload/result.png';
$handle = fopen(dirname(__FILE__) . '/' . $filename, 'wb+');
fwrite($handle, base64_decode($image_b64));
fclose($handle);