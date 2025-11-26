<?php

namespace App\Http\Controllers\API\V1\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\DynamicPage;
use App\Models\Faq;
use App\Models\SystemSetting;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomePageController extends Controller
{


    /**
     * Retrieves the system information, which includes the system name, logo, favicon, copyright text,
     * description, contact number, address, and email.
     *
     * @param Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the system information or an error message.
     */
    public function getSystemInfo(Request $request): JsonResponse
    {
        try {
            $data = SystemSetting::select('id', 'system_name', 'logo', 'favicon', 'copyright_text', 'address', 'company_open_hour', 'description', 'contact_number', 'address', 'email')->first();
            return Helper::jsonResponse(true, 'System data fetched successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getSystemInfo" . $e->getMessage());
            return Helper::jsonErrorResponse('Failed to retrieve System', 403);
        }
    }

    /**
     * Retrieves a paginated list of active dynamic pages.
     *
     * This method fetches dynamic pages that are marked as active, including
     * their ID, title, and slug. If the request contains a 'per_page' parameter,
     * it uses that value for pagination; otherwise, it defaults to 25 items per
     * page. Returns a JSON response with the paginated data or an error message
     * in case of failure.
     *
     * @param Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse A JSON response with the dynamic pages data or an error message.
     */

    public function getDynamicPages(Request $request): JsonResponse
    {
        try {
            // Get 'per_page' from the request or default to 25
            $per_page = $request->has('per_page') ? $request->per_page : 25;
            $dynamicPages = DynamicPage::where('status', 'active')->select('id', 'page_title', 'page_slug')->paginate($per_page);
            if (!$dynamicPages) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }
            return Helper::jsonResponse(true, 'Dynamic pages retrieved successfully.', 200, $dynamicPages, true);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Failed to retrieve Dynamic pages data.', 403);
        }
    }
    /**
     * Retrieves a dynamic page by its slug.
     *
     * This method fetches a dynamic page based on its slug, including the ID,
     * title, slug, content, and status. If the page is not found or is not
     * active, it returns a JSON response with an error message and a status
     * code of 403.
     *
     * @param string $page_slug The slug of the dynamic page to retrieve.
     * @return \Illuminate\Http\JsonResponse A JSON response with the dynamic
     * page data or an error message.
     */
    public function showDaynamicPage($page_slug): JsonResponse
    {
        try {
            $page = DynamicPage::where('page_slug', $page_slug)->where('status', 'active')->firstOrFail();
            if (!$page) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }
            return Helper::jsonResponse(true, 'Dynamic page retrieved successfully.', 200, $page);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Failed to retrieve Dynamic page data.', 403);
        }
    }
    public function getSocialLinks(Request $request): JsonResponse
    {
        try {
            $per_page = $request->has('per_page') ? $request->per_page : 25;
            $data = CMS::select('id', 'title', 'image', 'link_url')->where('page', Page::HomePage)->where('section', Section::SocialLinkContainer)->where('status', 'active')->paginate($per_page);
            return Helper::jsonResponse(true, 'Social links data fatced successfully', 200, $data, true);
        } catch (Exception $e) {
            Log::error("HomePageController::getSocialLinks" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

    public function getHeroSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::HeroSection)
                ->select('id', 'title', 'description', 'button_text', 'image')
                ->where('status', 'active')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

    public function getServiceSection()
    {
        try {
            $section = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::ServicesSection],
                ['status', 'active']
            ])
                ->select('id', 'title', 'sub_title')
                ->first();

            $contents = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::ServicesSectionContent],
                ['status', 'active']
            ])
                ->select('id', 'title', 'description', 'button_text', 'image')
                ->get();

            // Use Laravel Collection to pass data
            $data = collect([
                'id' => $section->id,
                'section_title' => $section->title,
                'title' => $section->sub_title,
                'contents' => $contents,
            ]);

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getFeatureSection - " . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getAboutUsSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::AboutUs)
                ->where('status', 'active')
                ->select('id', 'title', 'sub_title', 'description', 'image')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getQuickRateCheckSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::QuickRateCheck)
                ->where('status', 'active')
                ->select('id', 'title', 'description', 'button_text', 'image')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getHeroSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getWorkProcessSection()
    {
        try {
            $section = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::WorkProcessSection],
                ['status', 'active']
            ])
                ->select('id', 'title', 'sub_title')
                ->first();

            $contents = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::WorkProcessSectionContent],
                ['status', 'active']
            ])
                ->select('id', 'title', 'description', 'image')
                ->get();

            // Use Laravel Collection to pass data
            $data = collect([
                'id' => $section->id,
                'section_title' => $section->title,
                'title' => $section->sub_title,
                'contents' => $contents,
            ]);

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getFeatureSection - " . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

    public function getFaqSection()
    {
        try {
            $section = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::FaqContainer],
                ['status', 'active']
            ])
                ->select('id', 'title', 'sub_title')
                ->first();

            $contents = Faq::where('status', 'active')
                ->select('id', 'question', 'answer')
                ->get();

            // Use Laravel Collection to pass data
            $data = collect([
                'id' => $section->id,
                'section_title' => $section->title,
                'title' => $section->sub_title,
                'contents' => $contents,
            ]);

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getFeatureSection - " . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

    public function getTestimonialSection()
    {
        try {
            $section = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::TestimonialSection],
                ['status', 'active']
            ])
                ->select('id', 'title', 'sub_title')
                ->first();

            $contents = CMS::where([
                ['page', Page::HomePage],
                ['section', Section::TestimonialSectionContent],
                ['status', 'active']
            ])
                ->select('id', 'title', 'description', 'sub_title', 'sub_description', 'image')
                ->get();
            //here title is number of start, sub_title is user name and sub_description is user tagline , image is user photo

            // Use Laravel Collection to pass data
            $data = collect([
                'id' => $section->id,
                'section_title' => $section->title,
                'title' => $section->sub_title,
                'contents' => $contents->map(function ($item) {
                    return [
                        'stars' => $item->title,
                        'name' => $item->sub_title,
                        'tagline' => $item->sub_description,
                        'image' => $item->image
                    ];
                }),
            ]);

            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getFeatureSection - " . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }
    public function getCustomTextSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::CustomText)
                ->where('status', 'active')
                ->select('id', 'description')
                ->first();

            if (!$data) {
                return Helper::jsonResponse(true, 'No data found', 200, []);
            }

            return Helper::jsonResponse(true, 'Data fatced successfully', 200, $data);
        } catch (Exception $e) {
            Log::error("HomePageController::getJobSeekerSection" . $e->getMessage());
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }


}
