<?php

namespace App\Http\Controllers;

use App\Settings\CaptchaSetting;
use App\Settings\EmailSetting;
use App\Settings\GeneralSettings;
use App\Settings\ThemeSetting;
use Exception;
use Illuminate\Http\Request;
use Storage;

class SettingController extends Controller
{
    public function general(GeneralSettings $setting)
    {
        return view("setting.general", compact("setting"));
    }


    public function general_save(GeneralSettings $setting, Request $request)
    {
        try {
            $data = $request->only([
                'site_name',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'language',
                'default_language',
                'time_zone',
                'date_format',
                'time_format'
            ]);

            $uploadableFields = ['site_logo', 'favicon'];
            foreach ($uploadableFields as $field) {
                if ($request->boolean("remove_{$field}")) {
                    if ($setting->$field)
                        Storage::disk('public')->delete($setting->$field);
                    $data[$field] = null;
                } elseif ($request->hasFile($field)) {
                    if ($setting->$field)
                        Storage::disk('public')->delete($setting->$field);
                    $data[$field] = $request->file($field)->store('settings/general', 'public');
                } else {
                    $data[$field] = $setting->$field;
                }
            }

            $hasChanges = false;
            foreach ($data as $key => $value) {
                if ($setting->$key !== $value) {
                    $setting->$key = $value;
                    $hasChanges = true;
                }
            }

            if ($hasChanges) {
                $setting->save();
                return redirect()->back()->with('success', 'Settings updated successfully!');
            }

            return redirect()->back()->with('error', 'No changes were made.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function theme(ThemeSetting $setting)
    {
        return view("setting.theme", compact("setting"));
    }

    public function theme_save(ThemeSetting $setting, Request $request)
    {
        if ($setting->theme_color == $request->theme_color) {
            return redirect()->back();
        }
        $setting->theme_color = $request->theme_color;
        $setting->save();
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }


    public function captcha(CaptchaSetting $setting)
    {
        return view("setting.captcha", compact("setting"));
    }

    public function captcha_save(CaptchaSetting $setting, Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:on',
            'site_key' => 'required_if:status,on|max:255',
            'site_secret' => 'required_if:status,on|max:255',
        ]);

        $data = $request->only([
            'site_key',
            'site_secret'
        ]);

        $status = $request->status == "on" ? 'on' : 'off';
        $data['status'] = $status;

        $hasChanges = false;

        foreach ($data as $key => $value) {
            if ($setting->$key !== $value) {
                $setting->$key = $value;
                $hasChanges = true;
            }
        }

        if ($hasChanges) {
            $setting->save();
            return redirect()->back()->with('success', 'Settings updated successfully!');

        }

        return redirect()->back()->with('error', 'No changes were made.');
    }

    public function email(EmailSetting $setting)
    {
        return view("setting.email", compact("setting"));
    }

    public function email_save(EmailSetting $setting, Request $request)
    {
        try {
            $data = $request->only([
                'smtp_host',
                'smtp_port',
                'encryption',
                'smtp_username',
                'smtp_password',
                'sender',
                'sender_email'
            ]);

            $hasChanges = false;
            foreach ($data as $key => $value) {
                if ($setting->$key !== $value) {
                    $setting->$key = $value;
                    $hasChanges = true;
                }
            }

            if ($hasChanges) {
                $setting->save();
                return redirect()->back()->with('success', 'Settings updated successfully!');
            }

            return redirect()->back()->with('error', 'No changes were made.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
