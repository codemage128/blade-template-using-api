<?php namespace App\Http\Controllers;


use App\Blog;
use App\ClientLog;
use App\Payment;
use App\Product;
use App\ProductWeight;
use App\Setting;
use App\ViewInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use phpDocumentor\Reflection\Types\Compound;
use PragmaRX\Google2FA;
//use PragmaRX\Google2FAQRCode\Google2FA;
//use PragmaRX\Google2FALaravel\Google2FA;
use Prophecy\Util\ExportUtil;
use Sentinel;
use Analytics;
use View;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;
use Charts;
use App\Datatable;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;
use File;
use function Sodium\add;



class JoshController extends Controller
{

    protected $countries = array(
        "" => "Select Country",
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegowina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "IO" => "British Indian Ocean Territory",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CD" => "Congo, the Democratic Republic of the",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote d'Ivoire",
        "HR" => "Croatia (Hrvatska)",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands (Malvinas)",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard and Mc Donald Islands",
        "VA" => "Holy See (Vatican City State)",
        "HN" => "Honduras",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran (Islamic Republic of)",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "Korea, Democratic People's Republic of",
        "KR" => "Korea, Republic of",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Lao People's Democratic Republic",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libyan Arab Jamahiriya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macau",
        "MK" => "Macedonia, The Former Yugoslav Republic of",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia, Federated States of",
        "MD" => "Moldova, Republic of",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PA" => "Panama",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint LUCIA",
        "VC" => "Saint Vincent and the Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia (Slovak Republic)",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and the South Sandwich Islands",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SH" => "St. Helena",
        "PM" => "St. Pierre and Miquelon",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen Islands",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan, Province of China",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania, United Republic of",
        "TH" => "Thailand",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "US" => "United States",
        "UM" => "United States Minor Outlying Islands",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "Viet Nam",
        "VG" => "Virgin Islands (British)",
        "VI" => "Virgin Islands (U.S.)",
        "WF" => "Wallis and Futuna Islands",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe"
    );
    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    /**
     * Initializer.
     *
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;

    }

    /**
     * Crop Demo
     */
    public function crop_demo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targ_w = $targ_h = 150;
            $jpeg_quality = 99;

            $src = base_path() . '/public/assets/img/cropping-image.jpg';

            $img_r = imagecreatefromjpeg($src);

            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, intval($_POST['x']), intval($_POST['y']), $targ_w, $targ_h, intval($_POST['w']), intval($_POST['h']));

            header('Content-type: image/jpeg');
            imagejpeg($dst_r, null, $jpeg_quality);

            exit;
        }
    }
    public function showView($name = null)
    {
        if (Sentinel::check()) {
            if ($name == "") {
                $product_list = Product::paginate(8);
                $id = 4;
                return view('admin.index', compact('product_list'), compact('id'));
            } else {
                if (View::exists('admin/' . $name)) {
                    if (Sentinel::check()) {
                        return view('admin.' . $name);
                    } else {
                        return redirect('admin/signin')->with('error', 'You must be logged in!');
                    }
                } else {
                    abort('404');
                }
            }
        } else {
            return redirect('admin/signin')->with('error', 'You must be logged in!');
        }
    }
    public function activityLogData()
    {
        $logs = Activity::get(['causer_id', 'log_name', 'description', 'created_at']);
        return DataTables::of($logs)
            ->make(true);
    }
    public function filter_date(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $logs = DB::table('log_client')->where('created_at', '>',$startDate)->where('created_at', '<', $endDate)->paginate(12);
        return view("admin.logclient", compact('logs'));
    }
    public function logclient(Request $request){
        $logs = ClientLog::orderby('created_at', 'desc')->paginate(10);
        return view("admin.logclient", compact('logs'));
    }
    public function showHome2(Request $request, $id)
    {
        if (Sentinel::check()) {
            if ($id == 4) {
                $product_list = Product::paginate(8);
                $id = 4;
                return view('admin.index', compact('product_list'), compact('id'));
            } else {
                $product_list = Product::where([
                    'status' => $id
                ])->paginate(8);
                return view('admin.index', compact('product_list'), compact('id'));
            }
        } else {
            return redirect('admin/signin')->with('error', 'You must be logged in!');
        }
    }

    public function showHome()
    {
        if (Sentinel::check()) {
            $product_list = Product::paginate(8);
            $addflag = true;
            $id = 4;
            return view('admin.index', compact('product_list', 'id'), compact('addflag'));
        } else {
            return redirect('btmadmin/signin')->with('error', 'You must be logged in!');
        }
    }

    public function getProductInfo(Request $request)
    {
        $productid = $request->productid;
        $product = Product::find($productid);
        //$btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $product->price_lower);
        //$product->btc = $btc;
        //$product->save();
        $pricelist = ProductWeight::where(['product_id' => $productid])->get();
        $data = array();
        $data['product'] = $product;
        $data['priceList'] = $pricelist;
        return json_encode($data);
    }
    public function save_news(Request $request){
        $viewinfo = ViewInfo::first();
        $viewinfo->news_content = $request->news_content;
        $viewinfo->save();
        $data = "success";
        return json_encode($data);
    }
    public function delProductInfo(Request $request)
    {
        $productid = $request->productid;
        $product = Product::find($productid);
        $product->delete();
        $data = "success";
        return json_encode($data);
    }

    public function updateProductInfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description_short' => 'required',
            'description_long' => 'required',
            'price_fee_first' => 'required',
            'price_fee_second' => 'required',
            'price_fee_third' => 'required',
            'status' => 'required'
        ]);
        $id = $request->current_id;
        $name_product = $request->name;
        $des_short = $request->description_short;
        $des_long = $request->description_long;
        $price_fee_first = $request->price_fee_first;
        $price_fee_second = $request->price_fee_second;
        $price_fee_third = $request->price_fee_third;
        $status = $request->status;

        $product = Product::find($id);
        $product->name = $name_product;
        $product->des_short = $des_short;
        $product->des_long = $des_long;
        $product->price_fee_first = $price_fee_first;
        $product->price_fee_second = $price_fee_second;
        $product->price_fee_third = $price_fee_third;
        $product->status = $status;
//        $data = array();
        $data = json_decode($product->avatar);
        if ($request->hasFile('avatars')) {
            $avatars = $request->avatars;
            foreach ($avatars as $file) {
                $name = $file->getClientOriginalName();
                $name_str = time() . $name;
                $file->move(public_path() . '/productsimage/', $name_str);
                array_push( $data, $name_str);
            }
        } else {
            $data = json_decode($product->avatar);
        }
        $count = $request->count_price / 2;
        $j = 0;
        for($i = 0; $i < $count; $i ++){
            $gramString = 'price'.$j.'0';
            $priceString = 'price'.$j.'1';
            $product_weight = ProductWeight::create([
                'product_id' => $product->id,
                'weight' => $request[$gramString],
                'price' => $request[$priceString]
            ]);
            $j = $j + 2;
        }
        $product->avatar = json_encode($data);
        $product->save();
        return redirect()->back();
    }

    public function editimage($id){
        $product = Product::find($id);
        return view('admin.editimage', compact('product'));
    }

    public function editprice($id){
        $product = Product::find($id);
        $pricelist = ProductWeight::where(['product_id' => $id])->get();
        $data = array();
        $data[0] = $product;
        $data[1] = $pricelist;
        return view('admin.editprice', compact('data'));
    }
    public function removeprice($id){
        $productweight = ProductWeight::find($id);
        $productweight->delete();
        return \redirect()->back();
    }

    public function addprice(Request $request, $id){
        $this->validate($request,  [
            'weight' => 'required',
            'price' => 'required'
        ]);
        if($request->addflag == "add") {
            $productweight = ProductWeight::create([
                'weight' => $request->weight,
                'price' => $request->price,
                'product_id' => $id
            ]);
        }else if($request->addflag == 'update'){
            $priceid = $request->priceid;
            $productweight = ProductWeight::find($priceid);
            $productweight->weight = $request->weight;
            $productweight->price = $request->price;
            $productweight->save();
        }
        return \redirect()->back();
    }
    public function updateimage(Request $request){
        $product = Product::find($request->productid);
        $product->avatar = json_encode($request->imagelist);
        $product->save();
        $data = "successful";
        return json_encode($data);
    }

    public function clearPrice(Request $request){
        $productid = $request->productid;
        $product = Product::find($productid);
        //$btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $product->price_lower);
        //$product->btc = $btc;
        //$product->save();
        $pricelist = ProductWeight::where(['product_id' => $productid])->get();
        foreach ($pricelist as $item) {
            $item->delete();
        }
        $pricelist = ProductWeight::where(['product_id' => $productid])->get();
        $data = array();
        $data['product'] = $product;
        $data['priceList'] = $pricelist;
        return json_encode($data);
    }

    public function otpinfo(Request $request){
        $setting = Setting::first();
        $google2fa = app('pragmarx.google2fa');
        $google2fa_array = array();
        $google2fa_array['secret'] = $setting->otp_key;
        //$google = new Google2FA();
        $google2fa_array['image'] = $google2fa->getQRCodeInline(
            '',
            '',
            $setting->otp_key,
            200
        );
        return view('admin.otpinfo', compact('google2fa_array'));
    }

    public function optinfo_save(Request $request){
        $setting = Setting::first();
        $google2fa = app('pragmarx.google2fa');
        $setting->otp_key = $google2fa->generateSecretKey();
        $setting->save();
        return \redirect()->back();
    }
    public function viewinfo(Request $request){
        $viewinfo = ViewInfo::first();
        if(!$viewinfo) {
            $viewinfo = ViewInfo::create();
        }
        return view('admin.viewinfo', compact('viewinfo'));
    }

    public function viewinfo_save(Request $request){
        $this->validate($request,  [
            'about_us' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required|email',
            'skype' => 'required',
            'instagram' => 'required'
        ]);
        $viewinfo = ViewInfo::first();
        $data = array();
        if ($request->hasFile('photos')) {
            $photos = $request->photos;
            foreach ($photos as $file) {
                $name = $file->getClientOriginalName();
                $name_str = time() . $name;
                $file->move(public_path() . '/productsimage/', $name_str);
                $data[] = $name_str;
            }
        }else {
            $data = json_decode($viewinfo->home_photo);
        }
        $about_us = $request->about_us;
        $phone = $request->phone;
        $fax = $request->fax;
        $email = $request->email;
        $skype = $request->skype;
        $instagram = $request->instagram;

        $viewinfo->about_us = $about_us;
        $viewinfo->phone = $phone;
        $viewinfo->fax = $fax;
        $viewinfo->email = $email;
        $viewinfo->skype = $skype;
        $viewinfo->instagram = $instagram;
        $viewinfo->home_photo = json_encode($data);
        $viewinfo->save();
        return \redirect()->back();
    }

    public function manage(Request $request)
    {
        $setting = Setting::first();
        $address = $setting->address;
        return view('admin.blank', compact('address'));
    }

    public function manage_save(Request $request)
    {
        $this->validate($request, [
            'address' => 'required'
        ]);
        $setting = Setting::first();
        $setting->address = $request->address;
        $setting->save();
        return redirect()->back();
    }

    public function addProductInfo(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description_short' => 'required',
            'description_long' => 'required',
            'price_fee_first' => 'required',
            'price_fee_second' => 'required',
            'price_fee_third' => 'required',
            'status' => 'required'
        ]);
        $name_product = $request->name;
        $des_short = $request->description_short;
        $des_long = $request->description_long;
        $price_fee_first = $request->price_fee_first;
        $price_fee_second = $request->price_fee_second;
        $price_fee_third = $request->price_fee_third;
        $status = $request->status;
        $data = array();
//        $btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $price_original);
        if ($request->hasFile('avatars')) {
            $avatars = $request->avatars;
            foreach ($avatars as $file) {
                $name = $file->getClientOriginalName();
                $name_str = time() . $name;
                $file->move(public_path() . '/productsimage/', $name_str);
                $data[] = $name_str;
            }
        }
        $product = Product::create([
            'name' => $name_product,
            'des_short' => $des_short,
            'des_long' => $des_long,
            'price_fee_first' => $price_fee_first,
            'price_fee_second' => $price_fee_second,
            'price_fee_third' => $price_fee_third,
            'status' => $status,
            'avatar' => 0,
        ]);
        $weight = [1, 1.75, 3.5, 7, 14, 28, 50, 100, 250];
        foreach ($weight as $item){
            $productweight = ProductWeight::create([
                'product_id' => $product->id,
                'weight' => $item,
                'price' => 50
            ]);
        }

        $product->avatar = json_encode($data);
        $product->save();
        return redirect()->back();
    }

    public function showTransaction(Request $request)
    {
        $transactions = Payment::orderby('created_at', 'desc')->paginate(10);
        $id = 4;
        return view('admin.transitions', compact('transactions'), compact('id'));
    }

    public function showTransaction2($id)
    {
        if ($id == 4) {
            $transactions = Payment::paginate(10);
            $id = 4;
            return view('admin.transitions', compact('transactions'), compact('id'));
        } else {
            $transactions = Payment::where([
                'pay_status' => $id
            ])->paginate(10);
            return view('admin.transitions', compact('transactions'), compact('id'));
        }
    }

    public function getTransactionInfo(Request $request)
    {
        $transactionId = $request->transactionId;
        $transaction = Payment::find($transactionId);
        $data = array();
        $data['input_address'] = $transaction->input_address;
        $data['product_name'] = Product::find($transaction->product_id)->name;
        $data['product_price'] = $transaction->product_price;
        $data['amount'] = $transaction->amount;
        $data['total_amount'] = $transaction->total_amount;
        $data['total_bitcoin'] = $transaction->total_bitcoin;
        $data['payed_bitcoin'] = $transaction->payed_bitcoin;
        $data['customer_info'] = $transaction->custominfo;
        $data['pay_status'] = $transaction->pay_status;
        return json_encode($data);
    }

    public function delTransaction(Request $request)
    {
        $transactionid = $request->transactionid;
        $transaction = Payment::find($transactionid);
//        $transaction->isdeleted = 1;
//        $transaction->save();
        $transaction->delete();
        $data = 'success';
        return json_encode($data);
    }

}