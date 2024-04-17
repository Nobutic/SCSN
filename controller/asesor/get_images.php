<?php
$images = scandir('images');
$images = array_diff($images, array('.', '..'));
echo json_encode(array_values($images));
?>