<?php

namespace App\Http\Controllers;
use App\Models\Settings;

use Illuminate\Http\Request;

class settingsController extends Controller
{
    /**
     * logo show
     *
     * @return void
     */
    public function logoIndex(){
        $logo = Settings::find(1);
        return view('admin.settings.logo.index',[
            'logo'  => $logo,
        ]);
    }
    /**
     *   Logo update
     */
    public function logoUpdate(Request $request){
        $logo = $request -> file('logo');
        $old_logo = $request -> old_logo;
        $logo_width = $request -> logo_width;
        if($request -> hasFile('logo')){
            $logo_name = md5(time().rand()).'.'.$logo -> getClientOriginalExtension();
            $logo -> move(public_path('media/settings/'), $logo_name);
        }else{
            $logo_name = $old_logo;
        }

        $logo_update = Settings::find(1);
        $logo_update -> logo_name = $logo_name;
        $logo_update -> logo_width = $logo_width;
        $logo_update -> update();

        return redirect() -> back() -> with('success', 'Logo Uploded Successfull');
    }

    /**
     * Settings Social update links
     */

     public function socialIndex(){
        $settings = Settings::find(1);
        return view('admin.settings.social.index', compact('settings'));
     }

     public function socialUpdate(Request $request){
        $social_data = [
            'fb'  => $request -> fb,
            'tw'  => $request -> tw,
            'ln'  => $request -> ln,
            'in'  => $request -> in,
            'drb' => $request -> drb,
        ];
        $social_encode = json_encode($social_data);
        $settings = Settings::find(1);

        $settings -> social = $social_encode;
        $settings -> update();

        return redirect() -> back() -> with('success', 'Social Links Uploded Successfull');
     }
}
