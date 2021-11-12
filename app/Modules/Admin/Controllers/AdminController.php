<?php
namespace App\Modules\Admin\Controllers;

use App\Helpers\getUsers;
use App\Http\Controllers\Controller;
use App\Modules\Battery\Models\Battery as Battery;
use App\Modules\Admin\Models\Product as Product;
use App\Modules\Admin\Models\Invoice as Invoice;
use App\Modules\Client\Models\Client as Client;
use App\Modules\Admin\Models\ClientproductCart as ClientproductCart;
use App\Modules\Admin\Models\Quotation as Quotation;
use App\Modules\Client\Models\CompanyContact as CompanyContact;
use DB;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\User as User;
//use App\Product as Product;
use Auth;
use Config;
use Illuminate\Http\Request;
use Response;

class AdminController extends Controller
{

    /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/

    public function index(Request $request)
    {
        $data=product::where('status','1')->get();
        return view('Admin::productadd',['data'=>$data]);
    }



     /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  product 
     * output 
     * Description: product adding
     **/



    public function create(Request $request)
    {
        $request->validate([
            'product' => 'required',                
            'description' => 'required',
            
           
        ]);
        


        $product=new Product;
        $product->product=$request->product;
        $product->description=$request->description;
        $product->status=1;
        
        $product->save();
       // DB::update('update clients set status=? where id=?',['1',$id]);
        
        return redirect()->back()->with('sucess','successfully registerd');
        
   
    }

    public function productdelete($id)
    {
        $data=product::where('id',$id)->update(array('status'=>0));
        //$flag= DB::update('update products set status=? where id=?',['0',$id]);
          if($data){
           return 'success';
           }
           else{
           return 'failed';
           }
    }



    public function edit($id)
    {
        $data=product::where("id",$id)
        ->first(array('product','description'));
        return $data;
    }


    // public function Quotationadd(Request $request)
    // {
    //      $data=Client::where('status','1')->get();
    //      $use=User::all();

    //      $qlist=Quotation::with(array('clients' => function ($query) {
    //         $query->select('company_name','email','id');  
    //     }))->with(array('products' => function ($query) {
    //         $query->select('product','id');
    //     }))->with(array('users' => function ($query) {
    //         $query->select('name','id');}))->
    //      get();



    //     return view('Admin::quotationadd',['data'=>$data,'use'=>$use,'qlist'=>$qlist]);
    // }





     /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/


    public function addingquotation(Request $request)
    {


      // add quotation 


        $request->validate([
                           
            'product_id' => 'required',
            'quotation_amount' => 'required|between:0,9999.999',
            'quotation_no' => 'required',
            'user_id'=>'required',
            
           
        ]);
        
        // return 1;
            
        $quotation=new Quotation;
        $s=$quotation->id;
        $quotation->client_id=$request->client_id;        
        $quotation->product_id=$request->product_id;        
        $quotation->quotation_amount=$request->quotation_amount;
        $quotation->quotation_no=$request->quotation_no . 'QNO';      
        $quotation->pdf=$request->quotation_no .  '.pdf';
        $quotation->user_id=$request->user_id;
        $quotation->status='not_paid';
        $quotation->created=Carbon::now()->toDateTimeString();
        
        $quotation->save();
            

        
        $s=$quotation->id;
       // return $s;
        $qlist=Quotation::with(array('clients' => function ($query) {
            $query->select('company_name','address','email','id');  
        }))->with(array('products' => function ($query) {
            $query->select('product','id');
        }))->with(array('users' => function ($query) {
            $query->select('name','id');

        }))->where('id',$s)->get();

        view()->share('Admin::pdf',['qlist'=>$qlist]);



        
  //send mail(quotation pdf)
  $data["email"]='roseelizabetheliza@gmail.com';
  $data["client_name"]='Radhu';
  $data["subject"]='sending pdf as attachment';

  //Generating PDF with all the post details
  $pdf = PDF::loadView('Admin::pdf',['qlist'=>$qlist]);  // this view file will be converted to PDF
  $path=public_path('pdf/');
  $pdf->save($path . '/' . $request->quotation_no);


  //Sending Mail to the corresponding user

  Mail::send([], $data, function($message)use($data,$pdf) {
  $message->to($data["email"], $data["client_name"])
  ->subject($data["subject"])
  ->attachData($pdf->output(), 'Quotation_Detail.pdf', [
             'mime' => 'application/pdf',
         ])
  ->setBody('Hi, Radhika!  ');
  });


  return redirect()->back()->with('sucess','successfully registerd');





//    $path=public_path('pdf/');

//      $pdf = PDF::loadView('Admin::pdf',['qlist'=>$qlist]);
//     $pdf->save($path . '/' . 'pd.pdf');
//      return $pdf->download('pd.pdf');




        //return 1;
       // return back();
        
    }



    public function invoice($id)
    {

        

        $data=Quotation::with(array('clients' => function ($query) {
            $query->select('company_name','address','email','id');  
        }))->with(array('products' => function ($query) {
            $query->select('product','id');
        }))->with(array('users' => function ($query) {
            $query->select('name','id');

        }))->where('id',$id)->first();

    return  $data;
    }
    public function invoiceadd(Request $request)
    {


      // add quotation 
      

        // $request->validate([
                           
        //     'product_id' => 'required',
        //     'quotation_amount' => 'required',
        //     'quotation_no' => 'required',
        //     'payment'=>'required',
            
           
        // ]);
        // return 1;
      
            
        $invoice=new Invoice;
        $invoice->client_id=$request->client_id;        
        $invoice->product_id=$request->product_id;        
        $invoice->quotation_amount=$request->quotation_amount;
        $invoice->quotation_no=$request->quotation_no;      
        $invoice->payment=$request->payment;
        $invoice->status=2;
        $invoice->created=Carbon::now();
        //return $invoice;
        $invoice->save();
        //return 1;
        $id=$request->client_id;

        DB::update('update clients set status=? where id=?',['1',$id]);

        $qid=$request->id;

        DB::update('update quotations set status=? where id=?',['paid',$qid]);

       //
       return redirect()->back()->with('sucess','successfully registerd');
            
    }

    public  function pdf_invoice(Request $request)
    {

         $s=$request->id;
           
        $invoice=Invoice::with(array('clients' => function ($query) {
            $query->select('company_name','email','address','id');  
        }))->with(array('products' => function ($query) {
            $query->select('product','id');
        
        }))->where('id',$s)->get();


            view()->share('Admin::invoice_pdf',['invoice'=>$invoice]);




      //path setting for pdf download



       $path=public_path('pdf/');

         $pdf = PDF::loadView('Admin::invoice_pdf',['invoice'=>$invoice]);
        $pdf->save($path . '/' . 'invoice.pdf');
         return $pdf->download('invoice.pdf');
        }

 /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/


    public function quotationlist()
    {
    $data=Quotation::with(array('clients' => function ($query) {
        $query->select('company_name','email','id');  
    }))->with(array('products' => function ($query) {
        $query->select('product','id');
    }))->with(array('users' => function ($query) {
        $query->select('name','id');}))->
     get();
    //paginate(3);
//return $data;
   return view('list',['data'=>$data]);





}


 /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/


    public function  dropproduct($id)
    {
        // return 1;
         
       $product_ids = ClientproductCart::where('client_id','=',$id)->get(array('product_id'))->pluck('product_id');
       $data=Product::whereIn("id",$product_ids)->get(array('id','product'));
        
        return $data;

        
    }



 /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/


    public function client(Request $request)
    {
        $data=Client::all();
        return view('Admin::clientdetail',['data'=>$data]);
       
    }


 /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/


    public function clientdetails(Request $request)
    {

        $s=$request->id;
        $data=Client::with(array('users' =>function($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query) {
            $query->select('branches','client_id');                 
        }))->with(array('company_contacts' => function ($query) {
            $query->select('contact_number','client_id');
        }))->with(array('carts' => function ($query) {
            $query->select('start_date','expiry_date','no_of_license','customization_description','customization_amount','license_amount','platform_charge','product_id','client_id')->with(array('products' =>function($query)
            {$query->select('product','id');
            }));
        }))->where('id',$s)->get();

         


      
        $use=User::all();

        $qlist=Quotation::with(array('clients' => function ($query) {
            $query->select('company_name','email','id');  
        }))->with(array('products' => function ($query) {
            $query->select('product','id');
        }))->with(array('users' => function ($query) {
            $query->select('name','id');
        
        }))->where('client_id',$s)->get();



        $invoice=Invoice::with(array('clients' => function ($query) {
            $query->select('company_name','email','address','id');  
        }))->with(array('products' => function ($query) {
            $query->select('product','id');
        
        }))->where('client_id',$s)->get();




        $ldata=DB::table('licences')->get();
  




       return view('Admin::quotationadd',['data'=>$data,'use'=>$use,'qlist'=>$qlist ,'invoice'=>$invoice,'ldata'=>$ldata]);


       // return view('Admin::quotationadd',['data'=>$data]);
    }


 /**
     * Laravel  6.0
     * @package Company management
     * @author  Radhika Jaladharan
     * @param  Request $request
     * @Date   12-02-2020
     * @module Admin
     * @Input  
     * output 
     * Description: product list
     **/



   public  function quotation_pdf(Request $request)
    {

         $s=$request->id;
            $qlist=Quotation::with(array('clients' => function ($query) {
                $query->select('company_name','address','email','id');  
            }))->with(array('products' => function ($query) {
                $query->select('product','id');
            }))->with(array('users' => function ($query) {
                $query->select('name','id');

            }))->where('id',$s)->get();

            view()->share('Admin::pdf',['qlist'=>$qlist]);




      //path setting for pdf download



    //    $path=public_path('pdf/');

    //      $pdf = PDF::loadView('Admin::pdf',['qlist'=>$qlist]);
    //     $pdf->save($path . '/' . 'pd.pdf');
    //      return $pdf->download('pd.pdf');




         $data["email"]='roseelizabetheliza@gmail.com';
         $data["client_name"]='Radhu';
         $data["subject"]='sending pdf as attachment';

         //Generating PDF with all the post details
         $pdf = PDF::loadView('Admin::pdf',['qlist'=>$qlist]);  // this view file will be converted to PDF

         //Sending Mail to the corresponding user

         Mail::send([], $data, function($message)use($data,$pdf) {
         $message->to($data["email"], $data["client_name"])
         ->subject($data["subject"])
         ->attachData($pdf->output(), 'Your_Quotation details_Detail.pdf', [
                    'mime' => 'application/pdf',
                ])
         ->setBody('Hi, welcome user! this is the body of the mail');
         });

         //return redirect('admin/clientdetails');


         
            
    }
    



















//------------------------------------------------demo-------------------------------------------

    public function cli(Request $request)
    {
         $data=Client::where('status','1')->get();
        return view('Admin::add',['data'=>$data]);
    }

    public function Qu(Request $request)
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
        Mail::send([], $data, function($message)use($data,$email,$pdf) {
            $message->to($email, $data["client_name"])
            ->subject($data["subject"])
            ->setBody('Hi, renewal message');
            });   
      }
        
       



        






        //$s=$request->client_id;
        //return $s;
    //    $s=1;
    //    $data=Quotation::with(array('clients' => function ($query) {
    //     $query->select('company_name','email','id');  
    // }))->with(array('products' => function ($query) {
    //     $query->select('product','id');
    // }))->with(array('users' => function ($query) {
    //     $query->select('name','id');
    
    // }))->where('id',$s)->get();


    //      return $data;
    

    // $data=Quotation::with(array('clients' => function ($query) {
    //     $query->select('company_name','email','id');  
    // }))->with(array('products' => function ($query) {
    //     $query->select('product','id');
    // }))->with(array('users' => function ($query) {
    //     $query->select('name','id');}))->
    //  get();


        // $id=$request->id;
        // $data=DB::table('client_product_carts')->join('clients','clients.id','=',
        // 'client_product_carts.client_id')
        // ->join('products','products.id','=','client_product_carts.product_id')
        // ->select('products.product as id')
        // ->where('client_product_carts.client_id','=',$id)->get();
        // dd($data);
    }
//------------------------------------------------------end-----------------------------------------------------

}
