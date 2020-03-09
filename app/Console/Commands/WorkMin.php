<?php

namespace App\Console\Commands;

use App\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Print_;

class WorkMin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:min';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the update command. This runs once every 10 minutes.';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $transactions = Payment::all();
        foreach ($transactions as $transaction) {
            if ($transaction->status != 3) {//not fail
                try{
                    $parameter = "1_".$transaction->id;
                    $res = file_get_contents('https://blockchainapi.org/api/receive?method=check_logs&callback=http://darkrice.online/payment/btc_callback?type='.$transaction->id);
                    $result = json_decode($res);
                    $total_payed = 0;
                    foreach ($result->callbacks as $callback) {
                        $total_payed += $callback->value;
                    }
                    $transaction->payed_bitcoin = $total_payed;
                    if ($transaction->payed_bitcoin == $transaction->total_bitcoin) {
                        $transaction->pay_status = 2;
                    } else {
                        $transaction->pay_status = 1;
                    }
                    $transaction->save();
                }catch(\Exception $e){

                }
            }
            $nowdate = Carbon::now(); //->toDateString();
            $created_date = $transaction->created_at;//->toDateString();
            $different = date_diff($nowdate,$created_date);
            $diffdays = $different->d;
            $diffhours = $different->h;
            $diffmins = $different->m;
            if (( $diffdays * 1440 + $diffhours * 60 + $diffmins) > 150) {
                print_r("Fail");
                $transaction->pay_status = 3;
                $transaction->save();
                //$transaction->delete();
            }
            //print_r('Done');
        }
    }
}
