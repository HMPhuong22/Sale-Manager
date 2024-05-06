<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Sell 
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuatity = 0;

    public function __construct($sell){
        if($sell){
            $this->products = $sell->products;
            $this->totalPrice = $sell->totalPrice;
            $this->totalQuatity = $sell->totalQuatity;
        }
    }

    // thêm sản phẩm vào hóa đơn bán hàng
    public function addSell($product, $id){
        // tạo mảng thành phần
        $newProduct = [
            'quanty' => 0,
            'gia' => $product->gia,
            'productInf' => $product
        ];

        // kiếm tra sản phẩm tồn tại
        if($this->products){
            if(array_key_exists($id, $this->products)){
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quanty']++;
        $newProduct['gia'] = $newProduct['quanty'] * $product->gia;
        
        // cập nhật lại thông tin hóa đơn
        $this->products[$id] = $newProduct;
        $this->totalPrice += $product->gia;
        $this->totalQuatity++;
    }

    // Xóa sản phẩm trong hóa đơn
    public function deleteItemSell($id){
        $this->totalQuatity -= $this->products[$id]['quanty'];
        $this->totalPrice -= $this->products[$id]['gia'];
        unset($this->products[$id]);
    }
}
 