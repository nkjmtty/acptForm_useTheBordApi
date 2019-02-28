<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tmpId = Auth::id();
        $tmpUser = Setting::find($tmpId);
        //echo $tmpUser->admin_level;
        if($tmpUser->admin_level >= 5){
            $settings = Setting::all();
            return view('setting/index', compact('settings'));
        }else{
            return $this->detail($tmpId);
        }
        /*
        $myAdminLevel = Auth::id();
        echo $myAdminLevel;
        if($myAdminLevel == 9){
            $settings = Setting::all();
            //print_r($mySetting);
            return view('setting', compact('settings'));
        }else{
            $myId = Auth::id();
            self::show($myId);
        }
        */
    }

    public function show($anId)
    {
        return $this->detail($anId);
    }
    public function edit($anId)
    {
        return $this->detail($anId);
    }
    public function update(SettingRequest $request, $anId)
    {
        $setting = Setting::findOrFail($anId);
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->admin_level = $request->admin_level;
        $setting->board_api_key = $request->board_api_key;
        $setting->board_api_token = $request->board_api_token;
        $setting->board_verified_at = date("Y/m/d H:i:s");
        $setting->save();
        return redirect("setting/");
    }
    public function destroy($anId)
    {
        $setting = Setting::findOrFail($anId);
        $setting->delete();
        return redirect("setting/");
    }
    public function create()
    {
        $setting = new Setting();
        $setting->admin_level = 0;
        return view('setting/create', compact('setting'));
    }
    public function store(SettingRequest $request)
    {
        $setting = new Setting();
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->password = Hash::make($request->password);
        $setting->admin_level = $request->admin_level;
        $setting->email_verified_at = date("Y/m/d H:i:s");
        $setting->save();
        return redirect("setting/");
    }

    private function detail($anId)
    {
        $setting = Setting::find($anId);
        //print_r($setting);
        return view('setting/detail', compact('setting'));
    }
}
