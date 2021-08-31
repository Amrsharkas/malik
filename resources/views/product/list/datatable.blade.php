
<!--begin: Datatable -->
<table class="table table-striped table-responsive m_datatable m-datatable--default m-datatable__table products init_datatable"
       data-route="{{route('product.Products_datatable')}}" data-excel="1" data-pdf="1" data-scrollX='true'
       data-processing="true" data-bFilter="false" data-bLengthChange="false" data-drawCallbackFN=""
       data-tableSortable="0" id="products" data-deleteRoute="{{route('product.handleDelete')}}"
       data-recordsPerPage="25">

    <thead>

    <tr>

        <th valign="middle" class="no-sorting table-checkbox-col" data-name="multiple_delete" data-nonSortable="1">
                <input type="checkbox" class="group-checkable"></th>
<th valign="middle" data-name="category_id" data-nonSortable="0">
                        Category
                    </th>
<th valign="middle" data-name="name" data-nonSortable="0">
                        Name
                    </th>
<th valign="middle" data-name="created_at" data-nonSortable="0">
                        Created At
                    </th>
<th valign="middle" data-name="action" data-nonSortable="1">Actions</th><th valign="middle" data-name="category_name" data-nonSortable="0">Category name</th>

    </tr>

    </thead>
    <tbody>
    </tbody>
</table>

<!--end: Datatable -->

