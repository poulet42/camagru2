<?php
if (isset($_POST['img'])) {
  file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/img/temp.png', base64_decode(substr(explode(";",$_POST['img'])[1], 7)));
  echo "COUCOU <img src='img/temp.png' />";
}
else {
  echo "La requete POST n'a pas abouti";
}