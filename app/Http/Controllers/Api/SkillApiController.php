<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponseHelper;
use App\Models\Skill;


class SkillApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Skill::count() > 0){
            $skills = Skill::orderBy('created_at','desc')->get();
            return ApiResponseHelper::jsonResponse( true, 200, "Skills retrieved successfully", $skills );
        }  else { 
            return ApiResponseHelper::jsonResponse( false, 404, "No Skill Found");
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skill = new Skill();
        $skill->skill_name  = $request->skill_name;
        $skill->created_by  = $request->created_by;
        $skill->save();

        // response
        return ApiResponseHelper::jsonResponse( true, 200, "Skill saved successfully", $skill );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skill = Skill::findOrFail($id);
        if($skill){
           return ApiResponseHelper::jsonResponse( true, 200, "Skill Retrieved Successfully", $skill );
        }
        else { 
           return ApiResponseHelper::jsonResponse( false, 404, "Oops, Skill Not Found" );
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Skill::where("id", $id)->exists()){
            $skill =  Skill::findOrFail($id);
            $skill->skill_name  = $request->skill_name;
            $skill->created_by  = $request->created_by;
            $skill->save();

            return ApiResponseHelper::jsonResponse( true, 200, "Skill updated successfully", $skill );
        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No Skill Found To update" );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Skill::where("id", $id)->exists()){
            $skill =  Skill::findOrFail($id);
            $skill->delete();
            return ApiResponseHelper::jsonResponse( true, 200, "Skill deleted successfully", $skill );
        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No Skill Found To delete" );
        }
    }
}
