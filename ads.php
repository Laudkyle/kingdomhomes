<?php

function ads($id, $label, $price, $image){
    $element = "
                <form action=\"product-details.php\" method=\"post\">
            <div class='col-4'><img src='images/$image' >
		<h3>$label</h3>
		  <p>GH&#8373 $price.00</p>
          <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"view\">View Details</button>
          <input type='hidden' name='productid' value='$id'></div>
                </form>
    ";
    echo "$element";
}

function ads_related($id, $label, $price, $image_related){
    $element_related = "
                <form action=\"product-details.php\" method=\"post\">
            <div class='col-4'><img src='images/$image_related' >
		<h3>$label</h3>
		  <p>GH&#8373 $price.00</p>
          <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"view\">View Details</button>
          <input type='hidden' name='productid' value='$id'></div>
                </form>
    ";
    echo "$element_related";
}









