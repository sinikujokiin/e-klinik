<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;


class Medicine extends Eloquent{
    protected $table = 'medicines';
    use SoftDeletes;

    protected $fillable = [
        'code','name','description','stock', 'stock_min','purchase_price','selling_price','unit','type','status', 'image'
    ];
}
