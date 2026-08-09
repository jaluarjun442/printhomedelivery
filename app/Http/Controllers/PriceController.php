<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Store;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PriceController extends Controller
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

    public function index()
    {
        return view('admin/price/index');
    }
    public function get_price(Request $request)
    {
        $data = Price::with('parentPrice');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return "<img src='" . asset('uploads/price') . '/' . $row['image'] . "' style='width:50px; height:50px;' />";
            })
            ->addColumn('parent_price_name', function ($row) {
                return $row->parentPrice ? $row->parentPrice->name : '-';
            })
            ->addColumn('action', function ($row) {
                $btn = "";
                $btn .= '<a href="' . route('admin.edit_price', $row['id']) . '" class="edit mr-2 btn btn-info btn-sm">Edit</a>';
                // $btn .= '<a href="javascript:void(0)" class="edit mr-2 btn btn-warning btn-sm">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function edit_price($price_id)
    {
        $price_data = Price::where('id', $price_id)->first();
        $price = Price::where('id', '!=', $price_id)->get();
        return view('admin/price/edit', compact('price_id', 'price_data', 'price'));
    }
    public function update_price(Request $request)
    {
        $name = $request->post('name');
        $slug = $request->post('slug');
        $status = $request->post('status');
        $amount = $request->post('amount');
        $parent_price_id = $request->post('parent_price_id') ?? null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/price/", $image);
        } else {
            $image = $request->post('old_image');
        }

        $data = Price::where('id', $request->post('id'))
            ->update(
                [
                    'name' => $name,
                    'parent_price_id' => $parent_price_id,
                    'image' => $image,
                    'amount' => $amount,
                    'status' => $status,
                    'slug' => $slug,
                ]
            );
        if ($data) {
            return redirect()->route('admin.price')->with('success', 'Data Added Successfully.');
        }
    }
    public function add_price()
    {
        $price = Price::all();
        return view('admin/price/add', compact('price'));
    }
    public function save_price(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'parent_price_id' => 'nullable|integer', // Assuming parent_price_id is an integer
        ]);
        $name = $request->post('name');
        $amount = $request->post('amount');
        $status = $request->post('status');
        $slug = $request->post('slug');
        $parent_price_id = $request->post('parent_price_id') ?? null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $name . "." . $file->getClientOriginalExtension();
            // $image = $name . rand(1111111111, 9999999999) . "." . $file->getClientOriginalExtension();
            $file->move("uploads/price/", $image);
        } else {
            $image = "";
        }
        $data = Price::create(
            [
                'parent_price_id' => $parent_price_id,
                'name' => $name,
                'image' => $image,
                'amount' => $amount,
                'status' => $status,
                'slug' => $slug,
            ]
        );
        if ($data) {
            return redirect()->route('admin.price')->with('success', 'Data Added Successfully.');
        }
    }
}
