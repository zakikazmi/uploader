<?php


	require_once("upload.php");
	require_once("user.php");
	$auth_user = new USER();

	
	$user_id = $_SESSION['user_session'];
	if ($user_id == ""){
        header("Location:index.php");
    }
    else{
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    }

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Your Portal - <?php print($userRow['user_name']); ?></title>
</head>

<body class="body-background-uploader">

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand"><img src="images/sus_logo.png"></a>
        </div>
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
     <div class="row">
        <div class="col-lg-3 well">
      <div class="well">
            <div class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Welcome : <?php print($userRow['user_name']); ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </div>

      </div>
        <div class="well">
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <button class="custom-btn upload-btn-wrapper"  type="submit" name="btn-upload">upload</button>
            </form>
            <br /><br />
            <?php
            if(isset($_GET['success']))
            {
                ?>
                <label style="color:green;">File Uploaded Successfully!</label>
                <?php
            }
            else if(isset($_GET['fail']))
            {
                ?>
                <label style="color:red;">Problem While File Uploading!</label>
                <?php
            }
            else
            {
                ?>
                <label id="upload_info">Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
                <?php
            }
            ?>
        </div>
      <div class="well">
        <p>Table Options</p>
            <ul>
            <li id="showLess">Show Less</li>
            <li id="loadMore">Show More</li>
            <li id="hideData">Hide Table</li>
            </ul>

      </div>

    </div>

        <div class="col-lg-9">

            <table id="all_uploads" width="80%" border="1">
            <th colspan="5">your uploads...</th>
            <tr>
            <td>File Name</td>
            <td>File Type</td>
            <td>File Size(KB)</td>
            <td>View</td>
            </tr>
            <?php

            $result = $auth_user->runQuery("SELECT * FROM upload_file WHERE u_id='$user_id'");
            $result->execute(array(":user_id"=>$user_id));
            while ($Uploadrow = $result->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr id="records">
                <td><?php echo $Uploadrow['file'] ?></td>
                <td><?php echo $Uploadrow['type'] ?></td>
                <td><?php echo $Uploadrow['size'] ?></td>
                <td><a href="uploads/<?php echo $Uploadrow['file'] ?>" target="_blank">view file</a></td>
                </tr>
                <?php
            }
            ?>
            </table>
    
        </div>
      </div>
    </div>

</div>
<script src="js/custom.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                         Copyright © Secure Upload Software
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>