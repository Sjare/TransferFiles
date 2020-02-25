<?php

include 'header.php';
include 'include/printing.php';
include('include/ps_pagination.php');
	//if($_SESSION['AccessLevel']<>'9')
	//{
	//if($_SESSION['AccessLevel']<>'3')
	//{
	//if($_SESSION['AccessLevel']<>'4')
	//{
	//echo 'You do not have access to this page.';
	//exit;
	//}
	//}
	//}

	if(isset($_SESSION['id']))
		{
		if($_GET['option']=='tasksmain')
		{

		//GET Open Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Open' AND TaskAssignedTo='".$_SESSION['id']."'";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="tasks.php?page=taskshome&option=tasksmain">Open Tasks</a></li>
              <li class=""><a href="tasks.php?page=taskshome&option=tasksclosed">Closed Tasks</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Open Tasks Assigned to You!</h2>
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
				
				<td align='center'><a href=?page=taskshome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
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

		if($_GET['option']=='tasksclosed')
		{


		//GET Closed Tasks
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskCreatedBy, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskStatus='Closed' AND TaskAssignedTo='".$_SESSION['id']."'";
		$result=mysql_query($query);
		$num = mysql_numrows($result);
		$rowsPerPage = 5;

		?>
    <div id="wrapper" class="wat-cf">
      <div id="main">

        <div class="block" id="block-tables">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="first"><a href="tasks.php?page=taskshome&option=tasksmain">Open Tasks</a></li>
              <li class="active"><a href="tasks.php?page=taskshome&option=tasksclosed">Closed Tasks</a></li>
            </ul>
          </div>
          <div class="content">
            <h2 class="title">Closed Tasks Assigned to You!</h2>
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
				
				<td align='center'><a href=?page=taskshome&option=edittask&taskid=$TaskID><img src='include/images/icons/edit.png' width='16'></a></td>
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
		$query="SELECT TaskID, TaskStatus, TaskDateOpened, TaskDescription, TaskCreatedBy, TaskHours, TaskDateClosed, TaskVolunteerNotes, TaskAssignedTo, TaskDueDate, Name, fn, ln FROM Tasks, Locations, Users WHERE TaskLocation=LocationID AND TaskCreatedBy=id AND TaskID='".$TaskID."' AND TaskAssignedTo='".$_SESSION['id']."'";
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
              <li class="first"><a href="tasks.php?page=taskshome&option=tasksmain">Open Tasks</a></li>
              <li class=""><a href="tasks.php?page=taskshome&option=tasksclosed">Closed Tasks</a></li>
              <li class="active"><a href="">Edit Tasks</a></li>
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
                      <label class="label">Task Created By</label>
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





</body>
</html>

