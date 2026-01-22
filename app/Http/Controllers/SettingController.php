<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use App\Settings\ThemeSetting;
use Illuminate\Http\Request;
use Storage;

class SettingController extends Controller
{
    public function general(GeneralSettings $setting)
    {
        return view("setting.general", compact("setting"));
    }


    public function general_save(GeneralSettings $settings, Request $request)
    {
        $settings->site_name = $request->site_name;
        $settings->meta_title = $request->meta_title;
        $settings->meta_description = $request->meta_description;
        $settings->meta_keywords = $request->meta_keywords;
        if ($request->hasFile("logo")) {
            if ($settings->site_logo) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            $settings->site_logo = $request->file('logo')->store('sitelogo', 'public');
        }
        if ($request->hasFile("favicon")) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $settings->favicon = $request->file('favicon')->store('sitefavicon', 'public');
        }
        $settings->save();


        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function theme(ThemeSetting $setting)
    {
        return view("setting.theme", compact("setting"));
    }

    public function theme_save(ThemeSetting $settings, Request $request)
    {
        $settings->theme_color = $request->theme_color;
        $settings->save();
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
