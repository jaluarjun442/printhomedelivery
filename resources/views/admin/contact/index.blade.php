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

                    Contact Messages

                </div>


                <div class="card-body">

                    <table class="table table-bordered datatable">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Mobile</th>

                                <th>Subject</th>

                                <th>Date</th>

                                <th>Status</th>

                                <th>Action</th>

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



<script type="text/javascript">

    $(document).ready(function() {

        var table = $('.datatable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('admin.get_contact') }}",

            order: [
                [0, 'desc']
            ],

            columns: [

                {
                    data: 'id',
                    name: 'id'
                },

                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'mobile',
                    name: 'mobile'
                },

                {
                    data: 'subject',
                    name: 'subject'
                },

                {
                    data: 'created_at',
                    name: 'created_at'
                },

                {
                    data: 'is_read',
                    name: 'is_read',
                    orderable: false
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