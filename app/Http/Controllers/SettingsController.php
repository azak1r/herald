<?php

namespace nullx27\Herald\Http\Controllers;

use nullx27\Herald\Http\Requests\SettingsFormRequest;
use nullx27\Herald\Models\Setting;
use Illuminate\Http\Request;
use stdClass;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Setting::class);

        $settings = Setting::all();

        $pseudo_settigs = new stdClass();

        foreach($settings as $setting) {
            $pseudo_settigs->{$setting->key} = $setting->value;
        }

        return view('settings.index', ['settings' => $pseudo_settigs]);
    }



    public function update(SettingsFormRequest $request)
    {
        $this->authorize('update', Setting::class);

        foreach($request->validated() as $key => $value) {
            Setting::updateOrCreate(['key' => $key, 'value' => $value]);
        }

        return back();
    }

}
