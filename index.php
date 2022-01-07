<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include("application/class.items.php");
include("application/class.userconnect.php");
include("application/class.controlo.php");
require_once("config/config.php");
$connect =  new mysqli($server['database']['host'],$server['database']['username'],$server['database']['password'],$server['database']['db']);
   
?>
<!DOCTYPE html>
<html>
<head>
    <title>
    <?php  
    echo"".$settings['admin']['title']."".$settings['admin']['titletwo'].""; 
    ?>
    </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
</head>
<body>

<div id="login_box" style="display:none;"><!-- login-->

<div id="bg12" style="width:100%; position:absolute; z-index:1000; position:fixed; height:100%; background:black; opacity:0.7;">
</div>

<div style="width:1000px; height:100% auto;">
<div class="bg_wt" style="overflow:hidden; width:310px; border-radius:2px; background:red; margin:0 auto; text-align:center; left:0; right:0; margin-top:200px; position:fixed; z-index:1001; background:white;height:240px;">
<p style="font-family:Arial; font-size:18px; color:#939393; font-weight:bold; margin-top:30px;">SIGN IN</p>
<div style="margin:0 auto; background-red width:300px; height:100% auto;">
<form method="POST" style="margin:0 auto; margin-top:30px;">
<input type="text" class="test" name="username" placeholder="USER" /><br/>
<input type="password" class="test" name="password" placeholder="PASSWORD" /><br />
<button name="login" class="log">LOG IN</button>
</form>
</div>
</div>
</div>
<img src="images/close2.png" class="close2" style="position:fixed; z-index:1005; margin:0 auto; left:300px; right:0;  top:180px; cursor:pointer;"/>

</div>

<div id="register_box" style="display:none;"><!-- reg-->

<div id="bg12" style="width:100%; position:absolute; z-index:1000; position:fixed; height:100%; background:black; opacity:0.7;">
</div>

<div style="width:1000px; height:100% auto;">
<div class="bg_wt" style="overflow:hidden; width:310px; border-radius:2px; background:red; margin:0 auto; text-align:center; left:0; right:0; margin-top:200px; position:fixed; z-index:1001; background:white;height:280px;">
<p style="font-family:Arial; font-size:18px; color:#939393; font-weight:bold; margin-top:30px;">REGISTER</p>
<div style="margin:0 auto; background-red width:300px; height:100% auto;">
<form method="POST" style="margin:0 auto; margin-top:30px;">
<input type="text" class="test" name="username" placeholder="USER" /><br/>
<input type="password" class="test" name="password" placeholder="PASSWORD" /><br />
<input type="email" class="test" name="email" placeholder="EMAIL" /><br />
<button name="reg" class="log">SIGN UP</button>
</form>
</div>
</div>
</div>
<img src="images/close2.png" class="close2" style="position:fixed; z-index:1005; margin:0 auto; left:300px; right:0;  top:180px; cursor:pointer;"/>

</div>


<div id="container">



<?php
    if(!isset($_GET['page']))
{

include("pages/home.php");

}else{
    


// ANT SQL INJECTION PREPARED STATEMENTS
    $sename = $_GET['page'];
$check_name = $connect->prepare("SELECT item_name FROM product WHERE id= ?");
$check_name->bind_param('s', $sename);
$check_name->execute();
$check_name->store_result();
$row_n = $check_name->num_rows;
$check_name->close();

 	$page = 'pages/'.$_GET['page'].'.php';
	if(file_exists($page))
	{
		include($page);

	}else if($row_n){

		include("pages/article.php");

	}else{
            
            include("pages/error.php");

	}
}

?>


</div>

<script>
$('.login').click( function() {

    $('#login_box').show();
});

$('.signup').click( function() {

    $('#register_box').show();
});

$('.close2').click( function() {

    $('#login_box').hide();
    $('#register_box').hide();
});

</script>


<?php 
if(isset($_POST['login']))
{
userconnect::login();
}

if(isset($_POST['reg']))
{
userconnect::register();
}

?>


</body>
</html>