<?php
	session_start();
	if($_SESSION['username'] == "")
		header("location: logowanie.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="materialize.min.css">
	<script src="jquery-2.1.1.min.js"></script>
	<script src="materialize.min.js"></script>
</head>
<body>

<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center">Zdalny monitoring - Home</a>
 		<ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a class="waves-effect waves-light btn" href="wylogowanie.php">Wyloguj</a></li>
      </ul>
    </div>
</nav>

<div class="home">
	<h5>Witaj <?php echo $_SESSION['username']; ?>. Możesz sprawdzić podgląd z kamer</h5>
</div>

<script type="text/javascript">
  function capture(ql){
    $("#captureBtns a").each(function(i, o){
      $(o).addClass("disabled");
    });
    $.get("http://" + $("#cameraIP").val() + "/?plen=" +
     $("#cameraPLEN").val() + "&ql=" + ql + "&t=" + Math.random(), function(result){
      $("input[name='captureBtn']").addClass("disabled");
      if (result.indexOf("Server is running!") == -1){
        alert("Please input the correct 'Camera IP Address'!");
        $("#captureBtns a").each(function(i, o){
          $(o).removeClass("disabled");
        });

      }else{
        $("#capturePic").attr("src", "http://" + $("#cameraIP").val() + "/stream");
        if (ql<4) 
        {
          $("#capturePic").attr("width", "640");
          $("#capturePic").attr("height", "480");
        }else
        {
          $("#capturePic").attr("width", "auto");
          $("#capturePic").attr("height", "auto");
        }
      }
    });
  }
</script>

<div class="container">
	<div class="row center"></div>
	<div class="row center"></div>
	<div class="row center"></div>
	<div class="row center"></div>
	<div class="row center">
  		<img id="capturePic" src="images/video_logo.jpg">
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="input-field col s6 m4 offset-m4">
      <input id="cameraIP" type="text" class="validate" value="192.168.1.22">
      <label for="cameraIP">Wpisz numer IP swojej kamery</label>
    </div>
  </div>

  <div id="captureBtns" class="row center">
    <p>
      <a class="waves-effect waves-light btn" onclick="capture(0)">160x120</a>
      <a class="waves-effect waves-light btn" onclick="capture(1)">176x144</a>
      <a class="waves-effect waves-light btn" onclick="capture(2)">320x240</a>
    </p>

  </div>
  <div class="row center"></div>
</div>

  <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Opis</h5>
                <p class="grey-text text-lighten-4">Strona wykonana przy pomocy materialize.css.</p>
                <p class="grey-text text-lighten-4">Aplikacja internetowa umożliwia podgląd obrazu z bezprzewodowego monitoringu. Monitoring składa się z modułu kamery dedykowanej dla platformy Arduino - ArduCam-Mini OV2640 2MPx, oraz modułu WiFi opartego na układzie ESP8266 - Moduł WIFI ESP8266 NODEmcu V3.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Przydatne linki</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="http://materializecss.com/">Materialize.css Dokumentacja</a></li>
				  <li><a class="grey-text text-lighten-3" href="http://www.arducam.com/">Strona domowa ArduCam</a></li>
				  <li><a class="grey-text text-lighten-3" href="https://botland.com.pl/moduly-wifi/4450-modul-wifi-esp8266-nodemcu-v2.html">Wykorzystany w projekcie moduł WiFi</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" >Autor: Dominik Dziedzic</a>
            </div>
          </div>
        </footer>
            

</body>
</html>
