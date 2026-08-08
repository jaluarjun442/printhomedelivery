@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Category - {{ $category_data['name'] }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update_category') }}" id="add_form" name="add_form">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $category_data['id'] }}" />
                        <input type="hidden" name="old_image" id="old_image" value="{{ $category_data['image'] }}" />
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Parent Category</label>
                                <select name="parent_category_id" id="parent_category_id" class="form-control">
                                    <option value="">Select Option</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option <?php
                                                if ($category_data['parent_category_id'] == $value['id']) {
                                                    echo 'selected';
                                                }
                                                ?> value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo $category_data['name']; ?>" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
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