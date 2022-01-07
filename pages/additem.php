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
<p STYLE="font-weight:bold; font-family:Arial; margin-left:0px; OPACITY:0.7;">ADD A NEW ITEM:</p><br />
<form method="POST">
<select class="test" name="product_name">
<?php 
$getproduct = $connect->query("SELECT id,item_name FROM product");
while($fetch_s = $getproduct->fetch_array(MYSQLI_ASSOC))
{
echo'<option value="'.$fetch_s['id'].'">'.$fetch_s['item_name'].'</option>';
}
?>
</select>
<br />
<textarea type="text" name="details" placeholder="KEY OR ACCOUNT DETAILS HERE" class="test1"></textarea><br />

<button name="add" class="bt">ADD ITEM</button>
<?php 
if(isset($_POST['add']))
{

controlo::addItem();

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