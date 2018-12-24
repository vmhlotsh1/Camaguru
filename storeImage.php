 <?php

          if (isset($_POST['image']))
          {
          $img = $_POST['image'];
          $folderPath = "upload/";

          $image_parts = explode(";base64,", $img);
          $image_type_aux = explode("image/", $image_parts[0]);
          $image_type = $image_type_aux[1];

          $image_base64 = base64_decode($image_parts[1]);
          $fileName = uniqid() . '.png';

          $file = $folderPath . $fileName;
          file_put_contents($file, $image_base64);

          $target = "my_images/".basename($_FILES['image']['name']);
          $image = $_FILES['image']['name'];
          $directory_name = 'my_images';

          if (!is_dir($directory_name)){
                mkdir($directory_name, 0755);
          }

          if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                echo "Unable to upload pic!!!";
           }
           }
          print_r($fileName);

      ?>