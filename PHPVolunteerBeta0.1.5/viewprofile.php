<?php

include 'header.php';
//include('include/ps_pagination.php');

	if(isset($_SESSION['id']))
		{
		if(isset($_GET['user']))
		{
		if($_POST['submit']=='post')
		{
		$err= array();
		//echo 'Add Location';
		//We need to check some stuff first :)

		$addPost="INSERT INTO Wall (postBody, postUserID)
		VALUES('$_POST[post]','$_SESSION[id]')";
		if (!mysql_query($addPost))
  		{
 		 die('Error: ' . mysql_error());
 		}
		}
		//echo 'settings';

		//GET POSTS FROM DB
		$query="SELECT ln, fn, postBody, postUserID FROM UserWallPosts ORDER BY postDate DESC";
		$result=mysql_query($query);
		$num = mysql_numrows($result);




		?>
		<script type="text/javascript" src="include/tiny_mce/tiny_mce.js" ></script>
		<script type="text/javascript" >
		tinyMCE.init({
		mode : "textareas",
		theme : "simple",
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
<?php
if($_SESSION['wallmod']=='Active')
{
?>
        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <ul class="wat-cf">
              <li class="active first"><a href="">The Wall</a></li>

            </ul>
          </div>
          <div class="content">
            <h2 class="title">Post something on the wall...</h2>
            <form action="" method="post" class="form" name="posttowall">
            <div class="inner">
                  <p class="first">
              Anything you post on the wall will be viewable by everyone else.
              </p>
                <div class="group">
 
                <textarea class="text_area" id="post" Name="post" rows="4" cols="80"></textarea>
                </div>
                <div class="group navform wat-cf">
                  <button class="button" type="submit" name="submit" id="submit" value="post">
                    <img src="images/icons/tick.png" alt="Save" /> Post
                  </button>
                </div>



              
              <hr /><hr /><hr />
				<?php
				$i=0;
				while ($i < $num) {

				$ln =mysql_result($result,$i,"ln");
				$Body =mysql_result($result,$i,"postBody");
				$fn =mysql_result($result,$i,"fn");
				$UserID =mysql_result($result,$i,"postUserID");
				echo "
				<p>$Body</p>
				<p align='right'>Posted by <a href='viewprofile.php?page=userprofile&user=$UserID'>$fn $ln</a></p>

				<hr />
				";
				$i++;


				}
				?>


            
            </div>
          </div>
        </div>




<?php

	}

	$sql="SELECT path FROM ProfilePics WHERE VOL_ID='".$_GET['user']."'";
	$result=mysql_fetch_assoc(mysql_query($sql));
	$num_rows=mysql_num_rows($result);


	$submit="Update";
	$ProfilePicPath=$result['path'];

	if($ProfilePicPath=="")
	
	{
	$submit="Upload";
	$ProfilePicPath='images/avatar.png';
	}

	$sql="SELECT ln, fn, Notes, WorkPhone, HomePhone, CellPhone, email FROM Users WHERE id='".$_GET['user']."'";
	$result=mysql_fetch_assoc(mysql_query($sql));
	$num_rows=mysql_num_rows($result);
	$About=$result['Notes'];
	$WorkPhone=$result['WorkPhone'];
	$HomePhone=$result['HomePhone'];
	$CellPhone=$result['CellPhone'];
	$Email=$result['email'];
	$ln=$result['ln'];
	$fn=$result['fn'];
	
	
?>
		</div>
		<div id="sidebar">
		<div class="block notice">
		<center>
		<h4><?php echo $fn; ?> <?php echo $ln; ?>'s Picture</h4>
		<a href=""><img src="image.php?src=<? echo $ProfilePicPath; ?>" border="0" /></a>
		<br />
		<br />
		</center>
        </div>
		<div class="block notice">
		
		<h4>About <?php echo $fn; ?> <?php echo $ln; ?>:</h4>
		<?php echo $About; ?>
		<br />
		<br />
	
        </div>
		<div class="block notice">

		<h4><?php echo $fn; ?> <?php echo $ln; ?>'s Contact Info:</h4>
		<p><strong>Work Phone: </strong><?php echo $WorkPhone; ?></p>
		<p><strong>Home Phone: </strong><?php echo $HomePhone; ?></p>
		<p><strong>Cell Phone: </strong><?php echo $CellPhone; ?></p>
		<p><strong>Email: </strong><?php echo $Email; ?></p>


        </div>
<?php
	}


	}

		


			
?>





</body>
</html>

