<?php

namespace App\Services\API\V1\User;

use App\Models\Order;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderService
{

    /**
     * Display a listing of the resource.
     *
     * @param mixed $request
     * @return mixed
     */
    public function index($request)
    {
        try {
            $per_page = $request->input('per_page', 10);
            $orders = Order::where('customer_ip_address', $request->ip())
                ->with('service')
                ->paginate($per_page);
            return $orders;
        } catch (Exception $e) {
            Log::error("OrderService::index" . $e->getMessage());
            throw $e;
        }
    }
    /**
     * Store a new resource.
     *
     * @param array $validatedData
     * @return mixed
     */
    public function store(array $validatedData)
    {
        try {
            $service = $this->getServiceById($validatedData['service_id']);
            $validatedData['customer_ip_address'] = request()->ip(); // Get customer IP address 
            $validatedData['quantity'] = 1; // Default quantity ,in figma design missing
            $validatedData['price'] = $service->price;
            $validatedData['subtotal'] = $service->price;
            $validatedData['tax_percentage'] = $service->tax_percentage;
            $validatedData['shipping_installation_cost'] = $service->shipping_installation_cost;
            $validatedData['total'] = $validatedData['subtotal'] + $service->tax_percentage + $service->shipping_installation_cost;
            $order = Order::create($validatedData);
            return $order;
        } catch (Exception $e) {
            Log::error("OrderService::store" . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display a specific resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        try {
            $order = Order::where('customer_ip_address', request()->ip())
                ->with('service')
                ->find($id);
            if (!$order) {
                throw new Exception("Order not found", 404);
            }
            return $order;

        } catch (Exception $e) {
            Log::error("OrderService::show" . $e->getMessage());
            throw $e;
        }
    }

    private function getServiceById(int $id)
    {
        try {
            $service = Service::where('status', 'active')->find($id);
            if (!$service) {
                throw new Exception("Service not found or inactive", 404);
            }
            return $service;
        } catch (Exception $e) {
            Log::error("OrderService::getServiceById" . $e->getMessage());
            throw $e;
        }
    }



}