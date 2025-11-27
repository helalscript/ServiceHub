<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Exception;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = Order::with('service')->get();
        // dd($data);
        if ($request->ajax()) {
            $data = Order::with('service')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('thumbnail', function ($data) {
                    return '<img src="' . asset($data->thumbnail ?? '') . '" class="wh-40 rounded-3" alt="no thumbnail found">';
                })
                ->addColumn('service', function ($data) {
                    return $data->service ? $data->service->title : 'N/A';
                })
                ->addColumn('order_at', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
                </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("backend.layouts.orders.index");
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array', // Assuming tags is an array of strings
            'tags.*' => 'string|max:50', // Each tag should be a string
        ]);

        try {
            $data = Service::findOrFail($id);

            if ($request->hasFile('thumbnail')) {
                if (!empty($data->thumbnail)) {
                    Helper::fileDelete(public_path($data->thumbnail));
                }
                $validatedData['thumbnail'] = Helper::fileUpload($request->file('thumbnail'), 'how_it_works_section', time() . '_' . getFileName($request->file('thumbnail')));
            }
            $validatedData['tags'] = $request->input('tags') ? json_encode($request->input('tags')) : null; // Ensure tags is an array, even if empty, and json encode it
            $data->update($validatedData);
            flash()->success('Item updated Successfully');
            return redirect()->route('orders.index');
        } catch (Exception $e) {
            Log::error("AboutPageHowItWorkController::store" . $e->getMessage());
            flash()->error('Item updated Failed');
            return redirect()->route('orders.index');
        }
    }

    public function destroy(string $id)
    {
        $data = Order::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if (!empty($data->image)) {
            Helper::fileDelete(public_path($data->image));
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }

    public function show(string $id)
    {
        $order = Order::with('service')->findOrFail($id);
        return view('backend.layouts.orders.show', compact('order'));
    }
}
