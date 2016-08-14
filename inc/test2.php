<?php
require ($_SERVER['DOCUMENT_ROOT'] . "/inc/appstart.php");
if (isset($_POST['img'])) {

    //Coordonnées filtre
    $params = array(
    'dst_x' => intval($_POST['dstx']) - 462,
    'dst_y' => intval($_POST['dsty']) - 100,
    //'dst_x' => $img->getWidth() - $filter->getWidth(),
    //'dst_y' => $img->getHeight() - $filter->getHeight(),
    'transparence' => true,
  );

  $img = (new Image('png'))->from(
    [
      'method' => 'string',
      'data' => base64_decode(substr(explode(";",$_POST['img'])[1], 7))
    ]
  );

  $filter = (new Image('gif'))->from(
    [
      'method' => 'file',
      'data' => $_SERVER['DOCUMENT_ROOT'] . "/img/blingee.gif"
    ])->scaleCoeff(0.4);

  $img->merge($filter,$params)->to(['path' => 'test.png'])->destroy();
}
