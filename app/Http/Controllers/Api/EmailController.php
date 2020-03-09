<?php


namespace App\Http\Controllers\Api;


use App\Mail\Customer;
use App\Mail\Manager;
use Illuminate\Http\Request;
use Mail;

class EmailController extends BasicController
{
    public function sendemail(Request $request)
    {
        $particialpay = $request->particialpay;
        $receive_email = $request->receive_email;
        $customer_email = $request->customer_email;
        $data = [];
        $data['order_number'] = $request->order_number;
        $data['customer_email'] = $customer_email;
        $data['input_address'] = $request->input_address;
        $data['productname'] = $request->productname;
        $data['productprice'] = $request->productprice;
        $data['quantity'] = $request->quantity;
        $data['pay_amount'] = $request->pay_amount;
        $data['bitcoin'] = $request->bitcoin;
        $data['customerInfo'] = $request->customerInfo;
        $data['payed_coin'] = $request->payed_coin;
        if ($particialpay) {
            $type = $request->type; //hostinger, dweb
            $particialamount = $request->particialamount;
            $receive_email_two = $request->receive_email_two;
            $data['payvalue'] = $particialpay;
            if ($type == 1) {
                try {
                    Mail::to($receive_email)->send(new Send($data));
                    Mail::to($customer_email)->send(new Send_Customer($data));
                } catch (\Swift_TransportException $e) {
                    print_r($e->getMessage());
                }
            } else {
                try {
                    Mail::to($receive_email_two)->send(new Send($data));
                    Mail::to($customer_email)->send(new Send_Customer($data));
                } catch (\Swift_TransportException $e) {
                    print_r($e->getMessage());
                }
            }

        } else {

            try {
                Mail::to($receive_email)->send(new Manager($data));
                Mail::to($customer_email)->send(new Customer($data));
            } catch (Swift_TransportException $e) {
                print_r($e->getMessage());
            }
        }
        return $this->sendResponse($data, "Email Successful");
    }
}