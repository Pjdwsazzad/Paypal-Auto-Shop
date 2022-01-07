 <?php 

  if(isset($_SESSION['username'])){
  unset($_SESSION['id']);
  unset($_SESSION['product']);
  $user = $_SESSION['username'];
  $get_user = $connect->query("SELECT * FROM users WHERE username='$user'");
  $user_catch = $get_user->fetch_array(MYSQLI_ASSOC);

  include "includes/nav.php";

  if($user_catch['rank'] > 0){

  

?>

<!--MIDDLE-->
<div id="middle">
<div class="cc">
<div class="bx1">
<br />
<p STYLE="font-weight:bold; font-family:Arial; margin-left:0px; OPACITY:0.7;">ADD A NEW PRODUCT:</p><br />
<form method="POST">
<input type="text" name="itemname" placeholder="YOUR PRODUCT NAME" class="test"/><br />
<textarea type="text" name="details" placeholder="DETAILS OF THE ITEM YOU ARE SELLING" class="test1"></textarea><br />
<input type="text" name="link" placeholder="LINK TO THE ITEM IMAGE" class="test"/><br />
<input type="text" name="price" placeholder="price" class="test"/><br />
<button name="add" class="bt">ADD PRODUCT</button>
<?php 
if(isset($_POST['add']))
{

controlo::addProduct();

}
?>
</form>
<br />
</div>

</div>
</div>
<!--MIDDLE-->

<?php
}else{

echo '<meta http-equiv="refresh" content="0; url=/" />';


}


}else{
echo '<meta http-equiv="refresh" content="0; url=/" />';


}
?>