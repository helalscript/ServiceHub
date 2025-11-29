<?php

namespace App\Http\Controllers\API\V1\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Support\Facades\Log;

class IntroPageController extends Controller
{
    public function getIntroVideo()
    {
        try {
            $data = CMS::where('page', Page::IntroPage)
                ->where('section', Section::IntroVideo)
                ->select('id', 'image')
                ->where('status', 'active')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }
            $data = [
                'id' => $data->id,
                'video_url' => $data->image ?? '',
            ];
            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getIntroSection()
    {
        try {
            $data = CMS::where('page', Page::IntroPage)
                ->where('section', Section::IntroSection)
                ->select('id', 'title', 'sub_title', 'description', 'button_text', 'image')
                ->where('status', 'active')
                ->first();

            $system = SystemSetting::select('id', 'logo',)->first();
            
            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }
            $data = [
                'id' => $data->id,
                'logo' => $system->logo ?? '',
                'title' => $data->title ?? '',
                'description' => $data->description ?? '',
                'button_text_one' => $data->button_text ?? '',
                'button_text_two' => $data->sub_title ?? '',
                'background_image' => $data->image ?? '',
            ];
            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
}
