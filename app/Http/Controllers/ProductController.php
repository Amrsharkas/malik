<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use App\Helpers\Helper;
use Yajra\DataTables\Facades\DataTables;
use App\Category;
//uses
class ProductController extends Controller
{

    public function categoryNameData()
    {
        return Category::allCats()->pluck('name')->toArray();
    }

    public function index()
    {
        $data['products'] = Product::productsIndex()->get();
        $data['partialView'] = 'product.list.index';
        return view('product.base', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['id'] = $id;
        $product = Product::handleEdit($id);
        $data['product'] = $product;
        $data['admin_show'] = $product->admin_show;
        $data['partialView'] = 'product.form.edit';
        $data['product_categories'] = Category::where('admin_show', 1)->get();


        $data['form_action_class'] = 'hidden';
        return view('product.base', $data);
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

        $product = Product::findOrFail($id);
        $data = $request->input();
        //some-data

        $product_saved = $product->handleUpdate($data);
        if ($product_saved) {
            $response = [];
            $response['status'] = 'success';
            $response['msg'] = 'Product successfully saved';
            $response['virtual_save'] = 1;
            $response['toastr'] = true;

            $action_chain['page'] = route('product.index');
            $action_chain['toastr']['type'] = 'success';
            $action_chain['toastr']['title'] = 'Success';
            $action_chain['toastr']['msg'] = 'Product successfully saved';
            $response['action_chain'] = $action_chain;

            return response()->json($response);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'This record can\'t be saved', 'page' => 'none']);

        }
    }

    public function init($additional_fields = [])
    {
        $product_id = Product::initProduct($additional_fields); //returns record id
        return redirect(route('product.edit', ['id' => $product_id]));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->handleDelete();
    }
    public function deleteCells(Request $request)
    {
        $deleted_items_id = $request->item;
        if (is_array($deleted_items_id)) {
            foreach ($deleted_items_id as $item_id){
                $item =Product::findOrFail($item_id);
                $item->handleDelete();
            }
        } else {
            $item =Product::findOrFail($deleted_items_id);
            $item->handleDelete();
        }
        return Response()->json(['delete' => 'items deleted successfully']);
    }

    public function productsDatatable(Request $request)
    {
        $data = [];
        $products = Product::allproducts($request);
        //some_data

        return DataTables::eloquent($products)
                    ->addColumn('action', function($product) {
                $actions='';
                if (Auth::user()->hasAnyRole(["Admin","User"])) {
                    $actions .= '<a href="/product/'.$product->id .'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill pjax-link" title="Edit"><i class="la la-edit"></i></a> ';
                }
                if (Auth::user()->hasAnyRole(["Admin"])) {
                    $actions .='<a href="/product/'.$product->id .'/delete" data-method="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill remove-stuff" title="Delete"><i class="la la-trash"></i></a> ';
                }return $actions ;
            })
                    ->addColumn('category_name', function($query) {
                if ($query ->Category) {
                    return $query ->Category->name;
                }
                return '';
            })
                                ->addColumn('multiple_delete', function ($product) {
                $multiple_delete = '<input type="hidden" value="' . $product->id . '" class="reorder-vals"/>
               <input type="checkbox" name="items[]" class="table-checkbox" value="' . $product->id . '"/>';
                return $multiple_delete;
            })->rawColumns([  'multiple_delete','action', ])
                    //--@image-proccessing@--
            ->filter(function ($query) use ($request) {
                Product::filterproducts($query, $request);
            })
            ->order(function ($query) use ($request) {
                Product::productsIndexSorting($query, $request);
            })
            ->make(true);
    }

//functions


}
