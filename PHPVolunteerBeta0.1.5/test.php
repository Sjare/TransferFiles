<?php

header('Content-type: image/jpeg');
header('Content-type: image/png');
$image = $_GET['src'];
$image = new Imagick($image);


// If 0 is provided as a width or height parameter,
// aspect ratio is maintained
$image->thumbnailImage(100, 0);

echo $image;

?>