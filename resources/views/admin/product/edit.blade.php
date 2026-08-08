@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit product</div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update_product') }}" id="add_form" name="add_form">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $product_data['id'] }}" />
                        <input type="hidden" name="old_image" id="old_image" value="{{ $product_data['image'] }}" />

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Category</label>
                                <select multiple="multiple" name="category_id[]" id="category_id" class="form-control category_id">
                                    <option value="">Select Option</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option <?php
                                                if (in_array($value['id'], $product_data['categories']->pluck('category_id')->toArray())) {
                                                    echo 'selected';
                                                }
                                                ?> value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Images</label>
                                <div id="images-container" class="row">
                                    @foreach($product_data['products_images'] as $image)
                                    <div class="image-item col-md-3">
                                        <img style="width: 100px;" src="{{ asset('uploads/product/' . $image->image) }}" alt="{{ $image->image }}">
                                        <button class="btn btn-danger delete-image" data-image-id="{{ $image->id }}" data-url="{{ route('admin.delete_product_image', ['id' => $image->id]) }}">Delete</button>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- File Input for Adding More Images -->
                                <div class="additional-images">
                                    <input type="file" class="form-control" name="image[]" multiple accept="image/*">
                                </div>
                                <button type="button" class="btn btn-secondary mt-2 add-more-images">Add More</button>
                            </div>

                            <div class="form-group col-md-9">
                                <label for="inputEmail4">Name</label>
                                <input type="text" value="<?php echo $product_data['name']; ?>" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Price</label>
                                <input type="text" value="<?php echo $product_data['price']; ?>" class="form-control" id="price" name="price" placeholder="Price">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Body</label>
                                <textarea class="form-control" id="body" name="body"><?php echo $product_data['body']; ?></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option <?php
                                            if ($product_data['status'] == 0) {
                                                echo 'selected';
                                            }
                                            ?> value="0">InActive</option>
                                    <option <?php
                                            if ($product_data['status'] == 1) {
                                                echo 'selected';
                                            }
                                            ?> value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Auto Redirect</label>
                                <select name="au_red" id="au_red" class="form-control">
                                    <option <?php
                                            if ($product_data['au_red'] == 0) {
                                                echo 'selected';
                                            }
                                            ?> value="0">InActive</option>
                                    <option <?php
                                            if ($product_data['au_red'] == 1) {
                                                echo 'selected';
                                            }
                                            ?> value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Buy Now Text</label>
                                <input type="text" class="form-control" value="<?php echo $product_data['buy_now_text']; ?>" id="buy_now_text" name="buy_now_text" placeholder="Buy Now Text">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Buy Now Link</label>
                                <input type="text" class="form-control" value="<?php echo $product_data['buy_now_link']; ?>" id="buy_now_link" name="buy_now_link" placeholder="Buy Now Link">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Attributes</label>
                                <div class="attribute-input-container">
                                    @foreach($product_data['products_attributes'] as $attribute)
                                    <div class="row attribute-row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="attributes[{{ $loop->index }}][name]" placeholder="Attribute Name" value="{{ $attribute->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="attributes[{{ $loop->index }}][value]" placeholder="Attribute Value" value="{{ $attribute->value }}">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-danger delete-attribute" data-attribute-id="{{ $attribute->id }}">Delete</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-secondary mt-2 add-attribute">Add More Attribute</button>
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
        $('.category_id').select2();
        $("#add_form").validate({
            rules: {
                category_id: {
                    required: true,
                },
                name: {
                    required: true,
                },
                // image: {
                //     required: true,
                // }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Add More Images
        $(document).on('click', '.add-more-images', function() {
            var $additionalImages = $(this).prev('.additional-images');
            var $clone = $additionalImages.clone();
            $clone.find('input[type="file"]').val(''); // Clear the cloned input value
            $additionalImages.after($clone); // Append the cloned input after the original one
        });
        $(document).on('click', '.add-attribute', function() {
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
        // Delete Image AJAX call
        $(document).on('click', '.delete-image', function(event) {
            event.preventDefault(); // Prevent default action
            var imageId = $(this).data('image-id');
            var url = $(this).data('url'); // Get the delete URL from data attribute
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Remove the image container from DOM
                    $(`.delete-image[data-image-id="${imageId}"]`).parent('.image-item').remove();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        // Delete Attribute AJAX call
        $(document).on('click', '.delete-attribute', function(event) {
            event.preventDefault(); // Prevent default action
            var attributeId = $(this).data('attribute-id');
            var url = '{{ route("admin.delete_product_attribute", ":id") }}';
            url = url.replace(':id', attributeId);
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Remove the attribute row from DOM
                    $(`.delete-attribute[data-attribute-id="${attributeId}"]`).closest('.attribute-row').remove();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection