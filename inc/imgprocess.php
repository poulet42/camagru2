<?php
//require (__DIR__ . "/inc/appstart.php");
require ($_SERVER['DOCUMENT_ROOT'] . "/inc/appstart.php");
/*if (isset($_POST['img']))
  echo $_POST['img'];*/
  //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/img/temp.png', base64_decode(substr($_POST['img'], 22)));
$dst = new Image($_SERVER['DOCUMENT_ROOT'] . '/img/temp.png', 'png');
$src = new Image($_SERVER['DOCUMENT_ROOT'] . "/img/blingee.gif", 'gif');
$src->scaleCoeff(0.4);
$params = array(
    'dst_x' => $dst->getWidth() - $src->getWidth(),
    'dst_y' => $dst->getHeight() - $src->getHeight()
);
$dst->merge($src,$params);
header('Content-Type: image/png');
$dst->display();
?>