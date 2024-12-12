<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Helpers\ApiResponseHelper;


class FeedbackApiController extends Controller
{
      //get all feedbacks
      public function get_all_feedbacks(){

        if(Feedback::count() > 0){
            $feedbacks = Feedback::orderBy('created_at','desc')->get();
            return ApiResponseHelper::jsonResponse( true, 200, "Feedback retrieved successfully", $feedbacks );
        }  else { 
            return ApiResponseHelper::jsonResponse( false, 404, "No Feedback Found");
        }

    }


    //store feedbacks
    public function store_feedbacks(Request $request){
        $feedback = new Feedback();
        $feedback->first_name  = $request->first_name;
        $feedback->last_name  = $request->last_name;
        $feedback->subject  = $request->subject;
        $feedback->email  = $request->email;
        $feedback->phone  = $request->phone;
        $feedback->message  = $request->message;
        $feedback->created_by  = $request->created_by;
        $feedback->save();

        // response
        return ApiResponseHelper::jsonResponse( true, 200, "Feedback saved successfully", $feedback );

    }

    // show feedback
    public function show_feedback($id){

        $feedback = Feedback::find($id);
        if($feedback){
           return ApiResponseHelper::jsonResponse( true, 200, "Feedback Retrieved Successfully", $feedback );
        }
        else { 
           return ApiResponseHelper::jsonResponse( false, 404, "Oops, Feedback Not Found" );
        }

    }


    //delete
    public function delete_feedback($id){
        if(Feedback::where("id", $id)->exists()){
            $feedback =  Feedback::findOrFail($id);
            $feedback->delete();
            return ApiResponseHelper::jsonResponse( true, 200, "Feedback deleted successfully", $feedback );
        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No Feedback Found To delete" );
        }
    }


}
