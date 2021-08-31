<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helper;
use App\Traits\AllModels;

class  Category extends Model
{
    use AllModels;

    protected $table = 'categories';


    

    public function products()
    {
        return $this->hasMany('App\Product');
    }

//relations
}
