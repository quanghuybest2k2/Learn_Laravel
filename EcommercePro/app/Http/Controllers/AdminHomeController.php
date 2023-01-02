<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class AdminHomeController extends Controller
{
    //
    public function view_category()
    {
        return view('admin.category');
    }
    public function add_category(Request $request)
    {
        $data = new category(); // category(lowercase)
        $data->category_name = $request->category; // lay col cat_name = name"category" ben view
        $data->save();
        return redirect()->back()->with('message', 'Thêm loại thành công.');
    }
}
