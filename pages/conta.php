 <?php 

  if(isset($_SESSION['username'])){

unset($_SESSION['id']);
unset($_SESSION['product']);

  include "includes/nav.php";


  

?>





<!--MIDDLE-->
<div id="middle">
<div class="cc">
<div class="bx1">
<br />
<p STYLE="font-weight:bold; font-family:Arial; margin-left:0px; OPACITY:0.7;">EDIT ACCOUNT SETTINGS:</p><br />
<form method="POST">
<input type="text" name="pass" placeholder="YOUR OLD PASSWORD" class="test"/><br />
<input type="text" name="repass" placeholder="YOUR NEW PASSWORD" class="test"/><br />
<button name="change" class="bt">CHANGE</button>
</form>
<br />
</div>

</div>
</div>
<!--MIDDLE-->


<?php
if(isset($_POST['change']))
{
 controlo::changePassword();	
}


}else{
	
	echo '<meta http-equiv="refresh" content="0; url=/" />';

}
?>