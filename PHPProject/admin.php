
<link href="styles.css" rel="stylesheet" type="text/css"/>

<?php

session_start();
require_once ("sql.php");
require_once ("logincheck.php");


if ($_SESSION['userInfo']['role'] != 'Admin')
{
    header('refresh: 2; URL=home.php');
    echo '<h2>Sorry, you are not authorized to view this page.</h2>';
    die();
}
require_once ("site.php");
displayPageHeader("Admin Page");

$productList = getProduct(); 
$output = <<<HTML
<section>
   <section>
   <h2>Welcome back {$_SESSION['userInfo']['firstname']}</h2>
   </section>   
   <table id="allProducts">
HTML;

foreach ($productList as $product)
{
    extract($product);
    $output .= <<<HTML
    <tr>
        <td>
            $productname
        </td>
        <td>
            <a href="edit.php?productpk=$productpk">[Edit]</a>
        </td>
        <td>
            <a href="delete.php?productpk=$productpk" onclick="return confirm('Do you want to delete?')">[Delete]</a>
        </td>
    </tr>
HTML;
}

$output .= <<<HTML
    <tr>
        <td colspan="3" align="center">
            <a href="edit.php">[Add a Product]</a>
        </td>
    </tr>
</table></section>
HTML;

echo $output;
displayPageFooter();
?>

