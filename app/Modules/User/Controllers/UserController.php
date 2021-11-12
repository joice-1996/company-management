<?php
namespace App\Modules\User\Controllers;

use App\Helpers\getUsers;
use App\Http\Controllers\Controller;
use App\User as User;
use App\UserType as UserType;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use Config;
use App\licence;
use DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Response;
use Carbon\Carbon;

class UserController extends Controller
{

    /**
     * Laravel  6.0
     * @package company-management
     * @author  LIMI
     * * @param  Request $request
     * @Date   11-05-2021
     * @module add
     * @Input  user registeration
     * output json array
     * Description: Battery list
     **/
    public function registrationView(Request $request)
    {
        $data1 = [];
        $input = $request->all();
         //return $input;
        if (isset($input['data'])) {
             $data1 = json_decode($input['data']);
             $data1 = json_decode(json_encode($data1), true);
             //return $data1;
        }        
        $query=User::with(array('department'=>function ($query){
            $query->select('user_type','id');
        }))->where('status','1');
        if(isset($data1['to_filter']['search']) && ($data1['to_filter']['search']))
        {
            $search=$data1['to_filter']['search'];
            //return $search;
            $query->Where('name', 'LIKE',"%{$search}%")
                ->orWhere('email','LIKE', "%{$search}%")
                ->orWhere('phone','LIKE',"%{$search}%")
                ->orWhere('address','LIKE',"%{$search}%");
        }
        if(isset($data1['to_filter']['department_id']) && ($data1['to_filter']['department_id']))
        {
            $query->where('usertype_id',$data1['to_filter']['department_id']);
        }
        $data=$query->get();
        //return $data;
        $department=UserType::all();
        $depart=UserType::all();
        return view('User::registration',compact('data','department','depart'));
    }
    /**
     * Laravel  6.0
     * @package company-management
     * @author  LIMI
     * * @param  Request $request
     * @Date   11-05-2021
     * @module add
     * @Input licence log
     * output json array
     * Description: licence log
     **/
    public function licence_log(Request $request)
    {
        $n=DB::table('client_product_carts')->get();
        //return $n;
        return view('User::licence_log',['data'=>$n]);
    }


    /**
     * Laravel  6.0
     * @package company-management
     * @author  LIMI
     * * @param  Request $request
     * @Date   11-05-2021
     * @module add
     * @Input  user registeration
     * output json array
     * Description: 
     **/
    
    public function add(Request $req)
    {  
       
        // $req->validate([
        //     'name'=>'required|regex:/^[\pL\s\-]+$/u',
        //     'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        //     'email'=>'required|email|unique:users',
        //     'password'=>'required|min:3|max:10',
        //     ]);
            
        
        $user=new User;
       
        $user->employe_id=$req->employe_id;
        $user->usertype_id=$req->department;
        $user->image=$req->image;
        $user->name=$req->name;
        //$user->address=$req->address;

     
        // $file = $req->image;
        // $destinationPath = 'uploads/';
        // $extenstion = strtolower($file->getClientOriginalExtension());
        // $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // $file_name = $name . "." . $extenstion;
        // if (!is_dir($destinationPath)) {
        //     File::makeDirectory($destinationPath, 0775, true);            
        // }
        // $file->move($destinationPath, $file_name);
        //$user->image=$req->image;
        
        $user->address=$req->address;
        $user->created=Carbon::now();
        $user->phone=$req->phone;
        $user->gender=$req->gender;
        $user->email=$req->email;
        $user->user_type='user';
        $user->password=Hash::make($req->password);
        $user->status='1';
        
        $user->save();
        return redirect()->back();
       
        // if($qry)
        // {
        //     return 1;
        // }
        // else
        // {
        //     return redirect()->back()->with('fail','Registration Failed');
        // }
    }

    // edit function
    public function edit($id)
    {
        $data=User::where("id",$id)
        ->first(array('id','name','address','phone'));
       
        return Response::json($data);
    }  
    // public function update_datefunction($data){
    //     $update=User::where('id'$data['id']);
    // }
  


    public function prelicence(Request $req)
    {
        $id=$req->id;
        $pid=$req->product_id;
       return $data=ClientProductCart::where("id",$id && "product_id",$pid)
        ->first();
       


    }





//licence add
public function addlicence(Request $req)
    {  
        $user=new licence;
        $user->previous_licence=$req->previous_licence;
        $user->current_licence=$req->current_licence;
        $user->name=$req->name;
        $user->current_date=$req->current_date;
        $user->save();
    
       return redirect()->back();
       
    }
    //view licence

    public function licence_view()
    {
       $data=DB::table('licences')->get();
        return view('User::licence_view',['data'=>$data]);
    }

    

    //delete function

    public function delete($id){
        $data=User::where('id',$id)->update(array('status'=>0));
       //$flag= DB::update('update products set status=? where id=?',['0',$id]);
         if($data){
          return 'success';
          }
          else{
          return 'failed';
          }
      }
       /**
    Laravel 6.0
    * @package Company Management
    * @author Joice Sara Joseph
    * @param 
    * @Date 18-05-2021
    * @module  Client
    * Description: User Export
    **/
    public function user_export(Request $request)
    {
        $input=$request->all();
       // return $input;
        $query=User::with(array('department'=>function ($query){
            $query->select('user_type','id');
        }))->where('status','1');
        if(isset($input['search_user']) && ($input['search_user']))
        {
            $search=$input['search_user'];
            //return $search;
            $query->Where('name', 'LIKE',"%{$search}%")
                ->orWhere('email','LIKE', "%{$search}%")
                ->orWhere('phone','LIKE',"%{$search}%")
                ->orWhere('address','LIKE',"%{$search}%");
        }
        if(isset($input['department_id']) && ($input['department_id']))
        {
            $query->where('usertype_id',$input['department_id']);
        }
        $data=$query->get();
        //return $data;
        return (new FastExcel($data))->download('users.xlsx', function ($dept) {

            return [
                'Name' => $dept->name,
                'Address' => $dept->address,
                'Phone' => $dept->phone,
                'Gender' => $dept->gender,
                'Image' => $dept->image,
                'email' => $dept->email,
                'Department' =>$dept->department->user_type,
               
             ];
        });
    }
    
    public function index()
    {
    

            $data = DB::table('user_type')->get();
              $user= User::with(array('department' => function($query){
               $query->select('user_type','id');
           }))->where([
               ['user_type', '!=', 'admin'],
               ['status', '!=', 0]
              ])
             
             ->get();
           
         
           return View::make('User::registration',compact('data','user')); 
       
        
    }

}
