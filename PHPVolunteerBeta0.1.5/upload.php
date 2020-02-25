<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Max's File Uploader</title>
   <link href="include/style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>






<?php


?>




 <form enctype="multipart/form-data" action="" method="POST"> 
 Please choose a file: <input name="uploaded" type="file" />
 <br /> 
 <input type="submit" value="Upload" />
 </form> 

 <?php
 //This function separates the extension from the rest of the file name and returns it  
 function findexts ($filename) { $filename = strtolower($filename) ; $exts = split("[/\\.]", $filename) ; $n = count($exts)-1; $exts = $exts[$n]; return $exts; }
 //This applies the function to our file
 $ext = findexts ($_FILES['uploaded']['name']) ; 
 //This line assigns a random number to a variable. You could also use a timestamp here if you prefer.
 $ran = rand () ;
 //This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
 $ran2 = $ran.".";
 //This assigns the subdirectory you want to save into... make sure it exists!
 $target = "uploads/Documents/";
 //This combines the directory, the random file name, and the extension
 $target = $target . $ran2.$ext;
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
 {
 echo
 "The file has been uploaded as ".$ran2.$ext; 
 } else {
 echo "Sorry, there was a problem uploading your file.";
 } 
 ?> 


</body>   

