<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class AdminHomeController extends Controller
{
    // hien thi
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
}
