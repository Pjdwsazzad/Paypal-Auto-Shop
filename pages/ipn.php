<?php



// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
 
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
 
 
if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
 
// PAYMENT VALIDATED & VERIFIED!

$get_user = $connect->query("SELECT * FROM users WHERE username= '$_SESSION['username']'");
$fetch_user = $get_user->fetch_array(MYSQLI_ASSOC);
 
$email = $fetch_user['email'];
$itm_id = $_SESSION['id'];

$get_item = $connect->query("SELECT * FROM items WHERE id= '$itm_id'");
$fetch_item = $get_item->fetch_array(MYSQLI_ASSOC);

$pid= $fetch_item['product_id'];
 
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
$connect->query("UPDATE product SET stock = stock -1 WHERE id = '$pid");
$connect->query("UPDATE product SET sold = sold +1 WHERE id = '$pid");
 
}
 
else if (strcmp ($res, "INVALID") == 0) {
 
// PAYMENT INVALID & INVESTIGATE MANUALY!
 $user = $_SESSION['username'];
$to      = $fetch_user['email'];
$subject = 'GAME CREDENTIALS ';
$message = '
 
Dear '.$user.',
 
A payment has been made but is flagged as INVALID.
Please verify the payment manualy and contact the buyer.
';
$headers = 'From:noreply@yourdomain.com' . "\r\n";
 
mail($to, $subject, $message, $headers);
}
}
fclose ($fp);
}