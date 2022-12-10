<html>
<body>
<?php include("index.html"); ?>
<?php

//code references from https://www.w3schools.com/php/php_file_upload.asp
$fileName = $_FILES["myfile"]["name"];
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size
if ($_FILES["myfile"]["size"] > 500000) {
  $outputStatement = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "xls" && $fileType != "xlsx" ) 
{
  $outputStatement =  "Sorry, only excel file types are allowed.";
  $uploadOk = 0;
}

// if everything is ok, try to upload file
else {
  if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
    $outputStatement = "The file ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " has been uploaded.";
  } else {
    $outputStatement =  "Sorry, there was an error uploading your file.";
  }
}

exec("java convert $fileName");

?>
<center>

  <?php echo "$outputStatement" ?>
    <a href="convert/convEX.csv" download>
      <p>
        <?php if ($uploadOk){
        echo "Download Here!";
      } ?>
      </p>
    </a>

</center>

</body>
</html>