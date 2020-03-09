<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\FrontEndController;
use App\Payment;
use App\Product;
use App\ProductWeight;
use App\Setting;
use App\ViewInfo;
use Illuminate\Http\Request;
use Validator;

class ProductController extends BasicController
{
//    public function productList(Request $request){
//        $data = Product::all();
//        return $this->sendResponse($data, "ProductList");
//    }
//    public function productInfo($id){
//        $product = Product::find($id);
//        $weight = ProductWeight::where(['product_id' => $id])->get();
//        $data = [];
//        $data['product'] = $product;
//        $data['weight'] = $weight;
//        return $this->sendResponse($data, "ProductInfo");
//    }
//    public function buyproduct(Request $request, $productid){
//        $validator = Validator::make($request->all(), [
//            'amount' => 'required',
//            'custominfo' => 'required',
//            'email' => 'required|email',
//        ]);
//        if ($validator->fails()) {
//            return $this->sendError("Error", $validator->errors());
//        }
//        $product = Product::find($productid);
//        $price_fee_first = $product->price_fee_first;
//        $price_fee_second = $product->price_fee_second;
//        $price_fee_third = $product->price_fee_third;
//        $amount = $request->amount;
//        $price  = 0;
//        $priceList = ProductWeight::where(['product_id' => $productid])->get();
//        foreach ($priceList as $item) {
//            if($item->weight == $amount){
//                $price = $item->price;
//            }
//        }
//        $price_product = $price;
//        $fee = 0;
//        if($request->fee_first) {
//            $fee = $fee + $price_fee_first;
//        }
//        if($request->fee_second){
//            $fee = $fee + $price_fee_second;
//        }
//        if($request->fee_third){
//            $fee = $fee + $price_fee_third;
//        }
//        if($fee == 0){
//            $fee = $price_fee_first;
//        }
//        $total_fee = $fee * $amount;
//        $pay_amount = $total_fee + $price_product;
//        $transaction = Payment::create([
//            'product_id' => $productid,
//            'amount' => $amount,
//            'total_amount' => $pay_amount,
//            'total_bitcoin' => 0,
//            'pay_status' => 0,
//            'customer_email' => $request->email,
//            'custominfo' => $request->custominfo,
//            'input_address' => 0,
//            'payed_bitcoin' => 0,
//        ]);
//        $input_address = $this->requestBitCoin($transaction->id);
//        $transaction->input_address = $input_address;
//        $transaction->save();
//        $response = file_get_contents('https://blockchain.info/ticker');
//        $response = json_decode($response);
//        $todayprice = ((Array)$response->EUR)['15m'];
//        $total_btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $transaction->total_amount);
//        $transaction->total_bitcoin = $this->calculate($total_btc);
//        $transaction->save();
//        $data = [];
//        $data['trasaction'] = $transaction;
//        $data['todayprice'] = $todayprice;
//        return $this->sendResponse($data, "Successful buy!");
//    }
//    public function calculate($amount){
//        $amount = $amount + 0.00003;
//        $amount = $amount * 100000000;
//        $first = floor( $amount * 0.99);
//        $second = floor($amount - 50);
//        $maxvalue = min($first, $second);
//        return $maxvalue / 100000000;
//    }
//    public function pay(Request $request, $id){
//        $transaction_id = $id;
//        $transaction = Payment::find($transaction_id);
//        $transaction->pay_status = 1;
//        $transaction->save();
//        return $this->sendResponse($transaction, 'succcessful');
//    }
//    public function requestBitCoin($id)
//    {
//        $secret = "7j0ap91o99cxj8k9";
//        $setting = Setting::first();
//        $address = $setting->address;
//        $url = 'https://blockchainapi.org/api/receive?method=create&address=' . $address . '&callback=https://darkrice.online/payment/btc_callback?type=1&invoice_id='.$id;
//        $response = file_get_contents($url);
//        $response = json_decode($response);
//        return $response->input_address;
//    }
//    public function aboutus(Request $request){
//        $viewinfo = ViewInfo::first();
//        return $this->sendResponse($viewinfo, "This is About us page");
//    }
}