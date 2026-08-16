@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    Edit Blog
                </div>

                <div class="card-body">

                    <form
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('admin.update_blog') }}"
                        id="add_form"
                        name="add_form">

                        @csrf

                        <input
                            type="hidden"
                            name="id"
                            id="id"
                            value="{{ $blog_data['id'] }}">


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
                                    value="{{ $blog_data['title'] }}"
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

                                    <option
                                        value="0"
                                        {{ $blog_data['status'] == 0 ? 'selected' : '' }}>
                                        Draft
                                    </option>

                                    <option
                                        value="1"
                                        {{ $blog_data['status'] == 1 ? 'selected' : '' }}>
                                        Published
                                    </option>

                                </select>

                            </div>


                            {{-- CURRENT IMAGE --}}

                            <div class="form-group col-md-6">

                                <label>
                                    Current Featured Image
                                </label>

                                @if($blog_data['image'])

                                <div class="mb-2">

                                    <img
                                        src="{{ asset('uploads/blog/' . $blog_data['image']) }}"
                                        alt="{{ $blog_data['title'] }}"
                                        style="
                                                width:180px;
                                                height:120px;
                                                object-fit:cover;
                                                border:1px solid #ddd;
                                                padding:3px;
                                            ">

                                </div>

                                @else

                                <div class="text-muted mb-2">
                                    No image uploaded.
                                </div>

                                @endif


                                <label>
                                    Replace Featured Image
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"
                                    accept="image/jpeg,image/png,image/webp">

                                <small class="text-muted">
                                    Leave empty to keep current image.
                                    Recommended: 1200 × 630px
                                </small>

                            </div>


                            {{-- PUBLISHED DATE --}}

                            <div class="form-group col-md-6">

                                <label>
                                    Published Date
                                </label>

                                <input
                                    type="datetime-local"
                                    class="form-control"
                                    name="published_at"
                                    id="published_at"
                                    value="{{ $blog_data->published_at ? $blog_data->published_at->format('Y-m-d\TH:i') : '' }}">

                                <small class="text-muted">
                                    Used when the blog is published.
                                </small>

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
                                    placeholder="Short description for blog listing...">{{ $blog_data['excerpt'] }}</textarea>

                            </div>


                            {{-- CONTENT --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Blog Content
                                </label>

                                <textarea
                                    class="form-control"
                                    id="content"
                                    name="content">{{ $blog_data['content'] }}</textarea>

                            </div>


                            {{-- META TITLE --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="meta_title"
                                    name="meta_title"
                                    value="{{ $blog_data['meta_title'] }}"
                                    maxlength="60"
                                    placeholder="SEO Meta Title">

                                <small class="text-muted">
                                    Recommended: 50–60 characters
                                </small>

                            </div>


                            {{-- META DESCRIPTION --}}

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
                                    placeholder="SEO Meta Description">{{ $blog_data['meta_description'] }}</textarea>

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
                                    value="{{ $blog_data['og_title'] }}"
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
                                    placeholder="Social Share Description">{{ $blog_data['og_description'] }}</textarea>

                            </div>


                            {{-- CURRENT SLUG --}}

                            <div class="form-group col-md-12">

                                <label>
                                    Current Slug
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $blog_data['slug'] }}"
                                    readonly>

                                <small class="text-muted">
                                    Slug is automatically generated from the title.
                                </small>

                            </div>


                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary">
                            Update
                        </button>


                        <a
                            href="{{ route('admin.blog') }}"
                            class="btn btn-secondary">
                            Back
                        </a>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
    CKEDITOR
===================================================== --}}

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


{{-- =====================================================
    VALIDATION
===================================================== --}}

<script>
    $(document).ready(function() {


        $("#add_form").validate({

            rules: {

                title: {
                    required: true
                },

                image: {
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
                    extension: "Please select a valid image."
                },

                excerpt: {
                    required: "Please enter short description."
                }

            }

        });


    });
</script>

@endsection