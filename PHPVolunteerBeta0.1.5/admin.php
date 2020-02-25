<?php

include 'header.php';
include('include/ps_pagination.php');
	if($_SESSION['AccessLevel']=='9' || $_SESSION['AccessLevel']=='3')
	{
	

	if(isset($_SESSION['id']))
		{
		if($_GET['option']=='administration')
		{
		?>

    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <?php
              if($_SESSION['AccessLevel']=='9')
              {
              ?>

              <li><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>

              
              
              <?php
              if($_SESSION['blogmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Welcome to the Administration Home Page!</h2>
            
            <div class="inner">
			<?php echo $_SESSION['AdminWelcome']; ?>

              
              <hr />
				<p> <span class="gray"><?php echo $_SESSION['Assistance']; ?></span></p>
            </div>
          </div>
        </div>
<?php
		}
		if($_GET['option']=='volunteers')
		{
	//THIS DELETES USERS FROM THE DATABASE!
	if($_GET['deletevolunteer']=='yes')
	{
	//header('location: admin.php?page=adminhome&option=locations');
	//echo 'Delete';
	$ID=$_GET['VolunteerID'];
	$deleteUser="DELETE FROM Users WHERE id=$ID";
	mysql_query($deleteUser);
	header('location: admin.php?page=adminhome&option=volunteers');
	}




	if($_POST['submit']=='searchbylast')
		{

		$searched=$_POST['searchbylast'];
		
		// Get Active Volunteers from Database
		$getActiveVolunteers="SELECT id, fn, ln, email FROM Users WHERE UserStatus='2' AND ln LIKE '$searched%' ORDER BY ln LIMIT 50";
		$resultActiveVolunteers=mysql_query($getActiveVolunteers);
		$numActiveVolunteers = mysql_numrows($resultActiveVolunteers);
		
		//Get Inactive Volunteers from Database
		$getInactiveVolunteers="SELECT id, fn, ln, email FROM Users WHERE UserStatus='3' AND ln LIKE '$searched%' ORDER BY ln LIMIT 50";
		$resultInactiveVolunteers=mysql_query($getInactiveVolunteers);
		$numInactiveVolunteers = mysql_numrows($resultInactiveVolunteers);
		
		}
	else
		{




		// Get Active Volunteers from Database
		$getActiveVolunteers="SELECT id, fn, ln, email FROM Users WHERE UserStatus='2' ORDER BY ln LIMIT 15";
		$resultActiveVolunteers=mysql_query($getActiveVolunteers);
		$numActiveVolunteers = mysql_numrows($resultActiveVolunteers);		


		//Get Inactive Volunteers from Database
		$getInactiveVolunteers="SELECT id, fn, ln, email FROM Users WHERE UserStatus='3' ORDER BY ln LIMIT 15";
		$resultInactiveVolunteers=mysql_query($getInactiveVolunteers);
		$numInactiveVolunteers = mysql_numrows($resultInactiveVolunteers);
		}


?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <?php
              if($_SESSION['AccessLevel']=='9')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>
              <?php
              if($_SESSION['blogmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Active Volunteers</h2>
            <div class="inner">
            <?php
            if($_GET['deletevolunteer']=='ask')
			{
			?>
          <div class="flash">
          <div class="message warning">
          <?php
          $ID=$_GET['edit'];
          $deletemsg="<p>Are sure you would like to delete this Volunteer from the database forever? <a href='admin.php?page=adminhome&option=volunteers&deletevolunteer=yes&VolunteerID=$ID'>[ YES ]</a> / <a href='admin.php?page=adminhome&option=volunteers'>[ NO ]</a></p>";
          echo $deletemsg;
          ?>
          </div>
          </div>
			<?php
			}
            
            ?>
              <form action="#" class="form">
                <table class="table" id="activeResults">
                  <tr>              
                    <th NOWRAP>Volunteer ID</th>
                    <th NOWRAP>Last Name</th>
                    <th NOWRAP>First Name</th>
                    <th NOWRAP>Email Address</th>
                    <th class="last">&nbsp;</th>
				<?php
				$i=0;
				while ($i < $numActiveVolunteers) {

				$ID =mysql_result($resultActiveVolunteers,$i,"id");
				$LastName =mysql_result($resultActiveVolunteers,$i,"ln");
				$FirstName =mysql_result($resultActiveVolunteers,$i,"fn");
				$Email =mysql_result($resultActiveVolunteers,$i,"email");
				echo "
				<tr>
				<td>$ID</td>
				<td>$LastName</td>
				<td>$FirstName</td>
				<td>$Email</td>
				<td></td><td></td><td></td>
				
				<td><a href=admin.php?page=adminhome&option=volunteers&deletevolunteer=ask&edit=$ID><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=changevolunteerpassword&edit=$ID><img src='include/images/icons/key.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=editvolunteer&edit=$ID><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=reportvolunteerhours&edit=$ID><img src='include/images/icons/add.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=managevolunteerlocations&edit=$ID><img src='include/images/icons/application_edit.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=managevolunteerdocuments&edit=$ID><img src='images/icons/new_document.png' width='16' heigth='16' border='0'></a></td>
				</tr>";
				$i++;


				}
				?>
                </table>
                
                <div class="actions-bar wat-cf">
                  <div class="actions">
                  <div id="pageNavPosition"></div>

                  </div>
                  <div class="pagination">
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li class="active first"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              
            </ul>
        	</div>
          <div class="content">
            <h2 class="title">Inactive Volunteers</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table" id="inactiveResults" name="2">
                  <tr>              
                    <th NOWRAP>Volunteer ID</th>
                    <th NOWRAP>Last Name</th>
                    <th NOWRAP>First Name</th>
                    <th NOWRAP>Email Address</th>
                    <th class="last">&nbsp;</th>
				<?php
				$z=0;
				while ($z < $numInactiveVolunteers) {

				$ID =mysql_result($resultInactiveVolunteers,$z,"id");
				$LastName =mysql_result($resultInactiveVolunteers,$z,"ln");
				$FirstName =mysql_result($resultInactiveVolunteers,$z,"fn");
				$Email =mysql_result($resultInactiveVolunteers,$z,"email");
				echo "
				<tr>
				<td>$ID</td>
				<td>$LastName</td>
				<td>$FirstName</td>
				<td>$Email</td>
				<td></td><td></td><td></td>
				
				<td><a href=admin.php?page=adminhome&option=deletevolunteer&edit=$ID><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=changevolunteerpassword&edit=$ID><img src='include/images/icons/key.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=editvolunteer&edit=$ID><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=reportvolunteerhours&edit=$ID><img src='include/images/icons/add.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=managevolunteerlocations&edit=$ID><img src='include/images/icons/application_edit.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=managevolunteerdocuments&edit=$ID><img src='images/icons/new_document.png' width='16' heigth='16' border='0'></a></td>
				</tr>";
				$z++;


				}
				?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>

		<div id="sidebar">
        <div class="block notice">
          <h4>Filter Results</h4>
          
          <form action="" method="post" class="form" name="searchbylastname">
        	<div class="group">
            <label class="label">Search for Volunteer by Last Name:</label>
            <input type="text" id="searchbylast" name="searchbylast" value="<?php echo $_POST['searchbylast']; ?>" class="text_field" />
            </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="searchbylast">
                    <img src="images/icons/tick.png" alt="Search" /> Search
                  </button>
                  <button class="button" type="submit" name="submit" id="submit" value="clearbylast">
                    <img src="images/icons/cross.png" alt="Clear Search" /> Clear Search
                  </button>
                </div>
              </form>
			</div>
		 <div class="block notice">
          <h4>Legend</h4>
          <p><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'> Delete Volunteer</p>
          <p><img src='include/images/icons/key.png' width='16' heigth='16' border='0'> Change Volunteer's Password</p>
          <p><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'> Edit Volunteer's Information</p>
          <p><img src='include/images/icons/add.png' width='16' heigth='16' border='0'> Report Volunteer's Hours</p>
          <p><img src='include/images/icons/application_edit.png' width='16' heigth='16' border='0'> Manage Volunteer's Locations</p>
          <p><img src='images/icons/new_document.png' width='16' heigth='16' border='0'> Manage Volunteer's Documents</p>
          
        </div>

		<?php
		if($_SESSION['AccessLevel']=='9')
		{
		?>

        <div class="block notice">
          <h4>Add New Volunteer</h4>
        <?php
        if($_SESSION['msg']['add-err'])
        {
        
        ?>
          <div class="flash">
            <div class="message error">
              <?php
							echo $_SESSION['msg']['add-err'];
							unset($_SESSION['msg']['add-err']);
				?>
            </div>
          </div>
        <?php
        }
        ?>
          
          <form action="" method="post" class="form" name="addVolunteer">
        	<div class="group">
            <label class="label">First Name</label>
            <input type="text" id="fn" name="fn" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Last Name</label>
            <input type="text" id="ln" name="ln" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Email Address</label>
            <input type="text" id="email" name="email" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Street Address</label>
            <input type="text" id="address" name="address" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">City</label>
            <input type="text" id="city" name="city" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">State</label>
            <input type="text" id="state" name="state" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Zip</label>
            <input type="text" id="zip" name="zip" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Home Phone</label>
            <input type="text" id="homephone" name="homephone" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Work Phone</label>
            <input type="text" id="workphone" name="workphone" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Cell Phone</label>
            <input type="text" id="cellphone" name="cellphone" value="" class="text_field" />
            </div>
                    <div class="group">
                      <label class="label">Gender</label>
                      <select id="gender" name="gender">
                      
                      <?php
                      	echo "<option value=\"".$VolunteerGender."\">".$VolunteerGender."\n </option>";
                    
                      ?>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="group">
                      <label class="label">Ethnicity</label>
                      <select id="ethnicity" name="ethnicity" >
                      
                      <?php
                      	echo "<option value=\"".$VolunteerRace."\">".$VolunteerRace."\n </option>";
                    
                      ?>
                      <option value="Hispanic">Hispanic</option>
                      <option value="White">White</option>
                      <option value="Asian">Asian</option>
                      </select>
                    </div>
        	<div class="group">
            <label class="label">Date of Birth</label>
            <input type="text" id="dob" name="dob" value="" class="text_field" READONLY/>
                      	<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "addVolunteer",
						// input name
						"controlname": "dob"
						});
						</script>
            </div>
        	<div class="group">
            <label class="label">Start Date</label>
            <input type="text" id="startdate" name="startdate" value="" class="text_field" READONLY/>
                      	<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "addVolunteer",
						// input name
						"controlname": "startdate"
						});
						</script>
            </div>
        	<div class="group">
            <label class="label">Password</label>
            <input type="password" id="password1" name="password1" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Re-Type Password</label>
            <input type="password" id="password2" name="password2" value="" class="text_field" />
            </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="addvolunteer">
                    <img src="include/images/icons/adduser.png" alt="AddVolunteer" /> Add Volunteer
                  </button>
                  <button class="button" type="submit" name="submit" id="submit" value="startover">
                    <img src="include/images/icons/cross.png" alt="StartOver" /> Start Over!
                  </button>
                  </div>
                </div>
              </form>
        </div>

<?php
	}
	if($_POST['submit']=='addvolunteer')
	{
	$err= array();
	//We need to check some stuff first :)
	//if(!($_POST['password1']==$_POST['password2']))
	//{
	//$err[] = 'The Passwords do not match!';
	//}
	//if(!count($err))
	//{
	echo 'no errors';
	$addUser="INSERT INTO Users (fn, ln, email, VolAddress, VolCity, VolState, VolZip, HomePhone, WorkPhone, CellPhone, VolunteerGender, VolunteerRace, VolunteerDOB, VolunteerStartDate, AccessLevel, UserStatus, pass )
	VALUES('$_POST[fn]','$_POST[ln]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zip]','$_POST[homephone]','$_POST[workphone]','$_POST[cellphone]','$_POST[gender]','$_POST[ethnicity]','$_POST[dob]','$_POST[startdate]','2','2','".md5($_POST['password1'])."')";
	mysql_query($addUser);
	//}
	if($err)
	$_SESSION['msg']['add-err'] = implode('<br />',$err);
	// Save the error messages in the session
	exit;
	
	
	
	}

	}
	
				if(isset($_GET['deletedoc']))
				{
				$DocID=$_GET['deletedoc'];
				echo 'del';
				$sql = "DELETE FROM Documents WHERE id_files=$DocID";
				mysql_query($sql);
				//header('location: admin.php?page=adminhome&option=managevolunteerdocuments');
				}
	
	
	
	
	
	//////////////////////
	//Manage Volunteer Documents Page!
	//////////////////////




	if($_GET['option']=='managevolunteerdocuments')
	{
	//echo 'Feature Comming Soon :)';
	
	//GET VOLUNTEERS DOCUMTENS FROM THE DATABASE
	$query="SELECT id_files, description, path FROM Documents WHERE VOL_ID='".$_GET['edit']."'";
	$result=mysql_query($query);
	$num = mysql_numrows($result);
	
	?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
             <li class="first" class="active"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <li class="active"><a href="">Manage Volunteer's Documents</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Volunteer's Documents</h2>
            <div class="inner">
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
 				<?php
				/////////////
				//SUCCESS MESSAGE
           		if($status=="NOTOK")
           		{				
           		?>
				<div class="flash">
                <div class="message warning">
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
              <form action="#" class="form">
                <table class="table">
				<th scope='col'>Document ID:</th>
				<th>Description:</th>
				<th>Delete?:</th>
				<?php
				$i=0;
				while ($i < $num) {

				$ID =mysql_result($result,$i,"id_files");
				$Description =mysql_result($result,$i,"description");
				$path =mysql_result($result,$i,"path");

				echo "
				<tr>
				<td>$ID</td>
				<td><a href=$path>$Description</a></td>
				<td><a href=admin.php?page=adminhome&option=managevolunteerdocuments&edit=".$_GET['edit']."&deletedoc=$ID><img src='images/icons/cross.png'></a></td>
				</tr>";
				$i++;

				//END GET VOLUNTEER DOCUMENTS FROM DB
				}

				?>

                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        

        
	<?php
	//UPLOAD NEW DOCUMENT CODE
	?>
	
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="">Upload New Document</a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Upload a new document...</h2>
            <div class="inner">
            <p>Uploading a document here will connect it to the Volunteer's Account in the system.</p>
              <form enctype="multipart/form-data" action="" method="post" class="form">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Document Description</label>
                      <input type="text" class="text_field" name="description" />
                    </div>
                    <div class="group">
					<center><img src="images/icons/document.jpeg"></center>
                    </div>
                  </div>
                  <div class="column right">
                     <div class="group">
                      <label class="label">Please choose a file:</label>
                        <input name="uploaded" type="file" />

                    </div>

                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" id="Upload" name="Upload">
                    <img src="images/icons/tick.png" alt="Save" /> Upload Document
                  </button>

              </form>
            </div>
          </div>
        </div>


	<?php
	if($_POST['submit']=='Upload');
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
 $target = "uploads/Documents/";
 //This combines the directory, the random file name, and the extension
 $target = $target . $ran2.$ext;
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
 {
 echo
 "The file has been uploaded as ".$ran2.$ext;
 echo $target;
 $sql="INSERT INTO Documents (description,VOL_ID,path) VALUES ('".$_POST['description']."','".$_GET['edit']."','".$target."')";
 mysql_query($sql);
 } else {
// echo "Sorry, there was a problem uploading your file.";
 }
 }

	
	}
	
	
	//////////////////////
	//Edit Volunteer Page!
	//////////////////////
	if($_GET['option']=='editvolunteer')
	{
	//echo 'edit';
	

		$VOLID=$_GET['edit'];
		//echo $VOLID;
		$voldetails = mysql_query('SELECT * FROM Users, AccessGroups, StatusLevels WHERE id="'.$VOLID.'" AND AccessID=AccessLevel AND StatusLevelCode=UserStatus');
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
    	//$VolunteerWebSite = $details['WebSite'];
	    $VolunteerFirstName = $details['fn'];
	    $VolunteerLastName = $details['ln'];
	    $VolunteerEmail = $details['email'];
	    $VolunteerNotes = $details['Notes'];
	    $VolunteerGender = $details['VolunteerGender'];
	    $VolunteerRace = $details['VolunteerRace'];
	    $VolunteerDOB = $details['VolunteerDOB'];
	    $VolunteerStartDate = $details['VolunteerStartDate'];
	    $VolunteerEndDate = $details['VolunteerEndDate'];
	    $AccessLevel = $details['AccessID'];
	    $UserStatus = $details['UserStatus'];
	    $UserStatusName = $details['StatusLevel'];
	    $VolunteerID = $details['id'];
	    $AccessName = $details['AccessName'];

		//GET AccessGroups
		$AccessGroupssql = "SELECT AccessID, AccessName FROM AccessGroups WHERE AccessID<>".$AccessLevel." ORDER BY AccessName LIMIT 0, 30 ";
		$bob='shawn';
		$AccessGroupsrs = mysql_query($AccessGroupssql);
		
		//GET SatusLevels
		$StatusLevelssql = "SELECT StatusLevelCode, StatusLevel FROM StatusLevels WHERE StatusLevelCode<>".$UserStatus." ORDER BY StatusLevel";
		$bob='shawn';
		$StatusLevelsrs = mysql_query($StatusLevelssql);

}
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
             <li class="first" class="active"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <li class="active"><a href="">Edit Volunteer</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Editing Volunteer Information:</h2>
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
				
				if($_POST['submit']=='updateinfo')
				{
			 	if(!count($err))
        		{
        		$sql="UPDATE Users SET VolunteerGender='".$_POST['VolunteerGender']."', VolunteerRace='".$_POST['VolunteerRace']."',  VolunteerDOB='".$_POST['VolunteerDOB']."',  VolunteerStartDate='".$_POST['VolunteerStartDate']."',  VolunteerEndDate='".$_POST['VolunteerEndDate']."',  AccessLevel='".$_POST['AccessLevel']."',  UserStatus='".$_POST['UserStatus']."', email='".$_POST['email']."', Notes='".$_POST['notes']."', VolAddress='".$_POST['address']."', VolCity='".$_POST['city']."', VolState='".$_POST['state']."', VolZip='".$_POST['zip']."', HomePhone='".$_POST['homephone']."', WorkPhone='".$_POST['workphone']."', cellphone='".$_POST['cellphone']."' WHERE id='".$VOLID."' ";
        		mysql_query($sql);
		$voldetails = mysql_query('SELECT * FROM Users, AccessGroups, StatusLevels WHERE id="'.$VOLID.'" AND AccessID=AccessLevel AND StatusLevelCode=UserStatus');
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
    	//$VolunteerWebSite = $details['WebSite'];
	    $VolunteerFirstName = $details['fn'];
	    $VolunteerLastName = $details['ln'];
	    $VolunteerEmail = $details['email'];
	    $VolunteerNotes = $details['Notes'];
	    $VolunteerGender = $details['VolunteerGender'];
	    $VolunteerRace = $details['VolunteerRace'];
	    $VolunteerDOB = $details['VolunteerDOB'];
	    $VolunteerStartDate = $details['VolunteerStartDate'];
	    $VolunteerEndDate = $details['VolunteerEndDate'];
	    $AccessLevel = $details['AccessID'];
	    $UserStatus = $details['UserStatus'];
	    $UserStatusName = $details['StatusLevel'];
	    $VolunteerID = $details['id'];
	    $AccessName = $details['AccessName'];

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
          
              <form action="" method="post" class="form" name="VolunterInformation">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Volunteer ID</label>
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $VolunteerID; ?>" class="text_field" READONLY/>
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
                      <label class="label">Gender</label>
                      <select id="VolunteerGender" name="VolunteerGender">
                      
                      <?php
                      	echo "<option value=\"".$VolunteerGender."\">".$VolunteerGender."\n </option>";
                    
                      ?>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="group">
                      <label class="label">Ethnicity</label>
                      <select id="VolunteerRace" name="VolunteerRace" >
                      
                      <?php
                      	echo "<option value=\"".$VolunteerRace."\">".$VolunteerRace."\n </option>";
                    
                      ?>
                      <option value="Hispanic">Hispanic</option>
                      <option value="White">White</option>
                      <option value="White">Hispanic/White</option>
                      <option value="Black">Black</option>
                      <option value="Pasific Islander">Asian</option>
                      <option value="Native American">Native American</option>
                      <option value="NA">Unknown</option>
                      </select>
                    </div>
                    <div class="group">
                      <label class="label">Date of Birth</label>
                      <input type="text" id="VolunteerDOB" name="VolunteerDOB" value="<?php echo $VolunteerDOB; ?>" class="text_field" />
                      	<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "VolunterInformation",
						// input name
						"controlname": "VolunteerDOB"
						});
						</script>
                    </div>
                    <div class="group">
                      <label class="label">Start Date</label>
                      <input type="text" id="VolunteerStartDate" name="VolunteerStartDate" value="<?php echo $VolunteerStartDate; ?>" class="text_field" />
                        <script language="JavaScript">
						new tcal ({
						// form name
						"formname": "VolunterInformation",
						// input name
						"controlname": "VolunteerStartDate"
						});
						</script>
                    </div>
                    <div class="group">
                      <label class="label">End Date</label>
                      <input type="text" id="VolunteerEndDate" name="VolunteerEndDate" value="<?php echo $VolunteerEndDate; ?>" class="text_field" />
                        <script language="JavaScript">
						new tcal ({
						// form name
						"formname": "VolunterInformation",
						// input name
						"controlname": "VolunteerEndDate"
						});
						</script>
                    </div>
                    <div class="group">
                      <label class="label">Notes</label>
                      <textarea class="text_area" id="notes" name="notes" rows="10" cols="80"><?php echo $VolunteerNotes;?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Email Address</label>
                      <input type="text" id="email" name="email" value="<?php echo $VolunteerEmail; ?>" class="text_field" />
                    </div>
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
                    <div class="group">
                      <label class="label">Status</label>
                      <select id="UserStatus" name="UserStatus" value="3">
                      
                      <?php
                      	echo "<option value=\"".$UserStatus."\">".$UserStatusName."\n </option>";
  					  while($StatusLevelsrow = mysql_fetch_array($StatusLevelsrs))
						{
 						echo "<option value=\"".$StatusLevelsrow['StatusLevelCode']."\">".$StatusLevelsrow['StatusLevel']."\n </option>";
						}                      
                      ?>
                      
                      </select>
                    </div>
                    <?php
                    if($_SESSION['AccessLevel']=='9')
                    {
                    ?>
                    <div class="group">
                      <label class="label">Access Level</label>
                      <select id="AccessLevel" name="AccessLevel" value="3">
                      
                      <?php
                      	echo "<option value=\"".$AccessLevel."\">".$AccessName."\n </option>";
  					  while($AccessGroupsrow = mysql_fetch_array($AccessGroupsrs))
						{
 						echo "<option value=\"".$AccessGroupsrow['AccessID']."\">".$AccessGroupsrow['AccessName']."\n </option>";
						}                      
                      ?>
                      
                      </select>
                    </div>
                    <?php
                    }
                    ?>
                    
           
          
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
	//////////////////////
	//Change Volunteer Password Page!
	//////////////////////
	if($_GET['option']=='changevolunteerpassword')
	{
		//Get the VolunteerID
		$VOLID=$_GET['edit'];
		//$status="OK";
		if($_POST['submit']=='changepassword')
		{
		$todo=$_POST['submit'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		if(isset($todo) and $todo=="changepassword"){
		$password=mysql_real_escape_string($password);
		$status = "OK";
		$msg="";
		if ( strlen($password) < 3 or strlen($password) > 50 ){
		$msg=$msg."The password was not longer than 3 characters!<BR>";
		$status= "NOTOK";}
		if ( $password <> $password2 ){
		$msg=$msg."Both passwords are not matching!<BR>";
		$status= "NOTOK";}
   		}
   		if($status=="OK")
   		{
   		$msg="The password has been changed!";
   		mysql_query("update Users set pass='".md5($_POST['password'])."' where id='$_POST[VolunteerID]'");
		}	
   		}
?>

    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <li class="active"><a href="">Change Password</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Change Volunteer's Password...</h2>
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
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $VOLID; ?>" class="text_field" READONLY/>
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

	
	//////////////////////
	//Manage Volunteer Locations!
	//////////////////////
	if($_GET['option']=='managevolunteerlocations')
	{
	$VOLID=$_GET['edit'];
	//echo $VOLID;
	
	if(isset($_GET['deletelocation']))
		{
		mysql_query("DELETE FROM LocationAssignments WHERE LocID='$_GET[deletelocation]'");
		//echo 'shawn';
		}


		if($_GET['option']=='managevolunteerlocations')
		{
		
		$query="SELECT LocID, Name FROM VolunteerLocations WHERE VIP_ID='".$VOLID."'";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;
		
		if($_POST['submit']=='addlocation')
		{
		$VOLID=$_GET['edit'];
		$sql="INSERT INTO LocationAssignments (VIP_ID, Location)
		VALUES
		('$_POST[VolunteerID]','$_POST[Location]')";
		mysql_query($sql);
		$query="SELECT LocID, Name FROM VolunteerLocations WHERE VIP_ID='".$VOLID."'";
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
             <li class="first"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <li class="active"><a href="">Volunteer Locations</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Volunteer Location Assignments</h2>
            <div class="inner">

              <form action="#" class="form">
                <table class="table">
                  <tr>
                    
                    <th>Location Assignment ID</th>
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
				
				<td><a href=admin.php?page=adminhome&option=managevolunteerlocations&edit=$VOLID&deletelocation=$LocID><img src='include/images/icons/cross.png'></a></td>
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
                  <input type="text" name="VolunteerID" id="VolunteerID" value="<?php echo $VOLID; ?>" class="text_field" READONLY/>

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
	//////////////////////
	//Report Volunteer Hours Page!
	//////////////////////
	if($_GET['option']=='reportvolunteerhours')
	{
	$VOLID=$_GET['edit'];
		//GET LOCATIONS
			$sql = "SELECT Location, Name FROM VolunteerLocations WHERE VIP_ID='".$VOLID."' ".
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
             <li class="first" class="active"><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <li class="active"><a href="?page=volunteeroptions&option=userinformation">Report Hours</a></li>

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
                      <input type="text" id="VolunteerID" name="VolunteerID" value="<?php echo $VOLID; ?>" class="text_field" READONLY/>
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

	
		//Start Locations Page!
		if($_GET['option']=='locations')
		{
	if($_POST['submit']=='searchlocation')
		{

		$searched=$_POST['searchlocation'];
		
		// Get Locations
		$getLocations="SELECT LocationID, name FROM Locations WHERE name LIKE '%$searched%' ORDER BY name LIMIT 10";
		$resultLocations=mysql_query($getLocations);
		$numLocations = mysql_numrows($resultLocations);
		

		
		}
	else
		{




		// Get Locations
		$getLocations="SELECT LocationID, name FROM Locations ORDER BY name";
		$resultLocations=mysql_query($getLocations);
		$numLocations = mysql_numrows($resultLocations);		



		}
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <li class="active"><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>
              <?php
              if($_SESSION['blogmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Locations</h2>
            <div class="inner">
            <?php
            if($_GET['deletelocation']=='ask')
			{
			?>
          <div class="flash">
          <div class="message warning">
          <?php
          $ID=$_GET['locationID'];
          $deletemsg="<p>Are sure you would like to delete this location? <a href='admin.php?page=adminhome&option=locations&deletelocation=yes&locationID=$ID'>[ YES ]</a> / <a href='admin.php?page=adminhome&option=locations&deletelocation'>[ NO ]</a></p>";
          echo $deletemsg;
          ?>
          </div>
          </div>
			<?php
			}
            
            ?>
            
              <form action="" class="form">
                <table class="table" id="Locations">
                  <tr>              
                    <th>ID</th>
                    <th>Location Name</th>

                    <th class="last">&nbsp;</th>
				<?php
				$i=0;
				while ($i < $numLocations) {

				$ID =mysql_result($resultLocations,$i,"LocationID");
				$Name =mysql_result($resultLocations,$i,"name");
				echo "
				<tr>
				<td>$ID</td>
				<td>$Name</td>
				<td></td><td></td><td></td>
				
				<td><a href=admin.php?page=adminhome&option=locations&deletelocation=ask&locationID=$ID><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=editlocation&edit=$ID><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'></a></td>
				</tr>";
				$i++;


				}
				?>
                </table>
                
                <div class="actions-bar wat-cf">
                  <div class="actions">
                  <div id="pageNavPosition"></div>

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('Locations', 20); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
		<div id="sidebar">
        <div class="block notice">
          <h4>Filter Results</h4>
          
          <form action="" method="post" class="form" name="searchlocation">
        	<div class="group">
            <label class="label">Search for Location by Name:</label>
            <input type="text" id="searchlocation" name="searchlocation" value="<?php echo $_POST['searchlocation']; ?>" class="text_field" />
            </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="searchlocation">
                    <img src="images/icons/tick.png" alt="Search" /> Search
                  </button>
                  <button class="button" type="submit" name="submit" id="submit" value="clearbylast">
                    <img src="images/icons/cross.png" alt="Clear Search" /> Clear Search
                  </button>
                </div>
              </form>
			</div>
		 <div class="block notice">
          <h4>Legend</h4>
          <p><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'> Delete Location</p>
          <p><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'> Edit Location Information</p>
        </div>
        <div class="block notice">
          <h4>Add New Location</h4>
        <?php
	if($_POST['submit']=='addlocation')
        {
        
        ?>
          <div class="flash">
            <div class="message notice">
              <?php
				echo 'The location was successfully added to the database';
				?>
            </div>
          </div>
        <?php
        }
        ?>
          
          <form action="" method="post" class="form" name="addnewlocation">
        	<div class="group">
            <label class="label">Location Name</label>
            <input type="text" id="name" name="name" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Address</label>
            <input type="text" id="address" name="address" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">City</label>
            <input type="text" id="city" name="city" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">State</label>
            <input type="text" id="state" name="state" value="" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Zip</label>
            <input type="text" id="zip" name="zip" value="" class="text_field" />
            </div>
            <div class="group">
            <label class="label">Notes</label>
            <textarea class="text_area" id="notes" Name="notes" rows="10" cols="80"></textarea>
            </div>
            <div class="group navform wat-cf">
            <button class="button" type="submit" name="submit" id="submit" value="addlocation">
            <img src="include/images/icons/tick.png" alt="AddLocation" /> Add Location
            </button>
            <button class="button" type="submit" name="submit" id="submit" value="startover">
            <img src="include/images/icons/cross.png" alt="StartOver" /> Start Over!
            </button>
            </div>
            </div>
            </form>
        </div>

<?php
	if($_POST['submit']=='addlocation')
	{
	$err= array();
	//echo 'Add Location';
		//We need to check some stuff first :)

	$addLocation="INSERT INTO Locations (Name, Address, City, State, Zip, Notes)
		VALUES('$_POST[name]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zip]','$_POST[notes]')";
	if (!mysql_query($addLocation))
  	{
 	 die('Error: ' . mysql_error());
 	}
	}
	
	//Edit Location

	
	
	}
	if($_GET['deletelocation']=='yes')
	{
	header('location: admin.php?page=adminhome&option=locations');
	echo 'Delete';
	$ID=$_GET['locationID'];
	$deleteLoc="DELETE FROM Locations WHERE LocationID=$ID";
	mysql_query($deleteLoc);
	header('location: admin.php?page=adminhome&option=locations');
	}
	if($_GET['option']=='editlocation')
	{

	$locdetails = mysql_query('SELECT * FROM Locations WHERE LocationID="'.$_GET['edit'].'"');
	if (!$locdetails) {
	die('Invalid query: ' . mysql_error());
	}
		while ($details = mysql_fetch_assoc($locdetails)) {
   		$Name = $details['Name'];
    	$Address = $details['Address'];
	    $City = $details['City'];
    	$State = $details['State'];
	    $Zip = $details['Zip'];
    	$Notes = $details['Notes'];
    	
    }
	if($_POST['submit']=='updatelocation')
	{
	$LocationID=$_GET['edit'];
	//echo $LocationID;
	$updateLoc="UPDATE Locations SET Name='".$_POST['name']."', Address='".$_POST['address']."', City='".$_POST['city']."', State='".$_POST['state']."', Zip='".$_POST['zip']."', Notes='".$_POST['notes']."' WHERE LocationID=$LocationID";
	//$updateLoc="UPDATE Locations SET Name='".$_POST['name']."'";
	if (!mysql_query($updateLoc))
  	{
  	die('Error: ' . mysql_error());
  	}
	$locdetails = mysql_query('SELECT * FROM Locations WHERE LocationID="'.$_GET['edit'].'"');
	if (!$locdetails) {
	die('Invalid query: ' . mysql_error());
	}
		while ($details = mysql_fetch_assoc($locdetails)) {
   		$Name = $details['Name'];
    	$Address = $details['Address'];
	    $City = $details['City'];
    	$State = $details['State'];
	    $Zip = $details['Zip'];
    	$Notes = $details['Notes'];
    	
    }		



    	
    
	}
	if($_POST['submit']=='cancel')
	{
	header('location: admin.php?page=adminhome&option=locations');
	}



    
	//echo 'edit';
	
	?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li class="active"><a href="">Edit Location</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">You are editing :</h2>
            <div class="inner">
              <form action="" method="post" class="form">
                <div class="columns wat-cf">
                  <div class="column left">
        	<div class="group">
            <label class="label">Location Name</label>
            <input type="text" id="name" name="name" value="<?php echo $Name; ?>" class="text_field" />
            </div>
            <div class="group">
            <label class="label">Notes</label>
            <textarea class="text_area" id="notes" Name="notes" rows="10" cols="80"><?php echo $Notes;?></textarea>
            </div>
            </div>
            <div class="column right">
        	<div class="group">
            <label class="label">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $Address; ?>" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">City</label>
            <input type="text" id="city" name="city" value="<?php echo $City; ?>" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">State</label>
            <input type="text" id="state" name="state" value="<?php echo $State; ?>" class="text_field" />
            </div>
        	<div class="group">
            <label class="label">Zip</label>
            <input type="text" id="zip" name="zip" value="<?php echo $Zip; ?>" class="text_field" />
            </div>
            </div>
            </div>

            <div class="group navform wat-cf">
            <button class="button" type="submit" name="submit" id="submit" value="updatelocation">
            <img src="include/images/icons/tick.png" alt="UpdateLocation" /> Update Location
            </button>
            <button class="button" type="submit" name="submit" id="submit" value="cancel">
            <img src="include/images/icons/cross.png" alt="StartOver" /> Cancel
            </button>
        	</div>
            </form>
            </div>
          	</div>
        	</div>
		<?php
	
	}
	////////////
	//Edit News Blocks
	if($_GET['option']=='editnewsblocks')
	{
	
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
		
		
		//INSERT HOURS INTO mySQL
		if($_POST['submit']=='updatenews')
		{

		$updateBlock1="UPDATE SiteVars SET SiteVar='$_POST[news1]' WHERE SiteVarCode='NewsBlock1'";
		if (!mysql_query($updateBlock1))
 		{
 		die('Error: ' . mysql_error());
 		}
		$updateBlock2="UPDATE SiteVars SET SiteVar='$_POST[news2]' WHERE SiteVarCode='NewsBlock2'";
		if (!mysql_query($updateBlock2))
 		{
 		die('Error: ' . mysql_error());
 		}
		$updateBlock3="UPDATE SiteVars SET SiteVar='$_POST[news3]' WHERE SiteVarCode='NewsBlock3'";
		if (!mysql_query($updateBlock3))
 		{
 		die('Error: ' . mysql_error());
 		}
 		
 		
 		
 		
 		header('location: admin.php?page=adminhome&option=editnewsblocks');

		
		}
		?>
		<script type="text/javascript" src="include/tiny_mce/tiny_mce.js" ></script>
		<script type="text/javascript" >
		tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
		});
		</script>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>
              <?php
              if($_SESSION['blogmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Edit News Blocks!</h2>
            <div class="inner">
              <form action="" method="post" class="form" name="editnewsblock">
                <div class="group">
                <label class="label">News Block #1</label>
                <textarea class="text_area" id="news1" Name="news1" rows="20" cols="80"><?php echo $Block1SiteVar;?></textarea>
                </div>
                <div class="group">
                <label class="label">News Block #2</label>
                <textarea class="text_area" id="news2" Name="news2" rows="20" cols="80"><?php echo $Block2SiteVar;?></textarea>
                </div>
                <div class="group">
                <label class="label">News Block #3</label>
                <textarea class="text_area" id="news3" Name="news3" rows="20" cols="80"><?php echo $Block3SiteVar;?></textarea>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="updatenews">
                    <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
<?php
	}
	////////////
	//THE BLOG
	if($_GET['option']=='blogposts')
	{
	if($_GET['deletepost']=='yes')
	{
	header('location: admin.php?page=adminhome&option=blogposts');
	echo 'Delete';
	$ID=$_GET['postID'];
	$deleteLoc="DELETE FROM Blog WHERE postID=$ID";
	mysql_query($deleteLoc);
	header('location: admin.php?page=adminhome&option=blogposts');
	}
	if($_POST['submit']=='addpost')
	{
	$err= array();
	//echo 'Add Location';
		//We need to check some stuff first :)

	$addPost="INSERT INTO Blog (postTitle, postBody)
		VALUES('$_POST[title]','$_POST[body]')";
	if (!mysql_query($addPost))
  	{
 	 die('Error: ' . mysql_error());
 	}
	}




		// Get Blog Posts
		$getPosts="SELECT postID, postTitle FROM Blog ORDER BY postDate DESC";
		$resultPosts=mysql_query($getPosts);
		$numPosts = mysql_numrows($resultPosts);
	
	?>
	
	
		<script type="text/javascript" src="include/tiny_mce/tiny_mce.js" ></script>
		<script type="text/javascript" >
		tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
		});
		</script>	
	
	
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>
              <li  class="active"><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <li><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Blog Posts</h2>
            <div class="inner">
            <?php
            if($_GET['deletepost']=='ask')
			{
			?>
          <div class="flash">
          <div class="message warning">
          <?php
          $ID=$_GET['postID'];
          $deletemsg="<p>Are sure you would like to delete this post? <a href='admin.php?page=adminhome&option=blogposts&deletepost=yes&postID=$ID'>[ YES ]</a> / <a href='admin.php?page=adminhome&option=blogposts'>[ NO ]</a></p>";
          echo $deletemsg;
          ?>
          </div>
          </div>
			<?php
			}
            
            ?>
            
              <form action="" class="form">
                <table class="table" id="BlogPosts">
                  <tr>              
                    <th>Post ID</th>
                    <th>Post Title</th>

                    <th class="last">&nbsp;</th>
				<?php
				$i=0;
				while ($i < $numPosts) {

				$ID =mysql_result($resultPosts,$i,"postID");
				$Name =mysql_result($resultPosts,$i,"postTitle");
				echo "
				<tr>
				<td>$ID</td>
				<td>$Name</td>
				<td></td><td></td><td></td>
				
				<td><a href=admin.php?page=adminhome&option=blogposts&deletepost=ask&postID=$ID><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'></a></td>
				<td><a href=admin.php?page=adminhome&option=editpost&edit=$ID><img src='include/images/icons/edit.png' width='16' heigth='16' border='0'></a></td>
				</tr>";
				$i++;


				}
				?>
                </table>
                
                <div class="actions-bar wat-cf">
                  <div class="actions">
                  <div id="pageNavPosition"></div>

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('BlogPosts', 5); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>
		</div>
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">

              <li class="active first"><a href="admin.php?page=adminhome&option=blogposts">New Post</a></li>

            </ul>
          </div>

          <div class="content">
            <h2 class="title">Add A New Post...</h2>
            <div class="inner">
              <form action="" method="post" class="form" name="editnewsblock">
        	<div class="group">
            <label class="label">Post Title</label>
            <input type="text" id="title" name="title" value="<?php echo $City; ?>" class="text_field" />
            </div>
                <div class="group">
                
                <textarea class="text_area" id="body" Name="body" rows="20" cols="80"><?php echo $Block1SiteVar;?></textarea>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="addpost">
                    <img src="images/icons/tick.png" alt="Save" /> Save Post
                  </button>
                </div>
        </div>
<?php
	}
		if($_POST['submit']=='updatecompanyname')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[companyname]' WHERE SiteVarCode='CompanyName'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'CompanyName'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['Company'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='UpdateApplicationTitle')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[ApplicationTitle]' WHERE SiteVarCode='ApplicationTitle'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'ApplicationTitle'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['AppTitle'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updatehomewelcome')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[HomeWelcome]' WHERE SiteVarCode='HomeWelcome'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'HomeWelcome'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['HomeWelcome'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updatereportswelcome')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[ReportsWelcome]' WHERE SiteVarCode='ReportsWelcome'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'ReportsWelcome'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['ReportsWelcome'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updateadminwelcome')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[AdminWelcome]' WHERE SiteVarCode='AdminWelcome'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'AdminWelcome'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['AdminWelcome'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updateassistance')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[Assistance]' WHERE SiteVarCode='Assistance'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'Assistance'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['Assistance'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updateblogmod')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[BlogMod]' WHERE SiteVarCode='BlogMod'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'BlogMod'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['blogmod'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updatewallmod')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[WallMod]' WHERE SiteVarCode='WallMod'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'WallMod'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['wallmod'] = $row['SiteVar'];			
		}
		if($_POST['submit']=='updatetaskmod')
		{
		$sql="UPDATE SiteVars SET SiteVar='$_POST[TaskMod]' WHERE SiteVarCode='TaskMod'";
		mysql_query($sql);
		//Get Company Name From DB
		$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'TaskMod'";
		$row = mysql_fetch_assoc(mysql_query($sql));
		$_SESSION['taskmod'] = $row['SiteVar'];			
		}

		
		
		if($_GET['option']=='otheroptions')
		{
		?>
		<script type="text/javascript" src="include/tiny_mce/tiny_mce.js" ></script>
		<script type="text/javascript" >
		tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true
		});
		</script>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
              <li><a href="admin.php?page=adminhome&option=volunteers">Volunteers</a></li>
              <?php
              if($_SESSION['taskmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=taskadministration">Tasks</a></li>
              <?php
              }
              ?>
              <li><a href="admin.php?page=adminhome&option=locations">Locations</a></li>
              <li><a href="admin.php?page=adminhome&option=editnewsblocks">Edit News Blocks</a></li>
              <?php
              if($_SESSION['blogmod']=='Active')
              {
              ?>
              <li><a href="admin.php?page=adminhome&option=blogposts">Blog Posts</a></li>
              <?php
              }
              ?>
              <li class="active"><a href="admin.php?page=adminhome&option=otheroptions">Other Options</a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Edit other site variables...</h2>
            <div class="inner">
              <form action="" method="post" class="form" name="updatecompanyname">
        		<div class="group">
           		<label class="label">Company Name</label>
            	<input type="text" id="companyname" name="companyname" value="<?php echo $_SESSION['Company']; ?>" class="text_field" />
            	</div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updatecompanyname">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
              <form action="" method="post" class="form" name="updateapptitle">
        		<div class="group">
            	<label class="label">Application Title</label>
            	<input type="text" id="ApplicationTitle" name="ApplicationTitle" value="<?php echo $_SESSION['AppTitle']; ?>" class="text_field" />
            	</div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="UpdateApplicationTitle">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updatehomewelcome">
                <div class="group">
                <label class="label">Home Welcome</label>
                <textarea class="text_area" id="HomeWelcome" Name="HomeWelcome" rows="5" cols="80"><?php echo $_SESSION['HomeWelcome']; ?></textarea>
                </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updatehomewelcome">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updatereportswelcome">
                <div class="group">
                <label class="label">Reports Welcome</label>
                <textarea class="text_area" id="ReportsWelcome" Name="ReportsWelcome" rows="5" cols="80"><?php echo $_SESSION['ReportsWelcome']; ?></textarea>
                </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updatereportswelcome">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updateadminwelcome">
                <div class="group">
                <label class="label">Administration Welcome</label>
                <textarea class="text_area" id="AdminWelcome" Name="AdminWelcome" rows="5" cols="80"><?php echo $_SESSION['AdminWelcome']; ?></textarea>
                </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updateadminwelcome">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updateassistance">
                <div class="group">
                <label class="label">Assistance Information</label>
                <textarea class="text_area" id="Assistance" Name="Assistance" rows="5" cols="80"><?php echo $_SESSION['Assistance']; ?></textarea>
                </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updateassistance">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updateblogmod">
                    <div class="group">
                      <label class="label">Blog Module</label>
                      <select id="BlogMod" name="BlogMod">
                      <option value="<?php echo $_SESSION['blogmod']; ?>"><?php echo $_SESSION['blogmod']; ?></option>
                      <?php
                      if($_SESSION['blogmod']=='Active')
                      {
                      echo'<option value="Inactive">Inactive</option>';
                      }
                      ?>
                      <?php
                      if($_SESSION['blogmod']=='Inactive')
                      {
                      echo'<option value="Active">Active</option>';
                      }
                      ?>       
                      </select>
                    </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updateblogmod">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updatewallmod">
                    <div class="group">
                      <label class="label">Wall Module</label>
                      <select id="WallMod" name="WallMod">
                      <option value="<?php echo $_SESSION['wallmod']; ?>"><?php echo $_SESSION['wallmod']; ?></option>
                      <?php
                      if($_SESSION['wallmod']=='Active')
                      {
                      echo'<option value="Inactive">Inactive</option>';
                      }
                      ?>
                      <?php
                      if($_SESSION['wallmod']=='Inactive')
                      {
                      echo'<option value="Active">Active</option>';
                      }
                      ?>       
                      </select>
                    </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updatewallmod">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
                </button>
                </div>
              </form>
                <form action="" method="post" class="form" name="updatewallmod">
                    <div class="group">
                      <label class="label">Task Module</label>
                      <select id="TaskMod" name="TaskMod">
                      <option value="<?php echo $_SESSION['wallmod']; ?>"><?php echo $_SESSION['taskmod']; ?></option>
                      <?php
                      if($_SESSION['taskmod']=='Active')
                      {
                      echo'<option value="Inactive">Inactive</option>';
                      }
                      ?>
                      <?php
                      if($_SESSION['taskmod']=='Inactive')
                      {
                      echo'<option value="Active">Active</option>';
                      }
                      ?>       
                      </select>
                    </div>
                <div class="group navform wat-cf">
                <button class="button" type="submit" name="submit" id="submit" value="updatetaskmod">
                <img src="images/icons/tick.png" alt="Save" /> Save Your Changes
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
		if($_GET['option']=='taskadministration')
		{
		
		//GET Open Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Open' AND TaskCreatedBy='".$_SESSION['id']."' ORDER BY TaskDueDate";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;
		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>



              
              

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Open Tasks You Have Created...</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table" id="tasks" name="tasks">
                  <tr>
                    
                    <th>Task ID</th>
                    <th>Location</th>
                    <th>Due Date</th>
                    <th>Assigned By</th>
                    <th></th><th></th><th></th>
                    <th align='center'>Edit Task</th>

                    <th class="last">&nbsp;</th>
                  </tr>
				<?php
				$i=0;
				while ($i < $num) {

				$TaskID =mysql_result($result,$i,"TaskID");
				$TaskLocation =mysql_result($result,$i,"Name");
				$TaskDueDate =mysql_result($result,$i,"TaskDueDate");
				$fn =mysql_result($result,$i,"fn");
				$ln =mysql_result($result,$i,"ln");
				$TaskLocation =mysql_result($result,$i,"Name");
				echo "
				<tr>
				<td>$TaskID</td>
				<td>$TaskLocation</td>
				<td>$TaskDueDate</td>
				<td>$ln, $fn</td>
				<td></td><td></td><td></td>
				
				<td align='center'><a href=?page=adminhome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
				</tr>";
				$i++;


				}



				?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('tasks', 1); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
          </div>
        <?php
		}
	
	if($_GET['option']=='taskadministrationclosed')
	{

		//GET Closed Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Closed' AND TaskCreatedBy='".$_SESSION['id']."' ORDER BY TaskDueDate";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Closed Tasks You Have Created...</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table" id="tasks" name="Tasks">
                  <tr>
                    
                    <th>Task ID</th>
                    <th>Location</th>
                    <th>Due Date</th>
                    <th>Assigned By</th>
                    <th></th><th></th><th></th>
                    <th align='center'>Edit Task</th>

                    <th class="last">&nbsp;</th>
                  </tr>
				<?php
				$i=0;
				while ($i < $num) {

				$TaskID =mysql_result($result,$i,"TaskID");
				$TaskLocation =mysql_result($result,$i,"Name");
				$TaskDueDate =mysql_result($result,$i,"TaskDueDate");
				$fn =mysql_result($result,$i,"fn");
				$ln =mysql_result($result,$i,"ln");
				$TaskLocation =mysql_result($result,$i,"Name");
				echo "
				<tr>
				<td>$TaskID</td>
				<td>$TaskLocation</td>
				<td>$TaskDueDate</td>
				<td>$ln, $fn</td>
				<td></td><td></td><td></td>
				
				<td align='center'><a href=?page=adminhome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
				</tr>";
				$i++;


				}



				?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('Tasks', 1); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
          </div>
<?php


	}
	if($_GET['option']=='taskadministrationallopen')
	{

		//GET Closed Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Open' ORDER BY TaskDueDate";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Closed Tasks You Have Created...</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table" id="tasks" name="Tasks">
                  <tr>
                    
                    <th>Task ID</th>
                    <th>Location</th>
                    <th>Due Date</th>
                    <th>Assigned By</th>
                    <th></th><th></th><th></th>
                    <th align='center'>Edit Task</th>

                    <th class="last">&nbsp;</th>
                  </tr>
				<?php
				$i=0;
				while ($i < $num) {

				$TaskID =mysql_result($result,$i,"TaskID");
				$TaskLocation =mysql_result($result,$i,"Name");
				$TaskDueDate =mysql_result($result,$i,"TaskDueDate");
				$fn =mysql_result($result,$i,"fn");
				$ln =mysql_result($result,$i,"ln");
				$TaskLocation =mysql_result($result,$i,"Name");
				echo "
				<tr>
				<td>$TaskID</td>
				<td>$TaskLocation</td>
				<td>$TaskDueDate</td>
				<td>$ln, $fn</td>
				<td></td><td></td><td></td>
				
				<td align='center'><a href=?page=adminhome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
				</tr>";
				$i++;


				}



				?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('Tasks', 1); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
          </div>
<?php


	}
	if($_GET['option']=='taskadministrationallclosed')
	{

		//GET Closed Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Closed' ORDER BY TaskDueDate";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Closed Tasks You Have Created...</h2>
            <div class="inner">
              <form action="#" class="form">
                <table class="table" id="tasks" name="Tasks">
                  <tr>
                    
                    <th>Task ID</th>
                    <th>Location</th>
                    <th>Due Date</th>
                    <th>Assigned By</th>
                    <th></th><th></th><th></th>
                    <th align='center'>Edit Task</th>

                    <th class="last">&nbsp;</th>
                  </tr>
				<?php
				$i=0;
				while ($i < $num) {

				$TaskID =mysql_result($result,$i,"TaskID");
				$TaskLocation =mysql_result($result,$i,"Name");
				$TaskDueDate =mysql_result($result,$i,"TaskDueDate");
				$fn =mysql_result($result,$i,"fn");
				$ln =mysql_result($result,$i,"ln");
				$TaskLocation =mysql_result($result,$i,"Name");
				echo "
				<tr>
				<td>$TaskID</td>
				<td>$TaskLocation</td>
				<td>$TaskDueDate</td>
				<td>$ln, $fn</td>
				<td></td><td></td><td></td>
				
				<td align='center'><a href=?page=adminhome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
				</tr>";
				$i++;


				}



				?>
                </table>
                <div class="actions-bar wat-cf">
                  <div class="actions">

                  </div>
                  <div class="pagination">
                        <script type="text/javascript">
       					var pager = new Pager('Tasks', 1); 
        				pager.init(); 
        				pager.showPageNav('pager', 'pageNavPosition'); 
        				pager.showPage(1);
    					</script>
                  </div>
                </div>
              </form>
            </div>
          </div>



        </div>
          </div>




<?php


	}
	if($_GET['option']=='taskadministrationcreatenew')
	{
	if($_POST['submit']=='createtask')
	{
	$sql="INSERT INTO Tasks (TaskLocation, TaskDescription, TaskStatus, TaskAssignedTo, TaskCreatedBy, TaskDueDate) VALUES ('".$_POST['location']."', '".$_POST['description']."', '".$_POST['status']."', '".$_POST['volunteer']."', '".$_SESSION['id']."', '".$_POST['datedue']."')";
	mysql_query($sql);
	}
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class="active"><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Create New Task</h2>
            <div class="inner">
              <form action="" method="post" name="Edit Task" class="form">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Task ID</label>
                      <input type="text" name="taskid" class="text_field" value="<?php echo $TaskID; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Task Location</label>
                      <input type="text" name="location" class="text_field" value="<?php echo $TaskLocation; ?>" />
                    </div>
                    <div class="group">
                      <label class="label">Task Description</label>
                      <textarea class="text_area" id="description" name="description" rows="10" cols="80" ><? echo $TaskDescription; ?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">The current status is: <font color="#00FF00"><?php echo $TaskStatus; ?></font></label>
                      <select id="status" name="status">
                      <option value="Open">Open</option>
                      <option value="Closed">Closed</option>
                      </select>               
                    </div>
                    <div class="group">
                      <label class="label">Task Due Date</label>
                      <input type="text" name="datedue" id="datedue" class="text_field" value="<?php echo $TaskDateClosed; ?>" />
                      	<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "Edit Task",
						// input name
						"controlname": "datedue"
						});
						</script>
                    </div>
                    <div class="group">
                      <label class="label">Assign To Volunteer</label>
                      <input type="text" id="volunteer" name="volunteer" class="text_field" value="<?php echo $TaskLocation; ?>" />
                    </div>
             


                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" value="createtask">
                    <img src="images/icons/tick.png" alt="Save" /> Create Task
                  </button>

                </div>
              </form>
            </div>
          </div>
        </div>
<?php
	}
		if($_GET['option']=='edittask')
		{
		if($_POST['submit']=='updateTask')
		{
		//echo 'shawn';
		$sql="UPDATE Tasks SET TaskVolunteerNotes='".$_POST['notes']."',TaskStatus='".$_POST['status']."',TaskDateClosed='".$_POST['dateclosed']."' WHERE TaskID='".$_POST['taskid']."'";
		mysql_query($sql);
		}

		$TaskID=$_GET['taskid'];
		//GET Task to Edit!
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskDescription, TaskCreatedBy, TaskHours, TaskDateClosed, TaskVolunteerNotes, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskAssignedTo=id AND TaskID='".$TaskID."' AND TaskAssignedTo='".$_SESSION['id']."'";
		$results=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;


		while ($details = mysql_fetch_assoc($results)) {
		$TaskLocation = $details['Name'];
		$TaskStatus = $details['TaskStatus'];
		$TaskDescription = $details['TaskDescription'];
		$TaskDateOpened = $details['TaskDateOpened'];
		$fn = $details['fn'];
		$ln = $details['ln'];
		$TaskDueDate = $details['TaskDueDate'];
		$TaskHours = $details['TaskHours'];
		$TaskVolunteerNotes = $details['TaskVolunteerNotes'];
		$TaskStatus = $details['TaskStatus'];
		$TaskDateClosed = $details['TaskDateClosed'];
		$ln = $details['ln'];		
		}

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="admin.php?page=adminhome&option=taskadministration">Your Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationclosed">Your Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallopen">All Open Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationallclosed">All Closed Tasks</a></li>
              <li class=""><a href="admin.php?page=adminhome&option=taskadministrationcreatenew">Create New Task</a></li>
              <li class="active"><a href="">Edit Task</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Edit Task...</h2>
            <div class="inner">
              <form action="" method="post" name="Edit Task" class="form">
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">Task ID</label>
                      <input type="text" name="taskid" class="text_field" value="<?php echo $TaskID; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Task Location</label>
                      <input type="text" class="text_field" value="<?php echo $TaskLocation; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Date Task Was Opened</label>
                      <input type="text" class="text_field" value="<?php echo $TaskDateOpened; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Task Assigned To</label>
                      <input type="text" class="text_field" value="<?php echo $ln; ?>, <?php echo $fn; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Task Description</label>
                      <textarea class="text_area" rows="10" cols="80" READONLY><? echo $TaskDescription; ?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Task Module</label>
                      <select id="status" name="status">
                      <option value="<?php echo $TaskStatus; ?>"><?php echo $TaskStatus; ?></option>
                      <?php
                      if($TaskStatus=='Open')
                      {
                      echo'<option value="Closed">Closed</option>';
                      }
                      ?>
                      <?php
                      if($TaskStatus=='Closed')
                      {
                      echo'<option value="Open">Open</option>';
                      }
                      ?>       
                      </select>
                    </div>
                    <div class="group">
                      <label class="label">Task Due Date</label>
                      <input type="text" class="text_field" value="<?php echo $TaskDueDate; ?>" READONLY/>
                    </div>
                    <div class="group">
                      <label class="label">Date Task Completed</label>
                      <input type="text" name="dateclosed" id="dateclosed" class="text_field" value="<?php echo $TaskDateClosed; ?>" />
                      	<script language="JavaScript">
						new tcal ({
						// form name
						"formname": "Edit Task",
						// input name
						"controlname": "dateclosed"
						});
						</script>
                    </div>
                    <div class="group">
                      <label class="label">Volunteer Task Notes</label>
                      <textarea class="text_area" name="notes" id="notes" rows="10" cols="80"><? echo $TaskVolunteerNotes; ?></textarea>
                    </div>                    


                  </div>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" value="updateTask">
                    <img src="images/icons/tick.png" alt="Save" /> Update Task
                  </button>

                </div>
              </form>
            </div>
          </div>
        </div>
<?php
}

	}
	
		


			
?>








