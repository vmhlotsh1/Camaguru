<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
<body>

<div class="main-nav">
	<ul class="nav">
		<li class="name">CAMAGRU</li>
		<li><a href="login.php">Login</a></li>
		<li><a href="registration/registration.php">Register</a></li>
		<li><a href="snap.php">Snap</a></li>
		<li><a href="#">Gallery</a></li>
	</ul>
</div>

<header>
<main class="flex">
<div class="card">
       <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


       <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
       <style type="text/css">
           #results { padding:20px; border-radius: 19px 19px 19px 19px;
                                    -moz-border-radius: 19px 19px 19px 19px;
                                    -webkit-border-radius: 19px 19px 19px 19px;
                                    border: 0px solid #000000; solid; background:#0499ff; }
       </style>
   </head>

<body>
       <h2>Take Snap</h2>
       <form method="POST" action="storeImage.php">
           <div class="row">
               <div class="col-md-6">
                   <div id="my_camera"></div>
                   <br/>
                   <ul class="skills">
               </div>
               <div class="col-md-12 text-center">
                   <br/>
                   <ul class="skills">
                    <li><input type=button value="Take Snap" onClick="take_snapshot()"></li>
                    <input type="hidden" name="image" class="image-tag">
                    <li><a><input type=button value="Submit" onClick="take_snapshot()"></a></li>
                   </ul>
                    		<h2>Add Stickers</h2>
                    		<div class="row">
                    			<ul class="skills">
                    			<!--<div class="column">-->
                    				<img src="images/heart_skelton.png" style="width:15%">
                    			<!--</div>-->
                    			<!--<div class="column">-->
                    				<img src="images/mac_skelton.png" style="width:15%">
                    			<!--</div>-->
                    			<!--<div class="column">-->
                    				<img src="images/cute_skelton.png" style="width:15%">
                    			<!--</div>-->
                    				<!--<div class="column">-->
                    					<img src="images/watermelon.png" style="width:13%">
                    				<!--</div>-->
                    			</ul>
                    		</div>
               </div>
           </div>
       </form>
   </div>

   <!-- Configure a few settings and attach camera -->
   <script language="JavaScript">
       Webcam.set({
           width: 390,
           height: 390,
           image_format: 'jpeg',
           jpeg_quality: 90
       });

       Webcam.attach( '#my_camera' );

       function take_snapshot() {
           Webcam.snap( function(data_uri) {
               $(".image-tag").val(data_uri);
               document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
               var xhttp = new XMLHttpRequest();
               xhttp.open("POST", "http://localhost:8080/camagru/snaping.php", true);
               xhttp.setRequestHeader("Content-type", "application/x-wwww-form-urlencoded");
               xhttp.send("image="+encodeURIComponent(data_uri));
           } );
       }
   </script>

   	<div class="card">
    		<h2>Comments</h2>
    		<p>Say something about the picture you have just taken by clicking on the button below</p>
    		<div class="col-md-6">
                        <div id="results"><h2>Your snap image will appear here...(^^,)<h2></div>
            </div>
    		<ul class="skills">
    			<li><input type=button value="Like" onClick="take_snapshot()"></li>
    			<li><input type=button value="Dislike" onClick="take_snapshot()"></li>
    		</ul>
    	</div>
   </main>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once ('config/database.php');
          $img = $_POST['image'];
          $folderPath = "upload/";

          $image_parts = explode(";base64,", $img);
          $image_type_aux = explode("image/", $image_parts[0]);
          $image_type = $image_type_aux[1];

          $image_base64 = base64_decode($image_parts[1]);
          $fileName = uniqid() . '.png';
          $file = $folderPath . $fileName;
        $sqlInsert = "INSERT INTO images (name, username) VALUES (:name, :username)";

        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(
            ':name' => $fileName,
            ':username' => 'kaysiz'
        ));
          file_put_contents($file, $image_base64);

          print_r($fileName);

      ?>

   <footer>
   	<p class="copyright">Copyright 2018, Vuyo Mhlotshane</p>
   </footer>
</header>
   </body>
   </html>

