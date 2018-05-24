<?php
session_start();
include_once 'dbconfig.php';
require_once('user.php');
$user = new USER();
if(isset($_POST['btn-upload']))
{    
     
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
    $file_user = $_SESSION['user_session']; 
	$folder="uploads/";
	

	$new_size = $file_size/1024;  
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',$new_file_name);
    $user_data = $_SESSION['user_session']; 
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql=$user->runQuery("INSERT INTO upload_file(file,type,size,u_id) VALUES('$final_file','$file_type','$new_size','$file_user')");
		$sql->execute();
		?>
		<script>
		alert('successfully uploaded');
        window.location.href='user_portal.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='user_portal.php?fail';
        </script>
		<?php
	}
}
?>