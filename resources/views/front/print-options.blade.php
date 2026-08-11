@extends('layouts.web.web')

@section('custom_header')

<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* =====================================================
   ADD PREVIOUS FILE BUTTON
===================================================== */

    .print-add-previous-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 8px 12px;

        border: 1px solid #2856db;
        background: #edf3ff;
        color: #2856db;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;
        transition: .18s ease;
    }

    .print-add-previous-btn:hover {
        background: #2856db;
        color: #fff;
    }

    .print-add-previous-btn i {
        font-size: 14px;
    }


    /* =====================================================
       PREVIOUS FILES MODAL
       SAME DESIGN AS UPLOAD PAGE
    ===================================================== */

    .upload-verification-overlay {
        position: fixed;
        inset: 0;
        z-index: 99999;

        background: rgba(0, 0, 0, .55);

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 20px;
    }

    .upload-verification-modal {
        width: 100%;
        max-width: 650px;

        background: #fff;

        box-shadow:
            0 20px 60px rgba(0, 0, 0, .25);

        flex-shrink: 0;

        max-height: calc(100vh - 30px);

        display: flex;
        flex-direction: column;
    }

    .verification-header {
        padding: 22px 28px;

        border-bottom: 1px solid #e8e8e8;

        display: flex;
        align-items: center;
        justify-content: space-between;

        flex-shrink: 0;
    }

    .verification-header h4 {
        font-size: 18px;
        margin: 0;
        font-weight: 700;
        color: #111;
    }

    .verification-close {
        width: 34px;
        height: 34px;

        border: 1px solid #ddd;
        background: #fff;

        font-size: 22px;
        color: #555;

        line-height: 1;
        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .verification-close:hover {
        background: #f5f5f5;
        color: #111;
    }

    .verification-body {
        padding: 16px 20px 14px;

        min-height: 0;
        flex: 1 1 auto;

        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    #previousFilesModal .verification-body>p {
        margin-bottom: 12px !important;
        line-height: 1.45;
    }

    #previousFilesList {
        max-height: 52vh;

        overflow-y: auto;

        padding-right: 2px;
        margin-top: 8px;
    }

    .previous-file-item {
        border: 1px solid #e1e1e1;

        background: #fff;

        padding: 8px 10px;

        min-height: 54px;

        display: flex;
        align-items: center;

        gap: 9px;

        cursor: pointer;

        transition: .15s ease;
    }

    .previous-file-item+.previous-file-item {
        border-top: 0;
    }

    .previous-file-item:hover {
        background: #f7f9ff;
    }

    .previous-file-item.selected {
        border-color: #2860e8;
        background: #f2f6ff;
    }

    .previous-file-check {
        width: 20px;
        height: 20px;

        flex-shrink: 0;
    }

    .previous-file-icon {
        width: 34px;
        height: 34px;

        background: #edf3ff;
        color: #2860e8;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .previous-file-details {
        min-width: 0;
        flex: 1;
    }

    .previous-file-name {
        font-size: 13px;
        font-weight: 600;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .previous-file-meta {
        font-size: 11px;
        color: #777;
    }

    .previous-file-status {
        font-size: 11px;

        color: #198754;
        background: #e9f7ef;

        padding: 3px 7px;

        white-space: nowrap;
    }

    .previous-file-added {
        font-size: 11px;

        color: #198754;
        background: #e9f7ef;

        padding: 3px 7px;

        white-space: nowrap;
    }

    .verification-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 12px;
        padding-top: 12px;

        border-top: 1px solid #e8e8e8;
    }

    #previousFilesSelectedCount {
        font-size: 12px;
        color: #777;
    }

    #addPreviousFiles {
        border: 0;
        border-radius: 0;

        background: #2860e8;
        border-color: #2860e8;

        color: #fff;

        font-weight: 700;

        padding: 10px 14px;
    }

    #addPreviousFiles:disabled {
        background: #88a2e6;
        border-color: #88a2e6;
        cursor: not-allowed;
    }

    #previousFilesLoading {
        text-align: center;
    }

    #previousFilesEmpty {
        text-align: center;
    }

    @media (max-width: 767px) {

        .upload-verification-overlay {
            padding: 10px;
        }

        .upload-verification-modal {
            max-width: 100%;
            max-height: calc(100vh - 20px);
        }

        .verification-header {
            padding: 13px 16px;
            min-height: 54px;
        }

        .verification-header h4 {
            font-size: 17px;
        }

        .verification-body {
            padding: 14px 16px 12px;
        }

        #previousFilesList {
            max-height: 50vh;
        }
    }

    @media (max-width: 575px) {

        .previous-file-item {
            padding: 7px 8px;
            min-height: 50px;
            gap: 7px;
        }

        .previous-file-name {
            font-size: 12px;
        }

        .previous-file-meta {
            font-size: 10px;
        }

        .previous-file-status,
        .previous-file-added {
            font-size: 9px;
            padding: 3px 5px;
        }

        .verification-footer {
            gap: 10px;
        }

        #addPreviousFiles {
            padding: 9px 11px;
            font-size: 12px;
        }
    }

    /* =========================================================
   PRINT OPTIONS
========================================================= */

    .print-options-section {
        background: #fbf9f4;
        min-height: 100vh;
    }

    .print-options-wrapper {
        max-width: 760px;
        margin: 0 auto;
    }


    /* =========================================================
   HEADER
========================================================= */

    .print-options-title {
        font-size: 32px;
        line-height: 1.2;
        color: #111;
    }

    .print-options-title i {
        font-size: 21px;
        vertical-align: middle;
    }

    .print-options-subtitle {
        color: #777;
        font-size: 13px;
    }

    .print-options-badges {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .print-options-badge {
        display: inline-block;
        padding: 4px 8px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        border: 1px solid #f2c56c;
        background: #fff7e3;
        color: #d66b00;
    }


    /* =========================================================
   FILE CARD
========================================================= */

    .print-file-card {
        position: relative;
        background: #fff;
        border: 1px solid #d8d8d8;
        box-shadow: 2px 2px 0 rgba(0, 0, 0, .06);
        margin-bottom: 10px;
        overflow: hidden;
    }

    .print-file-card.removing {
        opacity: .45;
        pointer-events: none;
    }


    /* =========================================================
   FILE HEADER
========================================================= */

    .print-file-header {
        width: 100%;
        min-height: 80px;

        border: 0;
        background: #fff;

        padding: 14px 16px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        cursor: pointer;
        text-align: left;
    }

    .print-file-header:hover {
        background: #fafafa;
    }

    .print-file-card.is-open .print-file-header {
        border-bottom: 1px solid #e5e5e5;
    }


    /* =========================================================
   FILE LEFT
========================================================= */

    .print-file-left {
        min-width: 0;
        flex: 1;
    }

    .print-file-name-row {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .print-file-icon {
        color: #2856db;
        font-size: 18px;
        flex-shrink: 0;
    }

    .print-file-name {
        font-size: 15px;
        line-height: 1.3;
        font-weight: 700;
        color: #222;

        word-break: break-word;
        overflow-wrap: anywhere;
    }


    /* =========================================================
   DELETE BUTTON
========================================================= */

    .print-remove-file {
        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        height: 25px;
        padding: 0 9px;

        border: 1px solid #f1caca;
        background: #fff5f5;
        color: #dc3545;

        font-size: 10px;
        font-weight: 600;

        cursor: pointer;
        white-space: nowrap;

        transition: .18s ease;
    }

    .print-remove-file:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .print-remove-file i {
        margin-right: 4px;
        font-size: 11px;
    }


    /* =========================================================
   PAGES
========================================================= */

    .print-file-pages {
        display: inline-block;

        margin-top: 6px;

        padding: 3px 7px;

        border: 1px solid #f2d18b;
        background: #fff8e8;

        color: #c66a00;

        font-size: 9px;
        line-height: 1.2;

        font-weight: 700;
        letter-spacing: 1px;
    }


    /* =========================================================
   FILE RIGHT
========================================================= */

    .print-file-header-right {
        display: flex;
        align-items: center;
        gap: 7px;

        flex-shrink: 0;
    }

    .print-file-price {
        min-width: 45px;

        padding: 5px 7px;

        border: 1px solid #cbd8f7;
        background: #f3f6ff;

        color: #2856db;

        font-size: 14px;
        font-weight: 700;

        text-align: center;
    }

    .print-file-chevron {
        color: #555;
        font-size: 15px;

        transition: transform .2s ease;
    }

    .print-file-card.is-open .print-file-chevron {
        transform: rotate(180deg);
    }


    /* =========================================================
   FILE CONTENT
========================================================= */

    .print-file-content {
        display: none;
        padding: 10px 12px 13px;
    }

    .print-file-card.is-open .print-file-content {
        display: block;
    }

    /* =========================================
   UPLOAD NEW FILE - PREVIOUS FILE MODAL
========================================= */

    .previous-upload-new-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        background: #2860e8;
        color: #fff !important;

        border: 1px solid #2860e8;

        padding: 8px 12px;

        font-size: 12px;
        font-weight: 600;

        text-decoration: none !important;

        line-height: 1;

        white-space: nowrap;

        transition: .2s ease;
    }

    .previous-upload-new-btn:hover {
        background: #1d4fc7;
        border-color: #1d4fc7;
        color: #fff !important;
    }


    /* Mobile */

    @media (max-width: 575px) {

        .previous-upload-new-btn {
            padding: 7px 8px;
            font-size: 10px;
        }

        .verification-header {
            gap: 6px;
        }

    }

    /* =========================================================
   OPTION BOX
========================================================= */

    .print-option-box {
        background: #fff;
        border: 1px solid #ddd;

        padding: 11px 12px;
        margin-bottom: 7px;
    }

    .print-option-box:last-child {
        margin-bottom: 0;
    }

    .print-option-title {
        display: flex;
        align-items: center;
        gap: 7px;

        margin-bottom: 8px;

        font-size: 10px;
        line-height: 1.2;

        font-weight: 700;
        letter-spacing: 1.2px;

        text-transform: uppercase;

        color: #222;
    }

    .print-option-title i {
        color: #2856db;
        font-size: 16px;
    }


    /* =========================================================
   OPTION BUTTONS
========================================================= */

    .print-option-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 7px;
    }

    .print-option-btn {
        width: 100%;
        min-height: 40px;

        padding: 7px 9px;

        border: 1px solid #d2d2d2;
        background: #fff;

        color: #222;

        font-size: 12px;
        font-weight: 600;

        cursor: pointer;

        transition: .18s ease;
    }

    .print-option-btn:hover {
        border-color: #2856db;
        background: #f5f7ff;
    }

    .print-option-btn.active {
        border-color: #2856db;
        background: #edf3ff;
        color: #2856db;
    }


    /* =========================================================
   SELECT
========================================================= */

    .print-option-select {
        width: 100%;
        height: 40px;

        padding: 0 10px;

        border: 1px solid #d2d2d2;
        background: #fff;

        color: #222;

        font-size: 12px;
        outline: none;
    }

    .print-option-select:focus {
        border-color: #2856db;
        box-shadow: none;
    }


    /* =========================================================
   BINDING + COPIES
========================================================= */

    .print-settings-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 7px;
    }

    .print-compact-box {
        margin-bottom: 7px;
    }


    /* =========================================================
   COPIES
========================================================= */

    .print-copies-wrapper {
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 5px;
    }

    .print-copies-btn {
        width: 32px;
        height: 32px;

        padding: 0;

        border: 1px solid #ccc;
        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #222;
        font-size: 14px;

        cursor: pointer;
    }

    .print-copies-btn:hover {
        border-color: #2856db;
        color: #2856db;
        background: #f5f7ff;
    }

    .print-copies-value {
        min-width: 42px;
        height: 32px;

        border: 1px solid #ccc;
        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
   APPLY TO ALL
========================================================= */

    .print-apply-all-wrapper {
        margin: 2px 0 12px;
        text-align: center;
    }

    .print-apply-all-btn {
        width: 100%;
        min-height: 40px;

        border: 1px solid #2856db;
        background: #edf3ff;
        color: #2856db;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;

        transition: .18s ease;
    }

    .print-apply-all-btn:hover {
        background: #2856db;
        color: #fff;
    }

    .print-apply-all-btn i {
        margin-right: 6px;
    }

    .print-apply-message {
        display: none;

        margin-top: 6px;

        color: #198754;

        font-size: 11px;
        font-weight: 600;
    }


    /* =========================================================
   EMPTY STATE
========================================================= */

    .print-empty-state {
        display: none;

        background: #fff;
        border: 1px solid #ddd;

        padding: 25px 15px;

        text-align: center;
        color: #777;
    }

    .print-empty-state i {
        display: block;

        margin-bottom: 8px;

        font-size: 28px;
        color: #aaa;
    }

    .print-empty-state strong {
        display: block;

        color: #333;

        margin-bottom: 4px;
    }


    /* =========================================================
   SUMMARY
========================================================= */

    .print-summary-card {
        position: sticky;
        bottom: 0;

        z-index: 100;

        background: #fff;

        border: 1px solid #d8d8d8;

        box-shadow:
            0 -3px 12px rgba(0, 0, 0, .10);

        padding: 10px;

        margin-top: 12px;
    }

    .print-summary-total {
        min-height: 48px;

        padding: 8px 11px;

        border: 1px solid #cbd8f7;
        border-left: 2px solid #2856db;

        background: #f3f6ff;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .print-summary-total span {
        font-size: 9px;

        font-weight: 700;

        letter-spacing: 1.2px;
    }

    .print-summary-total strong {
        color: #2856db;

        font-size: 23px;
    }

    .print-continue-btn {
        height: 40px;

        border-radius: 0;

        background: #2856db;
        border-color: #2856db;

        font-size: 13px;
        font-weight: 600;
    }

    .print-continue-btn:disabled {
        background: #aaa;
        border-color: #aaa;

        cursor: not-allowed;
    }

    .print-add-files-row {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 8px;
    }

    .print-add-previous-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 8px 12px;

        border: 1px solid #2856db;
        background: #edf3ff;
        color: #2856db;

        font-size: 12px;
        font-weight: 700;

        cursor: pointer;

        transition: .18s ease;
    }

    .print-add-previous-btn:hover {
        background: #2856db;
        color: #fff;
    }

    .print-add-previous-btn i {
        font-size: 14px;
    }

    /* =========================================================
   MOBILE
========================================================= */

    @media (max-width: 767px) {

        .print-options-section {
            padding-top: 15px !important;
            padding-bottom: 20px !important;
        }

        .print-options-wrapper {
            max-width: 100%;
        }

        .print-options-title {
            font-size: 27px;
        }

        .print-options-subtitle {
            font-size: 12px;
        }

        .print-file-header {
            min-height: 75px;
            padding: 12px;
        }

        .print-file-name-row {
            gap: 6px;
            flex-wrap: wrap;
        }

        .print-file-name {
            font-size: 13px;
        }

        .print-file-icon {
            font-size: 17px;
        }

        .print-remove-file {
            height: 23px;
            padding: 0 7px;
            font-size: 9px;
        }

        .print-file-price {
            min-width: 42px;
            font-size: 13px;
        }

        .print-file-content {
            padding: 8px 9px 10px;
        }

        .print-option-box {
            padding: 10px;
            margin-bottom: 6px;
        }

        .print-option-grid {
            gap: 6px;
        }

        .print-option-btn {
            min-height: 38px;
            padding: 7px;
            font-size: 11px;
        }

        .print-option-select {
            height: 38px;
            font-size: 11px;
        }

        .print-settings-row {
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }

        .print-copies-wrapper {
            height: 38px;
        }

        .print-copies-btn {
            width: 29px;
            height: 29px;
        }

        .print-copies-value {
            min-width: 35px;
            height: 29px;
        }

        .print-apply-all-btn {
            min-height: 38px;
            font-size: 11px;
        }

        .print-summary-card {
            margin-left: -9px;
            margin-right: -9px;

            padding: 8px 9px;

            border-left: 0;
            border-right: 0;
            border-bottom: 0;

            box-shadow:
                0 -3px 12px rgba(0, 0, 0, .12);
        }

    }


    /* =========================================================
   SMALL MOBILE
========================================================= */

    @media (max-width: 400px) {

        .print-options-title {
            font-size: 24px;
        }

        .print-file-header {
            padding: 10px;
        }

        .print-file-content {
            padding: 7px;
        }

        .print-file-name {
            font-size: 12px;
        }

        .print-file-pages {
            font-size: 8px;
        }

        .print-file-price {
            font-size: 12px;
            min-width: 38px;
            padding: 4px;
        }

        .print-remove-file {
            height: 22px;
            padding: 0 6px;
        }

        .print-option-title {
            font-size: 9px;
        }

    }

    .page-icon {
        display: inline-block;
        width: 12px;
        height: 15px;
        border: 1.5px solid currentColor;
        vertical-align: -2px;
        margin-right: 6px;
        position: relative;
    }

    .landscape-page {
        width: 17px;
        height: 12px;
    }

    @media (max-width: 576px) {
        .d-flex.justify-content-between.align-items-center.mb-3 {
            flex-direction: column;
            align-items: stretch !important;
            gap: 10px;
        }

        .d-flex.justify-content-between.align-items-center.mb-3 .btn {
            width: 100%;
            margin-left: 0 !important;
        }
    }
</style>

@endsection


@section('content')

<main>

    <section class="print-options-section py-4">

        <div class="container">

            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">


                    <div class="text-center mb-3">

                        <h1 class="print-options-title fw-bold mb-1">

                            <i class="bi bi-printer text-primary"></i>

                            Print Options

                        </h1>

                        <p class="print-options-subtitle mb-2">

                            Configure printing options for each selected file.

                        </p>


                        <div class="print-options-badges">

                            <span class="print-options-badge">
                                LIVE PRICING
                            </span>

                            <span
                                class="print-options-badge"
                                style="
                    color:#198754;
                    background:#eaf6ef;
                    border-color:#c7e5d3;
                ">
                                SECURE PRINTING
                            </span>

                        </div>

                    </div>


                    <div class="print-add-files-row">

                        <button
                            type="button"
                            class="print-add-previous-btn"
                            id="openPreviousFiles">
                            <i class="bi bi-folder-plus"></i>
                            Add More Files
                        </button>

                    </div>
                    <div id="printFilesContainer">

                        @foreach($documents as $index => $document)

                        <div
                            class="print-file-card {{ $index === 0 ? 'is-open' : '' }}"
                            data-document-id="{{ $document->id }}">


                            <div
                                class="print-file-header"
                                role="button"
                                tabindex="0"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">

                                <div class="print-file-left">

                                    <div class="print-file-name-row">

                                        <i class="bi bi-file-earmark-text print-file-icon"></i>

                                        <div class="print-file-name">
                                            {{ $document->original_name }}
                                        </div>


                                        {{-- DELETE BUTTON --}}

                                        <button
                                            type="button"
                                            class="print-remove-file"
                                            title="Delete this file"
                                            aria-label="Delete this file">

                                            <i class="bi bi-x-lg"></i>

                                            Delete

                                        </button>

                                    </div>


                                    <span class="print-file-pages">

                                        {{ $document->pages }}

                                        {{ $document->pages == 1 ? 'PAGE' : 'PAGES' }}

                                    </span>

                                </div>


                                <div class="print-file-header-right">

                                    <div class="print-file-price">
                                        ₹0.00
                                    </div>

                                    <i class="bi bi-chevron-down print-file-chevron"></i>

                                </div>

                            </div>



                            <div class="print-file-content">



                                <div class="print-option-box">

                                    <div class="print-option-title">

                                        <i class="bi bi-palette"></i>

                                        <span>
                                            Color Mode
                                        </span>

                                    </div>


                                    <div class="print-option-grid dynamic-color-options">

                                        <div class="text-muted small">
                                            Loading...
                                        </div>

                                    </div>

                                </div>



                                <div class="print-option-box">

                                    <div class="print-option-title">

                                        <i class="bi bi-layers"></i>

                                        <span>
                                            Print Side
                                        </span>

                                    </div>


                                    <div class="print-option-grid">

                                        <button
                                            type="button"
                                            class="print-option-btn "
                                            data-option="print_side"
                                            data-value="single">

                                            <i class="bi bi-file-earmark me-1"></i>

                                            Single Side

                                        </button>


                                        <button
                                            type="button"
                                            class="print-option-btn active"
                                            data-option="print_side"
                                            data-value="double">

                                            <i class="bi bi-files me-1"></i>

                                            Double Sided

                                        </button>

                                    </div>

                                </div>


                                <div class="print-settings-row">


                                    {{-- BINDING DYNAMIC --}}

                                    <div class="print-option-box print-compact-box">

                                        <div class="print-option-title">

                                            <i class="bi bi-book"></i>

                                            <span>
                                                Binding
                                            </span>

                                        </div>


                                        <select
                                            class="print-option-select dynamic-binding-options"
                                            data-option="binding">

                                            <option value="">
                                                Loading...
                                            </option>

                                        </select>

                                    </div>


                                    {{-- COPIES --}}

                                    <div class="print-option-box print-compact-box">

                                        <div class="print-option-title">

                                            <i class="bi bi-files"></i>

                                            <span>
                                                Copies
                                            </span>

                                        </div>


                                        <div class="print-copies-wrapper">

                                            <button
                                                type="button"
                                                class="print-copies-btn print-copy-minus">

                                                <i class="bi bi-dash"></i>

                                            </button>


                                            <div class="print-copies-value">
                                                1
                                            </div>


                                            <button
                                                type="button"
                                                class="print-copies-btn print-copy-plus">

                                                <i class="bi bi-plus"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>



                                <div class="print-option-box">

                                    <div class="print-option-title">

                                        <i class="bi bi-file-earmark"></i>

                                        <span>
                                            Page Size
                                        </span>

                                    </div>


                                    <div class="print-option-grid">

                                        <button
                                            type="button"
                                            class="print-option-btn active"
                                            data-option="page_size"
                                            data-value="a4_75">

                                            A4 (75 GSM)

                                        </button>

                                    </div>

                                </div>



                                <div class="print-option-box">

                                    <div class="print-option-title">

                                        <i class="bi bi-phone"></i>

                                        <span>
                                            Orientation
                                        </span>

                                    </div>


                                    <div class="print-option-grid">

                                        <button
                                            type="button"
                                            class="print-option-btn active"
                                            data-option="orientation"
                                            data-value="portrait">
                                            <span class="page-icon"></span>
                                            Portrait
                                        </button>

                                        <button
                                            type="button"
                                            class="print-option-btn"
                                            data-option="orientation"
                                            data-value="landscape">
                                            <span class="page-icon landscape-page"></span>
                                            Landscape
                                        </button>

                                    </div>

                                </div>


                            </div>

                        </div>





                        @endforeach


                        <div
                            id="applyAllWrapper"
                            class="print-apply-all-wrapper">
                            <button
                                type="button"
                                id="applySettingsToAll"
                                class="print-apply-all-btn">
                                <i class="bi bi-copy"></i>
                                Apply These Settings to All Files
                            </button>

                            <div
                                id="applyAllMessage"
                                class="print-apply-message">
                                <i class="bi bi-check-circle me-1"></i>
                                Settings applied to all files.
                            </div>
                        </div>
                        <div
                            id="printEmptyState"
                            class="print-empty-state">

                            <i class="bi bi-files"></i>

                            <strong>
                                No files selected
                            </strong>

                            <span>
                                Please go back and select at least one file.
                            </span>

                        </div>

                    </div>



                    <div
                        class="print-summary-card"
                        id="printSummaryCard">

                        <div class="print-summary-total">

                            <span>
                                ESTIMATED TOTAL
                            </span>

                            <strong id="estimatedTotal">
                                ₹0.00
                            </strong>

                        </div>


                        <a href="{{ route('checkout') }}"
                            type="button"
                            class="btn btn-primary print-continue-btn w-100 mt-2"
                            id="continuePrintOptions">

                            Continue

                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>


                </div>

            </div>
        </div>

    </section>

</main>
<!-- =====================================================
     PREVIOUS FILES MODAL
     SAME DESIGN AS UPLOAD PAGE
====================================================== -->

<div
    id="previousFilesModal"
    class="upload-verification-overlay d-none">

    <div
        class="upload-verification-modal"
        style="max-width:650px;">

        <!-- Header -->

        <div class="verification-header">

            <div style="display:flex;align-items:center;">
                <h4 style="margin:0;">
                    <i class="bi bi-folder2-open me-2"></i>
                    Previous Uploaded Files
                </h4>
            </div>


            <div style="
        display:flex;
        align-items:center;
        gap:8px;
    ">

                <a
                    href="{{ route('upload') }}"
                    class="previous-upload-new-btn">

                    <i class="bi bi-upload"></i>

                    Upload New File

                </a>


                <button
                    type="button"
                    id="closePreviousFiles"
                    class="verification-close">

                    &times;

                </button>

            </div>

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
                class="verification-footer">

                <small class="text-muted">

                    <span id="previousFilesSelectedCount">
                        0 file(s) selected
                    </span>

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
@endsection


@section('custom_footer')

<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>

<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>


<script>
    $(document).ready(function() {


        /* =====================================================
           GLOBAL PRICE DATA
        ===================================================== */

        var printPrices = {

            black_white_single: 0,

            black_white_double: 0,

            color_single: 0,

            color_double: 0

        };


        var colorOptions = [];

        var bindingOptions = [];


        /* =====================================================
           HTML ESCAPE

           FIX:
           escapeHtml is defined before it is used.
        ===================================================== */

        function escapeHtml(text) {

            return $('<div>')
                .text(text || '')
                .html();

        }


        /* =====================================================
           FIRST FILE OPEN
        ===================================================== */

        var $firstCard =
            $('.print-file-card').first();

        if ($firstCard.length) {

            $firstCard
                .addClass('is-open');

            $firstCard
                .find('.print-file-header')
                .attr(
                    'aria-expanded',
                    'true'
                );

        }
        /* =====================================================
           RESTORE SAVED PRINT OPTIONS
        ===================================================== */

        var savedPrintOptions =
            @json(session('print_options', []));


        function restoreSavedPrintOptions() {

            if (
                !savedPrintOptions ||
                typeof savedPrintOptions !== 'object'
            ) {
                return;
            }


            $('.print-file-card').each(function() {

                var $card = $(this);

                var documentId = parseInt(
                    $card.data('document-id'),
                    10
                );

                if (!documentId) {
                    return;
                }


                var saved =
                    savedPrintOptions[documentId];

                if (!saved) {
                    return;
                }


                /*
                =================================================
                BUTTON OPTIONS
                =================================================
                */

                [
                    'color_mode',
                    'print_side',
                    'page_size',
                    'orientation'
                ].forEach(function(optionName) {

                    var savedValue =
                        saved[optionName];

                    if (!savedValue) {
                        return;
                    }


                    var $buttons =
                        $card.find(
                            '.print-option-btn[data-option="' +
                            optionName +
                            '"]'
                        );


                    if (!$buttons.length) {
                        return;
                    }


                    $buttons.removeClass('active');


                    $buttons
                        .filter(
                            '[data-value="' +
                            savedValue +
                            '"]'
                        )
                        .first()
                        .addClass('active');

                });


                /*
                =================================================
                BINDING
                =================================================
                */

                if (
                    saved.binding !== undefined &&
                    saved.binding !== null
                ) {

                    $card
                        .find(
                            '.dynamic-binding-options'
                        )
                        .val(
                            saved.binding
                        );

                }


                /*
                =================================================
                COPIES
                =================================================
                */

                var savedCopies =
                    parseInt(
                        saved.copies,
                        10
                    ) || 1;


                $card
                    .find(
                        '.print-copies-value'
                    )
                    .text(
                        savedCopies
                    );

            });


            /*
            =====================================================
            RECALCULATE AFTER RESTORE
            =====================================================
            */

            // updateEstimatedTotal();
        }

        /* =====================================================
           FILE ACCORDION
        ===================================================== */

        $(document).on(
            'click',
            '.print-file-header',
            function(e) {

                /*
                 * Delete button click should NOT
                 * open/close accordion.
                 */

                if (
                    $(e.target)
                    .closest('.print-remove-file')
                    .length
                ) {

                    return;

                }


                var $header =
                    $(this);

                var $card =
                    $header.closest(
                        '.print-file-card'
                    );

                var alreadyOpen =
                    $card.hasClass(
                        'is-open'
                    );


                /*
                 * Close all.
                 */

                $('.print-file-card')
                    .removeClass(
                        'is-open'
                    )
                    .find(
                        '.print-file-header'
                    )
                    .attr(
                        'aria-expanded',
                        'false'
                    );


                /*
                 * Open selected.
                 */

                if (!alreadyOpen) {

                    $card
                        .addClass(
                            'is-open'
                        );

                    $header
                        .attr(
                            'aria-expanded',
                            'true'
                        );

                }

            }
        );


        /* =====================================================
           KEYBOARD ACCORDION
        ===================================================== */

        $(document).on(
            'keydown',
            '.print-file-header',
            function(e) {

                if (
                    e.key === 'Enter' ||
                    e.key === ' '
                ) {

                    if (
                        $(e.target)
                        .closest(
                            '.print-remove-file'
                        )
                        .length
                    ) {

                        return;

                    }


                    e.preventDefault();

                    $(this).trigger(
                        'click'
                    );

                }

            }
        );


        /* =====================================================
           LOAD PRICES + OPTIONS FROM DATABASE
        ===================================================== */

        function loadPrintPrices() {

            $.ajax({

                url: "{{ route('print-options.prices') }}",

                type: "GET",

                dataType: "json",

                success: function(response) {

                    if (
                        !response ||
                        !response.success
                    ) {

                        console.error(
                            'Invalid price response.'
                        );

                        return;

                    }


                    /*
                     * PRINT PRICES
                     */

                    printPrices =
                        response.prices ||
                        printPrices;


                    /*
                     * COLOR OPTIONS
                     */

                    colorOptions =
                        response.color_options || [];


                    /*
                     * BINDING OPTIONS
                     */

                    bindingOptions =
                        response.binding_options || [];


                    /*
                     * Render dynamic options.
                     */

                    renderColorOptions();

                    renderBindingOptions();
                    restoreSavedPrintOptions();

                    /*
                     * Calculate prices.
                     */

                    updateEstimatedTotal();

                },

                error: function(
                    xhr
                ) {

                    console.error(
                        'Unable to load print prices.',
                        xhr.responseText
                    );

                }

            });

        }


        /* =====================================================
           RENDER COLOR MODE
        ===================================================== */

        function renderColorOptions() {

            var html = '';


            if (
                !colorOptions.length
            ) {

                html =
                    '<div class="text-muted small">' +
                    'No color mode available.' +
                    '</div>';

            } else {


                /*
                 * Prefer Black & White as default.
                 */

                var defaultIndex = 0;

                $.each(
                    colorOptions,
                    function(
                        index,
                        option
                    ) {

                        if (
                            option.slug ===
                            'black_white'
                        ) {

                            defaultIndex =
                                index;

                        }

                    }
                );


                $.each(
                    colorOptions,
                    function(
                        index,
                        option
                    ) {

                        var activeClass =
                            index === defaultIndex ?
                            'active' :
                            '';


                        var icon =
                            option.slug ===
                            'color' ?
                            'bi-palette' :
                            'bi-circle-half';


                        html +=

                            '<button ' +

                            'type="button" ' +

                            'class="print-option-btn ' +
                            activeClass +
                            '" ' +

                            'data-option="color_mode" ' +

                            'data-value="' +
                            escapeHtml(
                                option.slug
                            ) +
                            '" ' +

                            'data-price="' +
                            parseFloat(
                                option.amount || 0
                            ) +
                            '"' +

                            '>' +

                            '<i class="bi ' +
                            icon +
                            ' me-1"></i>' +

                            escapeHtml(
                                option.name
                            ) +

                            '</button>';

                    }
                );

            }


            /*
             * Put same options in every file.
             */

            $('.dynamic-color-options')
                .html(html);

        }


        /* =====================================================
           RENDER BINDING
        ===================================================== */

        function renderBindingOptions() {

            var html = '';


            if (
                !bindingOptions.length
            ) {

                html =
                    '<option value="">' +
                    'No binding available' +
                    '</option>';

            } else {


                /*
                 * Prefer free/loose binding
                 * as default.
                 */

                var defaultIndex = 0;

                $.each(
                    bindingOptions,
                    function(
                        index,
                        option
                    ) {

                        var slug =
                            String(
                                option.slug || ''
                            ).toLowerCase();


                        var name =
                            String(
                                option.name || ''
                            ).toLowerCase();


                        if (
                            slug === 'loose' ||
                            slug === 'loose_staple' ||
                            slug === 'staple_at_home' ||
                            name.indexOf(
                                'loose'
                            ) !== -1
                        ) {

                            defaultIndex =
                                index;

                        }

                    }
                );


                $.each(
                    bindingOptions,
                    function(
                        index,
                        option
                    ) {

                        var selected =
                            index === defaultIndex ?
                            ' selected' :
                            '';


                        var amount =
                            parseFloat(
                                option.amount || 0
                            );


                        html +=

                            '<option ' +

                            'value="' +
                            escapeHtml(
                                option.slug
                            ) +
                            '" ' +

                            'data-price="' +
                            amount +
                            '"' +

                            selected +

                            '>' +

                            escapeHtml(
                                option.name
                            ) +

                            ' (₹' +
                            amount.toFixed(2) +
                            ')' +

                            '</option>';

                    }
                );

            }


            /*
             * Put same binding options
             * in every file.
             */

            $('.dynamic-binding-options')
                .html(html);

        }


        /* =====================================================
           OPTION BUTTON CLICK
        ===================================================== */

        $(document).on(
            'click',
            '.print-option-btn',
            function(e) {

                e.preventDefault();


                var $button =
                    $(this);

                var option =
                    $button.attr(
                        'data-option'
                    );

                var $card =
                    $button.closest(
                        '.print-file-card'
                    );


                /*
                 * Only same option
                 * in current card.
                 */

                $card
                    .find(
                        '.print-option-btn[data-option="' +
                        option +
                        '"]'
                    )
                    .removeClass(
                        'active'
                    );


                $button
                    .addClass(
                        'active'
                    );


                updateEstimatedTotal();

            }
        );


        /* =====================================================
           BINDING CHANGE
        ===================================================== */

        $(document).on(
            'change',
            '.dynamic-binding-options',
            function() {

                updateEstimatedTotal();

            }
        );


        /* =====================================================
           COPIES PLUS
        ===================================================== */

        $(document).on(
            'click',
            '.print-copy-plus',
            function(e) {

                e.preventDefault();


                var $card =
                    $(this).closest(
                        '.print-file-card'
                    );


                var $value =
                    $card.find(
                        '.print-copies-value'
                    );


                var copies =
                    parseInt(
                        $value.text(),
                        10
                    ) || 1;


                copies++;


                $value.text(
                    copies
                );


                updateEstimatedTotal();

            }
        );


        /* =====================================================
           COPIES MINUS
        ===================================================== */

        $(document).on(
            'click',
            '.print-copy-minus',
            function(e) {

                e.preventDefault();


                var $card =
                    $(this).closest(
                        '.print-file-card'
                    );


                var $value =
                    $card.find(
                        '.print-copies-value'
                    );


                var copies =
                    parseInt(
                        $value.text(),
                        10
                    ) || 1;


                if (
                    copies > 1
                ) {

                    copies--;

                }


                $value.text(
                    copies
                );


                updateEstimatedTotal();

            }
        );


        /* =====================================================
           CALCULATE SINGLE FILE PRICE
        ===================================================== */

        function calculateFilePrice(
            $card
        ) {

            /*
             * Pages
             */

            var pages =
                parseInt(
                    $card
                    .find(
                        '.print-file-pages'
                    )
                    .text()
                    .replace(
                        /[^0-9]/g,
                        ''
                    ),
                    10
                ) || 1;


            /*
             * Copies
             */

            var copies =
                parseInt(
                    $card
                    .find(
                        '.print-copies-value'
                    )
                    .text(),
                    10
                ) || 1;


            /*
             * Color mode
             */

            var colorMode =
                $card
                .find(
                    '.print-option-btn[data-option="color_mode"].active'
                )
                .attr(
                    'data-value'
                );


            /*
             * Print side
             */

            var printSide =
                $card
                .find(
                    '.print-option-btn[data-option="print_side"].active'
                )
                .attr(
                    'data-value'
                ) ||
                'double';


            /*
             * Price slug
             */

            var priceSlug;


            if (
                colorMode ===
                'color'
            ) {

                if (
                    printSide ===
                    'double'
                ) {

                    priceSlug =
                        'color_double';

                } else {

                    priceSlug =
                        'color_single';

                }

            } else {

                if (
                    printSide ===
                    'double'
                ) {

                    priceSlug =
                        'black_white_double';

                } else {

                    priceSlug =
                        'black_white_single';

                }

            }


            /*
             * DB print rate
             */

            var printRate =
                parseFloat(
                    printPrices[
                        priceSlug
                    ]
                ) || 0;


            /*
             * Printable sides
             */

            var printableSides = pages;


            /*
             * Print cost
             */

            var printCost =
                printableSides *
                printRate *
                copies;

            /*
             * Binding
             */

            var bindingSlug =
                $card
                .find(
                    '.dynamic-binding-options'
                )
                .val();


            var bindingRate = 0;


            if (
                bindingSlug
            ) {

                var bindingOption =
                    bindingOptions.find(
                        function(
                            item
                        ) {

                            return String(
                                item.slug
                            ) === String(
                                bindingSlug
                            );

                        }
                    );


                if (
                    bindingOption
                ) {

                    bindingRate =
                        parseFloat(
                            bindingOption.amount
                        ) || 0;

                }

            }


            /*
             * Binding cost
             *
             * Binding is applied per copy.
             */

            var bindingCost =
                bindingRate *
                copies;


            /*
             * Final file cost
             */

            return (
                printCost +
                bindingCost
            );

        }


        /* =====================================================
           UPDATE ALL FILE PRICES
        ===================================================== */

        function updateFilePrices() {

            var grandTotal = 0;


            $('.print-file-card')
                .each(
                    function() {

                        var $card =
                            $(this);


                        var fileTotal =
                            calculateFilePrice(
                                $card
                            );


                        grandTotal +=
                            fileTotal;


                        $card
                            .find(
                                '.print-file-price'
                            )
                            .text(
                                '₹' +
                                fileTotal.toFixed(
                                    2
                                )
                            );

                    }
                );


            $('#estimatedTotal')
                .text(
                    '₹' +
                    grandTotal.toFixed(
                        2
                    )
                );


            return grandTotal;

        }


        /* =====================================================
           ESTIMATED TOTAL
        ===================================================== */

        function updateEstimatedTotal() {

            updateFilePrices();

        }


        /* =====================================================
           APPLY FIRST FILE SETTINGS TO ALL
        ===================================================== */

        $(document).on(
            'click',
            '#applySettingsToAll',
            function(e) {

                e.preventDefault();


                var $firstCard =
                    $('.print-file-card')
                    .first();


                if (
                    !$firstCard.length
                ) {

                    return;

                }


                /*
                 * =============================================
                 * BUTTON OPTIONS
                 * =============================================
                 */

                $firstCard
                    .find(
                        '.print-option-btn[data-option]'
                    )
                    .each(
                        function() {

                            var $source =
                                $(this);


                            if (
                                !$source.hasClass(
                                    'active'
                                )
                            ) {

                                return;

                            }


                            var option =
                                $source.attr(
                                    'data-option'
                                );


                            var value =
                                $source.attr(
                                    'data-value'
                                );


                            $('.print-file-card')
                                .not(
                                    $firstCard
                                )
                                .each(
                                    function() {

                                        var $target =
                                            $(this);


                                        $target
                                            .find(
                                                '.print-option-btn[data-option="' +
                                                option +
                                                '"]'
                                            )
                                            .removeClass(
                                                'active'
                                            );


                                        $target
                                            .find(
                                                '.print-option-btn[data-option="' +
                                                option +
                                                '"][data-value="' +
                                                value +
                                                '"]'
                                            )
                                            .addClass(
                                                'active'
                                            );

                                    }
                                );

                        }
                    );


                /*
                 * =============================================
                 * SELECT OPTIONS
                 * =============================================
                 */

                $firstCard
                    .find(
                        '.print-option-select[data-option]'
                    )
                    .each(
                        function() {

                            var $source =
                                $(this);


                            var option =
                                $source.attr(
                                    'data-option'
                                );


                            var value =
                                $source.val();


                            $('.print-file-card')
                                .not(
                                    $firstCard
                                )
                                .each(
                                    function() {

                                        $(this)
                                            .find(
                                                '.print-option-select[data-option="' +
                                                option +
                                                '"]'
                                            )
                                            .val(
                                                value
                                            );

                                    }
                                );

                        }
                    );


                /*
                 * =============================================
                 * COPIES
                 * =============================================
                 */

                var firstCopies =
                    parseInt(
                        $firstCard
                        .find(
                            '.print-copies-value'
                        )
                        .text(),
                        10
                    ) || 1;


                $('.print-file-card')
                    .not(
                        $firstCard
                    )
                    .each(
                        function() {

                            $(this)
                                .find(
                                    '.print-copies-value'
                                )
                                .text(
                                    firstCopies
                                );

                        }
                    );


                /*
                 * =============================================
                 * SUCCESS
                 * =============================================
                 */

                $('#applyAllMessage')
                    .stop(
                        true,
                        true
                    )
                    .fadeIn(150);


                setTimeout(
                    function() {

                        $('#applyAllMessage')
                            .fadeOut(300);

                    },
                    1800
                );


                updateEstimatedTotal();

            }
        );


        /* =====================================================
           DELETE INDIVIDUAL FILE
        ===================================================== */

        /* =====================================================
   DELETE INDIVIDUAL FILE
===================================================== */

        $(document).on(
            'click',
            '.print-remove-file',
            function(e) {

                e.preventDefault();
                e.stopPropagation();

                var $button = $(this);

                var $card = $button.closest(
                    '.print-file-card'
                );

                /*
                 * Document ID from card
                 */
                var documentId =
                    $card.data('document-id');


                /*
                 * File name
                 */
                var fileName =
                    $.trim(
                        $card
                        .find('.print-file-name')
                        .text()
                    );


                /*
                 * Safety confirmation
                 */
                if (
                    !confirm(
                        'Delete "' +
                        fileName +
                        '" from this print order?'
                    )
                ) {
                    return;
                }


                /*
                 * Prevent double click
                 */
                $button
                    .prop('disabled', true)
                    .css('opacity', '0.5');


                $card.addClass(
                    'removing'
                );


                /*
                 * Remove document from
                 * current print-order/session
                 */
                $.ajax({

                    url: "{{ route('print-options.remove-file') }}",

                    type: "POST",

                    data: {

                        _token: "{{ csrf_token() }}",

                        document_id: documentId

                    },


                    success: function(response) {

                        if (
                            response &&
                            response.success
                        ) {

                            /*
                             * Remove card from UI
                             */
                            $card.remove();


                            /*
                             * Check remaining files
                             */
                            handleFilesAfterDelete();


                            /*
                             * Recalculate total
                             */
                            updateEstimatedTotal();

                        } else {

                            $card.removeClass(
                                'removing'
                            );

                            $button
                                .prop(
                                    'disabled',
                                    false
                                )
                                .css(
                                    'opacity',
                                    '1'
                                );


                            alert(
                                response.message ||
                                'Unable to delete file.'
                            );

                        }

                    },


                    error: function(xhr) {

                        console.error(
                            'Delete file error:',
                            xhr.responseText
                        );


                        $card.removeClass(
                            'removing'
                        );


                        $button
                            .prop(
                                'disabled',
                                false
                            )
                            .css(
                                'opacity',
                                '1'
                            );


                        alert(
                            'Unable to delete file. Please try again.'
                        );

                    }

                });

            }
        );
        /* =====================================================
           AFTER DELETE
        ===================================================== */


        function handleFilesAfterDelete() {

            var $cards =
                $('.print-file-card');


            /*
             * No files remaining
             */
            if (!$cards.length) {

                $('#printEmptyState')
                    .show();


                $('.print-apply-all-wrapper')
                    .hide();


                $('#continuePrintOptions')
                    .prop(
                        'disabled',
                        true
                    );


                return;
            }


            /*
             * If currently opened file
             * was deleted, open first remaining.
             */
            if (
                !$('.print-file-card.is-open')
                .length
            ) {

                $cards
                    .removeClass(
                        'is-open'
                    )
                    .find(
                        '.print-file-header'
                    )
                    .attr(
                        'aria-expanded',
                        'false'
                    );


                $cards
                    .first()
                    .addClass(
                        'is-open'
                    )
                    .find(
                        '.print-file-header'
                    )
                    .attr(
                        'aria-expanded',
                        'true'
                    );

            }


            /*
             * Apply To All button
             */
            if (
                $cards.length > 1
            ) {

                $('.print-apply-all-wrapper')
                    .show();

            } else {

                $('.print-apply-all-wrapper')
                    .hide();

            }


            positionApplyAllButton();


            $('#continuePrintOptions')
                .prop('disabled', false);


            updateEstimatedTotal();
        }
        /* =====================================================
           CONTINUE
        ===================================================== */

        /* =====================================================
   SAVE PRINT OPTIONS + CONTINUE
===================================================== */

        $('#continuePrintOptions').on('click', function(e) {

            e.preventDefault();

            var $button = $(this);

            if ($button.prop('disabled')) {
                return;
            }

            var printOptions = {};

            $('.print-file-card').each(function() {

                var $card = $(this);

                var documentId = parseInt(
                    $card.data('document-id'),
                    10
                );

                if (!documentId) {
                    return;
                }

                var options = {};

                /*
                 * BUTTON OPTIONS
                 */
                $card.find('.print-option-btn[data-option]').each(function() {

                    var $option = $(this);

                    if (!$option.hasClass('active')) {
                        return;
                    }

                    var optionName = $option.attr('data-option');
                    var optionValue = $option.attr('data-value');

                    options[optionName] = optionValue;

                });


                /*
                 * SELECT OPTIONS
                 */
                $card.find('.print-option-select[data-option]').each(function() {

                    var $select = $(this);

                    var optionName = $select.attr('data-option');
                    var optionValue = $select.val();

                    options[optionName] = optionValue;

                });


                /*
                 * COPIES
                 */
                var copies = parseInt(
                    $card.find('.print-copies-value').text(),
                    10
                ) || 1;

                options.copies = copies;


                /*
                 * SAVE FOR THIS DOCUMENT
                 */
                printOptions[documentId] = options;

            });


            console.log(
                'Saving print options:',
                printOptions
            );


            /*
             * LOADING
             */
            $button
                .prop('disabled', true)
                .html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>' +
                    'Saving...'
                );


            /*
             * SAVE TO LARAVEL SESSION
             */
            $.ajax({

                url: "{{ route('print-options.save') }}",

                type: "POST",

                dataType: "json",

                data: {

                    _token: "{{ csrf_token() }}",

                    print_options: printOptions

                },

                success: function(response) {

                    if (
                        response &&
                        response.success
                    ) {

                        /*
                         * NOW GO TO CHECKOUT
                         */
                        window.location.href =
                            "{{ route('checkout') }}";

                    } else {

                        alert(
                            response.message ||
                            'Unable to save print options.'
                        );

                    }

                },

                error: function(xhr) {

                    console.error(
                        'Save print options error:',
                        xhr.responseText
                    );

                    alert(
                        'Unable to save print options. Please try again.'
                    );

                },

                complete: function() {

                    $button
                        .prop('disabled', false)
                        .html(
                            'Continue ' +
                            '<i class="bi bi-arrow-right ms-1"></i>'
                        );

                }

            });

        });

        /* =====================================================
           INITIAL LOAD
        ===================================================== */

        positionApplyAllButton();

        loadPrintPrices();
        /* =====================================================
           PREVIOUS FILES MODAL
        ===================================================== */

        var previousFilesModal = {

            show: function() {
                $('#previousFilesModal')
                    .removeClass('d-none');
            },

            hide: function() {
                $('#previousFilesModal')
                    .addClass('d-none');
            }

        };


        var previousFilesData = [];

        var previousFilesSelected = [];


        /* =====================================================
           OPEN PREVIOUS FILES
        ===================================================== */

        $(document).on(
            'click',
            '#openPreviousFiles',
            function() {

                previousFilesSelected = [];

                $('#previousFilesSelectedCount')
                    .text('0 file(s) selected');

                $('#addPreviousFiles')
                    .prop(
                        'disabled',
                        true
                    );

                loadPreviousFiles();

                previousFilesModal.show();

            }
        );


        /* =====================================================
           LOAD PREVIOUS FILES
        ===================================================== */

        function loadPreviousFiles() {

            $('#previousFilesLoading')
                .removeClass('d-none');

            $('#previousFilesList')
                .empty()
                .addClass('d-none');

            $('#previousFilesEmpty')
                .addClass('d-none');

            $('#previousFilesSelectedCount')
                .text('0 file(s) selected');

            $('#addPreviousFiles')
                .prop('disabled', true);


            $.ajax({

                url: "{{ route('print-options.previous-files') }}",

                type: 'GET',

                dataType: 'json',

                success: function(response) {

                    $('#previousFilesLoading')
                        .addClass('d-none');


                    if (
                        !response.success ||
                        !response.documents ||
                        !response.documents.length
                    ) {

                        $('#previousFilesEmpty')
                            .removeClass('d-none');

                        return;

                    }


                    previousFilesData =
                        response.documents;


                    renderPreviousFiles(
                        response.documents,
                        response.selected_ids || []
                    );

                },


                error: function() {

                    $('#previousFilesLoading')
                        .addClass('d-none');

                    $('#previousFilesEmpty')
                        .removeClass('d-none');

                }

            });

        }

        function renderPreviousFiles(
            documents,
            selectedIds
        ) {

            var html = '';


            /*
            =====================================================
            CURRENT DOM FILE IDS
            =====================================================
            */

            var currentIds = [];

            $('.print-file-card')
                .each(function() {

                    var id =
                        parseInt(
                            $(this).data(
                                'document-id'
                            ),
                            10
                        );

                    if (id) {
                        currentIds.push(id);
                    }

                });


            $.each(
                documents,
                function(index, file) {

                    var fileId =
                        parseInt(
                            file.id,
                            10
                        );


                    var alreadyAdded =
                        currentIds.includes(
                            fileId
                        );


                    var pageCount =
                        parseInt(
                            file.pages || 1,
                            10
                        );


                    html +=
                        '<div class="previous-file-item ' +
                        (alreadyAdded ? 'selected' : '') +
                        '" data-file-id="' +
                        fileId +
                        '">' +


                        '<input ' +
                        'type="checkbox" ' +
                        'class="previous-file-check" ' +
                        'value="' +
                        fileId +
                        '" ' +
                        (
                            alreadyAdded ?
                            'disabled' :
                            ''
                        ) +
                        '>' +


                        '<div class="previous-file-icon">' +

                        '<i class="bi bi-file-earmark-text"></i>' +

                        '</div>' +


                        '<div class="previous-file-details">' +

                        '<div class="previous-file-name">' +

                        escapeHtml(
                            file.original_name
                        ) +

                        '</div>' +


                        '<div class="previous-file-meta">' +

                        formatFileSize(
                            file.file_size
                        ) +

                        ' • ' +

                        pageCount +

                        (
                            pageCount === 1 ?
                            ' page' :
                            ' pages'
                        ) +

                        '</div>' +

                        '</div>';


                    if (alreadyAdded) {

                        html +=
                            '<div class="previous-file-added">' +
                            '<i class="bi bi-check-circle-fill me-1"></i>' +
                            'Added' +
                            '</div>';

                    } else {

                        html +=
                            '<div class="previous-file-status">' +
                            '<i class="bi bi-check-circle-fill me-1"></i>' +
                            'Uploaded' +
                            '</div>';

                    }


                    html +=
                        '</div>';

                }
            );


            $('#previousFilesList')
                .html(html)
                .removeClass('d-none');

        }

        /* =====================================================
   CLICK ANYWHERE ON PREVIOUS FILE ROW
   ===================================================== */

        $(document).on(
            'click',
            '.previous-file-item',
            function(e) {

                /*
                If user clicked directly on checkbox,
                let normal checkbox behaviour handle it.
                */
                if (
                    $(e.target).is(
                        '.previous-file-check'
                    )
                ) {
                    return;
                }


                var $checkbox =
                    $(this).find(
                        '.previous-file-check:not(:disabled)'
                    );


                /*
                Already added / disabled file
                */
                if (
                    !$checkbox.length
                ) {
                    return;
                }


                /*
                Toggle checkbox
                */
                $checkbox.prop(
                    'checked',
                    !$checkbox.prop('checked')
                );


                /*
                Trigger existing change handler
                so selected count + Add button
                update automatically.
                */
                $checkbox.trigger('change');

            }
        );
        $(document).on(
            'change',
            '.previous-file-check:not(:disabled)',
            function() {

                var $row =
                    $(this).closest(
                        '.previous-file-item'
                    );

                $row.toggleClass(
                    'selected',
                    $(this).prop('checked')
                );

                previousFilesSelected = [];


                $('.previous-file-check:checked')
                    .each(
                        function() {

                            previousFilesSelected.push(
                                parseInt(
                                    $(this).val(),
                                    10
                                )
                            );

                        }
                    );


                $('#previousFilesSelectedCount')
                    .text(
                        previousFilesSelected.length +
                        ' file(s) selected'
                    );


                $('#addPreviousFiles')
                    .prop(
                        'disabled',
                        previousFilesSelected.length === 0
                    );

            }
        );
        $(document).on(
            'click',
            '#closePreviousFiles',
            function(e) {

                e.preventDefault();
                e.stopPropagation();

                previousFilesModal.hide();

            }
        );


        /*
        =====================================================
        CLOSE WHEN CLICKING OUTSIDE MODAL
        =====================================================
        */

        $(document).on(
            'click',
            '#previousFilesModal',
            function(e) {

                if (
                    e.target ===
                    this
                ) {
                    previousFilesModal.hide();
                }

            }
        );


        $(document).on(
            'click',
            '#addPreviousFiles',
            function() {

                if (
                    !previousFilesSelected.length
                ) {

                    return;

                }


                var $button =
                    $(this);


                $button
                    .prop(
                        'disabled',
                        true
                    )
                    .html(
                        '<span class="spinner-border spinner-border-sm me-1"></span>' +
                        ' Adding...'
                    );


                $.ajax({

                    url: "{{ route('print-options.add-files') }}",

                    type: 'POST',

                    dataType: 'json',

                    data: {

                        _token: "{{ csrf_token() }}",

                        document_ids: previousFilesSelected

                    },


                    success: function(response) {

                        if (
                            !response.success
                        ) {

                            alert(
                                response.message ||
                                'Unable to add files.'
                            );

                            return;

                        }


                        /*
                        =================================================
                        CLOSE MODAL
                        =================================================
                        */

                        previousFilesModal.hide();


                        /*
                        =================================================
                        RELOAD PAGE

                        This guarantees:
                        - session updated
                        - correct pages
                        - correct options
                        - no duplicate cards
                        =================================================
                        */

                        window.location.reload();

                    },


                    error: function(xhr) {

                        console.error(
                            xhr.responseText
                        );


                        alert(
                            'Unable to add files. Please try again.'
                        );

                    },


                    complete: function() {

                        $button
                            .prop(
                                'disabled',
                                false
                            )
                            .html(
                                '<i class="bi bi-plus-lg me-1"></i>' +
                                ' Add Selected Files'
                            );

                    }

                });

            }
        );

        function formatFileSize(bytes) {

            bytes =
                parseInt(
                    bytes || 0,
                    10
                );


            if (
                bytes <= 0
            ) {

                return '0 KB';

            }


            var units = [
                'B',
                'KB',
                'MB',
                'GB'
            ];


            var i =
                Math.floor(
                    Math.log(bytes) /
                    Math.log(1024)
                );


            i =
                Math.min(
                    i,
                    units.length - 1
                );


            return (
                    bytes /
                    Math.pow(
                        1024,
                        i
                    )
                ).toFixed(
                    i === 0 ?
                    0 :
                    2
                ) +
                ' ' +
                units[i];

        }

        function positionApplyAllButton() {

            var $cards =
                $('.print-file-card');

            var $apply =
                $('#applyAllWrapper');


            if (
                !$cards.length ||
                $cards.length <= 1
            ) {

                $apply.hide();

                return;
            }


            /*
            ============================================
            Always put Apply button immediately
            after the FIRST current file.
            ============================================
            */

            $apply.insertAfter(
                $cards.first()
            );


            $apply.show();
        }
    });
</script>

@endsection