<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IntroPageController extends Controller
{
    public function getIntroVedio()
    {
        $data = CMS::where('page', Page::IntroPage->value)
            ->where('section', Section::IntroVideo->value)
            ->first();

        if ($data) {
            return view('backend.layouts.cms.intro_page.intro_video.create', compact('data'));
        }
        return view('backend.layouts.cms.intro_page.intro_video.create');
    }

    public function updateIntroVedio(Request $request)
    {
        // Validation
        $validatedData = $request->validate(
            [
                'image' => 'required|file|mimes:mp4,avi,mov,wmv|max:102400', // max 100MB
            ],
            [
                'image.mimes' => 'The intro video must be a file of type: mp4, avi, mov, wmv.',
                'image.max' => 'The intro video size must not exceed 100MB.',
                'image.required' => 'The intro video field is required.',
                'image.file' => 'The intro video must be a valid file.',
            ]
        );

        try {
            $data = CMS::where('page', Page::IntroPage->value)
                ->where('section', Section::IntroVideo->value)
                ->first();

            if ($request->hasFile('image')) {
                if ($data && $data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload(
                    $request->file('image'),
                    'intro-video',
                    time() . '_' . getFileName($request->file('image'))
                );
            }
            // Update or create intro video link in the database
            // Assuming there's a CMS model to handle this
            CMS::updateOrCreate(
                [
                    'page' => Page::IntroPage->value,
                    'section' => Section::IntroVideo->value,
                ],
                $validatedData
            );

            return redirect()->back()->with('success', 'Intro video link updated successfully.');
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating intro video link: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the intro video link.');
        }
    }

    public function getIntroSection()
    {
        $data = CMS::where('page', Page::IntroPage->value)
            ->where('section', Section::IntroSection->value)
            ->first();

        if ($data) {
            return view('backend.layouts.cms.intro_page.intro_section.create', compact('data'));
        }
        return view('backend.layouts.cms.intro_page.intro_section.create');
    }

    public function updateIntroSection(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // max 5MB
            'button_text' => 'required|string|max:20',
            'sub_title' => 'required|string|max:20', //button_text_two
        ], [
            'image.mimes' => 'The background image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The background image size must not exceed 5MB.',
            'sub_title.required' => 'The button two text field is required.',
            'sub_title.max' => 'The button two text may not be greater than 20 characters.',
        ]);

        try {
            $data = CMS::where('page', Page::IntroPage->value)
                ->where('section', Section::IntroSection->value)
                ->first();

            if ($request->hasFile('image')) {
                if ($data && $data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload(
                    $request->file('image'),
                    'intro-section',
                    time() . '_' . getFileName($request->file('image'))
                );
            }
            // Update or create intro section in the database
            // Assuming there's a CMS model to handle this
            CMS::updateOrCreate(
                [
                    'page' => Page::IntroPage->value,
                    'section' => Section::IntroSection->value,
                ],
                $validatedData
            );
            return redirect()->back()->with('success', 'Intro section updated successfully.');
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating intro section: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the intro section.');
        }
    }
}
