@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add product</div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_product') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Category</label>
                                <select multiple="multiple" name="category_id[]" id="category_id" class="form-control category_id">
                                    <option value="">Select Option</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Image</label>
                                <div class="image-input-container">
                                    <input type="file" class="form-control" name="image[]" accept="image/*">
                                </div>
                                <button type="button" class="btn btn-secondary add-image">Add More Image</button>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Body</label>
                                <textarea class="form-control" id="body" name="body"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">InActive</option>
                                    <option selected value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Auto Redirect</label>
                                <select name="au_red" id="au_red" class="form-control">
                                    <option selected value="0">InActive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Buy Now Text</label>
                                <input type="text" value="Buy Now" class="form-control" id="buy_now_text" name="buy_now_text" placeholder="Buy Now Text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Buy Now Link</label>
                                <input type="text" class="form-control" id="buy_now_link" name="buy_now_link" placeholder="Buy Now Link">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Attributes</label>
                                <div class="attribute-input-container">
                                    <div class="row attribute-row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="attributes[0][name]" placeholder="Attribute Name">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="attributes[0][value]" placeholder="Attribute Value">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary add-attribute">Add More Attribute</button>
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
    var editor = CKEDITOR.replace('body', {
        toolbar: 'Basic',
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        extraPlugins: 'autogrow',
        autoGrow_minHeight: 200,
        autoGrow_maxHeight: 600,
        autoGrow_bottomSpace: 50,
        removePlugins: 'resize',

        filebrowserBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'


        // filebrowserBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html',
        // filebrowserImageBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html?type=Images',
        // filebrowserUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        // filebrowserImageUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        // removeButtons: 'PasteFromWord'
    });
    CKFinder.setupCKEditor(editor);

    CKEDITOR.on("instanceReady", function(event) {
        event.editor.on("beforeCommandExec", function(event) {
            // Show the paste dialog for the paste buttons and right-click paste
            if (event.data.name == "paste") {
                event.editor._.forcePasteDialog = true;
            }
            // Don't show the paste dialog for Ctrl+Shift+V
            if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                event.cancel();
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        // Add More Image button click event
        $('.add-image').click(function() {
            var $container = $(this).prev('.image-input-container');
            var $clone = $container.clone();
            $clone.find('input[type="file"]').val(''); // Clear the cloned input value
            $container.after($clone); // Append the cloned input after the original one
        });
        // Add More Attribute button click event
        $('.add-attribute').click(function() {
            var $container = $(this).prev('.attribute-input-container');
            var $clone = $container.find('.attribute-row:first').clone();
            $clone.find('input').val(''); // Clear the cloned input values
            $container.append($clone); // Append the cloned input after the original one

            // Update input names for the new attribute inputs
            $clone.find('input[name^="attributes"]').each(function() {
                var index = $container.find('.attribute-row').length - 1; // Get the new index
                var newName = $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']'); // Update index in name attribute
                $(this).attr('name', newName); // Set the updated name attribute
            });
        });


        // Select2 initialization
        $('.category_id').select2();

        // Form validation
        $("#add_form").validate({
            rules: {
                category_id: {
                    required: true,
                },
                name: {
                    required: true,
                },
                price: {
                    required: true,
                },
            }
        });
    });
</script>
@endsection