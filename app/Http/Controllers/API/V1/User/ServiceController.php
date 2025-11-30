<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\API\V1\User\ServiceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct(protected ServiceService $serviceService)
    {
        //
    }

/**
 * Fetch all services.
 *
 * @param Request $request
 * @return mixed
 *
 * @throws Exception
 */
    public function index(Request $request)
    {
        try {
            $services = $this->serviceService->index($request);
            return Helper::jsonResponse(true, 'Services fetched successfully', 200, $services,true);
        } catch (Exception $e) {
            Log::error("ServiceController::index" . $e->getMessage());
            Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

/**
 * Fetch a specific service.
 *
 * @param string $slug
 * @return mixed
 * @throws Exception
 */
    public function show($slug)
    {
        try {
            $service = $this->serviceService->show($slug);
            return Helper::jsonResponse(true, 'Service fetched successfully', 200, $service);
        } catch (Exception $e) {
            Log::error("ServiceController::show" . $e->getMessage());
            return Helper::jsonErrorResponse($e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
