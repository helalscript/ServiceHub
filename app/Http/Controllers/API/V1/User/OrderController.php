<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\API\V1\User\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Pest\Console\Help;

class OrderController extends Controller
{

    public function __construct(private OrderService $orderService)
    {
    }

    public function index(Request $request)
    {
        try {
            $orders = $this->orderService->index($request);
            return Helper::jsonResponse(true, 'Orders retrieved successfully', 200, $orders, true);
        } catch (Exception $e) {
            Log::error("OrderController::index" . $e->getMessage());
            return Helper::jsonErrorResponse('Failed to retrieve orders', 500);
        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|integer',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:255',
        ]);
        try {
            $this->orderService->store($validatedData);
            return Helper::jsonResponse(true, 'Order placed successfully', 200, $validatedData);
        } catch (Exception $e) {
            Log::error("OrderController::store" . $e->getMessage());
            return Helper::jsonErrorResponse('Failed to place order', 500);
        }
    }

    public function show($id)
    {
        try {
            $order = $this->orderService->show($id);
            return Helper::jsonResponse(true, 'Order fetched successfully', 200, $order);
        } catch (Exception $e) {
            Log::error("OrderController::show" . $e->getMessage());
            return Helper::jsonErrorResponse($e->getMessage(), $e->getCode() ?: 500);
        }
    }
    
}
