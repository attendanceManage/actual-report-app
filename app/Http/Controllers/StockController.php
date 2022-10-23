<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function index()
    {
       $stock = Stock::get();

       if(!empty($stock)){
          return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
       }  
     
       return response(['response'=>[ 'code'=>200,'data'=>$stock]],200);

    }

    public function create(Request $request)
    {
      
        
       $stock =  new Stock();
            
        if(!empty($request->company_id))
        {
          $stock->company_id = $request->company_id;
        }

        if(!empty($request->company_id))
        {
          $stock->company_id = $request->company_id;
        }   

        if(!empty($request->unit_price))
        {
          $stock->unit_price = $request->unit_price;
        }

        if(!empty($stock->save()))
        {
            return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
        }
        
        return response(['response'=>[ 'code'=>200,'data'=>$stock]],200);
    }

    public function delete(Request $request ,$id)
    {

      if(!empty($id))
      {
        $stock = Stock::find($id);
        
        if($stock->delete()){
          return response(['response'=>[ 'code'=>200,'data'=>$stock,'message'=>'data_saved']],200);
        }

        return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);

      }

    }
  
    public function update(Request $request,$id)
    {
         
        $stock = Stock::find($id);
            
        if(!empty($request->company_id))
        {
          $stock->company_id = $request->company_id;
        }

        if(!empty($request->company_id))
        {
          $stock->company_id = $request->company_id;
        }   

        if(!empty($request->unit_price))
        {
          $stock->unit_price = $request->unit_price;
        }

        if(!empty($stock->save()))
        {
            return response(['response'=>[ 'code'=>404,'message'=>'data_not_found']],404);
        }
        
        return response(['response'=>[ 'code'=>200,'data'=>$stock,'message'=>'data_saved']],200);
    }




}
