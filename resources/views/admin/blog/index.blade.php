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

            @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ Session::get('error') }}
            </div>
            @endif


            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    Blog

                    <a
                        class="btn btn-sm btn-primary"
                        href="{{ route('admin.add_blog') }}">
                        Add
                    </a>

                </div>


                <div class="card-body">

                    <table class="table table-bordered datatable">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Image</th>

                                <th>Title</th>

                                <th>Slug</th>

                                <th>Status</th>

                                <th>Published</th>

                                <th width="">Action</th>

                            </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">
    $(document).ready(function() {

        $('.datatable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.get_blog') }}",

            columns: [

                {
                    data: 'id',
                    name: 'id'
                },

                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'title',
                    name: 'title'
                },

                {
                    data: 'slug',
                    name: 'slug'
                },

                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'published_at',
                    name: 'published_at'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ]

        });

    });
</script>

@endsection