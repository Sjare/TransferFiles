<?php

include 'header.php';
include 'include/printing.php';
include('include/ps_pagination.php');
	if($_SESSION['AccessLevel']<>'9')
	{
	if($_SESSION['AccessLevel']<>'3')
	{
	if($_SESSION['AccessLevel']<>'4')
	{
	echo 'You do not have access to this page.';
	exit;
	}
	}
	}

	if(isset($_SESSION['id']))
		{
		if($_GET['option']=='reportsmain')
		{
		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="reports.php?page=reportshome&option=reportsmain">Reports Home</a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Welcome to the reports sections.</h2>
            
            <div class="inner">
			<?php echo $_SESSION['ReportsWelcome']; ?>

              
              <hr />
				<p> <span class="gray"><?php echo $_SESSION['Assistance']; ?></span></p>
            </div>
          </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Select A Report:</h4>
        <table name="avaliable-reports">
        <tr><td><a href="reports.php?page=reportshome&option=ActiveVolsAtLocations"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Active Volunteer Count</td>
        <tr><td><a href="reports.php?page=reportshome&option=AllActiveVolunteers"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>All Active Volunteers</td>
        <tr><td><a href="reports.php?page=reportshome&option=AllVolunteerHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>All Volunteer Hours</td>		
		<tr><td><a href="reports.php?page=reportshome&option=VolunteersHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Single Volunteer's Hours</td>
		<tr><td><a href="reports.php?page=reportshome&option=VolunteersLocations"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Volunteers Location Assignments</td>
		<tr><td><a href="reports.php?page=reportshome&option=ActiveVolunteerGender"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Active Volunteers Gender Count</td>		
		<tr><td><a href="reports.php?page=reportshome&option=TopReportedHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Top Reported Hours All Locations</td>
		<tr><td><a href="reports.php?page=reportshome&option=TopReportedHoursOneLocation"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Top Reported Hours One Location</td>
		</table>
		</div>
        </div>
		<?php
		}
		if($_GET['option']=='ActiveVolsAtLocations')
		{
	$GetTotalAbsencebyType="SELECT Name, Volunteers FROM ActiveVolsAtLocations";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Active Volunteer Count</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Active Volunteer Count</h2>
            <div class="inner">
              <p class="first">
                Please note that some Volunteers are assigned to more that one Location.  These Volunteers are counted once for each Location assignment.
              </p>
              
              <hr />

			<table border='0' class='sortable'>
			<th align='left' width='220'>Location Name</th>
			<th align='right' width='400'>Number of Voluteers At Location</th>
          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
		
			$AbsenceType=mysql_result($TotalAbsencebyTypeResults,$i,"Name");
			$Total=mysql_result($TotalAbsencebyTypeResults,$i,"Volunteers");
			$grandTotal += $Total;
		echo "
		<tr>
		<td align='left'>$AbsenceType</td>
		<td align='right'>$Total</td>
		</tr>
		<tr><td></td><td><hr /></td>
		
		
		";
		$i++;

		}
		//echo $grandTotal;
		echo "<tr><td><td align='right'><strong>Total Active Volunteers:  $grandTotal<strong></td>";
		
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContent('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
		</div>
        </div>


<?php

	}
		if($_GET['option']=='AllActiveVolunteers')
		{
	$GetTotalAbsencebyType="SELECT ln, fn, email, HomePhone, WorkPhone, CellPhone FROM ActiveVolunteers ORDER BY ln";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Active Volunteer Count</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">All Active Volunteers</h2>
            <div class="inner">
              <p class="first">
                This is a report of all active Volunteers in the system.
              </p>
              
              <hr />

			<table border='0' class='sortable'>
			<th align="left" width="90">Last Name</th>
			<th align="left" width="90">First Name</th>
			<th align="left" width="180">Email Address</th>
			<th align="left" width="120">Home Phone</th>
			<th align="left" width="120">Work Phone</th>
			<th align="left" width="120">Cell Phone</th>
          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
		
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$email=mysql_result($TotalAbsencebyTypeResults,$i,"email");
			$HomePhone=mysql_result($TotalAbsencebyTypeResults,$i,"HomePhone");
			$WorkPhone=mysql_result($TotalAbsencebyTypeResults,$i,"WorkPhone");
			$CellPhone=mysql_result($TotalAbsencebyTypeResults,$i,"CellPhone");
			//$grandTotal += $Total;
		echo "
		<tr>
		<td>$ln</td>
		<td>$fn</td>
		<td>$email</td>
		<td>$HomePhone</td>
		<td>$WorkPhone</td>
		<td>$CellPhone</td>
		</tr>

		
		
		";
		$i++;

		}
		//echo $grandTotal;
		//echo "<tr><td><td align='right'><strong>Total Active Volunteers:  $grandTotal<strong></td>";
		
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContentLand('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
		</div>
        </div>
<?php
	}
		if($_GET['option']=='AllVolunteerHours')
		{
		if(isset($_POST['startdate'], $_POST['enddate']))
		{
	$StartDate=$_POST['startdate'];
	$EndDate=$_POST['enddate'];
	$GetTotalAbsencebyType="SELECT User_ID, ln, fn, Name, SUM(Hours) AS HOURS FROM VolHoursVerified WHERE date BETWEEN '$StartDate' AND '$EndDate' GROUP BY Name, User_ID ORDER BY Name";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: All Volunteer Hours</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">All Volunteer Hours</h2>
            <div class="inner">
              <p class="first">
                This is a report of all active Volunteers in the system.
                <?php
                echo "
                <br />
        		<p><strong>Between Dates:</strong> ".$StartDate." & ".$EndDate."</p>";
        		?>
              </p>
              
              <hr />
			<?php
			
			?>
			<table border='0' class='sortable'>
			<th align="left" width="180">Location</th>
			<th align="left" width="90">Volunteer ID</th>
			<th align="left" width="90">Last Name</th>
			<th align="left" width="90">First Name</th>
			<th align="right" width="120">Number Of Hours</th>

          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
			
			$Location=mysql_result($TotalAbsencebyTypeResults,$i,"Name");		
			$VolunteerID=mysql_result($TotalAbsencebyTypeResults,$i,"User_ID");
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$Hours=mysql_result($TotalAbsencebyTypeResults,$i,"HOURS");


			$grandTotal += $Hours;
		echo "
		<tr>
		<td>$Location</td>
		<td>$VolunteerID</td>
		<td>$ln</td>
		<td>$fn</td>
		<td align='right'>$Hours</td>

		</tr>

		
		
		";
		$i++;
		}
		
		
		//echo $grandTotal;
		echo "<tr><td><td align='right' colspan='4'><strong>Total Verified Hours for Date Range:  $grandTotal<strong></td>";
		}
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<form action="" method="post" class="form" name="VolunterInformation">
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContentLand('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
        </table>
        <div class="group">
        <label class="label">Start Date</label>
        <input type="text" id="startdate" name="startdate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "startdate"
		});
		</script>
        </div>
        <div class="group">
        <label class="label">End Date</label>
        <input type="text" id="enddate" name="enddate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "enddate"
		});
		</script>
        </div>
		
        <div class="group navform wat-cf">
        <button class="button" type="submit" name="submit" id="submit" value="runreport">
        <img src="images/icons/tick.png" alt="Save" /> Run Report
        </button>
        </div>
        </form>
        </div>
        </div>
<?php


		}
		if($_GET['option']=='VolunteersHours')
		{
?>
    <div id="wrapper" class="wat-cf">
      <div id="main">
<?php
		if(isset($_POST['startdate'], $_POST['enddate']))
		{
	$VOLID=$_POST['VOLID'];
	$StartDate=$_POST['startdate'];
	$EndDate=$_POST['enddate'];
	$GetTotalAbsencebyType="SELECT User_ID, ln, fn, Name, SUM(Hours) AS HOURS FROM VolHoursVerified WHERE date BETWEEN '$StartDate' AND '$EndDate' AND User_ID='$VOLID' GROUP BY Name, User_ID ORDER BY Name";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>


        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report:Single Volunteer's Hours</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Single Volunteer's Hours</h2>
            <div class="inner">
              <p class="first">
                This is a report of a single Volunteers hours based on a date range.
                <?php
                echo "
                <br />
        		<p><strong>Between Dates:</strong> ".$StartDate." & ".$EndDate."</p>";
        		?>
              </p>
              
              <hr />
			<?php
			
			?>
			<table border='0' class='sortable'>
			<th align="left" width="180">Location</th>
			<th align="left" width="90">Volunteer ID</th>
			<th align="left" width="90">Last Name</th>
			<th align="left" width="90">First Name</th>
			<th align="right" width="120">Number Of Hours</th>

          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
			
			$Location=mysql_result($TotalAbsencebyTypeResults,$i,"Name");		
			$VolunteerID=mysql_result($TotalAbsencebyTypeResults,$i,"User_ID");
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$Hours=mysql_result($TotalAbsencebyTypeResults,$i,"HOURS");


			$grandTotal += $Hours;
		echo "
		<tr>
		<td>$Location</td>
		<td>$VolunteerID</td>
		<td>$ln</td>
		<td>$fn</td>
		<td align='right'>$Hours</td>

		</tr>

		
		
		";
		$i++;
		}
		
		
		//echo $grandTotal;
		echo "<tr><td><td align='right' colspan='4'><strong>Total Verified Hours for Date Range:  $grandTotal<strong></td>";
		}
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<form action="" method="post" class="form" name="VolunterInformation">
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContentLand('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
        </table>
        <div class="group">
        <label class="label">Volunteer's ID</label>
        <input type="text" id="VOLID" name="VOLID" value="" class="text_field" />
        </div>
        <div class="group">
        <label class="label">Start Date</label>
        <input type="text" id="startdate" name="startdate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "startdate"
		});
		</script>
        </div>
        <div class="group">
        <label class="label">End Date</label>
        <input type="text" id="enddate" name="enddate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "enddate"
		});
		</script>
        </div>
		
        <div class="group navform wat-cf">
        <button class="button" type="submit" name="submit" id="submit" value="runreport">
        <img src="images/icons/tick.png" alt="Save" /> Run Report
        </button>
        </div>
        </form>
        </div>
        </div>
<?php
	}
		if($_GET['option']=='VolunteersLocations')
		{
	$GetTotalAbsencebyType="SELECT Name, ln, fn, VIP_ID FROM VolunteerLocations WHERE UserStatus='2' ORDER BY Name, ln";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Volunteer's Location Assignments</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Volunteer's Location Assignments</h2>
            <div class="inner">
              <p class="first">
                All Active Volunteers and their assigned locations.
              </p>
              
              <hr />

			<table border='0' class='sortable'>
			<th align='left' width='240'>Location</th>
			<th align='right' width='120'>ID</th>
			<th align='right' width='120'>Last Name</th>
			<th align='right' width='120'>First Name</th>
          <?php
			$grandTotal=0;
			$i=0;
			//$j=1
			while ($i < $TotalAbsencebyTypeNum) {
		
			$LocationName=mysql_result($TotalAbsencebyTypeResults,$i,"Name");
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$id=mysql_result($TotalAbsencebyTypeResults,$i,"VIP_ID");
			$grandTotal += $Total;
		echo "
		<tr>
		<td align='left'>$LocationName</td>
		
		<td align='right'>$id</td>
		
		<td align='right'>$ln</td>
		<td align='right'>$fn</td>
		</tr>
		<tr><td colspan='4'><hr /></td></tr>
		
		
		";
		$i++;

		}
		//echo $grandTotal;

		
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContent('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
		</div>
        </div>
<?php


	}
		if($_GET['option']=='ActiveVolunteerGender')
		{
	$GetTotalAbsencebyType="SELECT Females, Males FROM CountActiveFemales, CountActiveMales";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Active Volunteer Gender Count</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Active Volunteer Gender Count</h2>
            <div class="inner">
              <p class="first">
                All Active Volunteers groups into Male  or Female.
              </p>
              
              <hr />

			<table border='0' class='sortable'>
			
			<th align='center' width='220'>Active Females In System</th>
			<th align='center' width='220'>Active Males In System</th>
          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
		
			
			$females=mysql_result($TotalAbsencebyTypeResults,$i,"Females");
			$males=mysql_result($TotalAbsencebyTypeResults,$i,"Males");
			$grandTotal += $Total;
		echo "
		<tr>
		
		<td align='center'>$females</td>
		<td align='center'>$males</td>
		</tr>
		
		
		
		";
		$i++;

		}
		//echo $grandTotal;

		
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContent('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
		</div>
        </div>
<?php
	}
	
		if($_GET['option']=='TopReportedHours')
		{
		if(isset($_POST['startdate'], $_POST['enddate']))
		{
	$StartDate=$_POST['startdate'];
	$EndDate=$_POST['enddate'];
	$GetTotalAbsencebyType="SELECT *, COUNT(*) AS HoursCount FROM `VolHoursVerified` GROUP BY User_ID ORDER BY HoursCount DESC LIMIT 10";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Top Reported Hours</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Top Reported Hours</h2>
            <div class="inner">
              <p class="first">
                Top ten highest reported hours based on a date range.  This report is based on all Locations.
                <?php
                echo "
                <br />
        		<p><strong>Between Dates:</strong> ".$StartDate." & ".$EndDate."</p>";
        		?>
              </p>
              
              <hr />
			<?php
			
			?>
			<table border='0' class='sortable'>
			<th align="left" width="90">Volunteer ID</th>
			<th align="left" width="90">Last Name</th>
			<th align="left" width="90">First Name</th>
			<th align="right" width="120">Number Of Hours</th>

          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
			
					
			$VolunteerID=mysql_result($TotalAbsencebyTypeResults,$i,"User_ID");
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$Hours=mysql_result($TotalAbsencebyTypeResults,$i,"HoursCount");


			$grandTotal += $Hours;
		echo "
		<tr>
		
		<td>$VolunteerID</td>
		<td>$ln</td>
		<td>$fn</td>
		<td align='right'>$Hours</td>

		</tr>

		
		
		";
		$i++;
		}
		
		
		//echo $grandTotal;
		echo "<tr><td><td align='right' colspan='4'><strong>Total Verified Hours for Date Range:  $grandTotal<strong></td>";
		}
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<form action="" method="post" class="form" name="VolunterInformation">
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContentLand('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
        </table>
        <div class="group">
        <label class="label">Start Date</label>
        <input type="text" id="startdate" name="startdate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "startdate"
		});
		</script>
        </div>
        <div class="group">
        <label class="label">End Date</label>
        <input type="text" id="enddate" name="enddate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "enddate"
		});
		</script>
        </div>
		
        <div class="group navform wat-cf">
        <button class="button" type="submit" name="submit" id="submit" value="runreport">
        <img src="images/icons/tick.png" alt="Save" /> Run Report
        </button>
        </div>
        </form>
        </div>
        </div>
<?php


		}
		
		if($_GET['option']=='TopReportedHoursOneLocation')
		{
		
			//GET LOCATIONS
			$getlocations = "SELECT LocationID, Name FROM Locations ".
			"ORDER BY Name";
			$bob='shawn';
			$locationsrs = mysql_query($getlocations);

		if(isset($_POST['startdate'], $_POST['enddate']))
		{
	$StartDate=$_POST['startdate'];
	$EndDate=$_POST['enddate'];
	$Location=$_POST['Location'];
	$GetTotalAbsencebyType="SELECT *, COUNT(*) AS HoursCount FROM `VolHoursVerified` WHERE Name='$Location' GROUP BY User_ID ORDER BY HoursCount DESC LIMIT 10";
	$TotalAbsencebyTypeResults=mysql_query($GetTotalAbsencebyType);
	$TotalAbsencebyTypeNum=mysql_numrows($TotalAbsencebyTypeResults);
	$CampusRow=mysql_fetch_assoc(mysql_query($GetTotalAbsencebyType));

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="#block-text">Report: Top Reported Hours</a></li>


            </ul>
          </div>
          <div class="content">

		
          <DIV id="print_div2">
            <h2 class="title">Top Reported Hours for <?php echo $Location; ?></h2>
            <div class="inner">
              <p class="first">
                Top ten highest reported hours based on a date range.  This report is based on a specified location.
                <?php
                echo "
                <br />
        		<p><strong>Between Dates:</strong> ".$StartDate." & ".$EndDate."</p>";
        		?>
              </p>
              
              <hr />
			<?php
			
			?>
			<table border='0' class='sortable'>
			<th align="left" width="90">Volunteer ID</th>
			<th align="left" width="90">Last Name</th>
			<th align="left" width="90">First Name</th>
			<th align="right" width="120">Number Of Hours</th>

          <?php
			$grandTotal=0;
			$i=0;
			while ($i < $TotalAbsencebyTypeNum) {
			
					
			$VolunteerID=mysql_result($TotalAbsencebyTypeResults,$i,"User_ID");
			$ln=mysql_result($TotalAbsencebyTypeResults,$i,"ln");
			$fn=mysql_result($TotalAbsencebyTypeResults,$i,"fn");
			$Hours=mysql_result($TotalAbsencebyTypeResults,$i,"HoursCount");


			$grandTotal += $Hours;
		echo "
		<tr>
		
		<td>$VolunteerID</td>
		<td>$ln</td>
		<td>$fn</td>
		<td align='right'>$Hours</td>

		</tr>

		
		
		";
		$i++;
		}
		
		
		//echo $grandTotal;
		echo "<tr><td><td align='right' colspan='4'><strong>Total Verified Hours for Date Range:  $grandTotal<strong></td>";
		}
		?>
		</table>
            </div>
          </div>
        </div>
        </div>
		</div>
		<form action="" method="post" class="form" name="VolunterInformation">
		<div id="sidebar">
        <div class="block notice">
        <h4>Report Options:</h4>
        <table name="avaliable-reports">
        <tr>
        <td>
		<a href="" onclick="printContentLand('print_div2')"><img src="include/images/icons/print.png" width="16" higth="16" border="0"></a>
        </td>
        <td>
        Print Report
        </td>
        </table>
        <div class="group">
        <label class="label">Start Date</label>
        <input type="text" id="startdate" name="startdate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "startdate"
		});
		</script>
        </div>
        <div class="group">
        <label class="label">End Date</label>
        <input type="text" id="enddate" name="enddate" value="" class="text_field" />
        <script language="JavaScript">
		new tcal ({
		// form name
		"formname": "VolunterInformation",
		// input name
		"controlname": "enddate"
		});
		</script>
        </div>
                    <div class="group">
                      <label class="label">Campus / Location</label>
                      <select id="Location" name="Location">
                      
                      <?php
  					  while($locationsrow = mysql_fetch_array($locationsrs))
						{
 						echo "<option value=\"".$locationsrow['Name']."\">".$locationsrow['Name']."\n </option>";
						}                      
                      ?>
                      
                      </select>
                    </div>
		
        <div class="group navform wat-cf">
        <button class="button" type="submit" name="submit" id="submit" value="runreport">
        <img src="images/icons/tick.png" alt="Save" /> Run Report
        </button>
        </div>
        </form>
        </div>
        </div>
<?php



		}
	}
		
		if($_GET['option']=='customreports')
		{
		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="reports.php?page=reportshome&option=reportsmain">Reports Home</a></li>
              <li class="active"><a href="reports.php?page=reportshome&option=customreports">Custom Reports</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Welcome to the reports sections.</h2>
            
            <div class="inner">
			<?php echo $_SESSION['ReportsWelcome']; ?>

              
              <hr />
				<p> <span class="gray"><?php echo $_SESSION['Assistance']; ?></span></p>
            </div>
          </div>
        </div>
		</div>
		<div id="sidebar">
        <div class="block notice">
        <h4>Select A Report:</h4>
        <table name="avaliable-reports">
        <tr><td><a href="reports.php?page=reportshome&option=ActiveVolsAtLocations"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Active Volunteer Count</td>
        <tr><td><a href="reports.php?page=reportshome&option=AllActiveVolunteers"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>All Active Volunteers</td>
        <tr><td><a href="reports.php?page=reportshome&option=AllVolunteerHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>All Volunteer Hours</td>		
		<tr><td><a href="reports.php?page=reportshome&option=VolunteersHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Single Volunteer's Hours</td>
		<tr><td><a href="reports.php?page=reportshome&option=VolunteersLocations"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Volunteers Location Assignments</td>
		<tr><td><a href="reports.php?page=reportshome&option=ActiveVolunteerGender"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Active Volunteers Gender Count</td>		
		<tr><td><a href="reports.php?page=reportshome&option=TopReportedHours"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Top Reported Hours All Locations</td>
		<tr><td><a href="reports.php?page=reportshome&option=TopReportedHoursOneLocation"><img src="include/images/icons/report.png" width="16" higth="16" border="0"></a></td><td>Top Reported Hours One Location</td>
		</table>
		</div>
        </div>
		<?php
		}

			
?>





</body>
</html>

