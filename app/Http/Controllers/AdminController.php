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
}
