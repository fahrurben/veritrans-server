<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 12:57
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $req_params = request()->all();

        $rules = [
            'hp' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($req_params, $rules);

        ['hp' => $hp, 'password' => $password] = $req_params;

        if ($validator->fails()) {
            return response()->json(
                $validator->messages(), 500
            );
        } else {
            try {
                $user = User::where('hp', $hp)->first();

                if ($user !== null && Hash::check($password, $user->password)) {
                    return response()->json(
                        ['api_token' => $user->api_token]
                    );
                } else {
                    return response()->json(
                        ['message' => 'Nomor Hp atau Password salah'], 500
                    );
                }

            } catch (\Exception $e) {

                return response()->json(
                    ['message' => $e->getMessage()], 500
                );
            }

            return response()->json(
                ['success' => true]
            );
        }
    }
}