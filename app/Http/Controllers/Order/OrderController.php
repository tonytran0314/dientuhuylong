<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incompletedOrders = Order::where([
            ['user_id', Auth::user()->id],
            ['status_id', '<>', 24],
            ['status_id', '<>', 34]
        ])->orderBy('order_time', 'desc')->get();

        $completedOrders = Order::where([
            ['user_id', Auth::user()->id],
            ['status_id', 24]
        ])->orderBy('order_time', 'desc')->get();

        $cancelledOrders = Order::where([
            ['user_id', Auth::user()->id],
            ['status_id', 34]
        ])->orderBy('order_time', 'desc')->get();
        
        return view('dynamic.order.index', [
            'incompletedOrders' => $incompletedOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $orderDetail = Order::find($order_id);
        $items = $orderDetail->items_in_order;

        $paymentColor = ($orderDetail->payment_status_id == 14) ? 'success' : 'warning';
        $orderColor = ($orderDetail->status_id == 14 || $orderDetail->status_id == 24) ? 'success' : 'warning';
        
        return view('dynamic.order.show', [
            'detail' => $orderDetail,
            'items' => $items,
            'paymentColor' => $paymentColor,
            'orderColor' => $orderColor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {   
        $cancelResultMessage = 'Hủy đơn thành công. Quá trình hoàn tiền có thể cần thời gian để hoàn thành';

        // refund if paid by vnpay
        if ($request->payment_method_id == 14) { 

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

            function callAPI_auth($method, $url, $data)
            {
                $curl = curl_init();

                switch ($method) {
                    case "POST":
                        curl_setopt($curl, CURLOPT_POST, 1);
                        if ($data)
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        break;
                    case "PUT":
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                        if ($data)
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        break;
                    default:
                        if ($data)
                            $url = sprintf("%s?%s", $url, http_build_query($data));
                }
                // OPTIONS:
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json'
                ));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                // EXECUTE:
                $result = curl_exec($curl);

                if (!$result) {
                    die("Connection Failure");
                }
                curl_close($curl);
                return $result;
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $vnp_RequestId = rand(1,10000); // Mã truy vấn
                $vnp_Command = "refund"; // Mã api
                $vnp_TransactionType = "02"; // 02 hoàn trả toàn phần - 03 hoàn trả một phần
                $vnp_TxnRef = $request->order_id; // Mã tham chiếu của giao dịch
                $vnp_Amount = $request->Amount * 100; // Số tiền hoàn trả
                $vnp_OrderInfo = "Hoan Tien Giao Dich"; // Mô tả thông tin
                $vnp_TransactionNo = "0"; // Tuỳ chọn, "0": giả sử merchant không ghi nhận được mã GD do VNPAY phản hồi.
                $vnp_TransactionDate = date_format(date_create($request->order_time), "YmdHis"); // Thời gian ghi nhận giao dịch
                $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
                $vnp_CreateBy = Auth::user()->name; // Người khởi tạo hoàn tiền
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của máy chủ thực hiện gọi API

                $ispTxnRequest = array(
                    "vnp_RequestId" => $vnp_RequestId,
                    "vnp_Version" => "2.1.0",
                    "vnp_Command" => $vnp_Command,
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_TransactionType" => $vnp_TransactionType,
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_TransactionNo" => $vnp_TransactionNo,
                    "vnp_TransactionDate" => $vnp_TransactionDate,
                    "vnp_CreateDate" => $vnp_CreateDate,
                    "vnp_CreateBy" => $vnp_CreateBy,
                    "vnp_IpAddr" => $vnp_IpAddr
                );

                $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s';

                $dataHash = sprintf(
                    $format,
                    $ispTxnRequest['vnp_RequestId'], //1
                    $ispTxnRequest['vnp_Version'], //2
                    $ispTxnRequest['vnp_Command'], //3
                    $ispTxnRequest['vnp_TmnCode'], //4
                    $ispTxnRequest['vnp_TransactionType'], //5
                    $ispTxnRequest['vnp_TxnRef'], //6
                    $ispTxnRequest['vnp_Amount'], //7
                    $ispTxnRequest['vnp_TransactionNo'],  //8
                    $ispTxnRequest['vnp_TransactionDate'], //9
                    $ispTxnRequest['vnp_CreateBy'], //10
                    $ispTxnRequest['vnp_CreateDate'], //11
                    $ispTxnRequest['vnp_IpAddr'], //12
                    $ispTxnRequest['vnp_OrderInfo'] //13
                ); 

                $checksum = hash_hmac('SHA512', $dataHash, $vnp_HashSecret);
                $ispTxnRequest["vnp_SecureHash"] = $checksum;
                $txnData = callAPI_auth("POST", $apiUrl, json_encode($ispTxnRequest));
                $ispTxn = json_decode($txnData, true);

                if ($ispTxn["vnp_ResponseCode"] != '00') {
                    $cancelResultMessage = 'Hủy đơn và hoàn tiền thất bại!';
                }
            }
        }
        
        Order::where('id', $request->order_id)->update(['status_id' => 34]);

        return Redirect::route('orders.index')->with('cancelResultMessage', $cancelResultMessage);
    }
}
