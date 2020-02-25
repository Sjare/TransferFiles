<?php

include 'header.php';
include('include/ps_pagination.php');

	if(isset($_SESSION['id']))
		{
	if($_GET['option']=='messagesinbox')
		{
	if($_POST['submit']=='searchbylast')
		{

		$searched=$_POST['searchbylast'];
		
		// Get Messages from Database
		$getActiveVolunteers="SELECT messageID, messageTimeStamp, messageFrom, messageTo, messageSubject, messageStatus FROM Messages WHERE messageTo='$_SESSION[id]' AND messageSubject LIKE '%$searched%' ORDER BY messageTimeStamp";
		$resultActiveVolunteers=mysql_query($getActiveVolunteers);
		$numActiveVolunteers = mysql_numrows($resultActiveVolunteers);
		

		
		}
	else
		{




		// Get Messages from Database
		$getActiveVolunteers="SELECT messageID, messageTimeStamp, messageFrom, messageTo, messageSubject, messageStatus FROM Messages WHERE messageTo='$_SESSION[id]' ORDER BY messageTimeStamp";
		$resultActiveVolunteers=mysql_query($getActiveVolunteers);
		$numActiveVolunteers = mysql_numrows($resultActiveVolunteers);		



		}


?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li><a href=""></a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Your Messages...</h2>
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
                <table class="table" id="messages">
                  <tr>              
                    <th NOWRAP>Message ID</th>
                    <th NOWRAP>From</th>
                    <th NOWRAP>Subject</th>

                    <th class="last">&nbsp;</th>
				<?php
				$i=0;
				while ($i < $numActiveVolunteers) {

				$ID =mysql_result($resultActiveVolunteers,$i,"messageID");
				$From =mysql_result($resultActiveVolunteers,$i,"messageFrom");
				$Subject =mysql_result($resultActiveVolunteers,$i,"messageSubject");

				echo "
				<tr>
				<td>$ID</td>
				<td>$From</td>
				<td NOWRAP><a href='messages.php?page=readmessage&message=$ID&user=31'>$Subject</a></td>
				<td></td><td></td><td></td>
				
				<td><a href=admin.php?page=adminhome&option=volunteers&deletevolunteer=ask&edit=$ID><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'></a></td>
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
       					var pager = new Pager('messages', 20); 
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
          
          <form action="" method="post" class="form" name="searchbylastname">
        	<div class="group">
            <label class="label">Search for Message by Subject:</label>
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
          <p><img src='include/images/icons/delete.png' width='16' heigth='16' border='0'> Delete Message</p>

          
        </div>
<?php
}
}

?>
