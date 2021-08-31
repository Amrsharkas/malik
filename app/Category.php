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


    public static function initCategory($additional_fields){
        $category = new Category();
        foreach ($additional_fields as $field => $value) {
            $category->$field = $value;
        }
        $record_before = json_encode([]);
        $record_after = json_encode($category);
        $description = Auth::user()->name.' initialized Category record';
        $category->save();
        Helper::initLogRecord('Category', $category->id, null, null, 'init', $description, $record_before, $record_after);
        return $category->id;
    }


    public static function handleEdit($id)
    {
        return self::where('id', $id)->first();
    }


    public function handleUpdate($data){
        $record_before = json_encode($this);
        //save_as_new
        //some-data
        $this->name = $data['name'];

        if (!$this->admin_show) {
            $description = Auth::user()->name . ' saved category record';
            $operation = 'save';


            $record_before = json_encode([]);
            $record_after = json_encode($this);
        } else {
            $description = Auth::user()->name . ' updated category record';
            $operation = 'update';
            $record_after = json_encode($this);
        }
        $this->admin_show = 1;
        Helper::initLogRecord('Category', $this->id, null, null, $operation, $description, $record_before, $record_after);
        return [$this->save()];
    }


    public static function reOrder($newSequence)
    {
        $order = 1;
        foreach ($newSequence as $id) {
            Category::where('id', '=', $id)->update(['stuff_order' => $order++]);
        }
        $description = Auth::user()->name . ' reordered Category records';
        $data = Helper::initLogRecord('Category', null, null, null, 'reorder', $description, null, null);

    }


    public static function categoriesIndex()
    {
        return self::orderBy('stuff_order', 'asc')->where('admin_show', 1);
        //@@some-data@@
    }


   public static function categoriesIndexSorting($query, $request)
   {
       if ($request->order[0]) {
           if ($request->columns[$request->order[0]['column']]['name'] == 'name') {
               $query->orderBy('categories.name', $request->order[0]['dir']);
           }


       }
   }


    public static function allcategories($request)
    {
        //some_data
        $categories= self::with([])->where('categories.admin_show', 1)
            ->orderBy('categories.stuff_order', 'asc')
         ;
        return $categories;
    }


    public static function filtercategories($query,$request)
    {

        if ($request->has('categories_name')) {
            $query->where("name", 'like','%'.$request->input('categories_name').'%');
        }

    }


    public function handleDelete()
    {
        $record_before = json_encode($this);
        $id = $this->id;
        $this->delete();
        $record_after = json_encode([]);
        $description = Auth::user()->name . ' deleted Category record';
        $data = Helper::initLogRecord('Category', $id, null, null, 'delete', $description, $record_before, $record_after);
    }


    public static function allCats()
    {
        $data= self::where('admin_show',1);

        return $data;
    }

//relations
}
