<?php
require_once(__DIR__ . '/../Classes/Image.Class.php');
if ($_POST['img'])
    file_put_contents('temp.png', base64_decode(substr($_POST['img'], 22)));
$dst = new photo('temp.png', 'png');
$src = new photo(__DIR__ . "/../../img/blingee.gif", 'gif');
$src->scaleCoeff(0.4);
$params = array(
    'dst_x' => $dst->getWidth() - $src->getWidth(),
    'dst_y' => $dst->getHeight() - $src->getHeight()
);
$dst->merge($src,$params);
header('Content-Type: image/png');
$dst->display();
?>