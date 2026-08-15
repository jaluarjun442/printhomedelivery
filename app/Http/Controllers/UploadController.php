<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Price;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\PrintDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upload(Request $request)
    {
        $data = [];

        $mobile = $request->cookie('loggedin_number');

        $selectedDocumentIds = session(
            'upload_selected_document_ids',
            []
        );

        $selectedDocuments = collect();

        if ($mobile && !empty($selectedDocumentIds)) {

            $selectedDocuments = PrintDocument::where('mobile', $mobile)
                ->whereIn('id', $selectedDocumentIds)
                ->get([
                    'id',
                    'original_name',
                    'file_size',
                    'pages',
                    'mime_type',
                    'status'
                ]);


            $validIds = $selectedDocuments
                ->pluck('id')
                ->map(fn($id) => (int) $id)
                ->values()
                ->toArray();

            session([
                'upload_selected_document_ids' => $validIds
            ]);
        }

        return view(
            'front.upload',
            compact(
                'data',
                'selectedDocuments'
            )
        );
    }

    public function status(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        return response()->json([
            'verified' => !empty($mobile),
            'mobile' => $mobile
        ]);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => [
                'required',
                'digits:10'
            ]
        ]);

        $mobile = $request->mobile;

        // TEMPORARY TEST OTP
        $otp = '000000';

        // Production:
        // $otp = (string) random_int(100000, 999999);

        Cache::put(
            'upload_otp_' . $mobile,
            Hash::make($otp),
            now()->addMinutes(5)
        );

        /*
        =====================================================
        SEND OTP THROUGH WHATSAPP HERE

        Example:

        $this->sendWhatsAppOtp(
            $mobile,
            $otp
        );
        =====================================================
        */

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.'
        ]);
    }


    /**
     * Verify OTP and create the loggedin_number cookie.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => [
                'required',
                'digits:10'
            ],
            'otp' => [
                'required',
                'digits:6'
            ]
        ]);

        $mobile = $request->mobile;
        $otp = $request->otp;

        $storedOtp = Cache::get(
            'upload_otp_' . $mobile
        );

        if (!$storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired. Please request a new OTP.'
            ], 422);
        }

        if (!Hash::check($otp, $storedOtp)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.'
            ], 422);
        }

        // OTP is correct; it cannot be reused.
        Cache::forget(
            'upload_otp_' . $mobile
        );


        $cookie = cookie(
            'loggedin_number',
            $mobile,
            60 * 24 * 30,
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'lax'
        );

        return response()
            ->json([
                'success' => true,
                'verified' => true,
                'message' => 'Mobile number verified successfully.',
                'mobile' => $mobile
            ])
            ->withCookie($cookie);
    }


    /**
     * Upload documents for the verified mobile number.
     */
    public function upload_documents(Request $request)
    {

        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {

            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }


        set_time_limit(1200);
        ini_set('max_execution_time', '1200');

        $request->validate([

            'documents' => [
                'required',
                'array',
                'min:1',
                'max:50'
            ],

            'documents.*' => [
                'required',
                'file',
                'mimes:pdf',
                'max:3000000'
            ]

        ]);



        $uploadDirectory = base_path(
            'uploads/print_documents'
        );




        if (!is_dir($uploadDirectory)) {

            mkdir(
                $uploadDirectory,
                0755,
                true
            );
        }


        $uploadedDocuments = [];



        // $pdfParser = new Parser();



        foreach ($request->file('documents') as $file) {



            $originalName =
                $file->getClientOriginalName();

            $extension =
                strtolower(
                    $file->getClientOriginalExtension()
                );

            $mimeType =
                $file->getMimeType();

            $fileSize =
                $file->getSize();



            $nameWithoutExtension = pathinfo(
                $originalName,
                PATHINFO_FILENAME
            );


            do {

                $randomNumber = random_int(
                    1000,
                    9999
                );

                $filename =
                    $nameWithoutExtension .
                    '_' .
                    $randomNumber .
                    '.' .
                    $extension;
            } while (
                file_exists(
                    $uploadDirectory .
                        DIRECTORY_SEPARATOR .
                        $filename
                )
            );



            $file->move(
                $uploadDirectory,
                $filename
            );



            $pages = 1;


            if ($extension === 'pdf') {

                $pages = $this->getPdfPageCount(
                    $uploadDirectory .
                        DIRECTORY_SEPARATOR .
                        $filename
                );
            } else {

                $pages = 1;
            }


            $storedPath = $filename;



            $document = PrintDocument::create([

                'mobile' =>
                $mobile,

                'original_name' =>
                $originalName,

                'stored_path' =>
                $storedPath,

                'mime_type' =>
                $mimeType,

                'file_size' =>
                $fileSize,

                'pages' =>
                $pages,

                'status' =>
                'uploaded'

            ]);



            $uploadedDocuments[] = [

                'id' =>
                $document->id,

                'name' =>
                $document->original_name,

                'size' =>
                $document->file_size,

                'pages' =>
                $document->pages,

                'status' =>
                $document->status

            ];
        }


        $currentIds = session(
            'upload_selected_document_ids',
            []
        );


        foreach ($uploadedDocuments as $document) {

            $currentIds[] =
                (int) $document['id'];
        }



        $currentIds = array_values(
            array_unique(
                $currentIds
            )
        );



        session([
            'upload_selected_document_ids' =>
            $currentIds
        ]);


        return response()->json([

            'success' =>
            true,

            'message' =>
            'All documents uploaded successfully.',

            'count' =>
            count($uploadedDocuments),

            'documents' =>
            $uploadedDocuments

        ]);
    }
    private function getPdfPageCount($filePath)
    {
        try {

            $pdf = new \Com\Tecnick\Pdf\Tcpdf();

            $sourceId = $pdf->setImportSourceFile(
                $filePath
            );

            $pageCount = $pdf->getSourcePageCount(
                $sourceId
            );

            /*
        |--------------------------------------------------------------------------
        | Release parser resources
        |--------------------------------------------------------------------------
        */

            if (
                isset($pdf->importer) &&
                $pdf->importer
            ) {

                $pdf->importer->cleanUp();
            }

            return max(
                1,
                (int) $pageCount
            );
        } catch (\Throwable $e) {

            \Log::error(
                'PDF page count failed',
                [
                    'file' =>
                    $filePath,

                    'error' =>
                    $e->getMessage()
                ]
            );

            return 1;
        }
    }
    public function saveSelectedFiles(Request $request)
    {

        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }


        $request->validate([
            'document_ids' => [
                'nullable',
                'array'
            ],

            'document_ids.*' => [
                'integer'
            ]
        ]);


        /*
    |--------------------------------------------------------------------------
    | Get IDs from request
    |
    | If Clear All sends nothing, use empty array.
    |--------------------------------------------------------------------------
    */
        $requestedIds = collect(
            $request->input('document_ids', [])
        )
            ->map(function ($id) {
                return (int) $id;
            })
            ->filter(function ($id) {
                return $id > 0;
            })
            ->unique()
            ->values();


        /*
    |--------------------------------------------------------------------------
    | SECURITY
    |
    | Only allow documents belonging to the currently
    | verified mobile number.
    |--------------------------------------------------------------------------
    */
        $validIds = [];

        if ($requestedIds->isNotEmpty()) {

            $validIds = PrintDocument::where(
                'mobile',
                $mobile
            )
                ->whereIn(
                    'id',
                    $requestedIds->toArray()
                )
                ->pluck('id')
                ->map(function ($id) {
                    return (int) $id;
                })
                ->values()
                ->toArray();
        }


        /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |
    | Replace the current session selection completely.
    |
    | Do NOT merge with old IDs.
    |
    | This is what makes:
    |
    | X remove
    | Clear All
    | Refresh
    |
    | work correctly.
    |--------------------------------------------------------------------------
    */
        session([
            'upload_selected_document_ids' => $validIds
        ]);


        /*
    |--------------------------------------------------------------------------
    | Response
    |--------------------------------------------------------------------------
    */
        return response()->json([
            'success' => true,
            'message' => 'Selected files updated successfully.',
            'document_ids' => $validIds,
            'count' => count($validIds)
        ]);
    }
    /**
     * Get previously uploaded files for the verified mobile number.
     */
    public function previousFiles(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }

        $documents = PrintDocument::where('mobile', $mobile)
            ->orderByDesc('id')
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status',
                'created_at'
            ]);

        return response()->json([
            'success' => true,
            'mobile' => $mobile,
            'count' => $documents->count(),
            'documents' => $documents->map(function ($document) {
                return [
                    'id' => $document->id,
                    'name' => $document->original_name,
                    'size' => $document->file_size,
                    'pages' => $document->pages,
                    'mime_type' => $document->mime_type,
                    'status' => $document->status,
                    'created_at' => optional($document->created_at)->format('d M Y')
                ];
            })->values()
        ]);
    }
    public function printOptions(Request $request)
    {
        /*
    =====================================================
    Get selected document IDs from current upload session
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );


        /*
    =====================================================
    If no files are selected, send user back to upload
    =====================================================
    */

        if (empty($selectedIds)) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please select at least one document.'
                );
        }


        /*
    =====================================================
    Get selected documents

    IMPORTANT:
    Keep the same database IDs.
    =====================================================
    */

        $documents = PrintDocument::whereIn(
            'id',
            $selectedIds
        )
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status'
            ]);


        /*
    =====================================================
    Return Print Options page
    =====================================================
    */

        return view(
            'front.print-options',
            compact('documents')
        );
    }
    public function printOptionPrices(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | COLOR MODE
    |--------------------------------------------------------------------------
    | Parent:
    | 1 = Color Mode
    |
    | Children:
    | black_and_white
    | color
    |--------------------------------------------------------------------------
    */

        $colorMode = Price::where('slug', 'color_mode')
            ->where('status', 1)
            ->with([
                'childPrice' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id');
                }
            ])
            ->first();


        /*
    |--------------------------------------------------------------------------
    | BINDING
    |--------------------------------------------------------------------------
    */

        $binding = Price::where('slug', 'bindings')
            ->where('status', 1)
            ->with([
                'childPrice' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id');
                }
            ])
            ->first();


        /*
    |--------------------------------------------------------------------------
    | PRINT SIDE PRICES
    |--------------------------------------------------------------------------
    */

        $printPrices = Price::whereIn('slug', [
            'black_white_single',
            'black_white_double',
            'color_single',
            'color_double',
        ])
            ->where('status', 1)
            ->pluck('amount', 'slug');


        /*
    |--------------------------------------------------------------------------
    | COLOR OPTIONS
    |--------------------------------------------------------------------------
    */

        $colorOptions = [];

        if ($colorMode) {

            foreach ($colorMode->childPrice as $item) {

                $colorOptions[] = [
                    'id'     => $item->id,
                    'name'   => $item->name,
                    'slug'   => $item->slug,
                    'amount' => (float) $item->amount,
                ];
            }
        }


        /*
    |--------------------------------------------------------------------------
    | BINDING OPTIONS
    |--------------------------------------------------------------------------
    */

        $bindingOptions = [];

        if ($binding) {

            foreach ($binding->childPrice as $item) {

                $bindingOptions[] = [
                    'id'     => $item->id,
                    'name'   => $item->name,
                    'slug'   => $item->slug,
                    'amount' => (float) $item->amount,
                ];
            }
        }


        return response()->json([

            'success' => true,

            /*
        |--------------------------------------------------------------------------
        | PRINT SIDE
        |--------------------------------------------------------------------------
        */

            'prices' => [

                'black_white_single' =>
                (float) ($printPrices['black_white_single'] ?? 0),

                'black_white_double' =>
                (float) ($printPrices['black_white_double'] ?? 0),

                'color_single' =>
                (float) ($printPrices['color_single'] ?? 0),

                'color_double' =>
                (float) ($printPrices['color_double'] ?? 0),

            ],


            /*
        |--------------------------------------------------------------------------
        | COLOR MODE OPTIONS
        |--------------------------------------------------------------------------
        */

            'color_options' => $colorOptions,


            /*
        |--------------------------------------------------------------------------
        | BINDING OPTIONS
        |--------------------------------------------------------------------------
        */

            'binding_options' => $bindingOptions,

        ]);
    }
    public function removePrintOptionFile(Request $request)
    {
        $request->validate([
            'document_id' => 'required|integer'
        ]);


        /*
    =====================================================
    Get currently selected document IDs
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );


        /*
    =====================================================
    Remove requested document ID
    =====================================================
    */

        $documentId = (int) $request->document_id;

        $selectedIds = array_values(
            array_filter(
                $selectedIds,
                function ($id) use ($documentId) {

                    return (int) $id !== $documentId;
                }
            )
        );


        /*
    =====================================================
    Save updated selected IDs back to session
    =====================================================
    */

        session()->put(
            'upload_selected_document_ids',
            $selectedIds
        );
        /*
=====================================================
REMOVE PRINT SETTINGS FOR DELETED FILE
=====================================================
*/

        $printOptions = session(
            'print_options',
            []
        );

        unset(
            $printOptions[$documentId]
        );

        session()->put(
            'print_options',
            $printOptions
        );

        /*
    =====================================================
    Response
    =====================================================
    */

        return response()->json([
            'success' => true,
            'document_ids' => $selectedIds
        ]);
    }
    public function previousPrintFiles(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {

            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }


        /*
    =====================================================
    CURRENTLY SELECTED FILES
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );


        /*
    =====================================================
    GET PREVIOUS UPLOADED FILES
    =====================================================
    */

        $documents = PrintDocument::where(
            'mobile',
            $mobile
        )
            ->where(
                'status',
                'uploaded'
            )
            ->orderBy(
                'id',
                'desc'
            )
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status'
            ]);


        return response()->json([

            'success' => true,

            'documents' => $documents,

            'selected_ids' => array_map(
                'intval',
                $selectedIds
            )

        ]);
    }
    public function addPreviousPrintFiles(Request $request)
    {
        $request->validate([
            'document_ids' => [
                'required',
                'array',
                'min:1'
            ],

            'document_ids.*' => [
                'integer'
            ]
        ]);


        /*
    =====================================================
    CURRENT SESSION FILES
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );


        $selectedIds = array_map(
            'intval',
            $selectedIds
        );


        /*
    =====================================================
    REQUESTED FILE IDS
    =====================================================
    */

        $newIds = array_map(
            'intval',
            $request->document_ids
        );


        /*
    =====================================================
    REMOVE DUPLICATES
    =====================================================
    */

        $newIds = array_unique(
            $newIds
        );


        /*
    =====================================================
    ONLY ADD FILES NOT ALREADY SELECTED
    =====================================================
    */

        foreach ($newIds as $id) {

            if (
                !in_array(
                    $id,
                    $selectedIds,
                    true
                )
            ) {

                $selectedIds[] = $id;
            }
        }


        /*
    =====================================================
    MAX 50 FILES
    =====================================================
    */

        $selectedIds = array_slice(
            $selectedIds,
            0,
            50
        );


        /*
    =====================================================
    SAVE SESSION
    =====================================================
    */

        session()->put(
            'upload_selected_document_ids',
            $selectedIds
        );


        /*
    =====================================================
    RETURN ADDED FILE DETAILS
    =====================================================
    */

        $documents = PrintDocument::whereIn(
            'id',
            $newIds
        )
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status'
            ]);


        return response()->json([

            'success' => true,

            'document_ids' => $selectedIds,

            'documents' => $documents

        ]);
    }
    public function savePrintOptions(Request $request)
    {
        $printOptions = $request->input(
            'print_options',
            []
        );

        if (!is_array($printOptions)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid print options.'
            ], 422);
        }

        /*
     * Clean + normalize options
     */
        $cleanOptions = [];

        foreach ($printOptions as $documentId => $options) {

            $documentId = (int) $documentId;

            if (!$documentId || !is_array($options)) {
                continue;
            }

            $cleanOptions[$documentId] = [

                'color_mode' =>
                $options['color_mode']
                    ?? 'black_white',

                'print_side' =>
                $options['print_side']
                    ?? 'double',

                'binding' =>
                $options['binding']
                    ?? '',

                'page_size' =>
                $options['page_size']
                    ?? 'a4_75',

                'orientation' =>
                $options['orientation']
                    ?? 'portrait',

                'copies' =>
                max(
                    1,
                    (int) (
                        $options['copies']
                        ?? 1
                    )
                ),
            ];
        }


        /*
     * Save in Laravel session
     */
        session()->put(
            'print_options',
            $cleanOptions
        );


        return response()->json([
            'success' => true,
            'print_options' => $cleanOptions
        ]);
    }
}
