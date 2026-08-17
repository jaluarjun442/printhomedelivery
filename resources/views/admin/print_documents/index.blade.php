@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            @if (Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ Session::get('success') }}

            </div>

            @endif


            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <span>
                        Print Documents
                    </span>

                </div>


                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-bordered datatable"
                            width="100%">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Mobile</th>

                                    <th>File</th>

                                    <th>Pages</th>

                                    <th>Type</th>

                                    <th>Size</th>

                                    <th>Status</th>

                                    <th>Order ID</th>

                                    <th>Uploaded</th>

                                    <th width="100">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    $(document).ready(function() {


        var table = $('.datatable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.get_print_documents') }}",

            order: [
                [0, 'desc']
            ],

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'mobile',
                    name: 'mobile'
                },

                {
                    data: 'original_name',
                    name: 'original_name'
                },

                {
                    data: 'pages',
                    name: 'pages'
                },

                {
                    data: 'mime_type',
                    name: 'mime_type'
                },

                {
                    data: 'file_size',
                    name: 'file_size',
                    orderable: false
                },

                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'order_id',
                    name: 'order_id'
                },

                {
                    data: 'created_at',
                    name: 'created_at'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]

        });



        /*
        =====================================================
        DELETE DOCUMENT
        =====================================================
        */

        $(document).on(
            'click',
            '.delete-document',
            function() {

                var id =
                    $(this).data('id');


                if (!confirm(
                        'Are you sure you want to delete this document?'
                    )) {

                    return;

                }


                $.ajax({

                    url: "{{ url('/admin/delete_print_document') }}/" + id,

                    type: 'DELETE',

                    data: {

                        _token: "{{ csrf_token() }}"

                    },

                    success: function(response) {

                        if (response.success) {

                            alert(
                                response.message
                            );

                            table.ajax.reload(
                                null,
                                false
                            );

                        } else {

                            alert(
                                response.message
                            );

                        }

                    },

                    error: function(xhr) {

                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            alert(
                                xhr.responseJSON.message
                            );

                        } else {

                            alert(
                                'Unable to delete document.'
                            );

                        }

                    }

                });

            }
        );


    });
</script>

@endsection