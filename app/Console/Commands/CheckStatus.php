<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Url;
use GuzzleHttp\Client;
use App\Mail\ApiStatusChanged;
use Illuminate\Support\Facades\Mail;

class CheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Status of each URL ';

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
        //
        //$name = $this->ask('What is your name?');
        $urls=Url::all();
        foreach ($urls as $url) {
            $client = new Client();
            $response = $client->request('GET', $url->url);
            $code = $response->getStatusCode();
            $this->info($code);
            if($code!=$url->status){$this->notifyIfChanged($url,$code);}
        }

    }//end of funcation

    function notifyIfChanged(Url $url,$code){
        $url->status=$code;
        $url->save();
        Mail::to($url->user()->get()->first())->send(new ApiStatusChanged($url));

    }
}
