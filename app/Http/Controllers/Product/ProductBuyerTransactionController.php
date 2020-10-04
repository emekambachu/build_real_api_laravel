<?php

namespace App\Http\Controllers\Product;

use App\Buyer;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $buyer, Product $product)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        if($buyer->id === $product->seller_id ){
            return $this->errorResponse('The buyer must be different from the Seller', 409);
        }

        if(!$buyer->isVerified()){
            return $this->errorResponse('The Buyer must be a verified user', 409);
        }

        if(!$product->seller->isVerified()){
            return $this->errorResponse('The Seller Must be a verified User', 409);
        }

        if(!$product->isAvailable()){
            return $this->errorResponse('The Product is not Available', 409);
        }

        if($product->quantity < $request->quantity){
            return $this->errorResponse('The product does not have enough units for this transaction', 409);
        }

        return DB::transaction(function () use ($request, $product, $buyer){

            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction, 201);
        });
    }

}
