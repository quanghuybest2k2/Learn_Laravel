<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Reply;
use Session;
use Stripe;

class HomeController extends Controller
{

    public function index()
    {
        $product = Product::paginate(10); // phan trang (x san pham)
        $comment  = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view('home.userpage', compact('product', 'comment', 'reply'));
    }
    /**
     * The above function is used to redirect the user to the appropriate page based on their user
     * type.
     */
    public function redirect()
    {

        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_product = Product::all()->count(); // dem so luong san pham
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach ($order as $item) {
                $total_revenue += $item->price; // tổng doanh thu
            }
            // đếm tổng đơn đã vận chuyển thành công
            $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $product = Product::paginate(10); // phan trang (hiển thị 10 san pham)
            $comment  = Comment::orderby('id', 'desc')->get();
            $reply  = Reply::all();
            return view('home.userpage', compact('product', 'comment', 'reply'));
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
    /**
     * It checks if the user is logged in, if so, it gets the user's id, then it gets all the orders
     * that have the user's id, and then it returns the view
     * 
     * @return The user's order history is being returned.
     */
    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $order = Order::where('user_id', '=', $userid)->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }
    /**
     * Cancel order
     * 
     * @param id The id of the order you want to cancel.
     */
    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Bạn đã hủy đơn hàng';
        $order->save();
        return redirect()->back();
    }
    /**
     * If the user is logged in, create a new comment, set the name to the user's name, set the user_id
     * to the user's id, set the comment to the comment from the form, and save the comment
     * 
     * @param Request request The request object.
     */
    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment  = new Comment;
            $comment->name = Auth::user()->name; // lay ten user
            $comment->user_id = Auth::user()->id; // lay id user
            $comment->comment = $request->comment; // lay comment ben view('home.userpage')
            $comment->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    // tra loi comment
    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply  = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id; // lay id user
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    /**
     * The function takes the search text from the user and searches the database for the text in the
     * title and category columns
     * 
     * @param Request request The request object.
     * 
     * @return The search text is being returned.
     */
    public function product_search(Request $request)
    {
        $comment  = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->paginate(10);
        return view('home.userpage', compact('product', 'comment', 'reply'));
    }
}
