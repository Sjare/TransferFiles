<?php
include 'header.php';
include 'mods.php';


		

	if(isset($_SESSION['id']))
		{
		if($_GET['page']=='home')
		{
		?>

    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="">Home</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Welcome to the <?php echo $_SESSION['Company']; ?> | <?php echo $_SESSION['AppTitle']; ?> System</h2>
            
            <div class="inner">
			<?php echo $_SESSION['HomeWelcome']; ?>

              
              <hr />
				<p> <span class="gray"><?php echo $_SESSION['Assistance']; ?></span></p>
            </div>
          </div>
        </div>
<?php
	
	if($_SESSION['blogmod'] == 'Active')
	{

//START THE BLOG
//GET POSTS FROM DB
		$query="SELECT postDate, postTitle, postBody FROM Blog ORDER BY postDate DESC";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;
?>

		
        <div class="block" id="block-text2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="">The Blog</a></li>
            </ul>
          </div>
          <div class="content">
           <div class="inner">
				<?php
				$i=0;
				while ($i < $num) {

				$Title =mysql_result($result,$i,"postTitle");
				$Body =mysql_result($result,$i,"postBody");
				$Date =mysql_result($result,$i,"postDate");
				echo "
				<strong><h3>$Title</h3></strong>
				<p>$Date</p>
				<p>$Body</p>
				<hr />
				";
				$i++;


				}
				?>


              
              <hr />
			
            </div>
          </div>
          </div>
         <?php


         
          }
?>

                    </div>


		<?php
		
		?>
		<?php
		}
		if($_GET['page']=='volunteeroptions')
		{
		

		
		//Report Hours Form
		if($_GET['option']=='reporthours')
		{
		
		//GET LOCATIONS
			$sql = "SELECT Location, Name FROM VolunteerLocations WHERE VIP_ID='".$_SESSION['id']."' ".
			"ORDER BY Name";
			$bob='shawn';
			$rs = mysql_query($sql);
			
		//INSERT HOURS INTO mySQL
		if($_POST['submit']=='savehours')
		{
		//echo 'Save Hours';
		$err = array();
		// Will hold our errors	
			
		
			if(!$_POST['date'])
				$err[] = 'You need to enter a date to report your hours!';
			if(!$_POST['Notes'])
				$err[] = 'The notes filed can not be blank.  You need to enter a discription of you work!';
			if($err)
				$_SESSION['msg']['hours-err'] = implode('<br />',$err);
			// Save the error messages in the session
			
			
		if(!count($err))
		{
		//echo 'no errors';
		$sql="INSERT INTO Hours (User_ID, Hours, Date, HoursLocation, HoursNotes, HoursStatus)
		VALUES
		('$_POST[VolunteerID]','$_POST[Hours]','$_POST[date]','$_POST[Location]','$_POST[Notes]','VERIFIED')";

		if (!mysql_query($sql))
 		{
 		die('Error: ' . mysql_error());
 		}
		}
		
		}
		?>		
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
             <li class="first active" class="active"><a href="?page=volunteeroptions&option=reporthours">Report Hours</a></li>
              <li class="first"><a href="?page=volunteeroptions&option=userinformation">User Information</a></li>
              <li><a href="?page=volunteeroptions&option=locations">Locations</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Report Volunteer Hours</h2>
            <div class="inner">
				<?php
				/////////////
				//ERROR MESSAGE
			
			 	 if($_SESSION['msg']['hours-err'])
        		{
        		?>
        		
				<div class="flash">
                <div class="message error">
                <p>
                <?php echo $_SESSION['msg']['hours-err'];
                unset($_SESSION['msg']['hours-err']);
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
				
				if($_POST['submit']=='savehours')
				{
			 	if(!count($err))
        		{
        		?>
				<div class="flash">
                <div class="message notice">
                <p>
                <?php echo 'Your hours have sucessfully been submitted!';
                ?>
                </p>
                </div>
                </div>
            	<?php
           		}
           		}
            	?>
          
              <form action="" method="post" class="form" name="reportHours">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Volunteer ID</label>
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $_SESSION['id']; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Notes / Work Performed</label>
                      <textarea class="text_area" id="Notes" Name="Notes" rows="10" cols="80"><?php echo $_POST['Notes'];?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Campus / Location</label>
                      <select id="Location" name="Location">
                      
                      <?php
  					  while($row = mysql_fetch_array($rs))
						{
 						echo "<option value=\"".$row['Location']."\">".$row['Name']."\n </option>";
						}                      
                      ?>
                      
                      </select>
                    </div>
                    <div class="group">
                      <label class="label">Date</label>
                      <div>
                        <input type="text" name="date" id="date"  value="" class="text_field" READONLY/>
						<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "reportHours",
						// input name
						"controlname": "date"
						});
						</script>
                      </div>
                    </div>
                    <div class="group">
                      <label class="label">Number of Hours</label>
                      <div>
                        <input type="text" name="Hours" id="Hours"  value="1" class="text_field" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="savehours">
                    <img src="images/icons/tick.png" alt="Save" /> Report Hours
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
<?php
		}
		//UserInformation Form
		if($_GET['option']=='userinformation')
		{
		$voldetails = mysql_query('SELECT * FROM Users WHERE id="'.$_SESSION['id'].'"');
		if (!$voldetails) {
   		 die('Invalid query: ' . mysql_error());
		}

		while ($details = mysql_fetch_assoc($voldetails)) {
   		$VolunteerAddress = $details['VolAddress'];
    	$VolunteerCity = $details['VolCity'];
	    $VolunteerState = $details['VolState'];
    	$VolunteerZip = $details['VolZip'];
	    $VolunteerHomePhone = $details['HomePhone'];
    	$VolunteerWorkPhone = $details['WorkPhone'];
	    $VolunteerCellPhone = $details['CellPhone'];
    	$VolunteerWebSite = $details['WebSite'];
	    $VolunteerFirstName = $details['fn'];
	    $VolunteerLastName = $details['ln'];
	    $VolunteerEmail = $details['email'];
	    $VolunteerNotes = $details['Notes'];
	    $VolunteerID = $details['id'];

}
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
             <li class="first" class="active"><a href="?page=volunteeroptions&option=reporthours">Report Hours</a></li>
              <li class="active"><a href="?page=volunteeroptions&option=userinformation">User Information</a></li>
              <li><a href="?page=volunteeroptions&option=locations">Locations</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Your User Information</h2>
            <div class="inner">
            <p>You can modify the information in the fields below.  Make sure you clik the Save button to update any changes.</p>
				<?php
				/////////////
				//ERROR MESSAGE
			
			 	 if($_SESSION['msg']['hours-err'])
        		{
        		?>
        		
				<div class="flash">
                <div class="message error">
                <p>
                <?php echo $_SESSION['msg']['hours-err'];
                unset($_SESSION['msg']['hours-err']);
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
				
				if($_POST['submit']=='updateinfo')
				{
			 	if(!count($err))
        		{
        		$sql="UPDATE Users SET fn='".$_POST['fn']."', ln='".$_POST['ln']."', email='".$_POST['email']."', VolAddress='".$_POST['address']."', VolCity='".$_POST['city']."', VolState='".$_POST['state']."', VolZip='".$_POST['zip']."', HomePhone='".$_POST['homephone']."', WorkPhone='".$_POST['workphone']."', Notes='".$_POST['notes']."', cellphone='".$_POST['cellphone']."' WHERE id='".$_SESSION['id']."' ";
        		mysql_query($sql);
		$voldetails = mysql_query('SELECT * FROM Users WHERE id="'.$_SESSION['id'].'"');
		if (!$voldetails) {
   		 die('Invalid query: ' . mysql_error());
		}

		while ($details = mysql_fetch_assoc($voldetails)) {
   		$VolunteerAddress = $details['VolAddress'];
    	$VolunteerCity = $details['VolCity'];
	    $VolunteerState = $details['VolState'];
    	$VolunteerZip = $details['VolZip'];
	    $VolunteerHomePhone = $details['HomePhone'];
    	$VolunteerWorkPhone = $details['WorkPhone'];
	    $VolunteerCellPhone = $details['CellPhone'];
    	$VolunteerWebSite = $details['WebSite'];
	    $VolunteerFirstName = $details['fn'];
	    $VolunteerLastName = $details['ln'];
	    $VolunteerEmail = $details['email'];
	    $VolunteerNotes = $details['Notes'];
	    $VolunteerID = $details['id'];

}
        		?>
				<div class="flash">
                <div class="message notice">
                <p>
                <?php echo 'Your information have sucessfully been updated!';
                ?>
                </p>
                </div>
                </div>
            	<?php
           		}
           		}
            	?>
          
              <form action="" method="post" class="form" name="VolunteerInformation">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Volunteer ID</label>
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $_SESSION['id']; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">First Name</label>
                      <input type="text" id="fn" name="fn" value="<?php echo $VolunteerFirstName; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Last Name</label>
                      <input type="text" id="ln" name="ln" value="<?php echo $VolunteerLastName; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Email Address</label>
                      <input type="text" id="email" name="email" value="<?php echo $VolunteerEmail; ?>" class="text_field" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Notes</label>
                      <textarea class="text_area" id="notes" name="notes" rows="10" cols="80"><?php echo $VolunteerNotes;?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                      <div class="group">
                      <label class="label">Address</label>
                      <input type="text" id="address" name="address" value="<?php echo $VolunteerAddress; ?>" class="text_field" />
                    </div>
                    <div class="group">
                    
                      <label class="label">City</label>
                      <input type="text" id="city" name="city" value="<?php echo $VolunteerCity; ?>" class="text_field" />
                    </div>
                    <div class="group">
             
                      <label class="label">State</label>
                      <input type="text" id="state" name="state" value="<?php echo $VolunteerState; ?>" class="text_field" />
                    </div>
                    <div class="group">
             
                      <label class="label">Zip</label>
                      <input type="text" id="zip" name="zip" value="<?php echo $VolunteerZip; ?>" class="text_field" />
                    </div>
                    <div class="group">
                  
                      <label class="label">Home Phone</label>
                      <input type="text" id="homephone" name="homephone" value="<?php echo $VolunteerHomePhone; ?>" class="text_field" />
                    </div>
                    <div class="group">
        
                      <label class="label">Work Phone</label>
                      <input type="text" id="workphone" name="workphone" value="<?php echo $VolunteerWorkPhone; ?>" class="text_field" />
                    </div>
                    <div class="group">
            
                      <label class="label">Cell Phone</label>
                      <input type="text" id="cellphone" name="cellphone" value="<?php echo $VolunteerCellPhone; ?>" class="text_field" />
                    </div>
           
          
                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="updateinfo">
                    <img src="images/icons/tick.png" alt="Save" /> Save Information
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      

<?php
		}
		if(isset($_GET['deletelocation']))
		{
		mysql_query("DELETE FROM LocationAssignments WHERE LocID='$_GET[deletelocation]'");
		//echo 'shawn';
		}


		if($_GET['option']=='locations')
		{
		
		$query="SELECT LocID, Name FROM VolunteerLocations WHERE VIP_ID='".$_SESSION['id']."'";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;
		
		if($_POST['submit']=='addlocation')
		{
		$sql="INSERT INTO LocationAssignments (VIP_ID, Location)
		VALUES
		('$_POST[VolunteerID]','$_POST[Location]')";
		mysql_query($sql);
		$query="SELECT LocID, Name FROM VolunteerLocations WHERE VIP_ID='".$_SESSION['id']."'";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;
		}

		
		
		
		
		
		
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
             <li class="first"><a href="?page=volunteeroptions&option=reporthours">Report Hours</a></li>
              <li><a href="?page=volunteeroptions&option=userinformation">User Information</a></li>
              <li class="active"><a href="?page=volunteeroptions&option=locations">Locations</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Location Assignments</h2>
            <div class="inner">
            <p>Here you can view / add / remove location assignments from your account.  Please note that you must be assigned to a location before you can report ours at that location.</p>
              <form action="#" class="form">
                <table class="table">
                  <tr>
                    
                    <th>Location ID</th>
                    <th>Location Name</th>
                    <th></th><th></th><th></th>
                    <th>Remove...</th>

                    <th class="last">&nbsp;</th>
                  </tr>
				<?php
				$i=0;
				while ($i < $num) {

				$LocID =mysql_result($result,$i,"LocID");
				$Name =mysql_result($result,$i,"Name");
				echo "
				<tr>
				<td>$LocID</td>
				<td>$Name</td>
				<td></td><td></td><td></td>
				
				<td><a href=?page=volunteeroptions&option=locations&deletelocation=$LocID><img src='include/images/icons/cross.png'></a></td>
				</tr>";
				$i++;


				}

			//GET LOCATIONS
			$getlocations = "SELECT LocationID, Name FROM Locations ".
			"ORDER BY Name";
			$bob='shawn';
			$locationsrs = mysql_query($getlocations);

				?>
                </table>

              </form>
            </div>
          </div>
        </div>



        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="#block-text">Add Location</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Add A Location...</h2>
            <div class="inner">
              <form action="" method="post" class="form">
                <div class="group">
                  <label class="label">Volunteer ID</label>
                  <input type="text" name="VolunteerID" id="VolunteerID" value="<?php echo $_SESSION['id']; ?>" class="text_field" READONLY/>

                </div>

                    <div class="group">
                      <label class="label">Campus / Location</label>
                      <select id="Location" name="Location">
                      
                      <?php
  					  while($locationsrow = mysql_fetch_array($locationsrs))
						{
 						echo "<option value=\"".$locationsrow['LocationID']."\">".$locationsrow['Name']."\n </option>";
						}                      
                      ?>
                      
                      </select>
                    </div>


                <div class="group navform wat-cf">
                  <button class="button" type="submit" id="submit" name="submit" value="addlocation">
                    <img src="images/icons/tick.png" alt="Save" /> Add This Location
                  </button>

                </div>
              </form>
            </div>
          </div>
        </div>
    
        </div>

<?php
		}
		}
		//GET NEWS BLOCK FROM DB
		$block1details = mysql_query('SELECT * FROM SiteVars WHERE SiteVarCode="NewsBlock1"');
		if (!$block1details) {
   		 die('Invalid query: ' . mysql_error());
		}

		while ($details1 = mysql_fetch_assoc($block1details)) {
   		$Block1Code = $details1['SiteVarCode'];
    	$Block1SiteVar = $details1['SiteVar'];
		}
		$block2details = mysql_query('SELECT * FROM SiteVars WHERE SiteVarCode="NewsBlock2"');
		if (!$block2details) {
   		 die('Invalid query: ' . mysql_error());
		}

		while ($details2 = mysql_fetch_assoc($block2details)) {
   		$Block2Code = $details2['SiteVarCode'];
    	$Block2SiteVar = $details2['SiteVar'];
		}
		$block3details = mysql_query('SELECT * FROM SiteVars WHERE SiteVarCode="NewsBlock3"');
		if (!$block3details) {
   		 die('Invalid query: ' . mysql_error());
		}

		while ($details3 = mysql_fetch_assoc($block3details)) {
   		$Block3Code = $details3['SiteVarCode'];
    	$Block3SiteVar = $details3['SiteVar'];			
		}
?>
<?php
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
?>

		<div id="sidebar">
		<div class="block notice">
		<center>
		<h4>Hello, <?php echo $_SESSION['fn']; ?> <?php echo $_SESSION['ln']; ?>!</h4>
		<a href="profile.php?page=profile&option=currentuser&user=<? echo $_SESSION['id']; ?>"><img src="image.php?src=<? echo $ProfilePicPath; ?>" border="0" /></a>
		<br />
		<br />
		</center>
        </div>
        <div class="block notice">
		<h4>Find Someone</h4>
        <form action="search.php?page=search&option=findvolunteer" method="post" class="form" name="search">
		<div class="group">
        <input type="text" id="searched" name="searched" value="<?php echo $VolunteerLastName; ?>" class="text_field" />
        </div>
        <div class="group navform wat-cf">
        <button class="button" type="submit" name="submit" id="submit" value="search">
        <img src="images/icons/tick.png" alt="Save" /> Search
        </button>
        </div>
        </form>
        </div>
        <div class="block notice">
		<?php echo $Block1SiteVar; ?>
        </div>

        <div class="block notice">
		<?php echo $Block2SiteVar; ?>
        </div>
        <div class="block notice">
		<?php echo $Block3SiteVar; ?>
        </div>
        </div>
        </div>


<?php
		
		}
		


			
?>






