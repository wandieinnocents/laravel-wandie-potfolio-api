<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Helpers\ApiResponseHelper;



class TestimonialApiController extends Controller
{
    //get all testimonials
    public function get_all_testimonials(){

        if(Testimonial::count() > 0){
            $testimonials = Testimonial::orderBy('created_at','desc')->get();
            return ApiResponseHelper::jsonResponse( true, 200, "Testimonials retrieved successfully", $testimonials );
        }  else { 
            return ApiResponseHelper::jsonResponse( false, 404, "No Testimonial Found");
        }

    }

    //store
    public function store_testimonial(StoreTestimonialRequest $request){
        $testimonial = new Testimonial();
        $testimonial->full_name  = $request->full_name;
        $testimonial->company  = $request->company;
        $testimonial->profession  = $request->profession;
        $testimonial->message  = $request->message;
        $testimonial->created_by  = $request->created_by;
        $testimonial->save();

        // response
        return ApiResponseHelper::jsonResponse( true, 200, "Testimonial saved successfully", $testimonial );

    }

    // get single testimonial
    public function show_testimonial($id){
         // find post id
         $testimonial = Testimonial::find($id);
         if($testimonial){
            return ApiResponseHelper::jsonResponse( true, 200, "Testimonial Retrieved Successfully", $testimonial );
         }
         else { 
            return ApiResponseHelper::jsonResponse( false, 404, "Oops, Tesimonial Not Found" );
         }
    }

        //update
        public function update_testimonial(Request $request,$id){

            if(Testimonial::where("id", $id)->exists()){
                $testimonial =  Testimonial::findOrFail($id);
                $testimonial->full_name  = $request->full_name;
                $testimonial->company  = $request->company;
                $testimonial->profession  = $request->profession;
                $testimonial->message  = $request->message;
                $testimonial->created_by  = $request->created_by;
                $testimonial->updated_by  = $request->updated_by;
                $testimonial->save();
                return ApiResponseHelper::jsonResponse( true, 200, "Testimonial updated successfully", $testimonial );

            } else{
                return ApiResponseHelper::jsonResponse( false, 404, "No Testimonial Found To Update" );
            }

        }

        //delete
        public function delete_testimonial($id){

            if(Testimonial::where("id", $id)->exists()){
                $testimonial =  Testimonial::findOrFail($id);
                $testimonial->delete();
                return ApiResponseHelper::jsonResponse( true, 200, "Testimonial deleted successfully", $testimonial );
            } else{
                return ApiResponseHelper::jsonResponse( false, 404, "No Testimonial Found To delete" );
            }

        }


}
