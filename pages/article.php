 <?php 



  $item_id = $connect->real_escape_string($_GET['page']);
  $get_item = $connect->query("SELECT * FROM product WHERE id='$item_id'");
  $item_catch = $get_item->fetch_array(MYSQLI_ASSOC);
  unset($_SESSION['product']);
include "includes/nav.php";
?>



<!--MIDDLE-->
<div id="middle">
 
 <?php 

  if(isset($_SESSION['username'])){
  $_SESSION['id'] = $item_id;	
 ?> 
 <!--ARTICLE-->
 <div id="artigo_comprar">
 <div class="imgda" style="float:left; width:230px; height:100%;">
 <img src="<?php echo"".$item_catch['item_image']."";?>" width="230px" style="position:relative;" height="300"/>
 <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="margin-left:32px;" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo"".$settings['admin']['paypal'].""; ?>">
<input type="hidden" name="lc" value="PT">
<input type="hidden" name="item_name" value="account">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="amount" value="<?php echo"".$item_catch['price']."";?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</div>
 <div class="desc">
 <p>
 <?php echo"".$item_catch['item_desc']."";?>
 </p>
 <br />
 <p style="font-weight:bold;">PRICE: <font style="font-weight:normal;"> <?php echo"".$item_catch['price']."";?>$</font></p><BR />
 <p style="font-weight:bold;">STOCK: <font style="font-weight:normal;"> <?php echo"".$item_catch['stock']."";?></font></p>

 </div>
 </div>
 <!--ARTICLE-->
 <?php }else{ ?>

 <p style="font-family:Arial; color:white; margin-top:50px; font-weight:bold;">YOU MUST BE LOGGED IN TO SEE CONTENT.</p>

 <?php } ?>



</div>
<!--MIDDLE-->
