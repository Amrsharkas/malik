<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\Helper;
use Yajra\DataTables\Facades\DataTables;
//uses
class CategoryController extends Controller
{


    public function reOrder(Request $request)
    {
        Category::reOrder($request->orderList);
    }

    public function index()
    {
        $data['categories'] = Category::categoriesIndex()->get();
        $data['partialView'] = 'category.list.index';
        return view('category.base', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['id'] = $id;
        $category = Category::handleEdit($id);
        $data['category'] = $category;
        $data['admin_show'] = $category->admin_show;
        $data['partialView'] = 'category.form.edit';


        $data['form_action_class'] = 'hidden';
        return view('category.base', $data);
    }

    public function update(Request $request, $id)
    {
        $validateFormsRequests = Helper::validateFormsRequests($request->all(), $id);

        if ($validateFormsRequests['pass'] === 0) {
            return response()->json([
                'status' => 'error',
                'msg' => 'This record can\'t be saved',
                'page' => 'none',
                'forms_errors' => $validateFormsRequests['validate_data']]);
        }

        $category = Category::findOrFail($id);
        $data = $request->input();
        //some-data

        $category_saved = $category->handleUpdate($data);
        if ($category_saved) {
            $response = [];
            $response['status'] = 'success';
            $response['msg'] = 'Category successfully saved';
            $response['virtual_save'] = 1;
            $response['toastr'] = true;

            $action_chain['page'] = route('category.index');
            $action_chain['toastr']['type'] = 'success';
            $action_chain['toastr']['title'] = 'Success';
            $action_chain['toastr']['msg'] = 'Category successfully saved';
            $response['action_chain'] = $action_chain;

            return response()->json($response);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'This record can\'t be saved', 'page' => 'none']);

        }
    }

    public function init($additional_fields = [])
    {
        $category_id = Category::initCategory($additional_fields); //returns record id
        return redirect(route('category.edit', ['id' => $category_id]));
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->handleDelete();
    }
    public function deleteCells(Request $request)
    {
        $deleted_items_id = $request->item;
        if (is_array($deleted_items_id)) {
            foreach ($deleted_items_id as $item_id){
                $item =Category::findOrFail($item_id);
                $item->handleDelete();
            }
        } else {
            $item =Category::findOrFail($deleted_items_id);
            $item->handleDelete();
        }
        return Response()->json(['delete' => 'items deleted successfully']);
    }

    public function categoriesDatatable(Request $request)
    {
        $data = [];
        $categories = Category::allcategories($request);
        //some_data

        return DataTables::eloquent($categories)
                    ->addColumn('action', function($category) {
                $actions='';
                if (Auth::user()->hasAnyRole(["Admin"])) {
                    $actions .= '<a href="/category/'.$category->id .'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill pjax-link" title="Edit"><i class="la la-edit"></i></a> ';
                }
                if (Auth::user()->hasAnyRole(["Admin"])) {
                    $actions .='<a href="/category/'.$category->id .'/delete" data-method="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill remove-stuff" title="Delete"><i class="la la-trash"></i></a> ';
                }return $actions ;
            })
                    
                    
            ->addColumn('order', function ($category) {
                $order = '';
                $order .= '<input type="hidden" value="' . $category->id . '" class="reorder-vals"/>';
                return $order;
            })
            ->addColumn('multiple_delete', function ($category) {
                $multiple_delete = '<input type="hidden" value="' . $category->id . '" class="reorder-vals"/>
               <input type="checkbox" name="items[]" class="table-checkbox" value="' . $category->id . '"/>';
                return $multiple_delete;
            })->rawColumns([ 'action', 'order', 'multiple_delete',])
                    //--@image-proccessing@--
            ->filter(function ($query) use ($request) {
                Category::filtercategories($query, $request);
            })
            ->order(function ($query) use ($request) {
                Category::categoriesIndexSorting($query, $request);
            })
            ->make(true);
    }

//functions


}
