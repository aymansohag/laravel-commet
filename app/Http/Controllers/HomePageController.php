<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoomePage;

class HomePageController extends Controller
{
    /**
     * Slider Index method
     */

    public function sliderIndex(){
        $sliders = HoomePage::find(1);
        return view('admin.pages.home.slider.index',[
            'slider'  => $sliders,
        ]);
    }

    /**
     * Home slider request method
     *
     * @param Request $request
     * @return void
     */
    public function homeSliderStore(Request $request){
        $slider_data =  HoomePage::find(1);
        $slider_num = count($request -> subtitle);
        $slider = [];
        for($i = 0; $i < $slider_num; $i++){
            $slide_arr = [
                'slide_code' => $request -> slide_code[$i],
                'subtitle'   => $request -> subtitle[$i],
                'title'      => $request -> title[$i],
                'btn1_title' => $request -> btn1_title[$i],
                'btn1_link'  => $request -> btn1_link[$i],
                'btn2_title' => $request -> btn2_title[$i],
                'btn2_link'  => $request -> btn2_link[$i],
            ];
            array_push($slider, $slide_arr);
        }

        $slider_arr = [
            'svideo'  => $request -> svideo,
            'slider'  => $slider,
        ];

        $slider_json = json_encode($slider_arr);
        $slider_data -> sliders = $slider_json;

        $slider_data -> update();

        return redirect() -> back() -> with('success', 'Slider Added Successfull !');

    }
}
