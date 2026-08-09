<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                    'mime_type',
                    'status'
                ]);

            /*
        |--------------------------------------------------------------------------
        | Remove IDs that no longer exist / don't belong to this mobile
        |--------------------------------------------------------------------------
        */

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


    /**
     * Check whether the current browser has a verified mobile cookie.
     */
    public function status(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        return response()->json([
            'verified' => !empty($mobile),
            'mobile' => $mobile
        ]);
    }


    /**
     * Send OTP.
     *
     * Temporary testing OTP is 000000.
     * Replace it with random_int() when WhatsApp OTP is connected.
     */
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

        /*
        =====================================================
        Create the cookie on the SERVER.

        HttpOnly = JavaScript cannot modify/read it.
        SameSite=Lax = normal same-site browser requests work.
        30 days = user remains verified for future visits.
        =====================================================
        */
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
        /*
    =====================================================
    Get verified mobile from server-side cookie
    =====================================================
    */
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {

            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }


        /*
    =====================================================
    Validate files
    =====================================================
    */
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
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,webp',
                'max:2097152'
            ]

        ]);


        /*
    =====================================================
    Upload directory

    D:\xampp\htdocs\printhomedelivery\
    uploads\print_documents\
    =====================================================
    */
        $uploadDirectory = base_path(
            'uploads/print_documents'
        );


        /*
    =====================================================
    Create directory if it doesn't exist
    =====================================================
    */
        if (!is_dir($uploadDirectory)) {

            mkdir(
                $uploadDirectory,
                0755,
                true
            );
        }


        $uploadedDocuments = [];


        /*
    =====================================================
    Upload each file
    =====================================================
    */
        foreach ($request->file('documents') as $file) {


            /*
        =================================================
        Get file information BEFORE move()
        =================================================
        */

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


            /*
        =================================================
        Remove extension from original filename

        Example:

        arjun_aadhar_card.pdf

        becomes:

        arjun_aadhar_card
        =================================================
        */

            $nameWithoutExtension = pathinfo(
                $originalName,
                PATHINFO_FILENAME
            );


            /*
        =================================================
        Generate unique filename

        Example:

        arjun_aadhar_card_5832.pdf
        =================================================
        */

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


            /*
        =================================================
        Move uploaded file

        Example:

        uploads/print_documents/
        arjun_aadhar_card_5832.pdf
        =================================================
        */

            $file->move(
                $uploadDirectory,
                $filename
            );


            /*
        =================================================
        Database path
        =================================================
        */

            $storedPath = $filename;


            /*
        =================================================
        Save database record
        =================================================
        */

            $document = PrintDocument::create([

                /*
            | Mobile stays in DB.
            */
                'mobile' =>
                $mobile,

                /*
            | Original filename shown to user.
            */
                'original_name' =>
                $originalName,

                /*
            | Actual stored filename/path.
            */
                'stored_path' =>
                $storedPath,

                /*
            | MIME type.
            */
                'mime_type' =>
                $mimeType,

                /*
            | File size.
            */
                'file_size' =>
                $fileSize,

                /*
            | Upload status.
            */
                'status' =>
                'uploaded'

            ]);


            /*
        =================================================
        Response data
        =================================================
        */

            $uploadedDocuments[] = [

                'id' =>
                $document->id,

                'name' =>
                $document->original_name,

                'size' =>
                $document->file_size,

                'status' =>
                $document->status

            ];
        }


        /*
    =====================================================
    Add uploaded document IDs to current session
    =====================================================
    */

        $currentIds = session(
            'upload_selected_document_ids',
            []
        );


        foreach ($uploadedDocuments as $document) {

            $currentIds[] =
                (int) $document['id'];
        }


        /*
    =====================================================
    Remove duplicate IDs
    =====================================================
    */

        $currentIds = array_values(
            array_unique(
                $currentIds
            )
        );


        /*
    =====================================================
    Save current selected document IDs
    =====================================================
    */

        session([
            'upload_selected_document_ids' =>
            $currentIds
        ]);


        /*
    =====================================================
    Final response
    =====================================================
    */

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
    public function saveSelectedFiles(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | Get verified mobile
    |--------------------------------------------------------------------------
    */
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile verification required.'
            ], 401);
        }


        /*
    |--------------------------------------------------------------------------
    | document_ids is allowed to be empty
    |
    | This is important for "Clear All".
    |--------------------------------------------------------------------------
    */
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
                    'mime_type' => $document->mime_type,
                    'status' => $document->status,
                    'created_at' => optional($document->created_at)->format('d M Y')
                ];
            })->values()
        ]);
    }
}
