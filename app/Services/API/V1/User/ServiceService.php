<?php

namespace App\Services\API\V1\User;

use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ServiceService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index($request)
    {
        try {
            $per_page = $request->input('per_page', 10);
            $services = Service::where('status', 'active')->paginate($per_page);
            return $services;
        } catch (Exception $e) {
            Log::error("ServiceService::index" . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display a specific resource.
     *
     * @param string $slug
     * @return mixed
     */
    public function show(string $slug)
    {
        try {
            $service = Service::where([
                'status' => 'active',
                'slug' => $slug
            ])
                ->first();
            if (!$service) {
                throw new Exception('Service not found at this time.', 404);
            }
            return $service;
        } catch (Exception $e) {
            Log::error("ServiceService::show" . $e->getMessage());
            throw $e;
        }
    }

}