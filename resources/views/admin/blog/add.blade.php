@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    Add Blog
                </div>

                <div class="card-body">

                    <form
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('admin.save_blog') }}"
                        id="add_form"
                        name="add_form">

                        @csrf


                        <div class="form-row">


                            {{-- TITLE --}}

                            <div class="form-group col-md-9">

                                <label>
                                    Title
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    name="title"
                                    placeholder="Blog Title">

                            </div>


                            {{-- STATUS --}}

                            <div class="form-group col-md-3">

                                <label>
                                    Status
                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="form-control">

                                    <option value="0">
                                        Draft
                                    </option>

                                    <option
                                        selected
                                        value="1">
                                        Published
                                    </option>

                                </select>

                            </div>


                            {{-- FEATURED IMAGE --}}

                            <div class="form-group col-md-6">

                                <label>
                                    Featured Image
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"
                                    accept="image/jpeg,image/png,image/webp">

                                <small class="text-muted">
                                    Recommended: 1200 × 630px
                                </small>

                            </div>


                            {{-- PUBLISHED AT --}}

                            <div class="form-group col-md-6">

                                <label>
                                    Published Date
                                </label>

                                <input
                                    type="datetime-local"
                                    class="form-control"
                                    name="published_at"
                                    id="published_at">

                            </div>


                            {{-- EXCERPT --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Short Description
                                </label>

                                <textarea
                                    class="form-control"
                                    id="excerpt"
                                    name="excerpt"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Short description for blog listing..."></textarea>

                            </div>


                            {{-- CONTENT --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Blog Content
                                </label>

                                <textarea
                                    class="form-control"
                                    id="content"
                                    name="content"></textarea>

                            </div>


                            {{-- SEO TITLE --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="meta_title"
                                    name="meta_title"
                                    maxlength="60"
                                    placeholder="SEO Meta Title">

                                <small class="text-muted">
                                    Recommended: 50–60 characters
                                </small>

                            </div>


                            {{-- SEO DESCRIPTION --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Meta Description
                                </label>

                                <textarea
                                    class="form-control"
                                    id="meta_description"
                                    name="meta_description"
                                    rows="3"
                                    maxlength="160"
                                    placeholder="SEO Meta Description"></textarea>

                                <small class="text-muted">
                                    Recommended: 140–160 characters
                                </small>

                            </div>


                            {{-- OG TITLE --}}

                            <div class="form-group col-md-6">

                                <label>
                                    OG Title
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="og_title"
                                    id="og_title"
                                    maxlength="100"
                                    placeholder="Social Share Title">

                            </div>


                            {{-- OG DESCRIPTION --}}

                            <div class="form-group col-md-6">

                                <label>
                                    OG Description
                                </label>

                                <textarea
                                    class="form-control"
                                    name="og_description"
                                    id="og_description"
                                    rows="2"
                                    maxlength="200"
                                    placeholder="Social Share Description"></textarea>

                            </div>


                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary">
                            Submit
                        </button>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    var editor = CKEDITOR.replace('content', {

        toolbar: 'Basic',

        enterMode: CKEDITOR.ENTER_BR,

        shiftEnterMode: CKEDITOR.ENTER_P,

        extraPlugins: 'autogrow',

        autoGrow_minHeight: 300,

        autoGrow_maxHeight: 800,

        autoGrow_bottomSpace: 50,

        removePlugins: 'resize',

        filebrowserBrowseUrl: '{{ env("APP_URL") }}/admin_asset/ckfinder/ckfinder.html',

        filebrowserUploadUrl: '{{ env("APP_URL") }}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'

    });


    CKFinder.setupCKEditor(editor);


    CKEDITOR.on(
        "instanceReady",
        function(event) {

            event.editor.on(
                "beforeCommandExec",
                function(event) {

                    if (
                        event.data.name == "paste"
                    ) {

                        event.editor._.forcePasteDialog = true;

                    }

                    if (
                        event.data.name == "pastetext" &&
                        event.data.commandData.from == "keystrokeHandler"
                    ) {

                        event.cancel();

                    }

                }
            );

        }
    );
</script>


<script>
    $(document).ready(function() {


        /*
        =====================================================
        AUTO FILL OG FIELDS
        =====================================================
        */

        $('#title').on(
            'input',
            function() {

                if (
                    $('#og_title').val() === ''
                ) {

                    $('#og_title').val(
                        $(this).val()
                    );

                }

            }
        );


        $('#excerpt').on(
            'input',
            function() {

                if (
                    $('#og_description').val() === ''
                ) {

                    $('#og_description').val(
                        $(this).val()
                    );

                }

            }
        );


        /*
        =====================================================
        FORM VALIDATION
        =====================================================
        */

        $("#add_form").validate({

            rules: {

                title: {
                    required: true
                },

                image: {
                    required: true,
                    extension: "jpg|jpeg|png|webp"
                },

                excerpt: {
                    required: true
                },

                meta_title: {
                    maxlength: 60
                },

                meta_description: {
                    maxlength: 160
                }

            },

            messages: {

                title: {
                    required: "Please enter blog title."
                },

                image: {
                    required: "Please select featured image."
                },

                excerpt: {
                    required: "Please enter short description."
                }

            }

        });


    });
</script>

@endsection