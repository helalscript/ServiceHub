<?php

namespace App\Http\Controllers\API\V1\CMS;

use App\Http\Controllers\Controller;
use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Models\CMS;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactUsPageController extends Controller
{
    public function getHeroSection()
    {
        try {
            $data = CMS::where('page', Page::ContactUsPage)
                ->where('section', Section::HeroSection)
                ->select('id', 'title', 'image')
                ->where('status', 'active')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("ContactUsPageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getContactSection()
    {
        try {
            $data = CMS::where('page', Page::ContactUsPage)
                ->where('section', Section::ContactSection)
                ->select('id', 'title', 'description')
                ->where('status', 'active')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("ContactUsPageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
}
