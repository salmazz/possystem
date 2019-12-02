<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    
    protected $guarded = [];
    public $translatedAttributes = ['name'];
    protected $fillable = ['code'];

    public function products(){
       return  $this->hasMany(Product::class);
    }

}
