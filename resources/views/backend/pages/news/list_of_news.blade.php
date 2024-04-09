@extends('backend.index')

@section('content')



<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">21,459</h3>
                                <p class="text-success mb-0">(+29%)</p>
                            </div>
                            <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">4,567</h3>
                                <p class="text-success mb-0">(+18%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="ti ti-user-plus ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">19,860</h3>
                                <p class="text-danger mb-0">(-14%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="ti ti-user-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">237</h3>
                                <p class="text-success mb-0">(+42%)</p>
                            </div>
                            <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ti ti-user-exclamation ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table" id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>title</th>
                            <th>Status</th>
                            <th>Creator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>




{{-- Activate and diactivate--}}
<script>
    $(document).ready(function(){

        $(document).on('click', '.status-toggle', function(e){
            var id = $(this).data('id');
            var newStatus = $(this).data('status');
            var url = "{{ route('news.status', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {
                    // Assuming the response contains updated status information

                    if (response.status === 'active') {
                        $('.status-toggle[data-id="' + id + '"]').html('<span class="badge bg-label-success">Active</span>');
                        // toastr.success(response.notify.message);
                         Swal.fire({
                            title: 'Good job!',
                            text:response.notify.message,
                            icon: 'success',
                            customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    } else {
                        $('.status-toggle[data-id="' + id + '"]').html('<span class="badge bg-label-danger">Inactive</span>');
                        // toastr.success(response.notify.message);
                         Swal.fire({
                            title: 'Good job!',
                            text:response.notify.message,
                            icon: 'success',
                            customClass: {
                            confirmButton: 'btn btn-primary waves-effect waves-light'
                            },
                            buttonsStyling: false
                        });
                    }

                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });
    });
</script>


{{-- force delete --}}
<script>
    $(document).ready(function(){
            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
                var deleteBtn = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        var id = deleteBtn.data('id');
                        var url = "{{ route('delete.news', ':id') }}".replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                deleteBtn.closest('tr').remove();
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
            });

    });
</script>

{{-- ban --}}
<script>
    $(document).ready(function(){
            $(document).on('click', '.ban-btn', function (e) {
                e.preventDefault();
                var banBtn = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, ban it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'baned!',
                            text: 'Your file has been baned.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        var id = banBtn.data('id');
                        var url = "{{ route('ban.news', ':id') }}".replace(':id', id);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                banBtn.closest('tr').remove();
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
            });
    });
</script>

{{-- crete new  --}}
<script>
    $(document).ready(function(){
            $(document).on('click', '.create-new', function (e) {
                e.preventDefault();
                var url = "{{ route('add.news') }}";
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(response) {
                        window.location.href = url;
                    },
                    error: function(xhr, error) {
                        toastr.error(error);
                    }
                });
            });
    });
</script>

{{-- Table Data --}}
<script>
    $(function(){

        var addButton = "Add New News";
        var tableTitle = "List Of News";
        var columnNumber = [1,2,3,4];
        var url = "{{ route('list.news') }}";
        let table =$('#table');

        table.dataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax:url,
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    responsivePriority: 3,
                    checkboxes: true,
                    render: function (id) {
                        return '<input type="checkbox" value="'+id+'" class="dt-checkboxes form-check-input select-item">';
                    },
                    checkboxes: {
                        selectAllRender:
                            '<input type="checkbox" class="form-check-input select-all-items">',
                    },
                }
            ],
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    visible: true
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '3%'
                },
                {
                    data: 'image',
                    name: 'name'
                },
                {
                    data: 'statusBtn',
                    name: 'status',
                    width: '15%'

                },
                {
                    data: 'creator',
                    name: 'creator',
                    width: '15%'

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },

            ],
            dom: '<"card-header flex-column flex-md-row"<"head-label fs-3 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [
                    {
                        extend: "collection",
                        className:
                            "btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light",
                        text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [
                            {
                                extend: "print",
                                text: '<i class="ti ti-printer me-1" ></i>Print',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: columnNumber,
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined &&
                                                    item.classList.contains(
                                                        "user-name"
                                                    )
                                                ) {
                                                    result =
                                                        result +
                                                        item.lastChild.firstChild
                                                            .textContent;
                                                } else if (
                                                    item.innerText === undefined
                                                ) {
                                                    result =
                                                        result + item.textContent;
                                                } else
                                                    result =
                                                        result + item.innerText;
                                            });
                                            return result;
                                        },
                                    },
                                },
                                customize: function (win) {
                                    //customize print view for dark
                                    $(win.document.body)
                                        .css("color", config.colors.headingColor)
                                        .css(
                                            "border-color",
                                            config.colors.borderColor
                                        )
                                        .css(
                                            "background-color",
                                            config.colors.bodyBg
                                        );
                                    $(win.document.body)
                                        .find("table")
                                        .addClass("compact")
                                        .css("color", "inherit")
                                        .css("border-color", "inherit")
                                        .css("background-color", "inherit");
                                },
                            },
                            {
                                extend: "csv",
                                text: '<i class="ti ti-file-text me-1" ></i>Csv',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: columnNumber,
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined &&
                                                    item.classList.contains(
                                                        "user-name"
                                                    )
                                                ) {
                                                    result =
                                                        result +
                                                        item.lastChild.firstChild
                                                            .textContent;
                                                } else if (
                                                    item.innerText === undefined
                                                ) {
                                                    result =
                                                        result + item.textContent;
                                                } else
                                                    result =
                                                        result + item.innerText;
                                            });
                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "excel",
                                text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: columnNumber,
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined &&
                                                    item.classList.contains(
                                                        "user-name"
                                                    )
                                                ) {
                                                    result =
                                                        result +
                                                        item.lastChild.firstChild
                                                            .textContent;
                                                } else if (
                                                    item.innerText === undefined
                                                ) {
                                                    result =
                                                        result + item.textContent;
                                                } else
                                                    result =
                                                        result + item.innerText;
                                            });
                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "pdf",
                                text: '<i class="ti ti-file-description me-1"></i>Pdf',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: columnNumber,
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined &&
                                                    item.classList.contains(
                                                        "user-name"
                                                    )
                                                ) {
                                                    result =
                                                        result +
                                                        item.lastChild.firstChild
                                                            .textContent;
                                                } else if (
                                                    item.innerText === undefined
                                                ) {
                                                    result =
                                                        result + item.textContent;
                                                } else
                                                    result =
                                                        result + item.innerText;
                                            });
                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "copy",
                                text: '<i class="ti ti-copy me-1" ></i>Copy',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: columnNumber,
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined &&
                                                    item.classList.contains(
                                                        "user-name"
                                                    )
                                                ) {
                                                    result =
                                                        result +
                                                        item.lastChild.firstChild
                                                            .textContent;
                                                } else if (
                                                    item.innerText === undefined
                                                ) {
                                                    result =
                                                        result + item.textContent;
                                                } else
                                                    result =
                                                        result + item.innerText;
                                            });
                                            return result;
                                        },
                                    },
                                },
                            },
                        ],
                    },
                    {
                        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">'+addButton+'</span>',
                        className:
                            "create-new btn btn-primary waves-effect waves-light me-2",
                    },
                    {
                        text: '<i class="ti ti-trash me-sm-1"></i> <span class="d-none d-sm-inline-block">Delete</span>',
                        className:
                            "btn btn-danger waves-effect waves-light delete-all d-none me-2",
                    },
                    {
                        text: '<i class="ti ti-ban me-sm-1"></i> <span class="d-none d-sm-inline-block">Ban</span>',
                        className:
                            "btn btn-info waves-effect waves-light ban-all d-none me-2",
                    },
                ],

        })
        $("div.head-label").html(
                '<h5 class="card-title mb-0"></h5>'+tableTitle+'</h5>'
            );
    })
</script>

{{-- Multiple select --}}
<script>
    $(document).ready(function(){
    $(document).on('change', '.select-all-items , .select-item', function(){
        if ($('.select-item:checked').length > 0) {
            $('.delete-all').removeClass('d-none');
            $('.ban-all').removeClass('d-none');
        }else {
            $('.delete-all').addClass('d-none');
            $('.ban-all').addClass('d-none');
        }
    });
    });
</script>

{{-- Multiple delete --}}
<script>
    $(document).ready(function(){

        $(document).on('click', '.delete-all', function(e){
            e.preventDefault();


            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });


                        var ids = [];
                        $('.select-item').each(function(){
                            if ($(this).is(':checked')) {
                                ids.push($(this).val());
                            }
                        });


                        if (ids.length <= 0) {
                            toastr.error('Please select atleast one item to delete.');
                            return;
                        }

                        var url = "{{ route('news.delete.multiple') }}";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function(response) {
                                $('#table').DataTable().ajax.reload();
                                $('.select-all-items').prop('checked', false);
                                $('.delete-all').addClass('d-none');
                                $('.restore-all').addClass('d-none');
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
        });
    });
</script>

{{-- Multiple Ban --}}
<script>
    $(document).ready(function(){

        $(document).on('click', '.ban-all', function(e){
            e.preventDefault();


            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, ban it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'baned!',
                            text: 'Your file has been baned.',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });


                        var ids = [];
                        $('.select-item').each(function(){
                            if ($(this).is(':checked')) {
                                ids.push($(this).val());
                            }
                        });


                        if (ids.length <= 0) {
                            toastr.error('Please select atleast one item to ban.');
                            return;
                        }

                        var url = "{{ route('news.ban.multiple') }}";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function(response) {
                                $('#table').DataTable().ajax.reload();
                                $('.select-all-items').prop('checked', false);
                                $('.delete-all').addClass('d-none');
                            },
                            error: function(xhr, error) {
                                toastr.error(error);
                            }
                        });
                    }
                });
        });
    });
</script>

@endsection
