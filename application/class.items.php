<?php
class items{

public static function allItems(){

global $connect;

$get_item = $connect->query("SELECT id,item_image,price,stock FROM product ORDER BY id DESC");
$row_this = $get_item->num_rows;

if($row_this)
{

while($item_fetch = $get_item->fetch_array(MYSQLI_ASSOC)){

echo '
 <!--ARTICLE-->
 <div id="artigo">
 <img src="'.$item_fetch['item_image'].'" width="230px" style="position:relative;" height="300"/>
 <div id="inform">
 <div class="price"><p style="margin-top:2px;">&nbsp;PRICE: '.$item_fetch['price'].'$&nbsp;</p></div>
<div class="price"><p style="margin-top:2px;">&nbsp;STOCK: '.$item_fetch['stock'].'&nbsp;</p></div>
 </div>
 <form  action="/'.$item_fetch['id'].'" method="POST">
 <button name="buy"  class="buy">BUY NOW</button>
 </form>
 </div>
 <!--ARTICLE-->
';


}

}


}
}