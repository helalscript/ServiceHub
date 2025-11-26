<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Models\CMS;
use Exception;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class HomePageController extends Controller
{
    public function getHeroSection()
    {
        $data = CMS::where('page', Page::HomePage->value)
            ->where('section', Section::HeroSection->value)
            ->first();

        return view('backend.layouts.cms.home_page.hero_section.create', compact('data'));
    }

    public function updateHeroSection(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);
        try {
            $data = CMS::where('page', Page::HomePage->value)
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
                    'page' => Page::HomePage->value,
                    'section' => Section::HeroSection->value,
                ],
                $validatedData
            );

            return redirect()->route('cms.home_page.hero_section.create')
                ->with('success', 'Services Overview Updated Successfully');
        } catch (\Exception $e) {
            Log::error("HomePageController::updateHeroSection " . $e->getMessage());
            return redirect()->route('cms.home_page.hero_section.create')
                ->with('error', 'Services Overview Not Updated');
        }
    }

    // ================= Helper Functions =================
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'tags' => 'nullable|json',
            'button_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|url',
        ]);
    }

    private function handleFileUpload(Request $request, $data, $folder)
    {
        $validatedData = $request->only(['title', 'sub_title', 'description', 'sub_description']);

        if ($request->hasFile('image')) {
            if ($data && $data->image && file_exists(public_path($data->image))) {
                Helper::fileDelete(public_path($data->image));
            }
            $validatedData['image'] = Helper::fileUpload(
                $request->file('image'),
                $folder,
                time() . '_' . getFileName($request->file('image'))
            );
        }

        return $validatedData;
    }

}
