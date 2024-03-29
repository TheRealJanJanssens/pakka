<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Session;
use TheRealJanJanssens\Pakka\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $settings = config('settings');
        $locale = App::getLocale();

        $values = Setting::getSettings(false, $userId);
        if (isset($values)) {
            //If value is not set it takes the default value set in config
            foreach ($settings as $group) {
                foreach ($group["inputs"] as $setting) {
                    foreach ($values as $key => $value) {
                        if (stripos($setting['name'], $key) !== false) {
                            if (! isset($value) && isset($setting['default']) && ! empty($setting['default'])) {
                                $values[$key] = $setting['default'];
                            }
                        }
                    }
                }
            }
        }

        return view('pakka::admin.settings.index', compact('settings', 'values'));
    }

    public function updateSettings(Request $request)
    {
        $settings = config('settings');
        $inputs = constructTranslations($request->all());

        foreach ($settings as $group) {
            foreach ($group["inputs"] as $setting) {
                foreach ($inputs as $key => $value) {
                    if ($key == $setting['name']) {
                        $fileInputs = ['app_logo','app_cover','app_dashboard_cover'];
                        $transInputs = ['site_title','site_description','site_keywords'];

                        switch (true) {
                            case contains($key, $fileInputs):
                                //handles files
                                $fileName = move_file($value, 'app');
                                Setting::updateOrCreate(['name' => $key], ['value' => $fileName]);

                                break;
                            case $setting['level'] == "personal":
                                //For personal settings
                                Setting::updateOrCreate(['user_id' => auth()->user()->id, 'name' => $key], ['value' => $value]);

                                break;
                            case ! contains($key, $transInputs):
                                //For global settings not using a translation value
                                Setting::updateOrCreate(['name' => $key], ['value' => $value]);

                                break;
                            default:
                                //For global settings with a translation value
                                Setting::updateOrCreate(['name' => $key, 'value' => $value]);
                        }
                    }
                }
            }
        }

        Session::forget('settings');

        return redirect()->route(config('pakka.prefix.admin'). '.settings.index')->withSuccess(trans('pakka::app.success_store'));
    }
}
