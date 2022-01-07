 <?php 

  if(isset($_SESSION['username'])){
  unset($_SESSION['id']);
  $user = $_SESSION['username'];
  $get_user = $connect->query("SELECT * FROM users WHERE username='$user'");
  $user_catch = $get_user->fetch_array(MYSQLI_ASSOC);

  include "includes/nav.php";

  if($user_catch['rank'] > 0){

  

?>

<!--MIDDLE-->
<div id="middle">
<div class="cc" style="width:1200px;">
<div class="bx1">
<br />
<p STYLE="font-weight:bold; font-family:Arial; margin-left:0px; OPACITY:0.7;">MANAGE YOUR PRODUCTS:</p><br />
<div class="boxwr" style="margin:0 auto; width:1100px; overflow:hidden; height:18px;  text-align:left; ">

<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('selected');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<form method="POST">
<div class="divdkj" style="width:62px; float:left; height:18px;">
<input type="checkbox" style="margin-left:20px;" onClick="toggle(this)"><br/>
</div>

<div class="divdkj" style="width:100% auto; float:left; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial; font-size:14px; margin-left:0px; OPACITY:0.5;">PRODUCT ID</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">PRODUCT NAME</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">PRICE</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">PICTURE</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">STOCK</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">SOLD</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">EDIT</p>
</div>

<div class="divdkj" style="width:100% auto; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">DELETE</p>
</div>

</div>

<div class="box1" style="margin:0 auto;width:1100px; margin-top:1px;height:1px; background:black; opacity:0.3;"></div>



<?php 

controlo::manageItem();

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