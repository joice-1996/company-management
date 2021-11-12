<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use DB;
use App\Modules\Admin\Models\ClientproductCart as ClientproductCart;
class RenewalMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewal:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail';

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
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime($startDate.'+1 days'));
  
        $client_products =  ClientProductCart::whereBetween('expiry_date', [$startDate, $endDate])
                    ->with(array('products' => function ($query) {
                        $query->select('product','id');
                    }))->with(array('clients' => function ($query) {
                        $query->select('company_name','id');}))->
                     get();



 
       foreach ($client_products as $client_product) {
        $emails=['roseelizabetheliza@gmail.com'];
        $data["client_name"]=$client_product->clients->company_name;
        $data["product"]=$client_product->products->product;
        $data["expiry_date"]=$client_product->expiry_date;
        $data["subject"]='Renewal Message';
       }
        //Sending Mail to the corresponding user
      foreach ($emails as $email) {
        Mail::send([], $data, function($message)use($data,$email) {
            $message->to($email, $data["client_name"])
            ->subject($data["subject"])
            ->setBody('Hi, renewal message');
            });   

      
    
      
        }
      
      
    }
}
