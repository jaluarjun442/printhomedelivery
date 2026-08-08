@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ Session::get('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Store
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.add_store') }}">Add</a>
                </div>
                <div class="card-body">
                    <table class="table  table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="">Action</th>
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
            ajax: "{{ route('admin.get_store') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'logo',
                    name: 'logo'
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endsection