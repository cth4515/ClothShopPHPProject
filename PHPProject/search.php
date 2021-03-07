<?php
session_start();
require_once ("Sql.php");
require_once ("site.php");
displayPageHeader("Search Page");
$category = getCategory();
if (isset($_POST['search'])) 
{
    $productname =  trim($_POST['productname']);
    $categoryPK = preg_replace("/[^0-9]/", '', $_POST['categorypk']);
    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('lastsearch', $productname, $expire);
}
elseif (isset($_COOKIE["lastsearch"])) {
     $productname =  $_COOKIE['lastsearch'];
}
else 
{
    $productname =  '';
    $categoryPK = '';
}
if (isset($_POST['search']) || isset($_COOKIE['lastsearch']))
{
    $results = getProductSearch($productname,$categoryPK);
    $resultsCount = count($results);
}
?>
<section>
    <div>
        <a href="product.php">View Product</a>
    </div>
    <form action="search.php" method = "post" >
        <label for="productname">Product Name:</label>
        <input type="text" name="productname" id ="productname" maxlength="50" autofocus pattern="^[a-zA-Z\s\-]*$" title="Only allow letters, spqce and hyphen" value="<?php echo $productname; ?>" />
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
        <p>
            <input type="submit" value="Search" name="search"/><br/>
        </p>
    </form>
</section>
    <?php
    
    if ((isset($_POST['search']) || isset($_COOKIE['lastsearch'])) && $resultsCount > 0)
{
    $counter = 0;

    $output = <<<ABC
    <table id="product">
      <tr>
ABC;
    foreach ($results as $aResult) {
        extract($aResult);
        $unitprice = number_format($unitprice,2,'.',',');
        $output .= <<<ABC
            <td>
                <a href="productdetail.php?productpk=$productpk">
                <img src="../Images/Product/$imagefile" width="450" height="550"><br/>
                <strong>  $productname  <strong> <br />
                </a>
                <i> \$$unitprice </i> <br />
            </td>
ABC;
       $counter ++;

        if ($counter === $resultsCount) {
            $output .= <<<ABC
                </tr> </table>
ABC;
        }
        elseif ($counter % 2 == 0) {
            $output .= <<<ABC
                </tr><tr>
ABC;
        }
    }

    echo $output;
    echo "</section>";
}

if((isset($_POST['search'])) && $resultsCount == 0) {
    header('Refresh: 4; URL=product.php');
    echo '<h2>The product you searched is not available. <br /> You will be redirected to our store in 4 seconds.</h2>';
    echo '<h2>If you are not redirected, please <a href="product.php">Click here to visit our Store</a>.</h2><br/>';
    die();
}
displayPageFooter();

    ?>
    