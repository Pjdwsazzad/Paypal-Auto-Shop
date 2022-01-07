<?php if(isset($_GET['version'])) { echo '9.0.3.4'; } ?>

<!--NAV-->
<div id="nav">
 <div id="nav_wr">
  <a href="/"><div class="logo"><p style="font-size:30px; font-family:Arial; margin-top:12px; font-weight:bold;"> <?php echo"".$settings['admin']['title']."<font style='font-weight:normal;'>".$settings['admin']['titletwo']."</font>"; ?></p></div></a>
  <div class="button_wr">
   <form method="POST">
   <?php

     if(!isset($_SESSION['username'])){

    ?>
   <button onclick="return false" class="signup">SIGN UP</button>
   <button onclick="return false" class="login">LOG IN</button>
    <?php }else{ ?>
   <button name="panel" class="signup1">PANEL</button>
   <?php if(isset($_POST['panel'])){ echo '<meta http-equiv="refresh" content="0; url=/conta" />';} ?>
   <button name="logout"  class="login1">EXIT</button>
   <?php if(isset($_POST['logout'])){ echo '<meta http-equiv="refresh" content="0; url=/logout" />';} ?>
   <?php } ?>
   </form>
  </div>
</div>
</div>
<!--NAV-->
<?php
if(isset($_SESSION['username']))
{
  $user = $_SESSION['username'];
  $get_user = $connect->query("SELECT * FROM users WHERE username='$user'");
  $user_catch = $get_user->fetch_array(MYSQLI_ASSOC);






?>
<div id="subnav">
<div id="sn_wr">
<?php
if($user_catch['rank'] > 0){
?>
<a href="/addproduct" style="color:white;">
<div class="button_p">
<p style="margin-top:11px;">&nbsp;&nbsp;ADD PRODUCT&nbsp;&nbsp;</p>
</div>
</a>

<a href="/additem" style="color:white;">
<div class="button_p">
<p style="margin-top:11px;">&nbsp;&nbsp;ADD ITEM&nbsp;&nbsp;</p>
</div>
</a>

<a href="/manageproduct" style="color:white;">
<div class="button_p">
<p style="margin-top:11px;">&nbsp;&nbsp;MANAGE PRODUCTS&nbsp;&nbsp;</p>
</div>
</a>

<?php
}
?>

<!--<a href="/mypurchases" style="color:white;">
<div class="button_p">
<p style="margin-top:11px;">&nbsp;&nbsp;MY PURCHASES&nbsp;&nbsp;</p>
</div>
</a>-->

</div>
</div>

<?php
}
?>