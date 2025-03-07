<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

        'quantity',
        'buyer_id',
        'product_id',

    ];
    /**
     * @var mixed
     */
    private $product;

    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
