@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* ==========================================
   DOCUMENT UPLOAD
========================================== */

    .document-upload-section {
        background: #fbf9f4;
    }


    /* ==========================================
   MAIN ICON
========================================== */

    .upload-main-icon {
        font-size: 42px;
        color: #2860e8;
        line-height: 1;
    }


    /* ==========================================
   VERIFIED BADGE
========================================== */

    .upload-badge {
        display: inline-block;
        padding: 6px 12px;

        border: 1px solid #f1c36a;
        background: #fff7e4;

        color: #c76b00;

        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }


    /* ==========================================
   TITLE
========================================== */

    .upload-title {
        font-size: 38px;
        color: #111;
    }


    /* ==========================================
   HIGHLIGHT
========================================== */

    .upload-highlight {
        background: #ffe7a0;
        padding: 0 3px;
    }


    /* ==========================================
   UPLOAD BOX
========================================== */

    .upload-box {
        min-height: 215px;

        border: 1px dashed #c8c8c8;
        background: #fff;

        padding: 45px 25px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        transition: all .2s ease;
    }


    /* Dragging */

    .upload-box.drag-over {
        border-color: #2860e8;
        background: #f2f6ff;

        box-shadow:
            inset 0 0 0 2px rgba(40, 96, 232, .08);
    }


    /* ==========================================
   CLOUD ICON
========================================== */

    .upload-cloud-icon {
        font-size: 48px;
        color: #2860e8;
        line-height: 1;

        transition: .2s ease;
    }

    .upload-box.drag-over .upload-cloud-icon {
        transform: translateY(-5px);
    }


    /* ==========================================
   BROWSE
========================================== */

    .browse-link {
        color: #111;
        text-decoration: underline;
        cursor: pointer;
    }

    .browse-link:hover {
        color: #2860e8;
    }


    /* ==========================================
   INFO BOX
========================================== */

    .upload-info {
        padding: 6px 12px;

        border: 1px solid #d8d4cc;

        background: #faf7f0;

        color: #555;

        font-size: 12px;
    }


    /* ==========================================
   FILE LIST
========================================== */

    .file-list-container {
        background: #fff;

        border: 1px solid #ddd;

        padding: 15px;
    }


    /* Individual File */

    .upload-file-item {
        border: 1px solid #e4e4e4;

        background: #fff;

        padding: 10px 12px;

        display: flex;
        align-items: center;

        gap: 12px;
    }

    .upload-file-item+.upload-file-item {
        border-top: 0;
    }


    /* ==========================================
   FILE ICON
========================================== */

    .file-icon {
        width: 38px;
        height: 38px;

        background: #edf3ff;
        color: #2860e8;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .file-icon i {
        font-size: 19px;
    }


    /* ==========================================
   FILE DETAILS
========================================== */

    .file-details {
        min-width: 0;
        flex: 1;
    }

    .file-name {
        font-size: 14px;
        font-weight: 600;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-size {
        font-size: 12px;
        color: #777;
    }


    /* ==========================================
   REMOVE BUTTON
========================================== */

    .remove-file {
        width: 32px;
        height: 32px;

        border: 0;

        background: #fff1f1;
        color: #dc3545;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .remove-file:hover {
        background: #dc3545;
        color: #fff;
    }


    /* ==========================================
   MOBILE
========================================== */

    @media (max-width: 767px) {

        .document-upload-section {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        .upload-main-icon {
            font-size: 36px;
        }

        .upload-title {
            font-size: 30px;
        }

        .upload-box {
            min-height: 230px;
            padding: 30px 15px;
        }

        .upload-cloud-icon {
            font-size: 42px;
        }

        .upload-box h4 {
            font-size: 16px;
            line-height: 1.5;
        }

        .upload-info {
            font-size: 11px;
            line-height: 1.5;
        }

        .upload-file-item {
            padding: 9px;
            gap: 8px;
        }

        .file-icon {
            width: 34px;
            height: 34px;
        }

    }

    /* ==========================================
   INFORMATION CONTENT
========================================== */

    .upload-info-content {
        background: #fff;
        border: 1px solid #ddd;
        padding: 30px;
    }

    .upload-info-content h3 {
        font-size: 24px;
        color: #111;
    }

    .upload-info-content p {
        font-size: 15px;
        line-height: 1.8;
    }


    /* Mobile */

    @media (max-width: 767px) {

        .upload-info-content {
            padding: 20px;
        }

        .upload-info-content h3 {
            font-size: 21px;
        }

        .upload-info-content p {
            font-size: 14px;
            line-height: 1.7;
        }

    }
</style>
@endsection

@section('content')
<main>
    <section class="document-upload-section py-5">

        <div class="container">

            <!-- Header -->
            <div class="text-center">

                <div class="mb-2">
                    <i class="bi bi-paperclip upload-main-icon"></i>
                </div>

                <div class="mb-3">
                    <span class="upload-badge">
                        <i class="bi bi-shield-check me-1"></i>
                        VERIFIED SESSION
                    </span>
                </div>

                <h1 class="fw-bold upload-title mb-2">
                    Upload Documents
                </h1>

                <p class="fw-semibold mb-0">
                    <span class="upload-highlight">
                        Supports PDF, Office Files PPTX, XLSX, DOCX, Images Max 2GB
                    </span>
                </p>

            </div>


            <!-- Upload Area -->
            <div class="row justify-content-center mt-4">

                <div class="col-lg-10">

                    <div id="uploadBox" class="upload-box">

                        <!-- Hidden File Input -->
                        <input
                            type="file"
                            id="documentFiles"
                            name="documents[]"
                            multiple
                            hidden
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.webp">

                        <div class="mb-3">
                            <i class="bi bi-cloud-arrow-up upload-cloud-icon"></i>
                        </div>

                        <h4 class="fw-bold mb-2">
                            Drag &amp; Drop files here or
                            <span id="browseFiles" class="browse-link">
                                click to browse
                            </span>
                        </h4>

                        <p class="text-secondary mb-3">
                            Upload your documents and we'll take care of the rest.
                        </p>

                        <div class="upload-info d-inline-block">
                            Supports PDF, Office Files (PPTX, XLSX, DOCX),
                            Images — up to 50 files, 2 GB total per order
                        </div>

                    </div>


                    <!-- File List -->
                    <div
                        id="fileListContainer"
                        class="file-list-container mt-3 d-none">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>
                                <strong>Selected Files</strong>

                                <span
                                    id="fileCount"
                                    class="badge bg-primary ms-2">
                                    0
                                </span>
                            </div>

                            <button
                                type="button"
                                id="clearFiles"
                                class="btn btn-sm btn-outline-danger">

                                <i class="bi bi-trash3 me-1"></i>
                                Clear All

                            </button>

                        </div>


                        <div id="fileList"></div>


                        <div class="text-end mt-2">

                            <small class="text-muted">
                                Total:
                                <strong id="totalFileSize">
                                    0 Bytes
                                </strong>
                            </small>

                        </div>

                    </div>


                    <!-- Error -->
                    <div
                        id="uploadError"
                        class="alert alert-danger mt-3 d-none">
                    </div>


                    <!-- Continue -->
                    <button
                        style="border-radius: 0;"
                        type="button"
                        id="continueUpload"
                        class="btn btn-primary w-100 d-none mt-3">

                        Upload & Continue
                        <i class="bi bi-arrow-right ms-2"></i>

                    </button>

                </div>

            </div>

        </div>


        <!-- ==========================================
     INFORMATION CONTENT
========================================== -->

        <div style="--bs-gutter-x:0 !important;" class="row justify-content-center mt-5">

            <div class="col-lg-10">

                <div class="upload-info-content">

                    <h3 class="fw-bold mb-3">
                        Easy Online Document Printing
                    </h3>

                    <p class="text-secondary mb-3">
                        Upload your documents online and get them professionally printed
                        without visiting a local print shop. You can upload assignments,
                        lecture notes, project reports, thesis documents, presentations,
                        and other study materials directly from your phone or computer.
                    </p>

                    <p class="text-secondary mb-3">
                        We support commonly used PDF, Word, Excel, PowerPoint, and image
                        formats, making it convenient to prepare all your documents in one
                        place. Before placing your order, you can select the printing
                        options that best match your requirements, including black and
                        white or color printing, paper quality, copies, and binding.
                    </p>

                    <p class="text-secondary mb-0">
                        Once your files are uploaded and your order is confirmed, your
                        documents are prepared for printing and carefully packed for
                        delivery. Whether you need a few pages for class or a complete
                        project or thesis, online printing saves time and makes the
                        entire process simple and convenient.
                    </p>

                </div>

            </div>

        </div>
    </section>

</main>
<!-- /main -->
@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        /* ==========================================
           SETTINGS
        ========================================== */

        const MAX_FILES = 50;
        const MAX_TOTAL_SIZE = 2 * 1024 * 1024 * 1024; // 2 GB

        const allowedExtensions = [
            'pdf',
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx',
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ];


        /* ==========================================
           VARIABLES
        ========================================== */

        let selectedFiles = [];


        /* ==========================================
           ELEMENTS
        ========================================== */

        const $uploadBox = $('#uploadBox');
        const $fileInput = $('#documentFiles');
        const $fileList = $('#fileList');
        const $fileListContainer = $('#fileListContainer');
        const $fileCount = $('#fileCount');
        const $totalFileSize = $('#totalFileSize');
        const $uploadError = $('#uploadError');
        const $continueUpload = $('#continueUpload');


        /* ==========================================
           OPEN FILE PICKER
           
           IMPORTANT:
           stopPropagation prevents infinite loop.
        ========================================== */

        $uploadBox.on('click', function(e) {

            /*
             * If the actual file input generated
             * the event, don't trigger it again.
             */

            if ($(e.target).is('#documentFiles')) {
                return;
            }

            $fileInput[0].click();

        });


        /* ==========================================
           STOP INPUT CLICK FROM BUBBLING
        ========================================== */

        $fileInput.on('click', function(e) {

            e.stopPropagation();

        });


        /* ==========================================
           FILE SELECTED
        ========================================== */

        $fileInput.on('change', function() {

            if (this.files && this.files.length > 0) {

                addFiles(this.files);

            }

            /*
             * Reset input so the same file can
             * be selected again later.
             */

            this.value = '';

        });


        /* ==========================================
           DRAG ENTER
        ========================================== */

        $uploadBox.on('dragenter', function(e) {

            e.preventDefault();
            e.stopPropagation();

            $(this).addClass('drag-over');

        });


        /* ==========================================
           DRAG OVER
        ========================================== */

        $uploadBox.on('dragover', function(e) {

            e.preventDefault();
            e.stopPropagation();

            $(this).addClass('drag-over');

        });


        /* ==========================================
           DRAG LEAVE
        ========================================== */

        $uploadBox.on('dragleave', function(e) {

            e.preventDefault();
            e.stopPropagation();

            $(this).removeClass('drag-over');

        });


        /* ==========================================
           DROP
        ========================================== */

        $uploadBox.on('drop', function(e) {

            e.preventDefault();
            e.stopPropagation();

            $(this).removeClass('drag-over');

            const files =
                e.originalEvent.dataTransfer.files;

            if (files && files.length > 0) {

                addFiles(files);

            }

        });


        /* ==========================================
           ADD FILES
        ========================================== */

        function addFiles(files) {

            clearError();


            if (!files || files.length === 0) {
                return;
            }


            /* ======================================
               MAX FILE COUNT
            ====================================== */

            if (
                selectedFiles.length + files.length > MAX_FILES
            ) {

                showError(
                    'You can upload a maximum of 50 files per order.'
                );

                return;

            }


            let newFiles = [];


            /* ======================================
               VALIDATE FILES
            ====================================== */

            for (let i = 0; i < files.length; i++) {

                const file = files[i];

                const extension =
                    getExtension(file.name);


                /* Unsupported file */

                if (
                    allowedExtensions.indexOf(extension) === -1
                ) {

                    showError(
                        '"' +
                        file.name +
                        '" is not a supported file type.'
                    );

                    continue;

                }


                /* Duplicate */

                const duplicate =
                    selectedFiles.some(function(existingFile) {

                        return (
                            existingFile.name === file.name &&
                            existingFile.size === file.size &&
                            existingFile.lastModified === file.lastModified
                        );

                    });


                if (duplicate) {

                    continue;

                }


                newFiles.push(file);

            }


            /* ======================================
               TOTAL SIZE
            ====================================== */

            let newTotal =
                getTotalSize();


            $.each(newFiles, function(index, file) {

                newTotal += file.size;

            });


            if (newTotal > MAX_TOTAL_SIZE) {

                showError(
                    'Total file size cannot exceed 2 GB.'
                );

                return;

            }


            /* ======================================
               ADD FILES
            ====================================== */

            selectedFiles =
                selectedFiles.concat(newFiles);


            renderFiles();

        }


        /* ==========================================
           GET EXTENSION
        ========================================== */

        function getExtension(filename) {

            const parts =
                filename.toLowerCase().split('.');

            return parts.length > 1 ?
                parts.pop() :
                '';

        }


        /* ==========================================
           TOTAL SIZE
        ========================================== */

        function getTotalSize() {

            let total = 0;

            $.each(selectedFiles, function(index, file) {

                total += file.size;

            });

            return total;

        }


        /* ==========================================
           FORMAT FILE SIZE
        ========================================== */

        function formatFileSize(bytes) {

            if (bytes === 0) {

                return '0 Bytes';

            }


            const units = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];


            const i = Math.floor(
                Math.log(bytes) / Math.log(1024)
            );


            return (
                    bytes /
                    Math.pow(1024, i)
                ).toFixed(i === 0 ? 0 : 2) +
                ' ' +
                units[i];

        }


        /* ==========================================
           FILE ICON
        ========================================== */

        function getFileIcon(extension) {

            switch (extension) {

                case 'pdf':
                    return 'bi-file-earmark-pdf';

                case 'doc':
                case 'docx':
                    return 'bi-file-earmark-word';

                case 'xls':
                case 'xlsx':
                    return 'bi-file-earmark-excel';

                case 'ppt':
                case 'pptx':
                    return 'bi-file-earmark-ppt';

                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'webp':
                    return 'bi-file-earmark-image';

                default:
                    return 'bi-file-earmark';

            }

        }


        /* ==========================================
           RENDER FILE LIST
        ========================================== */

        function renderFiles() {

            $fileList.empty();


            if (selectedFiles.length === 0) {

                $fileListContainer.addClass('d-none');

                $continueUpload.addClass('d-none');

                updateSummary();

                return;
            }


            $fileListContainer.removeClass('d-none');

            $continueUpload.removeClass('d-none');


            $.each(selectedFiles, function(index, file) {

                const extension =
                    getExtension(file.name);

                const icon =
                    getFileIcon(extension);


                const fileHtml = `

            <div
                class="upload-file-item"
                data-index="${index}"
            >

                <div class="file-icon">

                    <i class="bi ${icon}"></i>

                </div>


                <div class="file-details">

                    <div
                        class="file-name"
                        title="${escapeHtml(file.name)}"
                    >
                        ${escapeHtml(file.name)}
                    </div>

                    <div class="file-size">
                        ${formatFileSize(file.size)}
                    </div>

                </div>


                <button
                    type="button"
                    class="remove-file"
                    data-index="${index}"
                >

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

        `;


                $fileList.append(fileHtml);

            });


            updateSummary();


            /* ==========================================
               SCROLL TO SELECTED FILES
            ========================================== */

            setTimeout(function() {

                $('html, body').animate({

                    scrollTop: $fileListContainer.offset().top - 300

                }, 400);

            }, 100);

        }

        /* ==========================================
           REMOVE FILE
        ========================================== */

        $(document).on(
            'click',
            '.remove-file',
            function(e) {

                e.preventDefault();
                e.stopPropagation();


                const index =
                    parseInt(
                        $(this).attr('data-index'),
                        10
                    );


                if (
                    isNaN(index) ||
                    index < 0 ||
                    index >= selectedFiles.length
                ) {

                    return;

                }


                selectedFiles.splice(index, 1);

                renderFiles();

            }
        );


        /* ==========================================
           CLEAR ALL
        ========================================== */

        $('#clearFiles').on('click', function(e) {

            e.preventDefault();

            selectedFiles = [];

            clearError();

            renderFiles();

        });


        /* ==========================================
           UPDATE SUMMARY
        ========================================== */

        function updateSummary() {

            $fileCount.text(
                selectedFiles.length
            );


            $totalFileSize.text(
                formatFileSize(
                    getTotalSize()
                )
            );

        }


        /* ==========================================
           ERROR
        ========================================== */

        function showError(message) {

            $uploadError
                .removeClass('d-none')
                .html(
                    '<i class="bi bi-exclamation-triangle me-2"></i>' +
                    message
                );

        }


        function clearError() {

            $uploadError
                .addClass('d-none')
                .empty();

        }


        /* ==========================================
           ESCAPE HTML
        ========================================== */

        function escapeHtml(text) {

            return $('<div>')
                .text(text)
                .html();

        }


        /* ==========================================
           CONTINUE
        ========================================== */

        $('#continueUpload').on('click', function() {

            if (selectedFiles.length === 0) {

                showError(
                    'Please select at least one file.'
                );

                return;

            }


            console.log(
                'Files ready for upload:',
                selectedFiles
            );

        });

    });
</script>
@endsection