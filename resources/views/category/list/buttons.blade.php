@if(Auth::user()->hasAnyRole(["Admin","User"]))
                <a  href="{{route('category.init')}}"
                  class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill portlet-btn  pjax-link">
                   <span>
                       <i class="la la-plus"></i>
                       <span>
                           Add
                       </span>
                   </span>
               </a>@endif
                                                                                                                                                                                                                                                                                                                                                                                                    
                <div class="portlet-btn">
                    <div class="btn-group portlet-btn">
                        <button disabled class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill reorder" data-action="{{route('category.reorder')}}">
                            Reorder
                        </button>
                    </div>
                </div>



                <div class="portlet-btn">
                    <div class="btn-group portlet-btn">
                        <button  class="btn btn-danger multiple_delete m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"  data-tableID="#categories">
                            Delete
                        </button>
                    </div>
                </div>
{{--@toggle@--}}