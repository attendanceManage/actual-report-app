<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    // 
    public function index()
    {
       $clients = Clients::get();

       if(!empty($clients)){
          return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
       }  
     
       return response(['response'=>[ 'code'=>200,'data'=>$clients]],200);

    }

    public function view(Request $reqeust)
    {
      
        $clients = Clients::join('purchase','client.id','=','purchase.client_id')
        ->select('clients.id as id','clients.name as name',
                 'purchase.investment as price',
                 'purchase.gain_lose as gain_lose')
        ->where('id','=',$reqeust->id)
        ->get()
        ->groupBy();

        if(!empty($clients)){
            return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
         }  
       
         return response(['response'=>[ 'code'=>200,'data'=>$clients]],200);

    }

    public function create(Request $reqeust)
    {
        // validation here 

        $client =  new Clients();
        
        if(!empty($reqeust->username))
        {
          $client->username =  $reqeust->username;
        }
        
        if(!empty($reqeust->email))
        {
         $client->email =  $reqeust->email;
        }
      
        if(!empty($reqeust->password))
        {
         $client->password =  $reqeust->password;
        }
       
        if(!empty($client->save())){
          return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
        }

         return response(['response'=>[ 'code'=>200,'data'=>$clients]],200);
    }

}
