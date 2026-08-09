@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Price</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_price') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Parent Price</label>
                                <select name="parent_price_id" id="parent_price_id" class="form-control">
                                    <option value="">Select Option</option>
                                    <?php foreach ($price as $key => $value) { ?>
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">InActive</option>
                                    <option selected value="1">Active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#add_form").validate({
            rules: {
                name: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection