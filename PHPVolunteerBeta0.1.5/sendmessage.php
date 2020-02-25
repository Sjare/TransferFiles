<?php

include 'header.php';
include('include/ps_pagination.php');

	if(isset($_SESSION['id']))
		{
		if($_POST['submit']=='sendmessage')
		{
		$sql="INSERT INTO Messages (messageFrom, messageTo, messageSubject, messageBody, messageStatus) VALUES ('$_SESSION[id]', '$_GET[to]', '$_POST[subject]', '$_POST[body]', '1')";
		mysql_query($sql);
		}
		if(isset($_GET['to']))
		{
		?>

    <div id="wrapper" class="wat-cf">
      <div id="main">
                <div class="actions-bar wat-cf">
                  <div class="actions">
                  <div id="pageNavPosition"></div>
        <div class="block" id="block-forms">
          <div class="secondary-navigation">
            <ul class="wat-cf">

              <li class="active first"><a href="admin.php?page=adminhome&option=blogposts">Send Message</a></li>

            </ul>
          </div>

          <div class="content">
            <h2 class="title">Send New Message...</h2>
            <div class="inner">
        <?php
        if($_POST['submit']=='sendmessage')
        {
        
        ?>
          <div class="flash">
            <div class="message notice">
              <?php
							echo '<br>Your Message Has Been Sent.<br><br>';

				?>
            </div>
          </div>
        <?php
        }
        ?>
              <form action="" method="post" class="form" name="editnewsblock">
        	<div class="group">
            <label class="label">From</label>
            <input type="text" id="from" name="from" value="<?php echo $_GET['from']; ?>" class="text_field" READONLY/>
            </div>        	
        	<div class="group">
            <label class="label">To</label>
            <input type="text" id="to" name="to" value="<?php echo $_GET['to']; ?>" class="text_field" READONLY/>
            </div>
        	<div class="group">
            <label class="label">Subject</label>
            <input type="text" id="subject" name="subject" value="" class="text_field" />
            </div>
                <div class="group">
                <label class="label">Body</label>
                <textarea class="text_area" id="body" Name="body" rows="20" cols="80"><?php echo $Block1SiteVar;?></textarea>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="sendmessage">
                    <img src="images/icons/tick.png" alt="Save" /> Send Message
                  </button>
                </div>
        </div>
        </div>
        </div>
<?php
}
}
?>
