<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;

class AdminController extends Controller
{   
    // function clearCart()
    // {
    //     Cart::instance('cart')->destroy();
    
    //     return redirect()->back()->with('message', 'สินค้าทั้งหมดถูกลบออกจากตะกร้าเรียบร้อยแล้ว!');
    // }
    
    function checkout(Request $request){
        
        $subtotal = $request->input('subtotal');
        
        return view('checkout', compact('subtotal'));
    
    }

    function search(Request $request){
        
        $query = $request->input('NameSearch');
        
        // ทำการค้นหาตาม $query
        $results = Products::where('name', 'LIKE', "%{$query}%")->get();
        return view('search', compact('results', 'query'));
    
    }

    function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('message', 'Item removed from cart successfully!');
    }

    function addToCart(Request $request, $id)
    {   
        $product = Products::find($id);
        // / แสดงค่า ID ที่ได้รับ
        // dd([

        //     'id' => $id,
        //     'name' => $product->name, 
        //     'price' => $product->price, 
        //     'quantity' => $request->quantity, 
        // ]);
            
        // เพิ่มสินค้าในตะกร้า
        Cart::instance('cart')->add(
            $product->id,                    // ID สินค้า
            $product->name,                  // ชื่อสินค้า
            $request->quantity,              // จำนวนที่ส่งมา
            $product->price,                 // ราคาสินค้า
            [
                'image' => $product->image_products // ส่งข้อมูลภาพเป็นตัวเลือก
            ] 
        )->associate('App\Models\Product');
                
            return redirect()->back()->with('message', 'Success! Item has been added successfully!');
        }
        // Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $product->price)->associate('App\Models\Product');
    
        // return redirect()->back()->with('message', 'Success! Item has been added successfully!');
      


    function cart()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart', compact('cartItems'));
    }

    
    
    function addcart($id) {
        $products = Products::find($id);
        return view('addcart', compact('products'));
    }

    function pricerange($id, Request $request) {
        $category = Categories::find($id);
        $products = Products::all();
        
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        return view('pricerange', compact('products', 'category', 'min_price', 'max_price'));
        
    }

    function viewproduct($id) {
        $product = Products::find($id);
        return view('product', compact('product'));
    }

    function categories($id) {
        $products = Products::all();
        $category = Categories::find($id);
        return view('categories', compact('products', 'category'));
    }
    

    function welcome(){
        $categories = Categories::all();
        $products = Products::all();
        return view('welcome', compact('categories', 'products'));
    
    }

    function delete($id){
        Products::find($id)->delete();
        return redirect()->back();
    }

    function deletecategory($id){
        Categories::find($id)->delete();
        return redirect()->back();
    }

    

    function editcategory($id){
        $categories = Categories::find($id);
     
        return view('editcategory', compact('categories'));
    }


    function edit($id){
        $categories = Categories::all();
        $products=Products::find($id);
        return view('edit', compact('products', 'categories'));
    }
    
    function updatecategory(Request $request,$id){
        $request->validate(
            [
                'name'=>'required|max:50',
                'image_categories' => 'image|mimes:jpeg,png,jpg|max:2048' // เพิ่ม validation สำหรับไฟล์ภาพ
            ],

        );

        // อัปโหลดภาพ
        if ($request->hasFile('image_categories')) {
            // อัปโหลดภาพใหม่
            $imagePath = $request->file('image_categories')->store('categories', 'public');
        } else {
            // ใช้ภาพเดิม
            $imagePath = $request->input('old_image');
        }

        $data=[
            'name'=>$request->name,
            'image_categories'=> $imagePath,
        ];

        
        Categories::find($id)->update($data);
        return redirect('/manageAllproducts');
    }

    function update(Request $request,$id){
        $request->validate(
            [

                'name'=>'required|max:50',
                'description'=>'required|max:500',
                'price' => 'required|numeric', // ตรวจสอบให้แน่ใจว่า 'price' เป็นตัวเลข
                'image_products' => 'image|mimes:jpeg,png,jpg|max:2048', // เพิ่ม validation สำหรับไฟล์ภาพ
                'quantity' => 'required|integer', // ตรวจสอบให้แน่ใจว่า 'quantity' เป็นตัวเลขจำนวนเต็ม
                'category_id' => 'required|exists:categories,id' // ตรวจสอบว่า category_id มีอยู่ในตาราง categories

            ]
        );

        // อัปโหลดภาพ
        if ($request->hasFile('image_products')) {
            // อัปโหลดภาพใหม่
            $imagePath = $request->file('image_products')->store('products', 'public');
        } else {
            // ใช้ภาพเดิม
            $imagePath = $request->input('old_image');
        }
        
        $data = [
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image_products' => $imagePath, // เก็บที่อยู่ของภาพ
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
    ];

        Products::find($id)->update($data);
        return redirect('/manageAllproducts');
    }
    
    function manageAllproducts(){
        $products = Products::all(); 
        return view('manageAllproducts', compact('products'));
    
    }

    function Allproducts(){
        $products = Products::all(); // ดึงข้อมูลทั้งหมดจากตาราง products
        return view('Allproducts', compact('products')); // ส่งข้อมูลไปยัง View
    
    }
    

    function manageproducts(){
        $products = Products::all(); 
        $categories = Categories::all();
        return view('manageAllproducts', compact('products', 'categories')); 
        // return view('Allproducts');
    }

    
    function createproducts(){
        $categories = Categories::all();
        return view('form', compact('categories'));
    }

    function insertproducts(Request $request){
        $request->validate(
            [

                'name'=>'required|max:50',
                'description'=>'required|max:500',
                'price' => 'required|numeric', // ตรวจสอบให้แน่ใจว่า 'price' เป็นตัวเลข
                'image_products' => 'required|image|mimes:jpeg,png,jpg|max:2048', // เพิ่ม validation สำหรับไฟล์ภาพ
                'quantity' => 'required|integer', // ตรวจสอบให้แน่ใจว่า 'quantity' เป็นตัวเลขจำนวนเต็ม
                'category_id' => 'required|exists:categories,id' // ตรวจสอบว่า category_id มีอยู่ในตาราง categories

            
            ]
        );

        // อัปโหลดภาพ
        $imagePath = $request->file('image_products')->store('products', 'public');

        
        $data = [
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image_products' => $imagePath, // เก็บที่อยู่ของภาพ
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
    ];
        Products::insert($data);
        return redirect('/createproducts');
    }

    function createcategory(){
        return view('formcategories');
    }

    function insertcategory(Request $request){
        $request->validate(
            [
                'name'=>'required|max:50',
                'image_categories' => 'required|image|mimes:jpeg,png,jpg|max:2048' // เพิ่ม validation สำหรับไฟล์ภาพ
            ],

        );
        // อัปโหลดภาพ
        $imagePath = $request->file('image_categories')->store('categories', 'public');

        $data=[
            'name'=>$request->name,
            'image_categories'=> $imagePath,
        ];

        Categories::insert($data);
        return redirect('/createcategory');
    }

}
