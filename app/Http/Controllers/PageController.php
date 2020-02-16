<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Http\Requests\postCheckOut;
use App\Http\Requests\postLogin;
use App\Http\Requests\postSignup;
use App\Mail\CheckoutSuccess;
use App\Mail\SuccessEmail;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(4);
        $product_sale = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('page.home', compact('slide', 'new_product', 'product_sale'));
    }

    public function productType($type)
    {
        $product_Type = Product::where('id_type', $type)->get();
        $product_different = Product::where('id_type', '<>', $type)->paginate(3);
        $type_d = ProductType::all();
        $type_pd = ProductType::where('id', $type)->first();
        return view('page.ProductType', compact('product_Type', 'product_different', 'type_d', 'type_pd'));
    }

    public function productDetail(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product_related = Product::where('id_type', $product->id_type)->paginate(6);
        return view('page.ProductDetail', compact('product', 'product_related'));
    }

    public function contact()
    {
        return view('page.contact');
    }

    public function about()
    {
        return view('page.about');
    }

    public function addCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function delCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function getCheckOut() {
        $cart = Session::get('cart');
        return view('page.checkout', compact('cart'));
    }
    public function postCheckOut(postCheckOut $request)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone;
            $customer->note = $request->note;
            $customer->save();

            $bill = new  Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->payment;
            $bill->note = $request->note;
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = ($value['price'] / $value['qty']);
                $bill_detail->save();
            }
            Mail::to($customer)->send(new CheckoutSuccess($customer,$bill));
            Session::forget('cart');
        }

        return redirect()->back()->with('thongbao', 'Đã đặt hàng thành công');
    }
    public function getLogin() {
        return view('page.login');
    }
    public function getSignup() {
        return view('page.signup');
    }
    public function postSignup(postSignup $request) {
         $user = new User();
         $user->full_name = $request->full_name;
         $user->email = $request->email;
         $user->password = $request->password;
         $user->phone = $request->phone;
         $user->address = Hash::make($request->address);
         $user->save();
         Mail::to($user)->send(new SuccessEmail($user));
         return redirect()->back()->with('thanhcong','Đã tạo tài khoản thành công');
    }
    public function postLogin(postLogin $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            //return redirect()->intended('page.index');
            return redirect()->back()->with(['flag'=> 'success','message'=>'Đăng nhập thành công!']);
        } else {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công!']);
        }

    }
    public function getSearch(Request $request) {
        $product = Product::where('name','like','%'.$request->key.'%')->orWhere('unit_price',$request->key)->get();
        return view('page.search',compact('product'));
    }
}
