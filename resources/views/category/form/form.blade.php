<form id="main-form" class="ajax_form j-forms call-lrgt" method="post" action="{{route('category.update' , ['id'=>$category->id])}}"
      data-beforeSerialize="" data-beforeSubmit=""
      data-request="App/Http/Requests/CategoryRequest" data-on-start="false"
>
    {{csrf_field()}}
    <div class="content">
        
        <div class="unit form-group "  >
            <label class="label">Name <span class="required" aria-required="true"> * </span></label>
            <input value="{{$category&&$category->name?$category->name:''}}" class="form-control" type="text" name="name" id="name" data-name="Name"  data-validation=",alpha_num,required" />
        </div>

        <div class="form-actions form_save {{$form_action_class}}">
            <div class="btn-set pull-right">
                <?php if(isset($_GET['clone'])){?><input type="hidden" name="new" value="1"><?php ;}?> <input type="submit" name="new" class="<?php if(!isset($_GET['clone'])){?>hide<?php ;}?> btn btn-lg color do_clone btn-primary" value="Save as new">
                <input type="submit" name="update" class="<?php if(isset($_GET['clone'])){?>hide<?php ;}?> btn btn-lg btn-edit do_save btn-info" value="Save">
            </div>
        </div>
    </div>
</form>

