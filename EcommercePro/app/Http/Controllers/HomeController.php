<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use Session;
use Stripe;

class HomeController extends Controller
{

    public function index()
    {
        $product = Product::paginate(10); // phan trang (x san pham)
        return view('home.userpage', compact('product'));
    }
    public function redirect()
    {

        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $product = Product::paginate(10); // phan trang (x san pham)
            return view('home.userpage', compact('product'));
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);

        return view('home.product_details', compact('product'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            // dd($user);
            $product = Product::find($id);
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back()->with('message', 'Đã thêm vào giỏ hàng.');
        } else { /*chưa đăng nhập*/
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get(); // vd: user_id = 1
            return view('home.show_cart', compact('cart'));
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        // dd($userid);
        $data = Cart::where('user_id', '=', $userid)->get();
        // dd($data);
        // nhieu mang nen phai dung loop
        foreach ($data as $item) {
            $order = new Order;
            $order->name = $item->name; // du lieu lay tu cart
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->user_id;
            $order->product_title = $item->product_title;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->image = $item->image;
            $order->product_id = $item->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();
            // order thi xoa ben cart
            $cart_id = $item->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
            // neu return trong loop thi insert 1 data thi back
        }
        //insert xong het roi back
        return redirect()->back()->with('message', 'Chúng tôi đã nhận đơn hàng của bạn. Đơn hàng sẽ được giải quyết nhanh thôi...');
    }
    public function stripe($total_price)
    {
        return view('home.stripe', compact('total_price'));
    }
    public function stripePost(Request $request, $total_price)
    {
        // dd($total_price);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total_price * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanh toán thành công!"
        ]);

        $user = Auth::user();
        $userid = $user->id;
        // dd($userid);
        $data = Cart::where('user_id', '=', $userid)->get();
        // dd($data);
        // nhieu mang nen phai dung loop
        foreach ($data as $item) {
            $order = new Order;
            $order->name = $item->name; // du lieu lay tu cart
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->user_id;
            $order->product_title = $item->product_title;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->image = $item->image;
            $order->product_id = $item->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();
            // order thi xoa ben cart
            $cart_id = $item->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
            // neu return trong loop thi insert 1 data thi back
        }

        Session::flash('success', 'Thanh toán thành công!');

        return back();
    }
}
