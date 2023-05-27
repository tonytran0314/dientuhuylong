<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\TpTinh;
use App\Models\ProductOrder;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function show() {
        $productsInCart = User::find(Auth::user()->id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        return view('dynamic.checkout.show', [
            'productsInCart' => $productsInCart,
            'totalPrice' => $total_price,
            'tinh_tp' => TpTinh::all()
        ]);
    }

    public function storeUserInformation(CheckoutRequest $request) {

        $request->validated($request->all());

        $uuid = Str::uuid();
        $productsInCart = User::find(Auth::user()->id)->products;

        $total_price = 0;
        foreach($productsInCart as $product) {
            $total_price += ($product->price * $product->pivot->quantity);
        }

        Session::put('uuid', $uuid);
        Session::put('Amount', $total_price);

        foreach($productsInCart as $product) {
            ProductOrder::insert([
                'order_id' => $uuid,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity
            ]);
        }   

        return view('dynamic.checkout.paymentMethod');
    }

    public function result() {
        
        $url = URL::full();
        $parsedUrl = parse_url($url);

        if (array_key_exists("query", $parsedUrl)) {
            $vnp_TmnCode = "VSEDH0S9";//Mã website tại VNPAY 
            $vnp_HashSecret = "OUHPPOOKXFVQTAHRYUPIWVLYHPYUJSTY"; //Chuỗi bí mật
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/checkout/result";
            $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
            $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
            //Config input format
            //Expire
            $startTime = date("YmdHis");
            $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));


            $vnp_SecureHash = $_GET['vnp_SecureHash'];
            $inputData = array();
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }
            
            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }

            $paymentMessage = '';
            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            if ($secureHash == $vnp_SecureHash) {
                if ($_GET['vnp_ResponseCode'] == '00') {
                    $paymentMessage = 'Giao dịch thành công';
                } else {
                    $paymentMessage = 'Giao dịch không thành công';
                }
            } else {
                $paymentMessage = 'Chữ ký không hợp lệ';
            }

            return view('dynamic.checkout.result', [
                'paymentMessage' => $paymentMessage
            ]);
        } else {
            return view('dynamic.checkout.result');
        }
    }
}
