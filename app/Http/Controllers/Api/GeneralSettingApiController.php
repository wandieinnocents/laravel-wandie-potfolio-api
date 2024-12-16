<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use App\Helpers\ApiResponseHelper;


class GeneralSettingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(GeneralSettings::count() > 0){
            $general_settings = GeneralSettings::orderBy('created_at','desc')->get();
            return ApiResponseHelper::jsonResponse( true, 200, "GeneralSettings retrieved successfully", $general_settings );
        }  else { 
            return ApiResponseHelper::jsonResponse( false, 404, "No GeneralSetting Found");
        }


    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $general_setting = new GeneralSettings();
        $general_setting->phone1  = $request->phone1;
        $general_setting->phone2  = $request->phone2;
        $general_setting->email  = $request->email;
        $general_setting->address  = $request->address;
        $general_setting->google_map_url  = $request->google_map_url;
        $general_setting->copyright_info  = $request->copyright_info;
        $general_setting->created_by  = $request->created_by;
        $general_setting->save();

        // response
        return ApiResponseHelper::jsonResponse( true, 200, "General setting saved successfully", $general_setting );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $general_settings = GeneralSettings::find($id);
        if($general_settings){
           return ApiResponseHelper::jsonResponse( true, 200, "GeneralSettings Retrieved Successfully", $general_settings );
        }
        else { 
           return ApiResponseHelper::jsonResponse( false, 404, "Oops, GeneralSettings Not Found" );
        }
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(GeneralSettings::where("id",$id)->exists()){
            $general_setting =  GeneralSettings::findOrFail($id);
            $general_setting->phone1  = $request->phone1;
            $general_setting->phone2  = $request->phone2;
            $general_setting->email  = $request->email;
            $general_setting->address  = $request->address;
            $general_setting->google_map_url  = $request->google_map_url;
            $general_setting->copyright_info  = $request->copyright_info;
            $general_setting->created_by  = $request->created_by;
            $general_setting->save();
            return ApiResponseHelper::jsonResponse( true, 200, "General Settings updated successfully", $general_setting );


        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No General Settings Found To Update" );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(GeneralSettings::where("id", $id)->exists()){
            $general_setting =  GeneralSettings::findOrFail($id);
            $general_setting->delete();
            return ApiResponseHelper::jsonResponse( true, 200, "General Settings deleted successfully", $general_setting );
        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No General Settings Found To delete" );
        }
    }
}
