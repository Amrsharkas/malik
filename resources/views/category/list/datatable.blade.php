
<!--begin: Datatable -->
<table class="table table-striped table-responsive m_datatable m-datatable--default m-datatable__table categories init_datatable"
       data-route="{{route('category.Categories_datatable')}}" data-excel="1" data-pdf="1" data-scrollX='true'
       data-processing="true" data-bFilter="false" data-bLengthChange="false" data-drawCallbackFN=""
       data-tableSortable="1" id="categories" data-deleteRoute="{{route('category.handleDelete')}}"
       data-recordsPerPage="25">

    <thead>

    <tr>

        <th valign="middle" data-name="order" data-hidden="1" data-nonSortable="1">order</th>
<th valign="middle" class="no-sorting table-checkbox-col" data-name="multiple_delete" data-nonSortable="1">
                <input type="checkbox" class="group-checkable"></th>
<th valign="middle" data-name="name" data-nonSortable="1">
                        Name
                    </th>
<th valign="middle" data-name="action" data-nonSortable="1">Actions</th>

    </tr>

    </thead>
    <tbody>
    </tbody>
</table>

<!--end: Datatable -->

