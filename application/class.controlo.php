<?php

class controlo{

public static function addProduct(){

 global $connect;

 $name = $_POST['itemname'];
 $details = $_POST['details'];
 $link = $_POST['link'];
 $price = $_POST['price'];
 $stock = 0;
 $sold = 0;

 $additem = $connect->prepare("INSERT INTO product (item_name,item_image,item_desc,price,stock,sold) VALUES(?, ?, ?, ?, ?, ?)");
 $additem->bind_param('ssssii', $name,$link,$details,$price,$stock,$sold);
 $additem->execute();

echo"<script>alert('Your product was added successfully.');</script>";


}

public static function addItem(){

 global $connect;

 $name = $_POST['product_name'];
 $details = $_POST['details'];
 $stock = 1;

 $additem = $connect->prepare("INSERT INTO items (product_id,details) VALUES(?, ?)");
 $additem->bind_param('is', $name,$details);
 $additem->execute();

 $addstock = $connect->prepare("UPDATE product SET stock = stock + ? WHERE id = ? ");
 $addstock->bind_param('is', $stock,$name);
 $addstock->execute();
 
  echo"<script>alert('Your item was added successfully.');</script>";



}

public static function changePassword(){

 global $connect;

$pass = sha1($_POST['pass']);
$repass = sha1($_POST['repass']);
 
$check_usr_pw = $connect->prepare("SELECT password FROM users WHERE username = ?");
$check_usr_pw->bind_param("s", $username);
$check_usr_pw->execute();

$check_usr_pw->store_result();

$check_usr_pw->bind_result($password);




if($pass == $password){


 $addstock = $connect->prepare("UPDATE users SET password = ? ");
 $addstock->bind_param('s', $repass);
 $addstock->execute();

 echo"<script>alert('Your password was changed successfully.');</script>";

}else{

echo"<script>alert('Your password does not match.');</script>";

}





}

public static function manageItem(){

global $connect;

$get_item = $connect->query("SELECT id,item_name,item_image,price,stock,sold FROM product ORDER BY id ");
$row_this = $get_item->num_rows;



if($row_this)
{

while($item_fetch = $get_item->fetch_array(MYSQLI_ASSOC)){

echo '
 <!--ITEM-->
<div class="boxwr1" style="margin:0 auto; width:1100px; margin-top:4px; overflow:hidden; height:100% auto;  text-align:left; ">

<div class="divdkj" style="width:62px; float:left; height:18px;">
<input type="checkbox" style="margin-left:20px;" name="selected" value="'.$item_fetch['id'].'"><br/>
</div>

<div class="divdkj" style="width:90px;  text-align:center; float:left; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial; font-size:14px; margin-left:0px; OPACITY:0.5;">'.$item_fetch['id'].'</p>
</div>

<div class="divdkj" style="width:115px; text-align:center; float:left;  margin-left:75px; word-wrap:break-word; height:100% auto;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">'.$item_fetch['item_name'].'</p>
</div>

<div class="divdkj" style="width:43px; text-align:center; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">'.$item_fetch['price'].'$</p>
</div>

<div class="divdkj" style="width:60px; text-align:center; float:left; margin-left:78px; height:18px;">
<img src="'.$item_fetch['item_image'].'" width="18px" height="18px" />
</div>

<div class="divdkj" style="width:50px; text-align:center; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">'.$item_fetch['stock'].'</p>
</div>

<div class="divdkj" style="width:40px; text-align:center; float:left; margin-left:80px; height:18px;">
<p STYLE="font-weight:bold; font-family:Arial;  font-size:14px; margin-left:0px; OPACITY:0.5;">'.$item_fetch['sold'].'</p>
</div>

<div class="divdkj" style="width:30px;  float:left; text-align:center;  margin-left:77px; height:18px;">
<button style="background:url(images/icon2.png); width:18px; cursor:pointer; height:18px;" name="edit"></button>
</div>

<div class="divdkj" style="width:55px; float:left;  text-align:center; margin-left:80px; height:18px;">
<button style="background:url(images/icon3.png); cursor:pointer; width:18px; height:18px;" name="delete"></button>
</div>

</div>

 <!--ITEM-->
';

if(isset($_POST['delete'])){



if(isset($_POST['selected']))
{

$id_p = $_POST['selected'];	

$delete = $connect->prepare("DELETE FROM product WHERE id =  ? ");
$delete->bind_param("s", $id_p);
$delete->execute();
$delete->close();

echo "<script>alert('Product was deleted successfully');</script>";
echo '<meta http-equiv="refresh" content="2; url=/" />';


}else{

echo "<script>alert('You must select a product.');</script>";

}
}

if(isset($_POST['edit']))
{

if(isset($_POST['selected']))
{

$id_p = $_POST['selected'];	

$_SESSION['product'] = $_POST['selected'];
echo '<meta http-equiv="refresh" content="0; url=/editproduct" />';	
}else{
echo "<script>alert('You must select a product.');</script>";	
}


}




}

}

}

public static function editItem(){

 global $connect;
 
 if(isset($_SESSION['product']))
 {
 $idd = $_SESSION['product'];
 $name = $_POST['itemname'];
 $details = $_POST['details'];
 $link = $_POST['link'];
 $price = $_POST['price'];

  $connect->query("UPDATE product SET item_name = '$name' WHERE id = '$idd' ") or die(mysqli_error($connect));
 $connect->query("UPDATE product SET item_image = '$link' WHERE id = '$idd' ") or die(mysqli_error($connect));
  $connect->query("UPDATE product SET item_desc = '$details' WHERE id = '$idd' ") or die(mysqli_error($connect));
   $connect->query("UPDATE product SET price = '$price' WHERE id = '$idd' ") or die(mysqli_error($connect));
 
  echo"<script>alert('Your item was edited successfully.');</script>";
  echo '<meta http-equiv="refresh" content="1; url=/" />';





}else{
	echo"<script>alert('You need to select a product.');</script>";
	echo '<meta http-equiv="refresh" content="1; url=/" />';
}

}



}