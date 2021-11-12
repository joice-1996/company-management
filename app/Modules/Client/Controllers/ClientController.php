<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Product as Product;
use App\User as User;
use Validator;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;
use File;
use App\licence;
use App\Modules\Client\Models\Client as Client;
use App\Modules\Client\Models\CompanyBranch as CompanyBranch;
use App\Modules\Client\Models\CompanyContact as CompanyContact;
use App\Modules\Client\Models\ClientProductCart as ClientProductCart;

class ClientController extends Controller
{
     /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param 
    * @Date 11-05-2021
    * @module  Client
    * Description: Client ADD And View Page
    **/
    public function indexold(Request $request)
    {
        return view('Client::client');
    }
    public function index(Request $request)
    {
        //$this->client_export($request);
        $data = [];
        $input = $request->all();
       
         //return $input;
        if (isset($input['data'])) {
             $data = json_decode($input['data']);
             $data = json_decode(json_encode($data), true);
            // return $data;
           //return $data['to_filter']['customization'];
        //    return $data['to_filter']['product_id'];
        }        
       
        //$client_det=Client::all();
        $query=Client::with(array('consultant'=> function ($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query){
            $query->select('branches','client_id','id');
        }))->with(array('company_phones' => function($query){
            $query->select('contact_number','client_id','id');
        }))->with(array('company_cart_products'=> function ($query){
            $query->select('product_id','client_id','start_date','expiry_date','no_of_license','customization_description'
            ,'customization_amount','license_amount','platform_charge','id')->with(array('products' => function($query){
                $query->select('product','id');
            }));
        }))->where('status','!=','0');
      
        if(isset($data['to_filter']['customization'])&& ($data['to_filter']['customization']=="no"))
        {
            $query->whereHas('company_cart_products', function ($qu) use ($data) {
                $qu->whereNotNull('customization_description');
            });
            //$query->whereNull('customization_description');
            
        }
        else 
        {
            if(isset($data['to_filter']['customization'])&& ($data['to_filter']['customization']=="yes"))
            {
                $query->whereHas('company_cart_products', function ($qu) use ($data) {
                    $qu->whereNull('customization_description');  
                });
               // $query->whereNotNull('customization_description');    
            }
        }
        // return $query->get();
         if(isset($data['to_filter']['consultant_id']) && ($data['to_filter']['consultant_id']))
        {           
            $query->where('user_id',$data['to_filter']['consultant_id']);
               
         }
         
        // return $data['to_filter']['product_id'];
        if(isset($data['to_filter']['product_id']) && ($data['to_filter']['product_id']) )
        {
            
            $query->whereHas('company_cart_products', function ($qu) use ($data) {
                $qu->where('product_id',$data['to_filter']['product_id']);
            });
        }
        
        if(isset($data['to_filter']['search']) && ($data['to_filter']['search']))
        {
            $search=$data['to_filter']['search'];
            //return $search;
            $query->whereHas('company_phones', function ($qu) use ($search) {
                $qu->where('contact_number','LIKE', "%{$search}%");
            })->orwhereHas('company_branches', function ($qu) use ($search) {
                $qu->where('branches','LIKE', "%{$search}%");
            })->orWhere('company_name', 'LIKE',"%{$search}%")
            ->orWhere('email','LIKE', "%{$search}%");
        }
        //->Where('name', 'LIKE', $search.'%') orwhere
        $clients=$query->get();

        //return $clients;
        $products=Product::where('status',1)->pluck('product','id');
        $consultants=User::where('user_type','!=','admin')->get();
        // return ['products'=>$products, 'consultants'=>$consultants,'clients'=>$clients];
        return view('Client::client',compact('products','consultants','clients'));
    }
     /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param 
    * @Date 13-05-2021
    * @module  Client
    * Description: Get Product to Javascript
    **/
    public function get_product()
    {
        $products=Product::where('status',1)->pluck('product','id');
        return json_encode($products);
    }
     /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param request #request
    * @Date 13-05-2021
    * @module  Client
    * Description: Client Registration
    **/
    public function addClient(Request $request)
    {
        $input = $request->all();
        //return $input;
        $client = json_decode($input['client']);
        //$logo=$input['logo'];
        $client = json_decode(json_encode($client), true);
        $product = json_decode($input['product']);
        $product = json_decode(json_encode($product), true);
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $extenstion = strtolower($file->getClientOriginalExtension());
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $destinationPath = 'uploads/';
            $name=str_replace(' ', '', $name);
            if (!is_dir($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
                $file_name_1 = $destinationPath . "/index.html";
                fopen($file_name_1, "w");
            }    
            $file_name = $name . round(microtime(true)) . rand(10, 10000000) . "." . $extenstion;
            $file->move($destinationPath, $file_name);
            $input['image'] = $file_name;
        } else {
            $input['image'] = '';
        }
        
        $client_id =  Client::insertGetId([
            "company_name"=>$client['companydata']['compayname'],
            "contact_person"=>$client['companydata']['contact_person'],
            "email"=>$client['companydata']['email'],
            "address"=>$client['companydata']['address'],
            "company_logo"=> $input['image'],
            "user_id"=>(integer)$client['companydata']['consultant'],
            "created"=>Carbon::now(),
            "status"=>'2'
        ]); 
        
        CompanyBranch::insert([
            "client_id"=>$client_id,
            "branches"=>$client['companydata']['branches']
        ]);

        CompanyContact::insert([
            "client_id"=>$client_id,
            "contact_number"=>$client['companydata']['phone']
        ]);


        foreach($product as $key )
        {
            foreach ($key as $value)
            {                
                ClientProductCart::insert([
                    "client_id"=>$client_id,
                    "product_id"=>$value['id'],
                    "start_date"=>$value['start_date'],
                    "expiry_date"=>$value['expiry_date'],
                    "no_of_license"=>$value['licenses'],
                    "customization_description"=>$value['customization_description'],
                    "customization_amount"=> (float)$value['customization_amount'],
                    "license_amount"=>(float)$value['license_amount'],
                    "platform_charge"=>(float)$value['platform_charge'],
                    "installation_charge"=>(float)$value['installation_charge']
                ]);
            }
             
        }

        

        
         return 'success'; 
    }
    /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param 
    * @Date 17-05-2021
    * @module  Client
    * Description: Client Export
    **/
    public function client_export(Request $request)
    {
        $input=$request->all();
        //return $input;   

       
        //$client_det=Client::all();
        $query=Client::with(array('consultant'=> function ($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query){
            $query->select('branches','client_id','id');
        }))->with(array('company_phones' => function($query){
            $query->select('contact_number','client_id','id');
        }))->with(array('company_cart_products'=> function ($query){
            $query->select('product_id','client_id','start_date','expiry_date','no_of_license','customization_description'
            ,'customization_amount','license_amount','platform_charge','id')->with(array('products' => function($query){
                $query->select('product','id');
            }));
        }))->where('status','!=','0');
      
        if(isset($input['cust'])&& ($input['cust']=="no"))
        {
            $query->whereHas('company_cart_products', function ($qu) use ($input) {
                $qu->whereNotNull('customization_description');
            });
            //$query->whereNull('customization_description');
            
        }
        else 
        {
            if(isset($input['cust'])&& ($input['cust']=="yes"))
            {
                $query->whereHas('company_cart_products', function ($qu) use ($input) {
                    $qu->whereNull('customization_description');  
                });
               // $query->whereNotNull('customization_description');    
            }
        }
        // return $query->get();
         if(isset($input['consultant_id']) && ($input['consultant_id']))
        {           
            $query->where('user_id',$input['consultant_id']);
               
         }
         
        // return $data['to_filter']['product_id'];
        if(isset($input['product_id']) && ($input['product_id']) )
        {
            
            $query->whereHas('company_cart_products', function ($qu) use ($input) {
                $qu->where('product_id',$input['product_id']);
            });
        }
        
        if(isset($input['search_client']) && ($input['search_client']))
        {
            $search=$input['search_client'];
            //return $search;
            $query->whereHas('company_phones', function ($qu) use ($search) {
                $qu->where('contact_number','LIKE', "%{$search}%");
            })->orwhereHas('company_branches', function ($qu) use ($search) {
                $qu->where('branches','LIKE', "%{$search}%");
            })->orWhere('company_name', 'LIKE',"%{$search}%")
            ->orWhere('email','LIKE', "%{$search}%");
        }
        //->Where('name', 'LIKE', $search.'%') orwhere
        $clients=$query->get();
        //return $clients;
       // return $input;
         
        /*  $clients=Client::with(array('consultant'=> function ($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query){
            $query->select('branches','client_id','id');
        }))->with(array('company_phones' => function($query){
            $query->select('contact_number','client_id','id');
        }))->with(array('company_cart_products'=> function ($query){
            $query->select('product_id','client_id','start_date','expiry_date','no_of_license','customization_description'
            ,'customization_amount','license_amount','platform_charge','id')->with(array('products' => function($query){
                $query->select('product','id');
            }));
        }))->get();  */
        //return $clients;
        
             
       
      return (new FastExcel($clients))->download('client.xlsx', function ($clients) {

        return [
            'Contact Person' => $clients->contact_person,
            'Company Name' => $clients->company_name,
            'Email' => $clients->email,
            'Logo' => $clients->logo,
            'Consultant' => $clients->consultant['name'],
            'Address' => $clients->address,
            'Contact Number'=> $this->getphoneNumber($clients->company_phones),
            'Branches'=> $this->getBranchName($clients->company_branches),
            'Product Details'=>$this->getProductDetails($clients->company_cart_products),
            ];
         });
    
        // return (new FastExcel($data))->download('file.xlsx');
    }
    public function getphoneNumber($phonenumbers)
    {
        
        $str = '';
        foreach($phonenumbers as $phone)
        {
            $str .= $phone['contact_number'] . ',';
        }
        // print_r($str);exit;die;
        return $str;
    }
    public function getBranchName($Branch)
    {
        
        $str = '';
        foreach($Branch as $branchname)
        {
            $str .= $branchname['branches'] . ',';
           
        }
        
        return $str;
    }
    public function getProductDetails($productDetails)
    {
        
        $str = '';
        
        foreach($productDetails as $products)
        {

            //$str .= $products['cust_amt'];
           $str .= 'Customer Amount'.": ".$products['customization_amount']."\n".
                'Customer Descripiton'.": ".$products['customization_description']."\n".
                    'Platform Charge'." : ".$products['platform_charge']."\n".
                     'Number of License'.": ".$products['no_of_license']."\n".
           'License Amount'.":".$products['license_amount']."\n".'Start Date'.": ".$products['start_date'] ."\n".
           'Expiry Date'.": ".$products['expiry_date'];
           
        }
        

        //  print_r($str);exit;die;
        
         return $str;  
    }

   

  /*   public function client_view()
    {
        return $clients=Client::with(array('consultant'=> function ($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query){
            $query->select('branches','id');
        }))->with(array('company_phones' => function($query){
            $query->select('contact_number','id');
        }))->with(array('company_cart_products'=> function ($query){
            $query->select('product_id','id')->with(array('products' => function($query){
                $query->select('product','id');
            }));
        }))->get();
        return view
    }
 */   

  /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param $id
    * @Date 17-05-2021
    * @module  Client
    * Description: Client Delete(set status=0)
    **/
    public function client_delete($id)
    {
        $client=Client::where('id',$id)->first();
        if($client->status == '1')
        {
            return "company is activated can not to delete";
        }
        else
        {
            Client::where('id',$id)->update(['status'=>'0']);
            return "Successfully deleted";
        }
        
    } 
    
      /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param $id
    * @Date 18-05-2021
    * @module  Client
    * Description: Client Deactivate
    **/

    public function client_deactivate($id)
    {
        $client=Client::where('id',$id)->first();
       
            Client::where('id',$id)->update(['status'=>'2']); 
            return "Company is Deactivated";
    
        
        

    }

      /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param $id
    * @Date 18-05-2021
    * @module  Client
    * Description: Client Edit view
    **/
    public function client_edit_view($id)
    {
        $client=Client::with(array('consultant'=> function ($query){
            $query->select('name','id');
        }))->with(array('company_branches' => function ($query){
            $query->select('branches','client_id','id');
        }))->with(array('company_phones' => function($query){
            $query->select('contact_number','client_id','id');
        }))->with(array('company_cart_products'=> function ($query){
            $query->select('product_id','client_id','start_date','expiry_date','no_of_license','customization_description'
            ,'customization_amount','license_amount','installation_charge','platform_charge','id')->with(array('products' => function($query){
                $query->select('product','id');
            }));
        }))->where('id',$id)->first();

        return  json_encode($client);

    }
       /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param $id
    * @Date 18-05-2021
    * @module  Client
    * Description: Client Activate
    **/

    public function client_activate($id)
    {
        Client::where('id',$id)->update(['status'=>'1']); 
            return "Company is Activated";
    }

       /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param $id
    * @Date 19-05-2021
    * @module  Client
    * Description: Client Edit
    **/

    public function edit_client(Request $request)
    {
        $input = $request->all();
        //return $input;
        $client = json_decode($input['client']);
        //$logo=$input['logo'];
        $client = json_decode(json_encode($client), true); 
        
       
        if ($request->hasfile('logo1')) {
            $file = $request->file('logo1');
            $extenstion = strtolower($file->getClientOriginalExtension());
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $destinationPath = 'uploads/';
            $name=str_replace(' ', '', $name);
            if (!is_dir($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
                $file_name_1 = $destinationPath . "/index.html";
                fopen($file_name_1, "w");
            }    
            $file_name = $name . round(microtime(true)) . rand(10, 10000000) . "." . $extenstion;
            $file->move($destinationPath, $file_name);
            $input['image'] = $file_name;
        } else {
            $input['image'] = '';
        }
        $id=$client['clientdata']['client_id'];
          Client::where('id',$id)->update([
            "company_name"=>$client['clientdata']['compayname'],
            "contact_person"=>$client['clientdata']['contact_person'],
            "email"=>$client['clientdata']['email'],
            "address"=>$client['clientdata']['address'],
            "company_logo"=> $input['image'],
            "user_id"=>(integer)$client['clientdata']['consultant'],
            "created"=>Carbon::now(),
          
        ]); 
        
        CompanyBranch::where('client_id',$id)->update([
            "branches"=>$client['clientdata']['branches']
        ]);

        CompanyContact::where('client_id',$id)->update([
            "contact_number"=>$client['clientdata']['phone']
        ]);

        return "success";
    }
   
    
    //client_details
    public function client_details()
    {
        $data=DB::table('licences')->get();
        return view('Client::client-details',['data'=>$data]);
    }
}


