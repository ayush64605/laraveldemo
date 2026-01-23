<?php

namespace App\Http\Controllers;

use App\Settings\AnnoucementSetting;
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
        $request->validate([
            "site_name" => "nullable|max:30",
            "time_zone" => "nullable|in:UTC,ITC",
            "date_format" => "nullable|in:Y-m-d,d-m-Y",
            "time_format" => "nullable|in:12 hours,24 hours",
            "language" => "nullable|in:Hindi,English",
            "meta_title" => "nullable|regex:/^[^<>]*$/",
            "meta_description" => "nullable|regex:/^[^<>]*$/",
            "meta_keywords" => "nullable|regex:/^[^<>]*$/",
        ], [
            'regex' => 'The :attribute field cannot contain HTML tags or scripts.'
        ]);

        try {
            $data = $request->only([
                'site_name',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'language',
                'time_zone',
                'date_format',
                'time_format'
            ]);

            $data['site_logo'] = handle_setting_upload($request, $setting, 'site_logo');
            $data['favicon'] = handle_setting_upload($request, $setting, 'favicon');

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

            return redirect()->back();

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

        return redirect()->back();
    }

    public function email(EmailSetting $setting)
    {
        return view("setting.email", compact("setting"));
    }

    public function email_save(EmailSetting $setting, Request $request)
    {
        $request->validate([
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|numeric|between:1,65535',
            'encryption' => 'nullable|string|in:TLS,SSL,starttls',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string',
            'sender' => 'nullable|string|max:255',
            'sender_email' => 'nullable|email|max:255',
        ]);

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

            return redirect()->back();

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function annoucement(AnnoucementSetting $setting)
    {
        return view("setting.annoucement", compact("setting"));
    }

    public function annoucement_save(AnnoucementSetting $setting, Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:on',
            'link' => 'required_if:status,on|url|max:255',
            'link_text' => 'required_if:status,on|string|max:255',
            'msg' => 'required_if:status,on|string|max:1000',
            'bg_color' => 'required_if:status,on|string|max:7',
            'msg_color' => 'required_if:status,on|string|max:7',
            'txt_color' => 'required_if:status,on|string|max:7',
        ]);

        $data = $request->only([
            'link',
            'link_text',
            'msg',
            'bg_color',
            'msg_color',
            'txt_color'
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
            return redirect()->back()->with('success', 'Announcement settings updated successfully!');
        }

        return redirect()->back();
    }

}
