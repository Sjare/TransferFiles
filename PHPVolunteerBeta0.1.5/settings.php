
<?php

include 'header.php';
include('include/ps_pagination.php');

	if(isset($_SESSION['id']))
		{
		if($_GET['option']=='settingshome')
		{
		//echo 'settings';
		
		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="settings.php?page=settings&option=settingshome">Home</a></li>
              <li><a href="settings.php?page=settings&option=changepassword">Change Password</a></li>
              <li><a href="settings.php?page=settings&option=changepicture">Change Profile Picture</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">User Settings...</h2>
            
            <div class="inner">
            <h3>What settings can you modify?</h3>
              <p class="first">
                <span class="hightlight">Change your password</span>, can be accessed from the Change Password tab.
                </p>
                <p>
                <span class="hightlight">Change your profile picture</span>, can be accessed from the Change Profile Picture tab.
              </p>
              <p class="first">
                Keep an eye out for more options to come!
              </p>

              
              <hr />
				<p> <span class="gray"><?php echo $_SESSION['Assistance'];?></span></p>
            </div>
          </div>
        </div>
		</div>



<?php

	}
		if($_GET['option']=='changepassword')
		{
		//$status="OK";
		if($_POST['submit']=='changepassword')
		{
		echo 'change';
		$todo=$_POST['submit'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		if(isset($todo) and $todo=="changepassword"){
		$password=mysql_real_escape_string($password);
		$status = "OK";
		$msg="";
		if ( strlen($password) < 3 or strlen($password) > 50 ){
		$msg=$msg."Your password was not longer than 3 characters!<BR>";
		$status= "NOTOK";}
		if ( $password <> $password2 ){
		$msg=$msg."Both passwords are not matching<BR>";
		$status= "NOTOK";}
   		}
   		if($status=="OK")
   		{
   		$msg="Your password has been changed!";
   		mysql_query("update Users set pass='".md5($_POST['password'])."' where id='$_SESSION[id]'");
		}	
   		}

		//echo 'ChangePassword';
?>

    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="settings.php?page=settings&option=settingshome">Home</a></li>
              <li class="active"><a href="settings.php?page=settings&option=changepassword">Change Password</a></li>
              <li><a href="settings.php?page=settings&option=changepicture">Change Profile Picture</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Change your password...</h2>
            <div class="inner">
				<?php
				/////////////
				//ERROR MESSAGE
           		if($status=="NOTOK")
           		{				
           		?>
				<div class="flash">
                <div class="message error">
                <p>
				<?php echo $msg;
				unset($msg);
				?>
                </p>
                </div>
                </div>
           		<?php
            	}
           		?>
           		

				
				<?php
				/////////////
				//SUCCESS MESSAGE
           		if($status=="OK")
           		{				
           		?>
				<div class="flash">
                <div class="message notice">
                <p>
				<?php echo $msg;
				unset($msg);
				?>
                </p>
                </div>
                </div>
           		<?php
            	}				

            	?>
          
              <form action="" method="post" class="form" name="reportHours">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Volunteer ID</label>
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $_SESSION['id']; ?>" class="text_field" READONLY/>
                    </div>

                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Your password must be longer than 3 characters.</label>
                      <hr />
                      <br />
                      <div>

                    </div>
                    <div class="group">
                      <label class="label">New Password</label>
                      <div>
                        <input type="password" name="password" id="password"  value="" class="text_field" />
                      </div>
                    <div class="group">
                      <label class="label">Re-Type New Password</label>
                      <div>
                        <input type="password" name="password2" id="password2"  value="" class="text_field" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="changepassword">
                    <img src="images/icons/tick.png" alt="Save" /> Change Password
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>

<?php
	}


	

	if($_GET['option']=='changepicture')
	{
	//GET PROFILE PIC PATCH FROM DB
	$sql="SELECT path FROM ProfilePics WHERE VOL_ID='".$_SESSION['id']."'";
	$result=mysql_fetch_assoc(mysql_query($sql));
	$num_rows=mysql_num_rows($result);
	$_SESSION['oldPic']=$result['path'];
	if($_POST['submit']=='Update')
		{

 //This function separates the extension from the rest of the file name and returns it  
 function findexts ($filename) { $filename = strtolower($filename) ; $exts = split("[/\\.]", $filename) ; $n = count($exts)-1; $exts = $exts[$n]; return $exts; }
 //This applies the function to our file
 $ext = findexts ($_FILES['uploaded']['name']) ; 
 //This line assigns a random number to a variable. You could also use a timestamp here if you prefer.
 $ran = rand () ;
 //This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
 $ran2 = $ran.".";
 //This assigns the subdirectory you want to save into... make sure it exists!
 $target = "uploads/ProfilePics/";
 //This combines the directory, the random file name, and the extension
 $target = $target . $ran2.$ext;
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
 {
// echo
// "The file has been uploaded as ".$ran2.$ext;
// echo $target;
 $sql="UPDATE ProfilePics SET path='".$target."' WHERE VOL_ID='".$_SESSION['id']."'";
 mysql_query($sql);
 } else {
//echo "Sorry, there was a problem uploading your file.";
 }
 }
		

	if($_POST['submit']=='Upload')
		{

	echo 'upload';
 //This function separates the extension from the rest of the file name and returns it  
 function findexts ($filename) { $filename = strtolower($filename) ; $exts = split("[/\\.]", $filename) ; $n = count($exts)-1; $exts = $exts[$n]; return $exts; }
 //This applies the function to our file
 $ext = findexts ($_FILES['uploaded']['name']) ; 
 //This line assigns a random number to a variable. You could also use a timestamp here if you prefer.
 $ran = rand () ;
 //This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
 $ran2 = $ran.".";
 //This assigns the subdirectory you want to save into... make sure it exists!
 $target = "uploads/ProfilePics/";
 //This combines the directory, the random file name, and the extension
 $target = $target . $ran2.$ext;
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
 {
// echo
// "The file has been uploaded as ".$ran2.$ext;
// echo $target;
 $sql="INSERT INTO ProfilePics (VOL_ID,path) VALUES ('".$_SESSION['id']."','".$target."')";
 mysql_query($sql);
 } else {
//echo "Sorry, there was a problem uploading your file.";
 }
 }

	
	//GET PROFILE PIC PATCH FROM DB
	$sql="SELECT path FROM ProfilePics WHERE VOL_ID='".$_SESSION['id']."'";
	$result=mysql_fetch_assoc(mysql_query($sql));
	$num_rows=mysql_num_rows($result);


	$submit="Update";
	$ProfilePicPath=$result['path'];

	if($ProfilePicPath=="")
	
	{
	$submit="Upload";
	$ProfilePicPath='images/avatar.png';
	}

	//echo $ProfilePicPath;
	
	
	//echo 'shwn';
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="settings.php?page=settings&option=settingshome">Home</a></li>
              <li><a href="settings.php?page=settings&option=changepassword">Change Password</a></li>
              <li class="active"><a href="settings.php?page=settings&option=changepicture">Change Profile Picture</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Change your profile picture...</h2>
            <div class="inner">
			<form enctype="multipart/form-data" action="" method="post" class="form">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Volunteer ID</label>
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $_SESSION['id']; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Your current profile picture is:</label>
                      <img src="image.php?src=<? echo $ProfilePicPath; ?>">
                    </div>
                  </div>
                  <div class="column right">

                     <div class="group">
                      <label class="label">Please choose picture to upload:</label>
                        <input name="uploaded" type="file" />

                    </div>


                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="<?php echo $submit; ?>">
                    <img src="images/icons/tick.png" alt="Save" /> Change Profile Picture!
                  </button>
                </div>
              </form>
<?php
//echo $_SESSION['oldPic'];
	if($_POST['submit']=='Update')
		{
	$oldPic=$_SESSION['oldPic'];
	unlink($oldPic);
	unset($_SESSION['oldPic']);
		}
	
	
	}

	

		
	}
		


			
?>





</body>
</html>

