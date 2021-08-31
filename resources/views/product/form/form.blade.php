<form id="main-form" class="ajax_form j-forms call-lrgt" method="post" action="{{route('product.update' , ['id'=>$product->id])}}"
      data-beforeSerialize="" data-beforeSubmit=""
      data-request="App/Http/Requests/ProductRequest" data-on-start="false"
>
    {{csrf_field()}}
    <div class="content">
        
        <div class="unit form-group " >
            <label class="label">Category <span class="required" aria-required="true"> * </span></label>
            <label class="input select">
                <select name="category_id" id="category_id" class="form-control "
                 data-name="Category" data-validation=",required" 
                data-editable="0" data-url="">
                    <option value="">Select Category <span class="required" aria-required="true"> * </span></option>
                    @foreach($product_categories as $category)
                        <option data-depending-value="{{$category->id}}" @if($product->category_id && ($product->category_id == $category->id)) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                              {{--<option>add new option</option>--}}
                </select>
                <span class="error_message error-view"></span>
                <i></i>
            </label>
        </div>

        <div class="unit form-group "  >
            <label class="label">Name <span class="required" aria-required="true"> * </span></label>
            <input value="{{$product&&$product->name?$product->name:''}}" class="form-control" type="text" name="name" id="name" data-name="Name"  data-validation=",alpha_num,required" />
        </div>

        <div class="form-actions form_save {{$form_action_class}}">
            <div class="btn-set pull-right">
                <?php if(isset($_GET['clone'])){?><input type="hidden" name="new" value="1"><?php ;}?> <input type="submit" name="new" class="<?php if(!isset($_GET['clone'])){?>hide<?php ;}?> btn btn-lg color do_clone btn-primary" value="Save as new">
                <input type="submit" name="update" class="<?php if(isset($_GET['clone'])){?>hide<?php ;}?> btn btn-lg btn-edit do_save btn-info" value="Save">
            </div>
        </div>
    </div>
</form>

