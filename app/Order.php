<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['client_id','total_price'];
    public function client(){
        return $this->belongsTo(Client::class);
    }//end of user

    public function products(){
        
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity');
    } // end of products 
}
