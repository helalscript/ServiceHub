<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactUsPageController extends Controller
{
      public function getHeroSection()
    {
        $data = CMS::where('page', Page::ContactUsPage->value)
            ->where('section', Section::HeroSection->value)
            ->first();
        return view('backend.layouts.cms.contact_us_page.hero_section.create', compact('data'));
    }
    public function updateHeroSection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);
        try {
            // Update logic here
            $data = CMS::where('page', Page::ContactUsPage->value)
                ->where('section', Section::HeroSection->value)
                ->first();

            if ($request->hasFile('image')) {
                if ($data && $data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload(
                    $request->file('image'),
                    'hero_section',
                    time() . '_' . getFileName($request->file('image'))
                );
            }

            CMS::updateOrCreate(
                [
                    'page' => Page::ContactUsPage->value,
                    'section' => Section::HeroSection->value,
                ],
                $validatedData
            );
            return redirect()->route('cms.contact_us_page.hero_section.create')
                ->with('success', 'Banner Section Updated Successfully');
        } catch (Exception $e) {
            Log::error("ContactUsPageController::updateBannerSection " . $e->getMessage());
            return redirect()->route('cms.contact_us_page.hero_section.create')
                ->with('error', 'An error occurred while updating the Banner Section.');
        }
    }

    public function getContactSection()
    {
        $data = CMS::where('page', Page::ContactUsPage->value)
                ->where('section', Section::ContactSection->value)
                ->first();
        return view('backend.layouts.cms.contact_us_page.contact_section.create', compact('data'));
    }
    public function updateContactSection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        try {
            // Update logic here
            CMS::updateOrCreate(
                [
                    'page' => Page::ContactUsPage->value,
                    'section' => Section::ContactSection->value,
                ],
                $validatedData
            );
            return redirect()->route('cms.contact_us_page.contact_section.create')
                ->with('success', 'Contact Section Updated Successfully');
        } catch (Exception $e) {
            Log::error("ContactUsPageController::updateContactSection " . $e->getMessage());
            return redirect()->route('cms.contact_us_page.contact_section.create')
                ->with('error', 'An error occurred while updating the Contact Section.');
        }
    }
}
