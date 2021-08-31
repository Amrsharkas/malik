<!--begin: Search Form -->


<!--begin: Search Form -->
<div style="" class="srch_form m-form m-form--label-align-right  m--margin-bottom-30">
    <div class="row align-items-center">
        <div class="col-xl-12 order-2 order-xl-1">
            <div class="row table_search" data-tableID="#products">


            </div>
        </div>
    </div>
</div>
<!--end: Search Form -->




<div class="m-nav__item  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--mobile-full-width m-dropdown--skin-light"
     m-dropdown-toggle="click">
    <a href="#" class="m-nav__link m-dropdown__toggle btn btn-info">
        <span class="m-topbar__userpic">
         Search
        </span>
    </a>

    <div class="m-dropdown__wrapper">
        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        <div class="m-dropdown__inner">
            <div class="m-dropdown__body">
                <div class="m-dropdown__content">
                    <ul class="m-nav m-nav--skin-light search_criteria_container" data-table="#products">
                        <li class="m-nav__item search_list">


                            <a href='#' data-search-type="search_normal_text"  data-title='Search'
                               data_inputs="products_name" class="open_modal m-nav__link"
                               data-beforeModalInit="initTextAndDateAndNumberRange">
                                Name
                            </a>


                            <a href='#' data-search-type="search_date_range"  data-title='Search'
                               data_inputs="a_products_created_at,b_products_created_at"
                               class="open_modal m-nav__link" data-beforeModalInit="initTextAndDateAndNumberRange">
                                Joining Created At
                            </a>


                            <a href='#' data-search-type="search_db_data"  data-title='Search'
                               data-seletct-option="{{route('product.category_name_data')}}"
                               data_inputs="products_category_name" class="open_modal m-nav__link"
                               data-beforeModalInit="initSelectOptions">
                                category_name
                            </a>
{{--@@search-a-tags@@--}}



                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

