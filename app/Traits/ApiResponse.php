<?php
    namespace App\Traits;

    trait ApiResponse
    {
        public function successResponse($data, $code = 200, $message = '')
        {
            return response()->json(array(
                'response' => $data,
                'code' => $code,
                'message' => $message
            ), $code);
        }

        public function errorResponse($data, $code = 500, $message = '')
        {
            return response()->json(array(
                'response' => $data,
                'code' => $code,
                'message' => $message
            ), $code);
        }
    }