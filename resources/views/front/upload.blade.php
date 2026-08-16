@extends('layouts.web.web')

@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


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
                        Supports PDF Max 1GB
                    </span>
                </p>
            </div>

            <!-- Upload Area -->
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">

                    <div id="uploadBox" class="upload-box">

                        <input
                            type="file"
                            id="documentFiles"
                            name="documents[]"
                            multiple
                            hidden
                            accept=".pdf,.jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp,application/pdf">

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
                            Supports PDF,Image — up to 10 files, 3 GB total per order
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3 mb-3 flex-wrap gap-2">

                        <button
                            type="button"
                            id="managePreviousFiles"
                            class="btn btn-sm btn-outline-dark">

                            <i class="bi bi-folder2-open me-1"></i>
                            Manage Previous Files
                            <span
                                id="previousFilesCount"
                                class="badge bg-warning text-dark ms-1 d-none">
                                0
                            </span>

                        </button>

                    </div>
                    <!-- =====================================================
     PREVIOUS UPLOADED FILES MODAL
===================================================== -->

                    <div id="previousFilesModal"
                        class="upload-verification-overlay d-none">

                        <div class="upload-verification-modal"
                            style="max-width:650px;">

                            <!-- Header -->
                            <div class="verification-header">

                                <h4>
                                    <i class="bi bi-folder2-open me-2"></i>
                                    Previous Uploaded Files
                                </h4>

                                <button
                                    type="button"
                                    id="closePreviousFiles"
                                    class="verification-close">
                                    &times;
                                </button>

                            </div>

                            <!-- Body -->
                            <div class="verification-body">

                                <p class="text-secondary mb-3">
                                    Select files you have uploaded previously.
                                    Selected files will be added to your current order.
                                </p>

                                <!-- Loading -->
                                <div
                                    id="previousFilesLoading"
                                    class="text-center py-4">

                                    <div
                                        class="spinner-border text-primary"
                                        role="status">
                                    </div>

                                    <div class="small text-muted mt-2">
                                        Loading your previous files...
                                    </div>

                                </div>

                                <!-- Error -->
                                <div
                                    id="previousFilesError"
                                    class="alert alert-danger d-none">
                                </div>

                                <!-- Empty -->
                                <div
                                    id="previousFilesEmpty"
                                    class="text-center py-4 d-none">

                                    <i
                                        class="bi bi-folder-x"
                                        style="font-size:40px;color:#999;">
                                    </i>

                                    <h6 class="fw-bold mt-3">
                                        No previous files found
                                    </h6>

                                    <p class="text-muted small mb-0">
                                        Files you upload will appear here for future orders.
                                    </p>

                                </div>

                                <!-- File List -->
                                <div
                                    id="previousFilesList"
                                    class="d-none">
                                </div>

                                <!-- Footer -->
                                <div
                                    id="previousFilesFooter"
                                    class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top d-none">

                                    <small class="text-muted">

                                        <span id="previousSelectedCount">
                                            0
                                        </span>
                                        file(s) selected

                                    </small>

                                    <button
                                        type="button"
                                        id="addPreviousFiles"
                                        class="btn btn-primary"
                                        disabled>

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Add Selected Files

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Selected Files -->
                    <div id="fileListContainer" class="file-list-container mt-3 d-none">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>Selected Files</strong>
                                <span id="fileCount" class="badge bg-primary ms-2">0</span>
                            </div>

                            <button type="button" id="clearFiles" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3 me-1"></i>
                                Clear All
                            </button>
                        </div>

                        <div id="fileList"></div>

                        <div class="total-pages d-none text-end" id="totalPagesWrapper">
                            Total Pages: <span id="totalPages">0 pages</span>
                        </div>
                    </div>

                    <!-- Error -->
                    <div id="uploadError" class="alert alert-danger mt-3 d-none"></div>

                    <!-- Upload Success -->
                    <div id="uploadSuccess" class="upload-success-message d-none">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Upload successful!</strong>
                        All documents have been uploaded successfully and are ready.
                    </div>
                    <!-- Progress -->
                    <div id="uploadProgressContainer" class="upload-progress-container mt-3 d-none">

                        <div class="d-flex justify-content-between mb-2">
                            <strong id="uploadProgressText">Preparing your files...</strong>
                            <span id="uploadProgressPercent" class="fw-bold text-primary">0%</span>
                        </div>

                        <div class="progress upload-progress">
                            <div
                                id="uploadProgressBar"
                                class="progress-bar bg-primary"
                                role="progressbar"
                                style="width:0%;">
                            </div>
                        </div>

                        <div class="text-center mt-2">
                            <small id="uploadProgressStatus" class="text-muted">
                                Preparing upload...
                            </small>
                        </div>
                    </div>
                    <!-- Continue / Upload Button -->
                    <button
                        style="border-radius: 0;"
                        type="button"
                        id="continueUpload"
                        class="btn btn-primary w-100 d-none mt-3">
                        Upload &amp; Continue
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>


                </div>
            </div>

            <!-- Information -->
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

        </div>
    </section>
</main>

<!-- =========================================================
     MOBILE / OTP VERIFICATION MODAL
========================================================= -->

<div id="uploadCaptchaModal" class="upload-verification-overlay d-none">
    <div class="upload-verification-modal" style="max-width:420px;">
        <div class="verification-header">
            <h4><i class="bi bi-shield-check me-2"></i>Security Verification</h4>
        </div>
        <div class="verification-body text-center">
            <p class="text-secondary mb-3">Please complete the verification before uploading your files.</p>
            <div id="fileUploadTurnstile" class="d-flex justify-content-center"></div>
        </div>
    </div>
</div>

<div id="verificationModal" class="upload-verification-overlay d-none">

    <div class="upload-verification-modal">

        <div class="verification-header">

            <h4>
                <i class="bi bi-shield-check me-2"></i>
                Verify to Upload
            </h4>

            <button
                type="button"
                id="verificationClose"
                class="verification-close">
                &times;
            </button>

        </div>

        <div class="verification-body">

            <p class="text-secondary mb-0">
                <!-- We secure your uploads with OTP. No spam, promised. -->
                We secure your uploads with Mobile. No spam, promised.
            </p>

            <div class="verification-progress">
                <span id="verifyStepOne" class="active"></span>
                <span id="verifyStepTwo"></span>
            </div>

            <!-- MOBILE STEP -->
            <div id="mobileStep">

                <label class="fw-bold small mb-2">
                    Mobile Number
                </label>

                <div class="verification-phone-box">

                    <span class="verification-phone-prefix">
                        +91
                    </span>

                    <input
                        type="tel"
                        id="verificationMobile"
                        class="verification-phone-input"
                        maxlength="10"
                        inputmode="numeric"
                        autocomplete="tel"
                        placeholder="Enter mobile number">

                </div>

                <!-- <div class="small text-secondary mt-2">
                    We'll send a code on WhatsApp.
                </div> -->

                <div class="mt-3 mb-2 d-flex justify-content-center">
                    <div
                        id="uploadTurnstile"
                        class="turnstile-placeholder">
                    </div>
                </div>

                <div id="mobileVerificationError" class="verification-error"></div>

                <button
                    type="button"
                    id="sendOtpButton"
                    class="verification-action">
                    Continue
                    <!-- Send OTP -->
                </button>

            </div>

            <!-- OTP STEP -->
            <!-- <div id="otpStep" class="d-none">

                <div class="verification-sent-box mb-3">
                    <div>
                        <span class="small text-uppercase fw-bold text-muted">
                            Sent to
                        </span>
                        <strong id="sentMobileNumber" class="ms-2"></strong>
                    </div>

                    <button
                        type="button"
                        id="changeMobile"
                        class="btn btn-link p-0">
                        Change
                    </button>
                </div>

                <label class="fw-bold small mb-2">
                    Enter OTP
                </label>

                <input
                    type="text"
                    id="verificationOtp"
                    class="verification-otp-input"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    placeholder="••••••">

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <span id="resendOtpText" class="small text-muted">
                        Resend OTP in 60s
                    </span>

                    <button
                        type="button"
                        id="resendOtpButton"
                        class="btn btn-link p-0 small d-none">
                        Resend OTP
                    </button>

                </div>

                <div id="otpVerificationError" class="verification-error"></div>

                <button
                    type="button"
                    id="verifyOtpButton"
                    class="verification-action">
                    Verify &amp; Continue
                </button>

            </div> -->

        </div>
    </div>
</div>

@endsection

@section('custom_footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
    if (window.pdfjsLib) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }
</script>
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        /* =====================================================
           MODAL LAYER FIX
           Move modals directly under <body> so sticky header /
           transformed parent containers can never appear above them.
        ===================================================== */
        $('#previousFilesModal, #verificationModal, #uploadCaptchaModal').appendTo('body');

        function lockModalScroll() {
            $('body').css('overflow', 'hidden');
        }

        function unlockModalScroll() {
            if ($('#previousFilesModal').hasClass('d-none') &&
                $('#verificationModal').hasClass('d-none')) {
                $('body').css('overflow', '');
            }
        }

        /* =====================================================
           URLS
           Keep these URLs matching your Laravel routes.
        ===================================================== */

        const STATUS_URL = "{{ url('/upload/verification-status') }}";
        const SEND_OTP_URL = "{{ url('/upload/send-otp') }}";
        const VERIFY_OTP_URL = "{{ url('/upload/verify-otp') }}";
        const UPLOAD_URL = "{{ url('/upload/documents') }}";
        const R2_UPLOAD_URL = "{{ route('upload.r2.url') }}";
        const R2_COMPLETE_URL = "{{ route('upload.r2.complete') }}";
        const PREVIOUS_FILES_URL = "{{ url('/upload/previous-files') }}";

        let previousFiles = [];
        let selectedPreviousFileIds = {};
        /* =====================================================
           SETTINGS
        ===================================================== */

        const MAX_FILES = 50;
        const MAX_TOTAL_SIZE = 2 * 1024 * 1024 * 1024;

        const allowedExtensions = [
            'pdf',
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ];


        /* =====================================================
           VARIABLES
        ===================================================== */

        let selectedFiles = [];
        let uploadedFileKeys = {};
        let uploadedDocumentIds = {};
        let verifiedMobile = '';
        let sessionVerified = false;
        let isUploading = false;
        let uploadTurnstileWidgetId = null;
        let otpTimer = null;
        let otpSeconds = 60;
        const restoredDocuments = @json($selectedDocuments ?? []);

        /* =====================================================
           ELEMENTS
        ===================================================== */

        const $uploadBox = $('#uploadBox');
        const $fileInput = $('#documentFiles');
        const $fileList = $('#fileList');
        const $fileListContainer = $('#fileListContainer');
        const $fileCount = $('#fileCount');
        const $totalPages = $('#totalPages');
        const $uploadError = $('#uploadError');
        const $continueUpload = $('#continueUpload');


        /* =====================================================
           RESTORE VERIFIED SESSION
           If the Laravel cookie already exists, the user can add
           another file and it can be uploaded without OTP again.
        ===================================================== */
        $.each(restoredDocuments, function(index, document) {

            selectedFiles.push({

                isPrevious: true,

                previous_id: parseInt(
                    document.id,
                    10
                ),

                name: document.original_name,
                pages: parseInt(document.pages, 10) || 1,

                size: parseInt(
                    document.file_size,
                    10
                ) || 0,

                type: document.mime_type || '',

                lastModified: 0,

                uploaded_document_id: parseInt(
                    document.id,
                    10
                )

            });

            const restoredId = parseInt(document.id, 10);

            if (restoredId) {
                uploadedDocumentIds[restoredId] = true;
            }

        });
        if (selectedFiles.length > 0) {

            renderFiles(true);

            updateContinueButton();

        }
        $.ajax({
            url: STATUS_URL,
            type: 'GET',
            cache: false,
            success: function(response) {
                if (response && response.verified) {
                    sessionVerified = true;
                    verifiedMobile = response.mobile || '';
                }
            }
        });

        $('#managePreviousFiles').on('click', function() {

            if (isUploading) {
                return;
            }

            openPreviousFilesModal();

        });

        function openPreviousFilesModal() {

            $('#previousFilesModal').removeClass('d-none');
            lockModalScroll();

            $('#previousFilesLoading').removeClass('d-none');
            $('#previousFilesError').addClass('d-none');
            $('#previousFilesEmpty').addClass('d-none');
            $('#previousFilesList').addClass('d-none').empty();
            $('#previousFilesFooter').addClass('d-none');

            loadPreviousFiles();
        }


        function loadPreviousFiles() {

            $.ajax({

                url: PREVIOUS_FILES_URL,

                type: 'GET',

                cache: false,

                success: function(response) {

                    $('#previousFilesLoading').addClass('d-none');

                    if (!response || !response.success) {

                        showPreviousFilesError(
                            response && response.message ?
                            response.message :
                            'Unable to load previous files.'
                        );

                        return;
                    }

                    previousFiles = response.documents || [];

                    /*
                    =====================================================
                    AUTO-SELECT FILES ALREADY IN THE CURRENT ORDER

                    If a file was just uploaded in this order, its database
                    ID is stored in selectedFiles.uploaded_document_id.
                    If it was selected from Previous Uploaded Files, its
                    ID is stored in selectedFiles.previous_id.

                    When the Previous Files popup opens again, mark those
                    matching files as selected automatically.
                    =====================================================
                    */
                    syncPreviousSelectionWithCurrentFiles();

                    $('#previousFilesCount').text(
                        previousFiles.length
                    );

                    if (previousFiles.length > 0) {

                        $('#previousFilesCount')
                            .removeClass('d-none');

                    } else {

                        $('#previousFilesCount')
                            .addClass('d-none');

                        $('#previousFilesEmpty')
                            .removeClass('d-none');

                        return;
                    }

                    renderPreviousFiles();

                },

                error: function(xhr) {

                    $('#previousFilesLoading').addClass('d-none');

                    if (xhr.status === 401) {

                        $('#previousFilesModal')
                            .addClass('d-none');
                        unlockModalScroll();

                        openVerificationModal();

                        return;
                    }

                    showPreviousFilesError(
                        'Unable to load your previous files.'
                    );
                }

            });

        }

        function syncPreviousSelectionWithCurrentFiles() {

            /*
            Do not blindly clear the existing selection here.
            Keep any manual selections the user has already made, and add
            files that are already part of the current order.
            */
            $.each(previousFiles, function(index, previousFile) {

                const previousId = parseInt(
                    previousFile.id,
                    10
                );

                if (!previousId) {
                    return;
                }

                const alreadyInCurrentOrder = selectedFiles.some(function(file) {

                    const uploadedId = parseInt(
                        file.uploaded_document_id,
                        10
                    );

                    const previousIdFromFile = parseInt(
                        file.previous_id,
                        10
                    );

                    return (
                        uploadedId === previousId ||
                        previousIdFromFile === previousId
                    );

                });

                if (alreadyInCurrentOrder) {
                    selectedPreviousFileIds[previousId] = true;
                }

            });

        }


        function renderPreviousFiles() {

            const $list =
                $('#previousFilesList');

            $list.empty();


            $.each(previousFiles, function(index, file) {

                const id =
                    parseInt(file.id, 10);

                const selected = !!selectedPreviousFileIds[id];


                const html = `

            <div
                class="previous-file-item ${selected ? 'selected' : ''}"
                data-file-id="${id}">

                <input
                    type="checkbox"
                    class="previous-file-check"
                    data-file-id="${id}"
                    ${selected ? 'checked' : ''}>

                <div class="previous-file-icon">

                    <i class="bi ${getFileIcon(
                        getExtension(file.name)
                    )}"></i>

                </div>

                <div class="previous-file-details">

                    <div class="file-name">
                        ${file.name}
                    </div>

                    <div class="file-meta">
                        ${parseInt(file.pages, 10)}
                        ${parseInt(file.pages, 10) === 1 ? 'page' : 'pages'}

                    </div>

                </div>

                <span class="previous-file-status">

                    <i class="bi bi-check-circle-fill me-1"></i>
                    Uploaded

                </span>

            </div>

        `;


                $list.append(html);

            });


            $('#previousFilesList')
                .removeClass('d-none');


            $('#previousFilesFooter')
                .removeClass('d-none');


            updatePreviousSelection();

        }
        $(document).on('click', '#addPreviousFiles', function(e) {

            e.preventDefault();
            e.stopPropagation();

            const ids = Object.keys(selectedPreviousFileIds);

            if (ids.length === 0) {
                return;
            }

            let addedCount = 0;
            let duplicateCount = 0;

            $.each(previousFiles, function(index, oldFile) {

                const id = parseInt(oldFile.id, 10);

                /*
                |--------------------------------------------------------------------------
                | Only selected previous files
                |--------------------------------------------------------------------------
                */

                if (!selectedPreviousFileIds[id]) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | IMPORTANT:
                | If this database file was already uploaded/added,
                | don't add it again.
                |--------------------------------------------------------------------------
                */

                if (uploadedDocumentIds[id]) {

                    duplicateCount++;

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Also check current selectedFiles
                |--------------------------------------------------------------------------
                */

                const alreadySelected = selectedFiles.some(function(file) {

                    return (
                        file.isPrevious === true &&
                        parseInt(file.previous_id, 10) === id
                    );

                });


                if (alreadySelected) {

                    duplicateCount++;

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Add previous file
                |--------------------------------------------------------------------------
                */

                selectedFiles.push({

                    isPrevious: true,

                    previous_id: id,

                    name: oldFile.name,

                    size: parseInt(oldFile.size, 10) || 0,

                    pages: parseInt(oldFile.pages, 10) || 1,

                    type: oldFile.mime_type || '',

                    lastModified: 0

                });


                addedCount++;

            });


            /*
            |--------------------------------------------------------------------------
            | Clear selection and save the complete current order selection.
            |--------------------------------------------------------------------------
            */

            selectedPreviousFileIds = {};

            syncCurrentSelectionToSession(function() {

                $('#previousFilesModal').addClass('d-none');
                unlockModalScroll();

                renderFiles(true);

                updateContinueButton();

            });

            if (duplicateCount > 0) {

                // showError(
                //     duplicateCount +
                //     ' file(s) were already added and skipped.'
                // );

            }

        });

        function updatePreviousSelection() {

            const count =
                Object.keys(
                    selectedPreviousFileIds
                ).length;


            $('#previousSelectedCount')
                .text(count);


            /*
            |--------------------------------------------------------------------------
            | Enable Add button
            |--------------------------------------------------------------------------
            */

            $('#addPreviousFiles')
                .prop(
                    'disabled',
                    count === 0
                );


            /*
            |--------------------------------------------------------------------------
            | Selected visual state
            |--------------------------------------------------------------------------
            */

            $('.previous-file-item').each(function() {

                const id =
                    parseInt(
                        $(this).attr('data-file-id'),
                        10
                    );


                const isSelected = !!selectedPreviousFileIds[id];


                $(this)
                    .toggleClass(
                        'selected',
                        isSelected
                    );


                $(this)
                    .find('.previous-file-check')
                    .prop(
                        'checked',
                        isSelected
                    );

            });

        }

        function togglePreviousFile(id) {

            if (selectedPreviousFileIds[id]) {

                delete selectedPreviousFileIds[id];

            } else {

                selectedPreviousFileIds[id] = true;

            }

            renderPreviousFiles();

        }

        $(document).on(
            'change',
            '.previous-file-check',
            function(e) {

                e.stopPropagation();

                const id =
                    parseInt(
                        $(this).attr('data-file-id'),
                        10
                    );


                if (this.checked) {

                    selectedPreviousFileIds[id] = true;

                } else {

                    delete selectedPreviousFileIds[id];

                }


                updatePreviousSelection();

            }
        );
        $(document).on(
            'click',
            '.previous-file-item',
            function(e) {

                if (
                    $(e.target).is('input') ||
                    $(e.target).closest('button').length
                ) {
                    return;
                }


                const id =
                    parseInt(
                        $(this).attr('data-file-id'),
                        10
                    );


                if (selectedPreviousFileIds[id]) {

                    delete selectedPreviousFileIds[id];

                } else {

                    selectedPreviousFileIds[id] = true;

                }


                updatePreviousSelection();

            }
        );
        /* =====================================================
           FILE PICKER
        ===================================================== */

        $uploadBox.on('click', function(e) {
            if ($(e.target).is('#documentFiles')) {
                return;
            }

            if (isUploading) {
                return;
            }

            $fileInput[0].click();
        });


        $fileInput.on('click', function(e) {
            e.stopPropagation();
        });


        $fileInput.on('change', function() {
            if (this.files && this.files.length > 0) {
                addFiles(this.files);
            }

            this.value = '';
        });


        /* =====================================================
           DRAG & DROP
        ===================================================== */

        $uploadBox.on('dragenter dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (!isUploading) {
                $(this).addClass('drag-over');
            }
        });


        $uploadBox.on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).removeClass('drag-over');
        });


        $uploadBox.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).removeClass('drag-over');

            if (isUploading) {
                return;
            }

            const files = e.originalEvent.dataTransfer.files;

            if (files && files.length > 0) {
                addFiles(files);
            }
        });


        /* =====================================================
           ADD FILES
        ===================================================== */

        function addFiles(files) {
            clearError();

            if (!files || files.length === 0) {
                return;
            }

            if (selectedFiles.length + files.length > MAX_FILES) {
                showError('You can upload a maximum of 50 files per order.');
                return;
            }

            let newFiles = [];

            for (let i = 0; i < files.length; i++) {

                const file = files[i];
                const extension = getExtension(file.name);

                if (allowedExtensions.indexOf(extension) === -1) {
                    showError('"' + file.name + '" is not a supported file type.');
                    continue;
                }

                const duplicate = selectedFiles.some(function(existingFile) {
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

            let newTotal = getTotalSize();

            $.each(newFiles, function(index, file) {
                newTotal += file.size;
            });

            if (newTotal > MAX_TOTAL_SIZE) {
                showError('Total file size cannot exceed 2 GB.');
                return;
            }

            if (newFiles.length === 0) {
                return;
            }

            selectedFiles = selectedFiles.concat(newFiles);

            renderFiles(true);

            /*
             * Once the mobile has already been verified, any newly-added
             * files are uploaded automatically. Previously uploaded files
             * are ignored by startDocumentUpload().
             */
            if (sessionVerified && newFiles.length > 0 && !isUploading) {
                setTimeout(function() {
                    showUploadCaptchaAndStart();
                }, 150);
            }
        }

        /* =====================================================
           RENDER FILES
        ===================================================== */

        function renderFiles(scrollToList) {

            $fileList.empty();


            if (selectedFiles.length === 0) {

                $fileListContainer.addClass('d-none');

                $continueUpload.addClass('d-none');

                updateSummary();

                return;
            }


            $fileListContainer.removeClass('d-none');


            if (!isUploading) {
                updateContinueButton();
            }


            $.each(
                selectedFiles,
                function(index, file) {

                    const extension =
                        getExtension(file.name);

                    const icon =
                        getFileIcon(extension);


                    /*
                    =================================================
                    FILE STATUS
                    =================================================
                    */

                    let statusHtml = '';


                    /*
                    Already uploaded
                    */

                    if (
                        file.isPrevious ||
                        file.uploaded_document_id ||
                        uploadedFileKeys[
                            getFileKey(file)
                        ]
                    ) {

                        statusHtml = `
                    <span class="file-uploaded-badge">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Uploaded
                    </span>
                `;

                    }


                    /*
                    Currently processing
                    */
                    else if (
                        file.uploadStatus ===
                        'processing'
                    ) {

                        statusHtml = `
                    <span
                        class="file-uploaded-badge file-processing-badge"
                    >
						<span class="processing-spinner me-1">
    					<i class="bi bi-arrow-repeat"></i>
						</span>
						Processing...
                    </span>
                `;

                    }


                    /*
                    Currently uploading
                    */
                    else if (
                        file.uploadStatus ===
                        'uploading'
                    ) {

                        statusHtml = `
                    <span
                        class="file-uploaded-badge file-uploading-badge"
                    >
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i>
                        Uploading...
                    </span>
                `;

                    }


                    /*
                    =================================================
                    FILE HTML
                    =================================================
                    */

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
                        ${file.pages ? ' • ' + file.pages + (file.pages == 1 ? ' page' : ' pages') : ''}
                    </div>


                        ${statusHtml}

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

                }
            );


            updateSummary();


            if (scrollToList) {

                setTimeout(
                    function() {

                        if ($fileListContainer.length) {

                            $('html, body').animate({
                                    scrollTop: $fileListContainer.offset().top -
                                        80
                                },
                                400
                            );

                        }

                    },
                    100
                );
            }
        }

        /* =====================================================
           REMOVE FILE
        ===================================================== */

        /* =====================================================
   REMOVE FILE
===================================================== */

        $(document).on('click', '.remove-file', function(e) {

            e.preventDefault();
            e.stopPropagation();

            const index = parseInt(
                $(this).attr('data-index'),
                10
            );

            if (isNaN(index)) {
                return;
            }

            const file = selectedFiles[index];

            if (!file) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | If this file was previously uploaded in the current order,
            | remove its ID from the frontend duplicate tracker.
            |
            | This DOES NOT delete the file from database/server.
            |
            | It simply allows the user to select the same file again
            | from "Previous Uploaded Files".
            |--------------------------------------------------------------------------
            */

            if (file.uploaded_document_id) {

                const documentId = parseInt(
                    file.uploaded_document_id,
                    10
                );

                if (documentId) {
                    delete uploadedDocumentIds[documentId];
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Remove its upload key too.
            |
            | This is important if it was a newly uploaded physical file.
            | If the user adds it again, it should be allowed to upload again.
            |--------------------------------------------------------------------------
            */

            const fileKey = getFileKey(file);

            if (fileKey) {
                delete uploadedFileKeys[fileKey];
            }

            /*
            |--------------------------------------------------------------------------
            | Remove from current order only.
            |
            | Database record/file remains safe.
            |--------------------------------------------------------------------------
            */

            selectedFiles.splice(index, 1);

            /*
            |--------------------------------------------------------------------------
            | Update Laravel session with the new current selection.
            |--------------------------------------------------------------------------
            */

            syncCurrentSelectionToSession();

            /*
            |--------------------------------------------------------------------------
            | Re-render UI.
            |--------------------------------------------------------------------------
            */

            renderFiles(true);

            updateContinueButton();

        });

        /* =====================================================
           CLEAR ALL
        ===================================================== */

        $('#clearFiles').on('click', function(e) {
            e.preventDefault();

            if (isUploading) {
                return;
            }

            selectedFiles = [];
            uploadedFileKeys = {};
            uploadedDocumentIds = {};
            selectedPreviousFileIds = {};

            clearError();
            $('#uploadSuccess').addClass('d-none');
            $('#uploadProgressContainer').addClass('d-none');

            /* Clear the CURRENT order selection from the Laravel session. */
            syncCurrentSelectionToSession();

            renderFiles(false);
        });


        /* =====================================================
           CONTINUE / UPLOAD BUTTON
        ===================================================== */

        $('#continueUpload').on('click', function() {

            if (isUploading) {
                return;
            }

            clearError();

            const pending = getPendingFiles();

            /*
             * If there are newly-added files, upload ONLY those files.
             * Previously uploaded files are never sent again.
             */
            if (pending.length > 0) {

                if (sessionVerified) {
                    showUploadCaptchaAndStart();
                    return;
                }

                $continueUpload.prop('disabled', true);

                $.ajax({
                    url: STATUS_URL,
                    type: 'GET',
                    cache: false,
                    success: function(response) {

                        if (response && response.verified) {
                            verifiedMobile = response.mobile || '';
                            sessionVerified = true;
                            showUploadCaptchaAndStart();
                            return;
                        }

                        $continueUpload.prop('disabled', false);
                        openVerificationModal();
                    },
                    error: function() {
                        $continueUpload.prop('disabled', false);
                        showError('Unable to check verification status.');
                    }
                });

                return;
            }

            /*
             * No pending files means everything currently selected
             * has already been uploaded. This button is now the
             * normal next-step button.
             */
            continueToPrint();
        });


        /* =====================================================
           VERIFICATION MODAL
        ===================================================== */

        function openVerificationModal() {
            clearVerificationErrors();

            $('#verificationModal').removeClass('d-none');
            lockModalScroll();
            showMobileStep();

            /*
             * Turnstile is rendered only when the verification modal opens.
             * This avoids rendering it inside a hidden modal.
             */
            if (
                uploadTurnstileWidgetId === null &&
                window.turnstile
            ) {
                uploadTurnstileWidgetId =
                    window.turnstile.render(
                        '#uploadTurnstile', {
                            sitekey: "{{ env('TURNSTILE_SITE_KEY') }}",
                            theme: 'light'
                        }
                    );
            }

            $('#verificationMobile').trigger('focus');
        }


        function closeVerificationModal() {
            $('#verificationModal').addClass('d-none');
            clearVerificationErrors();
            unlockModalScroll();
        }


        $('#verificationClose').on('click', function() {
            closeVerificationModal();
        });


        /* Don't close by clicking outside while verification is active. */
        $('#verificationModal').on('click', function(e) {
            if (e.target === this) {
                return;
            }
        });


        /* =====================================================
           MOBILE VALIDATION
        ===================================================== */

        $('#verificationMobile').on('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
            $('#mobileVerificationError').hide().text('');
        });


        $('#verificationOtp').on('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
            $('#otpVerificationError').hide().text('');
        });


        /* =====================================================
           SEND OTP
        ===================================================== */

        $('#sendOtpButton').on('click', function() {

            const mobile = $.trim($('#verificationMobile').val());

            if (!/^\d{10}$/.test(mobile)) {
                showMobileError('Please enter a valid 10 digit mobile number.');
                return;
            }

            const $button = $(this);

            $button.prop('disabled', true).text('Continue...');
            clearVerificationErrors();

            $.ajax({
                url: SEND_OTP_URL,
                type: 'POST',
                data: {
                    mobile: mobile,
                    turnstile_token: (
                            uploadTurnstileWidgetId !== null &&
                            window.turnstile
                        ) ?
                        window.turnstile.getResponse(
                            uploadTurnstileWidgetId
                        ) : '',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (!response || !response.success) {
                        showMobileError(
                            (response && response.message) || 'Unable to send OTP.'
                        );
                        if (
                            uploadTurnstileWidgetId !== null &&
                            window.turnstile
                        ) {
                            window.turnstile.reset(
                                uploadTurnstileWidgetId
                            );
                        }

                        $button.prop('disabled', false).text('Continue');
                        //$button.prop('disabled', false).text('Send OTP');
                        return;
                    }

                    /*
                     * TEST / AUTO-VERIFY MODE
                     *
                     * User should never see the OTP input.
                     * As soon as Send OTP succeeds, submit 000000
                     * directly to the existing VERIFY_OTP_URL.
                     */
                    verifiedMobile = mobile;

                    $.ajax({
                        url: VERIFY_OTP_URL,
                        type: 'POST',
                        data: {
                            mobile: mobile,
                            otp: '000000',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(verifyResponse) {

                            if (!verifyResponse || !verifyResponse.success) {
                                showMobileError(
                                    (verifyResponse && verifyResponse.message) ||
                                    'OTP verification failed.'
                                );
                                $button.prop('disabled', false).text('Continue');
                                return;
                            }

                            clearError();

                            verifiedMobile =
                                verifyResponse.mobile || mobile;

                            sessionVerified = true;

                            stopOtpTimer();

                            /*
                             * Close verification modal immediately.
                             * OTP input / OTP screen is never shown.
                             */
                            closeVerificationModal();

                            if (
                                uploadTurnstileWidgetId !== null &&
                                window.turnstile
                            ) {
                                window.turnstile.reset(
                                    uploadTurnstileWidgetId
                                );
                            }

                            /*
                             * Give browser a moment to receive/store
                             * the verification response cookie.
                             */
                            setTimeout(function() {
                                showUploadCaptchaAndStart();
                            }, 150);
                        },
                        error: function(xhr) {

                            let message =
                                'OTP verification failed.';

                            if (
                                xhr.responseJSON &&
                                xhr.responseJSON.message
                            ) {
                                message =
                                    xhr.responseJSON.message;
                            }

                            showMobileError(message);
                            $button.prop('disabled', false).text('Continue');
                        }
                    });
                },
                error: function(xhr) {

                    let message = 'Unable to send OTP. Please try again.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    showMobileError(message);
                    $button.prop('disabled', false).text('Send OTP');
                }
            });
        });


        /* =====================================================
           CHANGE MOBILE
        ===================================================== */

        $('#changeMobile').on('click', function() {
            stopOtpTimer();
            showMobileStep();
            $('#verificationMobile').trigger('focus');
        });


        /* =====================================================
           RESEND OTP
        ===================================================== */

        $('#resendOtpButton').on('click', function() {

            const mobile = $.trim($('#verificationMobile').val());

            if (!/^\d{10}$/.test(mobile)) {
                showMobileError('Please enter a valid mobile number.');
                showMobileStep();
                return;
            }

            $('#sendOtpButton').trigger('click');
        });


        /* =====================================================
           OTP VERIFY
        ===================================================== */

        $('#verifyOtpButton').on('click', function() {

            const mobile = $.trim($('#verificationMobile').val());
            const otp = $.trim($('#verificationOtp').val());

            if (!/^\d{10}$/.test(mobile)) {
                showOtpError('Mobile number is invalid. Please change it.');
                return;
            }

            if (!/^\d{6}$/.test(otp)) {
                showOtpError('Please enter the 6 digit OTP.');
                return;
            }

            const $button = $(this);

            $button.prop('disabled', true).text('Verifying...');
            clearVerificationErrors();

            $.ajax({
                url: VERIFY_OTP_URL,
                type: 'POST',
                data: {
                    mobile: mobile,
                    otp: otp,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (!response || !response.success) {
                        showOtpError(
                            (response && response.message) || 'OTP verification failed.'
                        );
                        $button.prop('disabled', false).text('Verify & Continue');
                        return;
                    }

                    /*
                     * OTP SUCCESS.
                     * Clear any old page error first.
                     */

                    clearError();
                    verifiedMobile = response.mobile || mobile;
                    sessionVerified = true;

                    stopOtpTimer();

                    closeVerificationModal();

                    /*
                     * Small delay gives browser time to store
                     * Set-Cookie from the OTP response before
                     * the next AJAX request is made.
                     */

                    setTimeout(function() {
                        showUploadCaptchaAndStart();
                    }, 150);
                },
                error: function(xhr) {

                    let message = 'Invalid OTP. Please try again.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    showOtpError(message);
                    $button.prop('disabled', false).text('Verify & Continue');
                }
            });
        });


        /* =====================================================
           MOBILE / OTP STEP UI
        ===================================================== */

        function showMobileStep() {
            $('#mobileStep').removeClass('d-none');
            $('#otpStep').addClass('d-none');

            $('#verifyStepOne').addClass('active');
            $('#verifyStepTwo').removeClass('active');

            $('#sendOtpButton').prop('disabled', false).text('Continue');
        }


        function showOtpStep() {
            $('#mobileStep').addClass('d-none');
            $('#otpStep').removeClass('d-none');

            $('#verifyStepOne').addClass('active');
            $('#verifyStepTwo').addClass('active');

            $('#verifyOtpButton').prop('disabled', false).text('Verify & Continue');
        }


        /* =====================================================
           OTP TIMER
        ===================================================== */

        function startOtpTimer() {

            stopOtpTimer();

            otpSeconds = 60;

            $('#resendOtpText').removeClass('d-none');
            $('#resendOtpButton').addClass('d-none');

            updateOtpTimer();

            otpTimer = setInterval(function() {

                otpSeconds--;
                updateOtpTimer();

                if (otpSeconds <= 0) {
                    stopOtpTimer();

                    $('#resendOtpText').addClass('d-none');
                    $('#resendOtpButton').removeClass('d-none');
                }

            }, 1000);
        }


        function updateOtpTimer() {
            $('#resendOtpText').text('Resend OTP in ' + otpSeconds + 's');
        }


        function stopOtpTimer() {
            if (otpTimer) {
                clearInterval(otpTimer);
                otpTimer = null;
            }
        }


        /* =====================================================
           VERIFICATION ERRORS
        ===================================================== */

        function showMobileError(message) {
            $('#mobileVerificationError')
                .text(message)
                .show();
        }


        function showOtpError(message) {
            $('#otpVerificationError')
                .text(message)
                .show();
        }


        function clearVerificationErrors() {
            $('#mobileVerificationError').hide().text('');
            $('#otpVerificationError').hide().text('');
        }


        /* =====================================================
           FILE UPLOAD TURNSTILE
        ===================================================== */
        let fileUploadTurnstileWidgetId = null;

        function showUploadCaptchaAndStart() {
            if (isUploading || !getPendingFiles().length) return;

            $('#uploadCaptchaModal').removeClass('d-none');
            lockModalScroll();

            if (window.turnstile) {
                if (fileUploadTurnstileWidgetId === null) {
                    fileUploadTurnstileWidgetId = window.turnstile.render('#fileUploadTurnstile', {
                        sitekey: "{{ env('TURNSTILE_SITE_KEY') }}",
                        theme: 'light',
                        callback: function(token) {
                            $('#uploadCaptchaModal').addClass('d-none');
                            unlockModalScroll();
                            startDocumentUpload(token);
                        },
                        'expired-callback': function() {
                            showError('Captcha expired. Please verify again.');
                        },
                        'error-callback': function() {
                            showError('Captcha verification failed. Please try again.');
                        }
                    });
                } else {
                    window.turnstile.reset(fileUploadTurnstileWidgetId);
                }
            } else {
                setTimeout(showUploadCaptchaAndStart, 300);
            }
        }

        /* =====================================================
           START UPLOAD
        ===================================================== */
        function startDocumentUpload(turnstileToken) {

            if (isUploading) {
                return;
            }

            const pendingFiles = getPendingFiles();

            if (!pendingFiles.length) {
                updateContinueButton();
                return;
            }

            clearError();
            $('#uploadSuccess').addClass('d-none');

            isUploading = true;

            $continueUpload
                .prop('disabled', true)
                .addClass('d-none');

            $('#uploadProgressContainer').removeClass('d-none');

            let completed = 0;

            function finishR2UploadError(message) {

                isUploading = false;

                $.each(pendingFiles, function(index, file) {
                    if (file.uploadStatus !== 'uploaded') {
                        file.uploadStatus = null;
                    }
                });

                $('#uploadProgressContainer').addClass('d-none');

                $continueUpload
                    .removeClass('d-none')
                    .prop('disabled', false)
                    .html(
                        'Upload &amp; Continue ' +
                        '<i class="bi bi-arrow-right ms-2"></i>'
                    );

                showError(message);
                renderFiles(false);
                updateContinueButton();
            }

            function uploadNext(index) {

                if (index >= pendingFiles.length) {

                    isUploading = false;

                    renderFiles(false);

                    updateUploadProgress(
                        100,
                        'Upload completed successfully',
                        'All documents have been processed and are ready.'
                    );

                    $('#uploadSuccess').removeClass('d-none');

                    updateContinueButton();

                    return;
                }

                const file = pendingFiles[index];
                const fileKey = getFileKey(file);

                /*
                 * Never upload a file that has already been completed.
                 */
                if (
                    file.uploaded_document_id ||
                    uploadedFileKeys[fileKey] ||
                    file.uploadStatus === 'uploaded'
                ) {
                    uploadNext(index + 1);
                    return;
                }

                file.uploadStatus = 'uploading';
                renderFiles(false);

                updateUploadProgress(
                    Math.round(
                        (completed / pendingFiles.length) * 100
                    ),
                    'Uploading your files...',
                    file.name
                );

                /*
                 * STEP 1:
                 * Calculate PDF pages in the browser.
                 *
                 * The complete PDF is already available as a File object,
                 * so Laravel does not need to download the object from R2
                 * just to calculate the page count.
                 */
                function getBrowserPageCount(file) {

                    if (
                        !file ||
                        (
                            file.type !== 'application/pdf' &&
                            !/\.pdf$/i.test(file.name)
                        )
                    ) {
                        return Promise.resolve(1);
                    }

                    if (typeof window.pdfjsLib === 'undefined') {
                        return Promise.reject(
                            new Error(
                                'PDF page-count library is not available.'
                            )
                        );
                    }

                    return file.arrayBuffer().then(function(buffer) {

                        return window.pdfjsLib
                            .getDocument({
                                data: new Uint8Array(buffer)
                            })
                            .promise
                            .then(function(pdf) {
                                return pdf.numPages || 1;
                            });
                    });
                }

                getBrowserPageCount(file)
                    .then(function(pageCount) {

                        file.pages = pageCount;

                        /*
                         * STEP 2: Ask Laravel for a presigned R2 URL.
                         */
                        $.ajax({
                            url: R2_UPLOAD_URL,
                            type: 'POST',
                            data: {
                                filename: file.name,
                                mime_type: file.type || 'application/pdf',
                                turnstile_token: turnstileToken || '',
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            headers: {
                                'Accept': 'application/json'
                            },

                            success: function(response) {

                                if (
                                    !response ||
                                    !response.success ||
                                    !response.upload_url
                                ) {
                                    finishR2UploadError(
                                        response && response.message ?
                                        response.message :
                                        'Unable to prepare file upload.'
                                    );
                                    return;
                                }

                                /*
                                 * STEP 2: Browser -> Cloudflare R2 directly.
                                 */
                                const xhr =
                                    new window.XMLHttpRequest();

                                xhr.open(
                                    'PUT',
                                    response.upload_url,
                                    true
                                );

                                xhr.setRequestHeader(
                                    'Content-Type',
                                    file.type || 'application/pdf'
                                );

                                xhr.upload.addEventListener(
                                    'progress',
                                    function(e) {

                                        if (!e.lengthComputable) {
                                            return;
                                        }

                                        const currentPercent =
                                            Math.round(
                                                (e.loaded / e.total) * 100
                                            );

                                        const overallPercent =
                                            Math.round(
                                                (
                                                    completed +
                                                    (currentPercent / 100)
                                                ) /
                                                pendingFiles.length *
                                                100
                                            );

                                        updateUploadProgress(
                                            overallPercent,
                                            'Uploading your files...',
                                            file.name +
                                            ' — ' +
                                            currentPercent +
                                            '%'
                                        );
                                    },
                                    false
                                );

                                xhr.onload = function() {

                                    if (
                                        xhr.status < 200 ||
                                        xhr.status >= 300
                                    ) {
                                        finishR2UploadError(
                                            'Cloudflare R2 upload failed for ' +
                                            file.name
                                        );
                                        return;
                                    }

                                    file.uploadStatus = 'processing';
                                    renderFiles(false);

                                    /*
                                     * STEP 3: Tell Laravel that R2 upload completed.
                                     * Laravel creates print_documents record.
                                     */
                                    $.ajax({
                                        url: R2_COMPLETE_URL,
                                        type: 'POST',
                                        data: {
                                            filename: response.filename,
                                            original_name: file.name,
                                            mime_type: file.type || 'application/pdf',
                                            pages: file.pages || 1,
                                            _token: $('meta[name="csrf-token"]')
                                                .attr('content')
                                        },
                                        headers: {
                                            'Accept': 'application/json'
                                        },

                                        success: function(dbResponse) {

                                            if (
                                                !dbResponse ||
                                                !dbResponse.success ||
                                                !dbResponse.document
                                            ) {
                                                finishR2UploadError(
                                                    dbResponse &&
                                                    dbResponse.message ?
                                                    dbResponse.message :
                                                    'Unable to save document.'
                                                );
                                                return;
                                            }

                                            const documentId =
                                                parseInt(
                                                    dbResponse.document.id,
                                                    10
                                                );

                                            /*
                                             * Mark the exact selected File as uploaded
                                             * BEFORE starting the next file.
                                             */
                                            uploadedFileKeys[fileKey] = true;

                                            if (documentId) {
                                                uploadedDocumentIds[documentId] = true;
                                                file.uploaded_document_id =
                                                    documentId;
                                            }

                                            file.uploadedDocument =
                                                dbResponse.document;

                                            file.pages =
                                                parseInt(
                                                    dbResponse.document.pages,
                                                    10
                                                ) || 1;
                                            renderFiles(false);
                                            file.uploadStatus = 'uploaded';

                                            completed++;

                                            renderFiles(false);

                                            updateUploadProgress(
                                                Math.round(
                                                    (
                                                        completed /
                                                        pendingFiles.length
                                                    ) * 100
                                                ),
                                                'Uploading your files...',
                                                completed +
                                                ' of ' +
                                                pendingFiles.length +
                                                ' files uploaded'
                                            );

                                            /*
                                             * Only now move to the next file.
                                             */
                                            uploadNext(index + 1);
                                        },

                                        error: function(xhr) {

                                            let message =
                                                'Unable to save document.';

                                            if (
                                                xhr.responseJSON &&
                                                xhr.responseJSON.message
                                            ) {
                                                message =
                                                    xhr.responseJSON.message;
                                            }

                                            finishR2UploadError(message);
                                        }
                                    });
                                };

                                xhr.onerror = function() {
                                    finishR2UploadError(
                                        'Network error while uploading ' +
                                        file.name
                                    );
                                };

                                xhr.onabort = function() {
                                    finishR2UploadError(
                                        'Upload cancelled for ' +
                                        file.name
                                    );
                                };

                                xhr.send(file);
                            },

                            error: function(xhr) {

                                /*
                                 * Preserve the old verification behaviour.
                                 */
                                if (xhr.status === 401) {

                                    isUploading = false;

                                    $('#uploadProgressContainer')
                                        .addClass('d-none');

                                    $continueUpload
                                        .removeClass('d-none')
                                        .prop('disabled', false)
                                        .html(
                                            'Upload &amp; Continue ' +
                                            '<i class="bi bi-arrow-right ms-2"></i>'
                                        );

                                    clearError();
                                    openVerificationModal();

                                    return;
                                }

                                let message =
                                    'Unable to prepare file upload.';

                                if (
                                    xhr.responseJSON &&
                                    xhr.responseJSON.message
                                ) {
                                    message =
                                        xhr.responseJSON.message;
                                }

                                finishR2UploadError(message);
                            }
                        });
                    })
                    .catch(function(error) {

                        file.uploadStatus = null;
                        renderFiles(false);

                        finishR2UploadError(
                            error && error.message ?
                            error.message :
                            'Unable to calculate PDF page count.'
                        );
                    });
            }

            uploadNext(0);
        }

        /* =====================================================
           PROGRESS UI
        ===================================================== */

        function updateUploadProgress(percent, title, status) {

            $('#uploadProgressBar').css('width', percent + '%');
            $('#uploadProgressPercent').text(percent + '%');
            $('#uploadProgressText').text(title);
            $('#uploadProgressStatus').text(status);
        }


        /* =====================================================
           HELPERS
        ===================================================== */

        function getFileKey(file) {
            return [
                file.name,
                file.size,
                file.lastModified,
                file.type || ''
            ].join('|');
        }


        function getPendingFiles() {

            return selectedFiles.filter(function(file) {

                if (file.isPrevious) {
                    return false;
                }

                if (file.uploaded_document_id) {
                    return false;
                }

                if (file.uploadStatus === 'uploaded') {
                    return false;
                }

                return !uploadedFileKeys[getFileKey(file)];
            });
        }

        function getSelectedPreviousIds() {

            return selectedFiles
                .filter(function(file) {
                    return file.isPrevious === true;
                })
                .map(function(file) {
                    return parseInt(file.previous_id, 10);
                });

        }

        function updateContinueButton() {

            if (selectedFiles.length === 0) {
                $continueUpload.addClass('d-none');
                return;
            }

            const pending = getPendingFiles();

            $continueUpload
                .removeClass('d-none')
                .prop('disabled', false);

            if (pending.length > 0) {

                $continueUpload.html(
                    'Upload &amp; Continue ' +
                    '<i class="bi bi-arrow-right ms-2"></i>'
                );

            } else {

                $continueUpload.html(
                    'Continue to Print ' +
                    '<i class="bi bi-arrow-right ms-2"></i>'
                );
            }
        }


        function continueToPrint() {

            const previousIds = getSelectedPreviousIds();

            /*
            |--------------------------------------------------------------------------
            | Save selected previous IDs on button
            |--------------------------------------------------------------------------
            */

            $continueUpload.attr(
                'data-previous-file-ids',
                JSON.stringify(previousIds)
            );

            /*
            |--------------------------------------------------------------------------
            | Go to Print Options
            |--------------------------------------------------------------------------
            */

            window.location.href =
                "{{ route('print.options', []) }}";
        }


        /* =====================================================
           SAVE CURRENT ORDER SELECTION

           This keeps the current selected document IDs in the Laravel
           session so removing a file or using Clear All survives refresh.
           It does NOT delete the actual database file.
        ===================================================== */

        function getCurrentSelectedDocumentIds() {

            const ids = [];
            const seen = {};

            $.each(selectedFiles, function(index, file) {

                let id = 0;

                if (file.uploaded_document_id) {
                    id = parseInt(file.uploaded_document_id, 10);
                } else if (file.previous_id) {
                    id = parseInt(file.previous_id, 10);
                }

                if (id && !seen[id]) {
                    seen[id] = true;
                    ids.push(id);
                }
            });

            return ids;
        }


        function syncCurrentSelectionToSession(callback) {

            $.ajax({
                url: "{{ route('upload.saveSelectedFiles') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    document_ids: getCurrentSelectedDocumentIds()
                },
                success: function(response) {

                    if (response && response.success) {
                        console.log(
                            'Current order selection saved:',
                            response.document_ids || []
                        );
                    }

                    if (typeof callback === 'function') {
                        callback();
                    }
                },
                error: function(xhr) {

                    console.error(
                        'Unable to save current order selection:',
                        xhr.responseText || xhr.statusText
                    );

                    if (typeof callback === 'function') {
                        callback();
                    }
                }
            });
        }


        function getExtension(filename) {
            const parts = filename.toLowerCase().split('.');
            return parts.length > 1 ? parts.pop() : '';
        }


        function getTotalSize() {
            let total = 0;

            $.each(selectedFiles, function(index, file) {
                total += file.size;
            });

            return total;
        }


        function formatFileSize(bytes) {

            if (bytes === 0) {
                return '0 Bytes';
            }

            const units = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));

            return (
                bytes / Math.pow(1024, i)
            ).toFixed(i === 0 ? 0 : 2) + ' ' + units[i];
        }


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


        function updateSummary() {

            $fileCount.text(selectedFiles.length);

            /*
            |--------------------------------------------------------------------------
            | Total pages only after upload is completed
            |--------------------------------------------------------------------------
            */

            const uploadedFiles = selectedFiles.filter(function(file) {

                return (
                    file.uploadStatus === 'uploaded' &&
                    file.uploaded_document_id
                );

            });

            if (uploadedFiles.length === 0) {

                $('#totalPagesWrapper').addClass('d-none');

                $totalPages.text('0 pages');

                return;
            }

            let totalPages = 0;

            uploadedFiles.forEach(function(file) {

                const pages = parseInt(
                    file.pages,
                    10
                );

                if (pages > 0) {
                    totalPages += pages;
                }

            });

            if (totalPages > 0) {

                $('#totalPagesWrapper')
                    .removeClass('d-none');

                $totalPages.text(
                    totalPages +
                    (totalPages === 1 ? ' page' : ' pages')
                );

            } else {

                $('#totalPagesWrapper')
                    .addClass('d-none');

            }
        }

        function showError(message) {
            $uploadError
                .removeClass('d-none')
                .html(
                    '<i class="bi bi-exclamation-triangle me-2"></i>' +
                    escapeHtml(message)
                );
        }


        function clearError() {
            $uploadError
                .addClass('d-none')
                .empty();
        }


        function escapeHtml(text) {
            return $('<div>').text(text).html();
        }
        /* Close Previous Files modal by X or clicking outside the box. */
        $(document).on('click', '#closePreviousFiles', function(e) {
            e.preventDefault();
            e.stopPropagation();

            $('#previousFilesModal').addClass('d-none');
            unlockModalScroll();
        });

        $(document).on('click', '#previousFilesModal', function(e) {
            if (e.target === this) {
                $('#previousFilesModal').addClass('d-none');
                unlockModalScroll();
            }
        });

        /* Also allow outside click for the OTP modal. */
        // $(document).on('click', '#verificationModal', function(e) {
        //     if (e.target === this) {
        //         closeVerificationModal();
        //     }
        // });
    });
</script>
@endsection