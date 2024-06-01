<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Size;
use App\Models\Product;
use App\Models\Characteristics;
use App\Models\Local;
use App\Models\ImportGoods;
use Illuminate\Support\Facades\Log;

class AddListProductController extends Controller
{
    public function indexAddListProduct()
    {
        $dataListPro = Product::all();
        $listCate = Category::all();
        $listMenu = Menu::all();
        $listSize = Size::all();
        $listLocals = Local::all();

        return view('manage.hanghoa.themdssanpham', compact('dataListPro', 'listCate', 'listMenu', 'listSize', 'listLocals'));
    }

    public function addProduct(Request $request)
    {
        $productList = json_decode($request->input('products'), true);

        foreach ($productList as $productData) {
            $product = new Product();
            $product->name = $productData['name'];
            $product->code = $productData['code'];
            $product->price = $productData['price'];
            $product->quantity = $productData['quantity'];
            $product->size_id = $productData['size'];
            $product->category_id = $productData['category'];
            $product->local_id = $productData['local'];
            $product->menu_id = $productData['menu'];
            $product->description = $productData['description'];

            if (isset($productData['image'])) {
                // Handle file upload
                $file = $productData['image'];
                $filePath = $file->store('images', 'public');
                $product->image = $filePath;
            }

            try {
                $product->save();
            } catch (\Exception $e) {
                Log::error('Error saving product: ' . $e->getMessage());
                return response()->json(['message' => 'Error saving product'], 500);
            }
        }

        return response()->json(['message' => 'Products added successfully']);
    }
}
