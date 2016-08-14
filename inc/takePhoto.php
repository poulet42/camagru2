<?php include_once($_SERVER['DOCUMENT_ROOT'] . "inc/header.php"); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . 'inc/sidebar.php'); ?>
<section class='main-content main-content-w-side'>
  <video id="video"></video>
  <button id="startbutton">Prendre une photo</button>
  <canvas id="canvas" style="display:none;"></canvas>
  <img id="photo" onclick="filtermove(event)"/>
  <input type="number" value="0" name="sweg" id="swegs"/>
  <input type="number" value="0" name="sweg2" id="sweg2"/>
  <p id="demo"></p>
</section>
<script>
  function filtermove(e) {
    var x = e.clientX;
    var y = e.clientY;
    //var coor = "Coordinates: (" + x + "," + y + ")";
    document.getElementById("swegs").value = x;
    document.getElementById("sweg2").value = y;
    takepicture();
  }
</script>
<script src="js/script.js"></script>
<?php include_once('/inc/footer.php'); ?>
