<?php

include 'header.php';
include('include/ps_pagination.php');

	if(isset($_SESSION['id']))
		{
		if($_GET['option']=='findvolunteer')
		{
		$searched=$_POST['searched'];
		// Get Active Volunteers from Database
		$getActiveVolunteers="SELECT id, fn, ln, email FROM usersearch WHERE Search LIKE '%$searched%' ORDER BY ln LIMIT 50";
		$resultActiveVolunteers=mysql_query($getActiveVolunteers);
		$numActiveVolunteers = mysql_numrows($resultActiveVolunteers);
		//echo $searched;
		}
		}
		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="index.php?page=home">Home</a></li>
              <li class="active"><a href="">Search Results</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Your Search Results:</h2>
            <div class="inner">
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
				<td><a href='viewprofile.php?page=userprofile&user=$ID'>$ID</a></td>
				<td>$LastName</td>
				<td>$FirstName</td>
				<td>$Email</td>
				
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