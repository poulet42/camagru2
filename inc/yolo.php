<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/inc/appstart.php");
if (isset($_POST['img']))
  file_put_contents('cc.txt', base64_decode(substr(explode(";",$_POST['img'])[1], 7)));
$img = new Image('cc.txt', 'png');
$filter = new Image($_SERVER['DOCUMENT_ROOT'] . "/img/blingee.gif", 'gif');
$filter->scaleCoeff(0.4);
$x = $GET['coord'];
$params = array(
    'dst_x' => $x + $img->getWidth() - $filter->getWidth(),
    'dst_y' => $img->getHeight() - $filter->getHeight(),
    'transparence' => true,
);
$img->merge($filter,$params)->display()->destroy();
$filter->destroy();