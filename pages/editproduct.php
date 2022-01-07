 <?php 

 if((isset($_SESSION['username'])) && (isset($_SESSION['product']))){

  unset($_SESSION['id']);

  $pro = $_SESSION['product'];

  $user = $_SESSION['username'];

  $get_product = $connect->query("SELECT * FROM product WHERE id='$pro'");
  $pro_catch = $get_product->fetch_array(MYSQLI_ASSOC);

  include "includes/nav.php";

  if($user_catch['rank'] > 0){

  

?>

<!--MIDDLE-->
<div id="middle">
<div class="cc">
<div class="bx1">
<br />
<p STYLE="font-weight:bold; font-family:Arial; margin-left:0px; OPACITY:0.7;">PRODUCT: <?php echo"".$_SESSION['product'].""; ?> </p><br />
<form method="POST">
<input type="text" name="itemname" value="<?php echo"".$pro_catch['item_name'].""; ?>" class="test"/><br />
<textarea type="text" name="details" placeholder="<?php echo"".$pro_catch['item_desc'].""; ?>" class="test1"></textarea><br />
<input type="text" name="link" value="<?php echo"".$pro_catch['item_image'].""; ?>" class="test"/><br />
<input type="text" name="price" placeholder="<?php echo"".$pro_catch['price']."$"; ?>" class="test"/><br />
<button name="edit" class="bt">EDIT PRODUCT</button>
<?php 
if(isset($_POST['edit']))
{

controlo::editItem();

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