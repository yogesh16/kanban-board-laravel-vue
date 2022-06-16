<?php


namespace App\Http\Controllers\API;


use App\Models\Card;
use Illuminate\Http\Request;

class CardController
{
    /**
     * Get card
     */
    public function index(Request $request){

        $token = $request->access_token;
        if($token != env('ACCESS_TOKEN')){
            return response()->json(['status'=>false, 'msg'=> 'Invalid access code']);
        }

        $card = Card::select('id', 'title', 'description', 'created_at', 'deleted_at');
        if(isset($request->date) && $request->date != ''){
            $card->whereDate('created_at', date('Y-m-d', strtotime($request->date)));
        }
        if(isset($request->status) && $request->status == '1'){
            $card->whereNull('deleted_at');
        }
        else if(isset($request->status) && $request->status == '0'){
            $card->whereNotNull('deleted_at');
        }
        return response()->json($card->get());
    }
}
