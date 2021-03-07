<link href="styles.css" rel="stylesheet" type="text/css"/>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("Sql.php");
$editmode = false;

if ((isset($_GET['productpk'])) && (is_numeric($_GET['productpk'])))
{
    $productdetails = getProductDetails((int)$_GET['productpk']);
        
    $editmode = (count($productdetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
   extract($productdetails[0]);

    $formtitle = 'Update a Product';
    $buttontext = 'Update';
 }
else  
{
    $productname = '';
    $productdescription = '';
    $unitprice = '';
    $onhand = '';
    $imagefile = '';
    $size = '';
    $color = '';
    
    $formtitle = 'Add a Product';
    $buttontext = 'Insert';
}
?>


<form name ="addEditForm" id="addEditForm" action="editproduct.php" method="post">
<?php
    if ($editmode)  
    {
        echo '<input type="hidden" name="productpk" value="' . $productpk . '" />';
    }
?>

   <label for="productname">Product Name:</label>   
   <input type="text" name="productname" id="productname" maxlength="50" value="<?php echo $productname; ?>" autofocus required pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Product name has invalid characters" />
   <label for="productdescription">Product Description:</label>
   <textarea name="productdescription" id="productdescription" wrap="soft" onfocus="this.select()"><?php echo $productdescription; ?></textarea>
   <label for="unitprice">Unit Price:</label>        
   <input type="number" name="unitprice" id="unitprice" maxlength="4" class="sm" value="<?php echo $unitprice; ?>" required min="1" max="1000" />
   <label for="onhand">On Hand:</label>        
   <input type="number" name="onhand" id="onhand" maxlength="7" class="sm" value="<?php echo $onhand; ?>" required min="0" max="9999999" />
    <label for="imagefile">Image File:</label>         
   <input type="text" name="imagefile" id="imagefile" class="sm" maxlength="50" value="<?php echo $imagefile ?>" pattern="^\w+\.\w{3,5}$" title="Invalid file name" onfocus="this.select()" />
   <label for="size">Size:</label>   
   <input type="text" name="size" id="size" maxlength="3" value="<?php echo $size; ?>" autofocus required pattern="^[a-zA-Z]]$" title="Size has invalid characters" />
   <label for="color">Color:</label>   
   <input type="text" name="color" id="color" maxlength="20" value="<?php echo $color; ?>" autofocus required title="Color has invalid characters" />
   <label for="category">Category:</label>
   <select name="categorypk" id="category">
       <?php
         $categoryList = getCategory(); 
         foreach ($categoryList as $category)
         {
            extract($category);
            if ($categorypk == $categoryfk)
            {
               $output .= <<<HTML
                            <option value="$categorypk" selected>$productcategoryname</option>
HTML;
            }
            else
            {
               $output .= <<<HTML
                        <option value="$categorypk">$productcategoryname</option>
HTML;
            }

         }
         echo $output;
      ?>
   </select>
   <p>
      <input type="submit" value="<?php echo $buttontext ?>" />
      <a href="admin.php">Cancel</a>
    </p> 
</form>
 
  