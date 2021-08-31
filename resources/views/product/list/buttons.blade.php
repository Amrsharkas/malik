@if(Auth::user()->hasAnyRole(["Admin","User"]))
                <a  href="{{route('product.init')}}"
                  class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill portlet-btn  pjax-link">
                   <span>
                       <i class="la la-plus"></i>
                       <span>
                           Add
                       </span>
                   </span>
               </a>@endif
{{--@reorder-button@--}}
                <div class="portlet-btn">
                    <div class="btn-group portlet-btn">
                        <button  class="btn btn-danger multiple_delete m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"  data-tableID="#products">
                            Delete
                        </button>
                    </div>
                </div>
{{--@toggle@--}}