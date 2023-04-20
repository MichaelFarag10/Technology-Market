<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use PDF;
use Exception;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_catagory(){
        if(auth::id()){

            $data = Catagory::all();
            return view('admin.catagory',compact('data'));
        }else{
            return view('login');
        }
    }
    public function add_catagory(Request $request){
        $request->validate([
            'catagory_name' => 'required|string|regex:/^[a-zA-Z]+$/u',

        ]);
        $catagory = new Catagory;
        $catagory->catagory_name = $request->catagory_name;
        $catagory->save();
        return redirect()->back()->with('message','Catagory Added Succssfully');
    }
    public function delete_catagory($id){

        $delete = catagory::findOrFail($id);
        $delete->delete();
        return redirect()->back()->with('message','Catagory Deleted Successflly');
    }
    public function update_catagory($id){
        if(auth::id()){
            $catagory = Catagory::findOrFail($id);
            return view('admin.edit_catagory',compact('catagory'));

        }else{
            return redirect('login');
        }

    }
    public function edit_catagory(Request $request ,$id){
        $request->validate([
            'catagory_name' => 'string|regex:/^[a-zA-Z]+$/u',

        ]);
        $catagory = Catagory::findOrFail($id);
        $catagory->catagory_name = $request->catagory_name;
        $catagory->save();
        return redirect('view_catagory')->with('message','Catagory Added Succssfully');
    }




    public function view_product(){
        if(auth::id()){

            $catagory = catagory::all();
            return view('admin.view_product',compact('catagory'));

        }else{
            return view('login');
        }
    }

    public function add_product(Request $request){
        $request->validate([
            'title' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'description' => 'required|string',
            'price' => 'required|numeric:',
            'discount_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'catagory' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',

        ]);
        $catagory_name = Catagory::where('id','=',$request->catagory)->pluck('catagory_name');
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity ;
        $product->catagory = $catagory_name[0];
        $product->catagory_id = $request->catagory;

        $image = $request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;
        $product->save();
        return redirect()->back()->with('message','Prodect Added Successflly');
    }

    public function show_product(){
        if(auth::id()){

                $product = Product::all();
                return view('admin.show_product',compact('product'));
        }else{
            return view('login');
        }
    }

    public function update_product($id){
        if(auth::id()){
        $product = Product::findOrFail($id);
        $catagory = Catagory::all();
        return view('admin.update_product',compact('product','catagory'));
        }else{
            return view('login');
        }
    }


    public function edit_product(Request $request, $id){
        if(auth::id()){
            $request->validate([
                'title' => 'string|regex:/^[a-zA-Z]+$/u',
                'description' => 'string',
                'price' => 'numeric:',
                'discount_price' => 'numeric',
                'quantity' => 'numeric',
                'catagory' => 'string|regex:/^[a-zA-Z]+$/u',

            ]);
        $product =Product::findOrFail($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity ;
        $product->catagory = $request->catagory;

        $image = $request->image;
        if($image){
        $imagename =time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message','Prodect Updated Successflly');
    }else{
        return view('login');
    }
    }

    public function delete_product($id){

        $product = product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successflly');

    }

    public function order(){
        if(auth::id()){
        $order = Order::all();
        return view('admin.order',compact('order'));
        }else{
            return view('login');
        }
    }


    public function delivred($id){

        $order = order::findOrFail($id);
        $order->delivery_status = "delivred";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();

    }

    public function delete_order($id)
    {
        $delete_order = Order::findOrFail($id);
        $delete_order->delete();
        return redirect()->back();
    }

    public function print_pdf($id){
        $order = order::findOrFail($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function show_pdf($id){

        $order = order::findOrFail($id);
        return view('admin.show_pdf',compact('order'));
    }

    public function search(Request $request){

        $search = $request->search;
        $order = order::where('name','LIKE',"%$search%")->orWhere('product_title','LIKE',"%$search%")->get();
        return view('admin.order',compact('order'));

    }

    public function show_comment(){
        if(auth::id()){


             $comment = comment::all();

             return view('admin.show_comment',compact('comment'));

    }else{
        return redirect('lodin');
    }
    }

    public function one_comment($id){
        if(auth::id()){

            $comments = Comment::findOrFail($id);

           return view('admin.one_comment',compact('comments'));


        }else{
        return redirect('lodin');
    }

    }

    public function delete_comment($id){

        $delete = Comment::findOrFail($id);
        $delete->delete();
        return redirect()->back()->with('message','Comment Deleted !');
    }


    public function mark_as_read_all(){

        $unread = auth()->user()->unreadNotifications;
        if($unread){
            $unread->MarkAsRead();
            return back();
        }
    }

    public function show_users(){
        if(auth::id()){

            $users = User::all();
            return view('admin.show_users',compact('users'));

        }else{
            return redirect('login');
        }
    }

    public function delete_user($id){

        if(auth::id()){

            $user= user::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('message','User deleted');

        }
    }

    public function update_users($id){
        if(auth::id()){
        $user = User::findOrFail($id);
        return view('admin.update_users',compact('user'));
    }else{
        return redirect('login');
    }
    }


    public function edit_user(Request $request,$id){
        $request->validate([
            'name' => 'string|regex:/^[a-zA-Z]+$/u',
            'email' => 'email',
            'phone' => 'numeric|min:12',
            'adress' => 'string',
            'password' => 'string|min:9',

        ]);
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        if($request->usertype == "1"){

             $user->usertype = "1";
        }else{
            $user->usertype = "0";
        }
       $user->save();
       return redirect()->back()->with('message','User Updated successfull!!');
    }

    public function contact_view(){
        if(auth::id()){
            $contact = Contact::all();
            return view('admin.contact_view',compact('contact'));
        }else{
            return redirect('login');
        }
    }

    public function delete_contact($id){

        if(auth::id()){
            $contact = Contact::findOrFail($id);
            return redirect()->back()->with('message','Message Deleted Successfully!!');
        }else{
            return redirect('login');
        }
    }
}
