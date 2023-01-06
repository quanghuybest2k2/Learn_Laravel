<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class AdminHomeController extends Controller
{
    // hien thi category
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }
    // them
    public function add_category(Request $request)
    {
        $data = new Category; // khoi tao khong tham so
        $data->category_name = $request->category; // lay col cat_name = name"category" ben view
        $data->save();
        return redirect()->back()->with('message', 'Thêm loại thành công.');
    }
    // xoa
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Đã xóa loại thành công!');
    }
    // hien thi products
    public function view_product()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }
    // them product
    public function add_product(Request $request)
    {
        $product = new Product; // khoi tao khong tham so
        $product->title = $request->title; // col title trong mysql = name="title" ben view
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        // xu ly hinh anh
        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension(); //return current time không trùng tên
        $request->image->move('product', $imagename);
        $product->image = $imagename;
        $product->save();
        return redirect()->back()->with('message', 'Thêm sản phẩm thành công.');
    }
    public function show_product()
    {
        $product = Product::all();
        return view('admin.show_product', compact('product'));
    }
}
