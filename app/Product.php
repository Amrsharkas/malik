<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helper;
use App\Traits\AllModels;

class  Product extends Model
{
    use AllModels;

    protected $table = 'products';


    
    public function category()
    {
        return $this->belongsTo('App\Category' , 'category_id' );
    }

//relations
}
