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


    public static function initProduct($additional_fields){
        $product = new Product();
        foreach ($additional_fields as $field => $value) {
            $product->$field = $value;
        }
        $record_before = json_encode([]);
        $record_after = json_encode($product);
        $description = Auth::user()->name.' initialized Product record';
        $product->save();
        Helper::initLogRecord('Product', $product->id, null, null, 'init', $description, $record_before, $record_after);
        return $product->id;
    }


    public static function handleEdit($id)
    {
        return self::where('id', $id)->first();
    }


    public function handleUpdate($data){
        $record_before = json_encode($this);
        //save_as_new
        //some-data
        $this->category_id = $data['category_id'];
        $this->name = $data['name'];

        if (!$this->admin_show) {
            $description = Auth::user()->name . ' saved product record';
            $operation = 'save';


            $record_before = json_encode([]);
            $record_after = json_encode($this);
        } else {
            $description = Auth::user()->name . ' updated product record';
            $operation = 'update';
            $record_after = json_encode($this);
        }
        $this->admin_show = 1;
        Helper::initLogRecord('Product', $this->id, null, null, $operation, $description, $record_before, $record_after);
        return [$this->save()];
    }


    public static function productsIndex()
    {
        return self::orderBy('stuff_order', 'asc')->where('admin_show', 1);
        //@@some-data@@
    }


   public static function productsIndexSorting($query, $request)
   {
       if ($request->order[0]) {
           if ($request->columns[$request->order[0]['column']]['name'] == 'category_id') {
               $query->orderBy('products.category_id', $request->order[0]['dir']);
           }
           if ($request->columns[$request->order[0]['column']]['name'] == 'name') {
               $query->orderBy('products.name', $request->order[0]['dir']);
           }
           if ($request->columns[$request->order[0]['column']]['name'] == 'created_at') {
               $query->orderBy('products.created_at', $request->order[0]['dir']);
           }


       }
   }


    public static function allproducts($request)
    {
        //some_data
        $products= self::with(['Category',])->where('products.admin_show', 1)
            //--@ordering@--
         ;
        return $products;
    }


    public static function filterproducts($query,$request)
    {

        if ($request->has('products_name')) {
            $query->where("name", 'like','%'.$request->input('products_name').'%');
        }
        if ($request->input('a_products_created_at')) {
            $query->whereDate("created_at", '>=', $request->input('a_products_created_at'));
        }
        if ($request->input('b_products_created_at')) {
            $query->whereDate("created_at", '<=', $request->input('b_products_created_at'));
        }
        if ($request->has('products_category_name')) {
            $products_category_name = explode(',',$request->products_category_name);
            $query->whereHas('Category', function($q) use ($products_category_name){
                $q->whereIn('categories.name',$products_category_name);
            });                  
        }

    }


    public function handleDelete()
    {
        $record_before = json_encode($this);
        $id = $this->id;
        $this->delete();
        $record_after = json_encode([]);
        $description = Auth::user()->name . ' deleted Product record';
        $data = Helper::initLogRecord('Product', $id, null, null, 'delete', $description, $record_before, $record_after);
    }

//relations
}
