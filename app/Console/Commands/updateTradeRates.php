<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OilRates;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class updateTradeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-trade-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //\Log::info("Cron Starts!");
        $this->info('Command executed successfully.');

        // set API Endpoint and API key
//        $endpoint   = 'open-high-low-close/'.date('Y-m-d');
//
//        $access_key = 'qygwrfvc09f98872k88vvwgt5t8zfkp5tiqtcrxgfj1zj9917tk8q7suon7x';

        // Initialize CURL:

        $ch = curl_init('https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $result = curl_exec($ch);
        curl_close($ch);


        // Decode JSON response:
        $oilRates               = json_decode($result);


        $databaseTime           = Carbon::now()->format('H:i:s');
//
//        if(isset($oilRates['time'])) {
//            $carbonTime         = Carbon::createFromTimestamp($oilRates['timestamp']);
//            // Format the Carbon instance as a database time string
//            $databaseTime       = $carbonTime->toDateTimeString();
//        }

        $saveRate               = new OilRates();

//        if(isset($oilRates['rates']['open'])) {
//            $saveRate->open         = $response->price;
//            $saveRate->open_rate    = (1 / $oilRates['rates']['open']);
//        }
//
//        if(isset($oilRates['rates']['high'])) {
//            $saveRate->high         = $oilRates['rates']['high'];
//            $saveRate->high_rate    = (1 / $oilRates['rates']['high']);
//        }
//
//        if(isset($oilRates['rates']['low'])) {
//            $saveRate->low = $oilRates['rates']['low'];
//            $saveRate->low_rate     = (1 / $oilRates['rates']['low']);
//        }
//
//        if(isset($oilRates['rates']['close'])) {
//            $saveRate->close = $oilRates['rates']['close'];
////            dd($saveRate->close);
//            $saveRate->close_rate   = (1 / $oilRates['rates']['close']);
//        }
//        $saveRate->time_stamp   = $oilRates['timestamp'];
        $saveRate->time         = $databaseTime;
//        $saveRate->date         = $oilRates['date'];
//        $saveRate->base_currency= $oilRates['base'];
        $saveRate->base_currency= 'USD';
//        $saveRate->symbol       = $oilRates['symbol'];
        $saveRate->symbol       = 'BTC';
        $saveRate->unit         = 'coin';

        $saveRate->close_rate  = $oilRates->price;
        $saveRate->low_rate = $oilRates->price;
        $saveRate->high_rate = $oilRates->price;
        $saveRate->open_rate = $oilRates->price;


        $saveRate->save();
        //\Log::info("Cron is Completed working fine!");
    }
}
