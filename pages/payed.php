<div id="middle">

<?php
$username = $_SESSION['username'];




$get_user = $connect->query("SELECT * FROM users WHERE username= '$username'")or die(mysqli_error($connect));
$fetch_user = $get_user->fetch_array(MYSQLI_ASSOC);
 
$email = $fetch_user['email'];
$itm_id = $_SESSION['id'];

$get_item = $connect->query("SELECT * FROM items WHERE product_id = '$itm_id'") or die(mysqli_error($connect));
$fetch_item = $get_item->fetch_array(MYSQLI_ASSOC);

 
$to      =  $email;
$subject = 'GAME CREDENTIALS ';
$message = '
 
Thank you for your purchase
 
Your account information
-------------------------
'.$fetch_item['details'].'
-------------------------
';

$headers = 'From:noreply@yourdomain.com' . "\r\n";
 
mail($to, $subject, $message, $headers);	
$connect->query("DELETE * FROM items WHERE id='$itm_id'");
$connect->query("UPDATE product SET stock = stock -1 WHERE id = '$itm_id'")or die(mysqli_error($connect));
$connect->query("UPDATE product SET sold = sold +1 WHERE id = '$itm_id'")or die(mysqli_error($connect));

echo '<meta http-equiv="refresh" content="0; url=/" />';
?>
</div>


