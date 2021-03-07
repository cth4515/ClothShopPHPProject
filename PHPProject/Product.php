<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once ("Sql.php");
require_once ('site.php');
displayPageHeader("Product");
$category = getCategory();
?>
<link href="styles.css" rel="stylesheet" type="text/css"/>
<link href="stylesProduct.css" rel="stylesheet"/>
<section>
    <form action="" method="post">
        <div class="sort"><div class="collection-sort"> 
        <label for="category">Category:</label>
        <select name="categorypk" id="category">
          <option value=""></option>
              <?php
                  foreach ($category as $aCategory)
                  {
                      extract($aCategory); 
                      echo '<option value="' . $categorypk .'">' . $productcategoryname . '</option>';
                  }
              ?>
       </select> 
            </div></div>
        <p>
       <input type="submit" name="submit" value="Please Select Category" id="select"/>
       </p>
    </form>
</section>
<?php
$categoryPK = $_POST['categorypk'];
$categoryPK = preg_replace("/[^0-9]/", '', $categoryPK);
$productList = getProductList($categoryPK);
$numProducts = count($productList);
$output = <<<ABC
       <div id="p-float">
            
ABC;
foreach ($productList as $product){
    extract($product);
    $productpk = urlencode(trim($productpk));
    $output .= <<<ABC
            <div class="p-float"><div class="p-float-in">   
                <input type="hidden" name="productpk" value =$productpk/>
                <a href="productdetail.php?productpk=$productpk">
                    <img src="../Images/Product/$imagefile" class="p-img"/>
                    <div class="p-name">$productname</div>
                </a>
             ​</div>​</div>
ABC;
}

$output .='​</div>' ;
echo $output;
displayPageFooter();
?>


