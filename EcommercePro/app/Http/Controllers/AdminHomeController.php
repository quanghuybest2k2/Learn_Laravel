<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use PDF;

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
    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Đã xóa sản phẩm thành công!');
    }
    public function update_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category'));
    }
    public function update_product_confirm(Request $request, $id)
    {
        # code...
        $product = Product::find($id);
        $product->title = $request->title; // col title trong mysql = name="title" ben view
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        // xu ly hinh anh
        $image = $request->image;
        // kiem tra xem co ton tai chua
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension(); //return current time không trùng tên
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Cập nhật sản phẩm thành công.');
    }
    // order in admin
    public function order()
    {
        $order = Order::all();
        return view('admin.order', compact('order'));
    }
    // update delivered and payment status
    public function delivered($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }
    // print pdf
    // cần vào php.ini bỏ (;) extension=gd, sau đó khởi động lại php server và xampp
    public function print_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        // dung mPDF có hổ trở tiếng việt
        // stream: xem truoc (ko tải xuống)
        // return $pdf->stream('order_details.pdf');
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id)
    {
        $order = Order::find($id);
        return view('admin.email_info', compact('order'));
    }
    //send_user_email
    public function send_user_email(Request $request, $id)
    {
        $order = Order::find($id);
        $details = [
            'greeting' => $request->greeting, //lay data ben view (email_info)
            'firstline' => $request->firstline,
            'body' => $request->body, // 'body' => 'viết theo mặc định cũng được, khỏi nhập mất công',
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }
}
