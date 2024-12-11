<?php

namespace App\Helpers;

class ApiResponseHelper
{
    public static function jsonResponse($success, $statusCode, $message, $data = null)
    {
        $response = [
            "success" => $success,
            "status_code" => $statusCode,
            "message" => $message,
        ];

        if (!is_null($data)) {
            $response["data"] = $data;
        }

        return response()->json($response, $statusCode);
    }
}
