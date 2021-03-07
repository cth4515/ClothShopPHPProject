<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shopCart
 *
 * @author Tuan Cuong Huynh
 */
class shopCart {
    private $cartItems;
    public function  _construct(){
        $this->cartItems = array();
    }
    public function addCartItem($productID){
        
        if(is_array($this->cartItems) && !array_key_exists($productID, $this->cartItems)){
            $this->cartItems[$productID] = 1; 

        }
        else{
            $this->cartItems[$productID]++;
        }
    }
    public function getCartItems(){
         return $this->cartItems;
    }
    public function getQtyByProductID($productID){
        return $this->cartItems[$productID];
    }
    public function updateCartItem($productID, $orderQty){
        if((int)$orderQty === 0){
            $this->deleteCartItem($productID);
        }
        else{
            $this->cartItems[$productID] = (int)$orderQty;
        }
    }
    public function deleteCartItem($productID){
        unset($this->cartItems[$productID]);
    }
}
