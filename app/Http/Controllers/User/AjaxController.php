<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
       // logger($request->all());        //read log from storage>>laravel.log to know ajax,api,.. are work(like>>dd())
       if($request->status == 'desc'){
        $pizza = Product::orderBy('created_at','desc')->get();
       }else{
        $pizza = Product::orderBy('created_at','asc')->get();
       }
        return response()->json($pizza,200);
    }

    //return pizza list
    public function addToCart(Request $request){
        //logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete' ,
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    //order
    public function order(Request $request){
        //logger($request->all());
        foreach($request->all() as $item){
            OrderList::create([
                'user_id'=> $iem['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'] ,
                'total' => $item['total'] ,
                'order_code' => $item['order_code'] ,
            ]);
        }
        return response()->json([
            'status' => 'true' ,
            'message' => 'order Complete'
        ],200);
    }

    //get order data
    private function getOrderData($request){
        return[
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

}
