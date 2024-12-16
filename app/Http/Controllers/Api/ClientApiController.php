<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Helpers\ApiResponseHelper;
use App\Http\Requests\StoreClientRequest;

class ClientApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('created_at','desc')->get();
        if(count($clients) > 0){
            $clients = Client::orderBy('created_at','desc')->get();
            return ApiResponseHelper::jsonResponse( true, 200, "Clients retrieved successfully", $clients );
        }  else { 
            return ApiResponseHelper::jsonResponse( false, 404, "No Client Found");
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {

        $client = new Client();
        $client->client_name  = $request->client_name;
        $client->created_by  = $request->created_by;

         // photo
         if($request->hasfile('client_photo')){
            $file               = $request->file('client_photo');
            $extension          = $file->getClientOriginalExtension();  //get image extension
            $filename           = time() . '.' .$extension;
            $file->move('uploads/client_photos/',$filename);
            $client->client_photo   = url('uploads' . '/client_photos/'  . $filename);
        }

        else{
            $client->client_photo = '';
        }
        $client->save();
        // response
        return ApiResponseHelper::jsonResponse( true, 200, "Client saved successfully", $client );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // find post id
        $client = Client::find($id);
        if($client){
           return ApiResponseHelper::jsonResponse( true, 200, "Client Retrieved Successfully", $client );
        }
        else { 
           return ApiResponseHelper::jsonResponse( false, 404, "Oops, Client Not Found" );
        }
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(Client::where("id", $id)->exists()){
            $client =  Client::findOrFail($id);
            $client->client_name  = $request->client_name;
            $client->created_by  = $request->created_by;
            $client->updated_by  = $request->updated_by;
    
             // photo
             if($request->hasfile('client_photo')){
                $file               = $request->file('client_photo');
                $extension          = $file->getClientOriginalExtension();  //get image extension
                $filename           = time() . '.' .$extension;
                $file->move('uploads/client_photos/',$filename);
                $client->client_photo   = url('uploads' . '/client_photos/'  . $filename);
            }
    
            else{
                $client->client_photo = '';
            }
            $client->save();
            return ApiResponseHelper::jsonResponse( true, 200, "Client updated successfully", $client );

        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No Client Found To Update" );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Client::where("id", $id)->exists()){
            $client =  Client::findOrFail($id);
            $client->delete();
            return ApiResponseHelper::jsonResponse( true, 200, "Client deleted successfully" );
        } else{
            return ApiResponseHelper::jsonResponse( false, 404, "No Client Found To delete" );
        }
        
    }
}
