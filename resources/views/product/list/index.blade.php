@extends("portlets.index_default")

@section("title")
    products
@stop

@section("tools")
    @include("portlets.datatable_exports", ['export_image'=>0, 'export_pdf'=>1, 'export_excel'=>1])
@stop

@section("advanced_search")
    @include("product.list.advanced_search")
@stop
@section("buttons")
    @include("product.list.buttons")
@stop
@section("datatable")
    @include("product.list.datatable")
@stop


<div id="hidden" class="hidden" hidden>
    @include('advanced_search.date')
    @include('advanced_search.date_range')
    @include('advanced_search.normal_text')
    @include('advanced_search.num_range')
    @include('advanced_search.select_from_big_data')
    @include('advanced_search.select_from_db_data')
</div>
