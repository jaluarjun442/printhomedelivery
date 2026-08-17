<?php

namespace App\Http\Controllers;

use App\Models\ProductsAttributes;
use App\Models\ProductsCategories;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Blogs;
use App\Models\Contact;
use App\Models\PrintDocument;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ck_product_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $image = $filenametostore;
            $request->file('upload')->move("uploads/ck/", $image);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/ck/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
    public function index()
    {
        return view('admin.home');
    }
    public function home()
    {
        return view('admin.home');
    }
    public function store()
    {
        return view('admin/store/index');
    }
    public function add_store()
    {
        return view('admin/store/add');
    }
    public function edit_store($store_id)
    {
        $store_data = Store::where('id', $store_id)->first();
        return view('admin/store/edit', compact('store_id', 'store_data'));
    }
    public function setting()
    {
        return view('admin.home');
    }
    public function save_store(Request $request)
    {
        $file = $request->file('logo');
        $image = $request->post('name') . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
        $file->move("uploads/logo/", $image);

        $data = Store::create(
            [
                'name' => $request->post('name'),
                'logo' => $image,
                'website' => $request->post('website'),
                'website_url' => $request->post('website_url'),
                'email' => $request->post('email'),
                'tag_id' => $request->post('tag_id'),
                'phone' => $request->post('phone'),
                'payment' => $request->post('payment'),
                'pan_card' => $request->post('pan_card'),
                'about_us_tag' => $request->post('about_us_tag'),
                'red_tim' => $request->post('red_tim'),
                'header_script' => $request->post('header_script'),
                'sidebar_script' => $request->post('sidebar_script'),
                'footer_script' => $request->post('footer_script'),
                'status' => $request->post('status')
            ]
        );
        if ($data) {
            return redirect()->route('admin.store')->with('success', 'Data Added Successfully.');
        }
    }
    public function update_store(Request $request)
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $image = $request->post('name') . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/logo/", $image);
        } else {
            $image = $request->post('old_logo');
        }
        $data = Store::where('id', $request->post('id'))
            ->update(
                [
                    'name' => $request->post('name'),
                    'logo' => $image,
                    'website' => $request->post('website'),
                    'website_url' => $request->post('website_url'),
                    'email' => $request->post('email'),
                    'tag_id' => $request->post('tag_id'),
                    'phone' => $request->post('phone'),
                    'payment' => $request->post('payment'),
                    'pan_card' => $request->post('pan_card'),
                    'about_us_tag' => $request->post('about_us_tag'),
                    'red_tim' => $request->post('red_tim'),
                    'header_script' => $request->post('header_script'),
                    'sidebar_script' => $request->post('sidebar_script'),
                    'footer_script' => $request->post('footer_script'),
                    'status' => $request->post('status')
                ]
            );
        if ($data) {
            return redirect()->route('admin.store')->with('success', 'Data Added Successfully.');
        }
    }

    public function get_store(Request $request)
    {
        $data = Store::select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('logo', function ($row) {
                return "<img src='" . asset('uploads/logo') . '/' . $row['logo'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a href="' . route('admin.edit_store', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
    }
    public function category()
    {
        return view('admin/category/index');
    }
    public function get_category(Request $request)
    {
        $data = Category::with('parentCategory');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return "<img src='" . asset('uploads/category') . '/' . $row['image'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('parent_category_name', function ($row) {
                return $row->parentCategory ? $row->parentCategory->name : '-';
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a href="' . route('admin.edit_category', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function edit_category($category_id)
    {
        $category_data = Category::where('id', $category_id)->first();
        $category = Category::where('id', '!=', $category_id)->get();
        return view('admin/category/edit', compact('category_id', 'category_data', 'category'));
    }
    public function update_category(Request $request)
    {
        $name = $request->post('name');
        $slug = Str::slug($request->post('name'));
        $parent_category_id = $request->post('parent_category_id') ?? null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/category/", $image);
        } else {
            $image = $request->post('old_image');
        }

        $data = Category::where('id', $request->post('id'))
            ->update(
                [
                    'name' => $name,
                    'parent_category_id' => $parent_category_id,
                    'image' => $image,
                    'slug' => $slug,
                ]
            );
        if ($data) {
            return redirect()->route('admin.category')->with('success', 'Data Added Successfully.');
        }
    }
    public function add_category()
    {
        $category = Category::all();
        return view('admin/category/add', compact('category'));
    }
    public function save_category(Request $request)
    {
        $request->validate([
            'image' => 'required|image', // max 2MB
            'name' => 'required|string',
            'parent_category_id' => 'nullable|integer', // Assuming parent_category_id is an integer
        ]);
        $name = $request->post('name');
        $parent_category_id = $request->post('parent_category_id') ?? null;
        $file = $request->file('image');
        $image = $name . "." . $file->getClientOriginalExtension();
        $file->move("uploads/category/", $image);
        $slug = Str::slug($request->post('name'));

        $data = Category::create(
            [
                'parent_category_id' => $parent_category_id,
                'name' => $name,
                'image' => $image,
                'slug' => $slug,
            ]
        );
        if ($data) {
            return redirect()->route('admin.category')->with('success', 'Data Added Successfully.');
        }
    }

    public function product()
    {

        return view('admin/product/index');
    }
    public function get_product(Request $request)
    {
        $data = Products::with('products_images')->orderBy('id', 'desc');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                if ($row['products_images'][0]) {
                    return "<img src='" . asset('uploads/product') . '/' . $row['products_images'][0]['image'] . "' style='width:50px; height:50px;' />";
                } else {
                    return "";
                }
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a target="" href="' . route('admin.edit_product', $row['id']) . '" class="edit mr-2 btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function delete_product_attribute($id)
    {
        try {
            $attribute = ProductsAttributes::findOrFail($id);
            $attribute->delete();
            return response()->json(['message' => 'Product attribute deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product attribute'], 500);
        }
    }
    public function delete_product_image($image_id)
    {
        $image = ProductsImages::find($image_id);
        if (!$image) {
            return response()->json(['message' => 'Image not found.'], 404);
        }
        $filePath = base_path('uploads/product/' . $image->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        } else {
            // return response()->json(['message' => 'Image file not found.'], 404);
        }
        $image->forceDelete();
        return response()->json(['message' => 'Image deleted successfully.']);
    }
    public function edit_product($product_id)
    {
        $product_data = Products::with(['categories', 'products_attributes'])->where('id', $product_id)->first();
        $category = Category::all();
        return view('admin/product/edit', compact('product_id', 'product_data', 'category'));
    }
    public function add_product()
    {
        $category = Category::all();
        return view('admin/product/add', compact('category'));
    }
    public function update_product(Request $request)
    {
        $category_id = $request->post('category_id') ?? '';
        $name = $request->post('name') ?? '';
        $body = $request->post('body') ?? '';
        $price = $request->post('price') ?? '';
        $buy_now_text = $request->post('buy_now_text') ?? '';
        $buy_now_link = $request->post('buy_now_link') ?? '';
        $status = $request->post('status') ?? 1;
        $au_red = $request->post('au_red') ?? 1;

        $slug = Str::slug($request->post('name'), '_');
        $data = Products::where('id', $request->post('id'))
            ->update(
                [
                    // 'category_id' => $category_id,
                    'name' => $name,
                    'buy_now_text' => $buy_now_text,
                    'buy_now_link' => $buy_now_link,
                    'slug' => $slug,
                    'price' => $price,
                    'status' => $status,
                    'au_red' => $au_red,
                    'body' => $body
                ]
            );
        $product_id = $request->post('id');
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $image = rand(1111111111, 9999999999) . '_' . rand(1111111111, 9999999999) . '.' . $file->getClientOriginalExtension();
                $file->move("uploads/product/", $image);
                ProductsImages::create(
                    [
                        'image' => $image,
                        'product_id' => $product_id
                    ]
                );
            }
        }
        ProductsCategories::where('product_id', $product_id)->forceDelete();
        foreach ($request->category_id as $key => $category_id) {
            ProductsCategories::create(
                [
                    'category_id' => $category_id,
                    'product_id' => $product_id
                ]
            );
        }
        if ($data) {
            return redirect()->route('admin.product')->with('success', 'Data Added Successfully.');
        }
    }
    public function save_product(Request $request)
    {
        $category_id = $request->post('category_id') ?? '';
        $name = $request->post('name') ?? '';
        $body = $request->post('body') ?? '';
        $price = $request->post('price') ?? '';
        $buy_now_text = $request->post('buy_now_text') ?? '';
        $buy_now_link = $request->post('buy_now_link') ?? '';
        $status = $request->post('status') ?? 1;
        $au_red = $request->post('au_red') ?? 1;


        $slug = Str::slug($request->post('name'), '_');
        $data = Products::create(
            [
                'name' => $name,
                'buy_now_text' => $buy_now_text,
                'buy_now_link' => $buy_now_link,
                'image' => "",
                'slug' => $slug,
                'price' => $price,
                'status' => $status,
                'au_red' => $au_red,
                'body' => $body
            ]
        );
        $product_id = $data['id'];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $image = rand(1111111111, 9999999999) . '_' . rand(1111111111, 9999999999) . '.' . $file->getClientOriginalExtension();
                $file->move("uploads/product/", $image);
                ProductsImages::create(
                    [
                        'image' => $image,
                        'product_id' => $product_id
                    ]
                );
            }
        } else {
            $image = 'default.png';
            ProductsImages::create(
                [
                    'image' => $image,
                    'product_id' => $product_id
                ]
            );
        }
        foreach ($request->category_id as $key => $category_id) {
            ProductsCategories::create(
                [
                    'category_id' => $category_id,
                    'product_id' => $product_id
                ]
            );
        }
        // Save product attributes
        $attributes = $request->post('attributes') ?? [];
        foreach ($attributes as $attribute) {
            ProductsAttributes::create([
                'name' => $attribute['name'],
                'value' => $attribute['value'],
                'product_id' => $product_id
            ]);
        }
        if ($data) {
            return redirect()->route('admin.product')->with('success', 'Data Added Successfully.');
        }
    }
    public function blog()
    {
        return view('admin/blog/index');
    }


    public function get_blog(Request $request)
    {
        $data = Blogs::orderBy('id', 'desc');

        return DataTables::of($data)
            ->addIndexColumn()

            ->editColumn('image', function ($row) {

                if ($row->image) {

                    return '<img src="' .
                        asset('uploads/blog/' . $row->image) .
                        '" style="width:60px;height:60px;object-fit:cover;" />';
                }

                return '';
            })

            ->editColumn('status', function ($row) {

                if ((int) $row->status === 1) {
                    return '<span class="badge badge-success">Published</span>';
                }

                return '<span class="badge badge-secondary">Draft</span>';
            })

            ->editColumn('published_at', function ($row) {

                return $row->published_at
                    ? $row->published_at->format('d M Y')
                    : '-';
            })

            ->addColumn('action', function ($row) {

                return '<a href="' .
                    route('admin.edit_blog', $row->id) .
                    '" class="edit mr-2 btn btn-primary btn-sm">
                    Edit
                </a>';
            })

            ->rawColumns([
                'image',
                'status',
                'action'
            ])

            ->make(true);
    }


    public function add_blog()
    {
        return view('admin/blog/add');
    }


    public function save_blog(Request $request)
    {
        $title = $request->post('title') ?? '';

        /*
    |--------------------------------------------------------------------------
    | SEO FRIENDLY SLUG
    |--------------------------------------------------------------------------
    */

        $slug = Str::slug($title, '-');

        /*
    |--------------------------------------------------------------------------
    | Prevent duplicate slug
    |--------------------------------------------------------------------------
    */

        $originalSlug = $slug;
        $counter = 1;

        while (
            Blogs::where('slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }


        /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

        $image = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $image = $file->getClientOriginalName();

            $file->move(
                'uploads/blog/',
                $image
            );
        }

        /*
    |--------------------------------------------------------------------------
    | BLOG
    |--------------------------------------------------------------------------
    */

        $data = Blogs::create([
            'title' => $title,
            'slug' => $slug,

            'excerpt' =>
            $request->post('excerpt') ?? '',

            'content' =>
            $request->post('content') ?? '',

            'image' => $image,

            'meta_title' =>
            $request->post('meta_title') ?? '',

            'meta_description' =>
            $request->post('meta_description') ?? '',

            'og_title' =>
            $request->post('og_title') ?? '',

            'og_description' =>
            $request->post('og_description') ?? '',

            'og_image' => $image,

            'status' =>
            $request->post('status') ?? 1,

            'published_at' => $request->post('status') == 1
                ? ($request->post('published_at') ?: now())
                : null,

            'views' => 0,
        ]);


        if ($data) {

            return redirect()
                ->route('admin.blog')
                ->with(
                    'success',
                    'Blog Added Successfully.'
                );
        }


        return back()
            ->withInput()
            ->with(
                'error',
                'Unable to add blog.'
            );
    }


    public function edit_blog($blog_id)
    {
        $blog_data = Blogs::where(
            'id',
            $blog_id
        )->firstOrFail();

        return view(
            'admin/blog/edit',
            compact(
                'blog_id',
                'blog_data'
            )
        );
    }


    public function update_blog(Request $request)
    {
        $blog = Blogs::where(
            'id',
            $request->post('id')
        )->firstOrFail();


        $title = $request->post('title') ?? '';


        /*
    |--------------------------------------------------------------------------
    | SLUG
    |--------------------------------------------------------------------------
    */

        $slug = Str::slug(
            $title,
            '-'
        );

        $originalSlug = $slug;
        $counter = 1;

        while (
            Blogs::where('slug', $slug)
            ->where(
                'id',
                '!=',
                $blog->id
            )
            ->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }


        /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

        $image = $blog->image;

        if ($request->hasFile('image')) {

            /*
        Delete old image
        */

            if (
                $image &&
                File::exists(
                    base_path(
                        'uploads/blog/' . $image
                    )
                )
            ) {

                File::delete(
                    base_path(
                        'uploads/blog/' . $image
                    )
                );
            }


            $file =
                $request->file('image');

            $image = $file->getClientOriginalName();

            $file->move(
                'uploads/blog/',
                $image
            );
        }


        /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

        $wasPublished =
            (int) $blog->status === 1;

        $newStatus =
            (int) ($request->post('status') ?? 1);


        $publishedAt =
            $blog->published_at;


        $publishedAt = $request->post('published_at');

        if ($newStatus === 1 && empty($publishedAt)) {
            $publishedAt = $blog->published_at ?: now();
        }

        if ($newStatus === 0) {
            $publishedAt = null;
        }



        $updated = $blog->update([

            'title' => $title,

            'slug' => $slug,

            'excerpt' =>
            $request->post('excerpt') ?? '',

            'content' =>
            $request->post('content') ?? '',

            'image' => $image,

            'meta_title' =>
            $request->post('meta_title') ?? '',

            'meta_description' =>
            $request->post('meta_description') ?? '',

            'og_title' =>
            $request->post('og_title') ?? '',

            'og_description' =>
            $request->post('og_description') ?? '',

            'og_image' => $image,

            'status' => $newStatus,

            'published_at' =>
            $publishedAt,
        ]);


        if ($updated) {

            return redirect()
                ->route('admin.blog')
                ->with(
                    'success',
                    'Blog Updated Successfully.'
                );
        }


        return back()
            ->withInput()
            ->with(
                'error',
                'Unable to update blog.'
            );
    }
    public function contact()
    {
        return view('admin/contact/index');
    }


    public function get_contact(Request $request)
    {
        $data = Contact::orderBy('id', 'desc');

        return DataTables::of($data)

            ->addIndexColumn()

            ->editColumn('is_read', function ($row) {

                if ($row->is_read) {
                    return '<span class="badge badge-success">Read</span>';
                }

                return '<span class="badge badge-warning">Unread</span>';
            })

            ->editColumn('created_at', function ($row) {

                return $row->created_at
                    ? $row->created_at->format('d M Y h:i A')
                    : '';
            })

            ->addColumn('action', function ($row) {

                return '<a href="' .
                    route('admin.contact.view', $row->id) .
                    '" class="btn btn-primary btn-sm">
                    View
                </a>';
            })

            ->rawColumns([
                'is_read',
                'action'
            ])

            ->make(true);
    }


    public function contact_view($id)
    {
        $contact = Contact::findOrFail($id);

        return view('admin/contact/view', compact('contact'));
    }


    public function contact_read($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->is_read = 1;
        $contact->save();

        return redirect()
            ->route('admin.contact.view', $id)
            ->with('success', 'Message marked as read.');
    }
    public function print_documents()
    {
        return view('admin/print_documents/index');
    }


    public function get_print_documents(Request $request)
    {
        $data = PrintDocument::orderBy('id', 'desc');

        return DataTables::of($data)

            ->addIndexColumn()

            ->editColumn('original_name', function ($row) {

                $fileName = $row->original_name ?? '';

                if ($row->mime_type === 'application/pdf') {

                    return '
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-pdf text-danger mr-2"
                           style="font-size:24px;"></i>
                        <span>' . e($fileName) . '</span>
                    </div>
                ';
                }

                if (str_starts_with($row->mime_type ?? '', 'image/')) {

                    return '
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-image text-primary mr-2"
                           style="font-size:24px;"></i>
                        <span>' . e($fileName) . '</span>
                    </div>
                ';
                }

                return e($fileName);
            })

            ->editColumn('file_size', function ($row) {

                $size = (int) $row->file_size;

                if ($size >= 1024 * 1024) {

                    return number_format(
                        $size / (1024 * 1024),
                        2
                    ) . ' MB';
                }

                if ($size >= 1024) {

                    return number_format(
                        $size / 1024,
                        2
                    ) . ' KB';
                }

                return $size . ' B';
            })

            ->editColumn('status', function ($row) {

                if ($row->status === 'uploaded') {

                    return '
                    <span class="badge badge-success">
                        Uploaded
                    </span>
                ';
                }

                return '
                <span class="badge badge-secondary">
                    ' . e($row->status) . '
                </span>
            ';
            })

            ->editColumn('created_at', function ($row) {

                return $row->created_at
                    ? $row->created_at->format('d M Y H:i')
                    : '';
            })

            ->addColumn('action', function ($row) {

                return '
                <button
                    type="button"
                    class="btn btn-danger btn-sm delete-document"
                    data-id="' . $row->id . '">

                    <i class="bi bi-trash"></i>
                    Delete

                </button>
            ';
            })

            ->rawColumns([
                'original_name',
                'status',
                'action'
            ])

            ->make(true);
    }
    public function delete_print_document($id)
    {
        try {

            $document = PrintDocument::find($id);

            if (!$document) {

                return response()->json([
                    'success' => false,
                    'message' => 'Document not found.'
                ], 404);
            }


            /*
        =====================================================
        DELETE FILE FROM CLOUDFLARE R2
        =====================================================
        */

            if (!empty($document->stored_path)) {

                $urlPath = parse_url(
                    $document->stored_path,
                    PHP_URL_PATH
                );

                $objectKey = ltrim(
                    $urlPath ?? '',
                    '/'
                );


                if (!empty($objectKey)) {

                    Storage::disk('r2')
                        ->delete($objectKey);
                }
            }


            /*
        =====================================================
        DELETE DATABASE RECORD
        =====================================================
        */

            $document->delete();


            return response()->json([
                'success' => true,
                'message' => 'Document deleted successfully.'
            ]);
        } catch (\Exception $e) {

            \Log::error(
                'Print document delete error',
                [
                    'id' => $id,
                    'error' => $e->getMessage()
                ]
            );

            return response()->json([
                'success' => false,
                'message' => 'Unable to delete document.'
            ], 500);
        }
    }
}
