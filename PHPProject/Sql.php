<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("dbConnExec.php");
function getCategory(){
     $query = <<<STR
Select categorypk, productcategoryname
From tblCategory
Order by categorypk
STR;

    return executeQuery($query);
}
function getProductList($categoryPK){
    $query = <<<STR
Select productpk, productname, imagefile
From tblProduct 
Where categoryfk = '$categoryPK'
STR;
return executeQuery($query);
}
function getProductDetails($productPK){
    $query = <<<STR
Select productpk, productname, productdescription, unitprice, color, imagefile, size, categoryfk, productcategoryname, onhand
From tblproduct inner join tblcategory on categoryfk = categorypk
Where productpk = $productPK
STR;

    return executeQuery($query);
}
function getProductInCart($productPKs)
{
    $query = <<<STR
Select productpk, productname, unitprice
From tblproduct
Where productpk in ($productPKs)
STR;

    return executeQuery($query);
}

function getProductSearch($productname,$categoryPK){
    $query = <<<STR
Select productpk, productname, imagefile, unitprice
From tblproduct
Where 0=0
STR;
    if ($productname != '')
    {
        $query .= <<<STR
        And productname like '%$productname%'
STR;
    }
    if ($categoryPK != '')
    {
        $query .= <<<STR
        And categoryfk = $categoryPK
STR;
    }
    $query .= <<<STR
        Order by productname
STR;
   return executeQuery($query);

}
function findDuplicateUser($userName)
{
    $query = <<<STR
Select userName
From tblUser
Where userName = '$userName'
STR;

return executeQuery($query);
}
function addCustomer($userName, $userPassword, $firstName, $lastName, $role, $eMail, $phone)
{
    $query = <<<STR
Insert Into tblUser(username, userpassword, firstname, lastname, role, email, phone)
Values('$userName','$userPassword','$firstName','$lastName', '$role','$eMail','$phone')
STR;

    executeQuery($query);
}

function getUser($userName, $userPassword){
    $query = <<<STR
Select userpk, firstname, role, username
From tbluser 
Where username = '$userName'
and userpassword = '$userPassword'
STR;

return executeQuery($query);
}
function getUserDetailsByID($userPK)
{
   $query = <<<STR
Select userpk, username, userpassword, firstname, lastname, role, email, phone
From tbluser
Where userpk = $userPK
STR;
    
    return executeQuery($query);
}
function updateUser($userpk, $userpassword, $email, $phone)
{
    $username = str_replace('\'', '\'\'', trim($username));
    $userpassword = str_replace('\'', '\'\'', trim($userpassword));
    $email = str_replace('\'', '\'\'',trim($email));
    $phone = str_replace('\'', '\'\'',trim($phone));

    $query = <<<STR
Update tbluser
Set userpassword = '$userpassword', email = '$email', phone = '$phone'
Where userpk = $userpk
STR;

    executeQuery($query);
}
function getProduct(){
    $query = <<<STR
Select productpk, productname
From tblproduct
Order by productname
STR;
    
    return executeQuery($query);
}
function deleteProduct($productpk)
{
    $query = <<<STR
Delete
From tblproduct
Where productpk = $productpk
STR;

    executeQuery($query);
}

function updateProduct($productpk,$categoryfk, $productname, $productdescription, $unitprice, $onhand, $imagefile, $size, $color){
    $productname = str_replace('\'', '\'\'', trim($productname));
    $size = str_replace('\'', '\'\'', trim($size));
    $color = str_replace('\'', '\'\'', trim($color));
    $productdescription = str_replace('\'', '\'\'',trim($productdescription));
    $imagefile = trim($imagefile);
    $query = <<<STR
Update tblproduct
Set categoryfk = $categoryfk,  productname = '$productname', productdescription = '$productdescription', unitprice = $unitprice, onhand = $onhand,
imagefile = '$imagefile', size = '$size', color = '$color'
Where productpk = $productpk
STR;

    executeQuery($query);
}

function addProduct($categoryfk, $productname, $productdescription, $unitprice, $onhand, $imagefile, $size, $color){
    
    $productname = str_replace('\'', '\'\'', trim($productname));
    $size = str_replace('\'', '\'\'', trim($size));
    $color = str_replace('\'', '\'\'', trim($color));
    $productdescription = str_replace('\'', '\'\'',trim($productdescription));
    $imagefile = trim($imagefile);
    
    $query = <<<STR
Insert Into tblproduct(categoryfk, productname,productdescription,unitprice,onhand,imagefile,size,color)
Values($categoryfk,'$productname','$productdescription',$unitprice,$onhand,'$imagefile','$size', '$color')
STR;

    executeQuery($query);
}

function insertOrder($userFK,$street,$city,$state,$zip)
{
    $query = <<<STR
Insert into tblorder(userfk,shipstreet,shipcity,shipstate,shipzip) 
Values ($userFK,'$street','$city','$state','$zip');
Select SCOPE_IDENTITY() As newOrderID;
STR;

    return executeQuery($query);
}

function insertOrderItem($orderFK, $productFK, $orderQty)
{
    $query = <<<STR
Insert into tblorderline(OrderFK, ProductFK, OrderQuantity)
Values ($orderFK, $productFK, $orderQty)
STR;

    executeQuery($query);
}


//function insertOrder($userFK,$street,$city,$state,$zip)
//{
//    $query = <<<STR
//Insert into tblorder(userfk,shipstreet,shipcity,shipstate,shipzip) Values ($userFK,'$street','$city','$state','$zip')
//STR;
//
//    return executeQuery($query);
//}
//function getOrder(){
//     $query = <<<STR
//SELECT TOP 1 orderpk FROM tblorder ORDER BY orderpk DESC
//
//STR;
//
//    return executeQuery($query);
//}
//
//
//function insertOrderItem($orderFK, $productFK, $orderQty){
//    $query = <<<STR
//Insert into tblorderline(OrderFK, ProductFK, OrderQuantity)
//Values ($orderFK, $productFK, $orderQty);
//STR;
//    return executeQuery($query);
//}
?>