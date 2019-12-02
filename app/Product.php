<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use \Dimsav\Translatable\Translatable;

    protected $table = 'products';

    
    protected $guarded = [];
    public $translatedAttributes = ['name','description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        return asset('uploads/product_images/'.$this->image);
    } // end of image path 

    public function category(){
        return $this->belongsTo(Category::class);
    } // end of category 
}
