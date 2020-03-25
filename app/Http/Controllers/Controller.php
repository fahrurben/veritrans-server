<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function submitAction($req_params, $validator, callable $submitFunction, $successMessage = '')
    {
        if ($validator->fails()) {
            return response()->json(
                $validator->messages(), 500
            );
        } else {
            try {
                $submitFunction($req_params);
            } catch (\Exception $e) {

                return response()->json(
                    ['message' => $e->getMessage()], 500
                );
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => $successMessage,
                ]
            );
        }
    }
}
