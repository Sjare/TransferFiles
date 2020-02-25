<?php
if(!isset($_GET['page']))
header("Location: index.php?page=home");


	define('INCLUDE_CHECK',true);

	require 'include/connect.php';
	require 'include/functions.php';

	// Those two files can be included only if INCLUDE_CHECK is defined


	session_name('ofnianfpivnapifnvpiajdnfv');
	// Starting the session

	session_set_cookie_params(2*7*24*60*60);
	//Making the cookie live for 2 weeks

	session_start();
	//Get Company Name From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'CompanyName'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['Company'] = $row['SiteVar'];
	
	//Get Application Title From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'ApplicationTitle'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['AppTitle'] = $row['SiteVar'];
	
	//Get Assitance From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'Assistance'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['Assistance'] = $row['SiteVar'];
	
	//Get Home Welcome From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'HomeWelcome'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['HomeWelcome'] = $row['SiteVar'];
	
	//Get Reports Welcome From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'ReportsWelcome'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['ReportsWelcome'] = $row['SiteVar'];
	
	//Get Admin Welcome From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'AdminWelcome'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['AdminWelcome'] = $row['SiteVar'];

	//Get BlogMod Status From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'BlogMod'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['blogmod'] = $row['SiteVar'];

	//Get WallMod Status From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'WallMod'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['wallmod'] = $row['SiteVar'];
	
	//Get TaskMod Status From DB
	$sql="SELECT SiteVarCode, SiteVar FROM SiteVars WHERE SiteVarCode = 'TaskMod'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['taskmod'] = $row['SiteVar'];
	
	
	//Get Task Count From DB
	$sql="SELECT COUNT(*) FROM Tasks WHERE TaskAssignedTo='".$_SESSION['id']."' AND TaskStatus='Open'";
	$row = mysql_fetch_assoc(mysql_query($sql));
	$_SESSION['taskcount'] = $row['COUNT(*)'];



	$Profile='Inactive';
	$_SESSION['profile'] = $profile;
	//echo $_SESSION['blogmod'];
	
	
	
	
	if(isset($_GET['logoff']))
	{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php?page=home");
	exit;
	}
	if($_POST['submit']=='Login')
	{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['email'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';
	
	if(!count($err))
	{
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		
		
		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT id,email,fn,ln,AccessLevel FROM Users WHERE email='{$_POST['email']}' AND pass='".md5($_POST['password'])."'"));
		

		if($row['email'])
		{
			// If everything is OK login
			
			//$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['fn'] = $row['fn'];
			$_SESSION['ln'] = $row['ln'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['AccessLevel'] = $row['AccessLevel'];
			
			$ADMIN='9';
			$ACCESSLEVEL=$_SESSION['AccessLevel'];
			// Store some data in the session
	
		
		}
		else $err[]='Wrong Volunteer ID and/or password!';
	}
	
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	// Save the error messages in the session

	header("Location: index.php?page=home");
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_SESSION['Company']; ?> | <?php echo $_SESSION['AppTitle']; ?></title>
<link rel="stylesheet" type="text/css" href="include/calendar/calendar.css" />
<link rel="stylesheet" href="stylesheets/base.css" type="text/css" media="screen" />
<link rel="stylesheet" id="current-theme" href="stylesheets/themes/default/style.css" type="text/css" media="screen" />
<script language="JavaScript" type="text/javascript" src="include/calendar/calendar_db.js"></script>
<script type="text/javascript" charset="utf-8" src="javascripts/jquery-1.3.min.js"></script>
<script type="text/javascript" charset="utf-8" src="javascripts/jquery.scrollTo.js"></script>
<script type="text/javascript" charset="utf-8" src="javascripts/jquery.localscroll.js"></script>
          <style type="text/css">    
            .pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color: black;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }
        </style>
<script type="text/javascript" src="include/paging.js"></script>
  <script type="text/javascript" charset="utf-8">
    // <![CDATA[
    var Theme = {
      activate: function(name) {
        window.location.hash = 'themes/' + name
        Theme.loadCurrent();
      },

      loadCurrent: function() {
        var hash = window.location.hash;
        if (hash.length > 0) {
          matches = hash.match(/^#themes\/([a-z0-9\-_]+)$/);
          if (matches && matches.length > 1) {
            $('#current-theme').attr('href', 'stylesheets/themes/' + matches[1] + '/style.css');
          } else {
            alert('theme not valid');
          }
        }
      }
    }

    $(document).ready(function() {
      Theme.loadCurrent();
      $.localScroll();
      $('.table :checkbox.toggle').each(function(i, toggle) {
        $(toggle).change(function(e) {
          $(toggle).parents('table:first').find(':checkbox:not(.toggle)').each(function(j, checkbox) {
            checkbox.checked = !checkbox.checked;
          })
        });
      });
    });
    // ]]>
  </script>
</head>
<body>
  
<?php
if(!isset($_SESSION['id']))
	{
?>
    <div id="box">
      <h1><?php echo $_SESSION['Company']; ?> | <?php echo $_SESSION['AppTitle']; ?></h1>
      <div class="block" id="block-login">
        <h2>Login</h2>
        <div class="content login">
        <?php
        if($_SESSION['msg']['login-err'])
        {
        
        ?>
          <div class="flash">
            <div class="message error">
              <?php
							echo $_SESSION['msg']['login-err'];
							echo '<br />';
							unset($_SESSION['msg']['login-err']);
				?>
            </div>
          </div>
        <?php
        }
        ?>
          <form action="" class="form login" method="post">
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Email</label>
              </div>
              <div class="right">
                <input type="text" id="email" name="email" class="text_field" />
              </div>
            </div>
            <div class="group wat-cf">
              <div class="left">
                <label class="label right">Password</label>
              </div>
              <div class="right">
                <input type="password" id="password" name="password" class="text_field" />
              </div>
            </div>
            <div class="group navform wat-cf">
              <div class="right">
                <button class="button" type="submit" name="submit" value="Login">
                  <img src="images/icons/key.png" alt="Save" /> Login
                </button>
              </div>
            </div>
          </form>
              </div>
            </div>
            </div>




<?php
	}
	if(isset($_SESSION['id']))
	{

?>


  <div id="container">
    <div id="header">
	<h1><a href="index.php?page=home"><?php echo $_SESSION['Company']; ?> | <?php echo $_SESSION['AppTitle']; ?></a></h1>
      <div id="user-navigation">
        <ul class="wat-cf">
          <li><a href="profile.php?page=profile&option=currentuser&user=<?php echo $_SESSION['id'];?>">Profile</a></li>
          <li><a href="settings.php?page=settings&option=settingshome">Settings</a></li>
          <li><a class="logout" href="?logoff">Logout</a></li>
        </ul>
      </div>
      <div id="main-navigation">
        <ul class="wat-cf">
         <?php
        if($_GET['page']=='home')
			{
		?>
          <li class="active first"><a href="?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
          <?php
          }
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
          }
          ?>
                  <?php
        if($_GET['page']=='volunteeroptions')
			{
		?>
          <li ><a href="index.php?page=home">Home</a></li>
          <li class="active"><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
		}
		?>
        <?php
        if($_GET['page']=='reportshome')
			{
		?>
          <li ><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li class="active"><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
 

        <?php
		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
		}
		?>
		
        <?php
        if($_GET['page']=='adminhome')
			{
		?>
          <li ><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li class="active"><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
		}
		?>
		
        <?php
        if($_GET['page']=='settings')
			{
		?>
          <li ><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
         <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }
		}
		?>
		
        <?php
        if($_GET['page']=='profile')
			{
		?>
          <li ><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>

        <?php

		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }


		}

		

		?>
        <?php
        if($_GET['page']=='search')
			{
		?>
          <li class="active first"><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>

        <?php

		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }


		}

		

		?>
        <?php
        if($_GET['page']=='userprofile')
			{
		?>
          <li class="active first"><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>

        <?php

		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }


		}

		?>
        <?php
        if($_GET['page']=='taskshome')
			{
		?>
          <li class="first"><a href="index.php?page=home">Home</a></li>
          <li><a href="index.php?page=volunteeroptions&option=reporthours">Volunteer Options</a></li>
        <?php
        if($_SESSION['taskmod']=='Active')
        {
        ?>
          <li class="active"><a href="tasks.php?page=taskshome&option=tasksmain">Tasks (<?php echo $_SESSION['taskcount']; ?>)</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='9')
        {
        ?>
          <li><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
          <li><a href="admin.php?page=adminhome&option=administration">Administration</a></li>

        <?php

		}
        if($_SESSION['AccessLevel']=='4')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <?php
        }
        if($_SESSION['AccessLevel']=='3')
        {
        ?>
        <li ><a href="reports.php?page=reportshome&option=reportsmain">Reports</a></li>
        <li ><a href="admin.php?page=adminhome&option=administration">Administration</a></li>
        <?php
        }


		}
		

		?>
        </ul>
      </div>
    </div>
        




      
    






<?php
	}
?>





