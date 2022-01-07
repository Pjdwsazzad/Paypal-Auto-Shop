<?php 
include "includes/nav.php";
if(isset($_SESSION['username']))
{
unset($_SESSION['id']);
unset($_SESSION['product']);
}
?>

<!--MIDDLE-->
<div id="middle">
 
<?php items::allItems(); ?>



</div>
<!--MIDDLE-->