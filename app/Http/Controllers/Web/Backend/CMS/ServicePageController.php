<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicePageController extends Controller
{
    public function getHeroSection()
    {
        return view('backend.layouts.cms.service_page.hero_section.create');
    }
    public function updateHeroSection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);
        try {
            // Update logic here

            return redirect()->route('cms.service_page.hero_section.create')
                ->with('success', 'Banner Section Updated Successfully');
        } catch (Exception $e) {
            Log::error("ServicePageController::updateBannerSection " . $e->getMessage());
            return redirect()->route('cms.service_page.hero_section.create')
                ->with('error', 'An error occurred while updating the Banner Section.');
        }
    }

    public function getServiceSection()
    {
        return view('backend.layouts.cms.service_page.service_section.create');
    }
    public function updateServiceSection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        try {
            // Update logic here

            return redirect()->route('cms.service_page.service_section.create')
                ->with('success', 'Service Section Updated Successfully');
        } catch (Exception $e) {
            Log::error("ServicePageController::updateServiceSection " . $e->getMessage());
            return redirect()->route('cms.service_page.service_section.create')
                ->with('error', 'An error occurred while updating the Service Section.');
        }
    }
}
