<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use Session;
use Stripe;
use App\Models\Comment;
use App\Models\Reply;
use App\Notifications\AddComment;
use Illuminate\Auth\Events\Login;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index(){

        $cartcount = cart::all()->count();
        $product = product::paginate('10');
        $comment = Comment::orderby('id','desc')->get();
        $ordercount = order::where('delivery_status','=','processing')->get()->count();

        if(auth::id()){
            $order = Order::where('user_id','=',auth()->user()->id)->get();

        }else{
            $order = 0;

        }
            return view('home.userpage',compact('product','comment','cartcount','ordercount','order'));


    }

    public function redirect(Request $request){
        if(auth::id()){
        $user = auth::user();
        $cartcount = cart::all()->count();
        $product = product::paginate('10');
        $usertype = Auth::user()->usertype;
        $id = Auth::user()->id;
        if($usertype == '1'){
            $total_product = product::all()->count();
            $total_orders = order::all()->count();
            $total_users = user::all()->count();
            $contact = Contact::all()->count();


            $order = order::all();


            $total_price = 0;


            $comment = comment::all();
            $comment_count = comment::all()->count();
            foreach($order as $order){

                $total_price = $total_price + $order->price;
            }
            $total_deliver = order::where('delivery_status','=','delivred')->get()->count();
            $total_processing = order::where('delivery_status','=','processing')->get()->count();


            return view('admin.home',compact('user',
                                    'total_product',
                                    'total_orders',
                                    'total_users',
                                    'total_price',
                                    'total_deliver',
                                    'total_processing',
                                    'comment',
                                    'comment_count',
                                    'contact',



                                ));
        }else{


            $comment = comment::orderby('id','desc')->get();
            $ordercount = order::where('delivery_status','=','processing')->get()->count();

            return view('home.userpage',compact('product','comment','cartcount','ordercount'));
        }
    }{
        return redirect('login');
    }
    }

   public function product_details($id){
    if(auth::id()){
    $cartcount = cart::all()->count();
        $product_details = Product::findOrFail($id);
        $order = Order::where('user_id','=',auth()->user()->id)->get();

        return view('home.product_details',compact('product_details','cartcount','order'));
    }else{
        return redirect('login');
    }
    }

    public function add_cart(Request $request, $id){
        if(auth::id()){

            $user=Auth::user();
            $userid= $user->id;
            $product = product::findOrFail($id);

            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id){

                $cart = cart::findOrFail($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if($product->discount_price != null){


                    $cart->price = $product->discount_price * $cart->quantity;
                }else{
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();
                Alert::success('Product Added Successflly','We have addeed product to the cart');
                return redirect()->back();

            }else{
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;

                $cart->quantity = $request->quantity ;


                if($product->discount_price != null){


                    $cart->price = $product->discount_price * $request->quantity;
                }else{
                    $cart->price = $product->price * $request->quantity;
                }

                $cart->image = $product->image;
                $cart->product_id = $product->id;

                $cart->save();
                return redirect()->back()->with('message','Cart Added Successflly');

            }


        }else{

            return redirect('/login');
        }
    }


    public function show_cart(){
        if(auth::id()){
        $id= auth::user()->id;
        $cart = cart::where('user_id','=',$id)->get();
        $cartcount = cart::where('user_id','=',$id)->count();
        $ordercount = order::where('delivery_status','=','processing')->get()->count();
        $order = Order::where('user_id','=',auth()->user()->id)->get();



        return view('home.show_cart',compact('cart','cartcount','ordercount','order'));

        }else{

            return redirect('login');
        }
    }


    public function remove_product($id){

        if($id != null){
        $cart = cart::findOrFail($id);

        $cart->delete();

        return redirect()->back()->with('message','Product Deleted!');

        }else{
            return redirect()->back();
        }
    }

    public function cash_order(){
        $user = auth::user();
        $userid = $user->id;
        $data = cart::where('user_id','=',$userid)->get();
       foreach($data as $data){
        $order = new order;

        $order->name = $data->name;
        $order->email = $data->email;
        $order->phone = $data->phone;
        $order->address = $data->address;
        $order->user_id = $data->user_id;

        $order->product_title = $data->product_title;
        $order->price = $data->price;
        $order->quantity = $data->quantity;
        $order->image = $data->image;
        $order->product_id = $data->product_id;

        $order->payment_status = "cash on delivery";
        $order->delivery_status = "processing";

        $order->save();
        $cartid = $data->id;
        $cart= Cart::findOrFail($cartid);
        $cart->delete();
    }


        return redirect()->back()->with('message','We have received  your order, we will connect with you soon...');
    }

    public function stripe($totalprice){


        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request ,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        $user = auth::user();
        $userid = $user->id;
        $data = cart::where('user_id','=',$userid)->get();
       foreach($data as $data){
        $order = new order;

        $order->name = $data->name;
        $order->email = $data->email;
        $order->phone = $data->phone;
        $order->address = $data->address;
        $order->user_id = $data->user_id;

        $order->product_title = $data->product_title;
        $order->price = $data->price;
        $order->quantity = $data->quantity;
        $order->image = $data->image;
        $order->product_id = $data->product_id;

        $order->payment_status = "Paid";
        $order->delivery_status = "processing";

        $order->save();
        $cartid = $data->id;
        $cart= Cart::findOrFail($cartid);
        $cart->delete();
    }
        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order(){
        if(Auth::id()){

            $order = Order::where('user_id','=',auth()->user()->id)->get();
            $cartcount = cart::all()->count();
            $ordercount = order::where('delivery_status','=','processing')->get()->count();

            return view('home.order',compact('order','cartcount','ordercount'));
        }else{
            return redirect('login');
        }
    }

    public function cancel_order($id){

        $order = order::findOrFail($id);
        $order->delivery_status ="canceled";
        $order->save();
        return redirect()->back()->with('message','Order Canceld');
    }

    public function add_comment(Request $request){
        if(auth::id()){
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->image = auth()->user()->profile_photo_path;
            $comment->save();
            //   Notification
            $admin = auth::user()->id;
            $user = user::get();
            $comment_id = Comment::latest()->first();

            Notification::send($user,new AddComment($comment_id));

            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    public function add_reply(Request $request){
        if(auth::id()){
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->image = auth()->user()->profile_photo_path;
            $reply->save();
            return redirect()->back();

        }else{
            return redirect('login');
        }

    }

    public function product_search(Request $request){

        $search = $request->search;
            $product = Product::where('title','LIKE',"%".$search."%")->paginate(10);
            $comment = Comment::orderby('id','desc')->get();
            $reply = reply::all();
            $cartcount = cart::all()->count();
            $order = Order::where('user_id','=',auth()->user()->id)->get();

            return view('home.userpage',compact('product','comment','reply','cartcount','order'));

    }

    public function product(){
        $cartcount = cart::all()->count();
        $product = product::paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
         $ordercount = order::where('delivery_status','=','processing')->get()->count();
         $order = Order::where('user_id','=',auth()->user()->id)->get();

        return view('home.all_products',compact('product','comment','reply','cartcount','ordercount','order'));


    }

    public function search_product(Request $request){
        $search = $request->search;
        $product = Product::where('title','LIKE',"%".$search."%")->paginate(10);
        $comment = Comment::orderby('id','desc')->get();
        $reply = reply::all();

        return view('home.all_products',compact('product','comment','reply'));
    }

    public function contact_view(){
        if(auth::id()){

            $cartcount = cart::all()->count();
            $ordercount = order::where('delivery_status','=','processing')->get()->count();
            $order = Order::where('user_id','=',auth()->user()->id)->get();

            return view('home.contact',compact('cartcount','ordercount','order'));
        }else{
            return redirect('login');
        }
    }

    public function add_contact(Request $request){
        if(auth::id()){
            $contact = new Contact;
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required|max:255',
            ]);

            if($validator->fails()){
                return redirect()->back()->with('message','The Message must be max 255 character');

            }else{
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->message = $request->message;
                $contact->save();
                return redirect()->back()->with('message','We have received  your Message, we will connect with you soon...');
            }


        }else{
            return redirect()->back();
        }

    }
}



