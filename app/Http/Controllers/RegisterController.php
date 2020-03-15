<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 10:49
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function submit()
    {
        $rules = User::getValidationRules();
        $err_messages = [
            'unique' => ':attribute sudah teregistrasi, silahkan ganti dengan nomor hp lain atau reset password jika lupa password.',
        ];
        $req_params = request()->all();
        $validator = Validator::make($req_params, $rules, $err_messages);

        return $this->submitAction($req_params, $validator, function($req_params) {
            $user = new User();
            $user->fill($req_params);
            $user->password = Hash::make($req_params['password']);
            $user->api_token = Str::random(60);
            $user->save();
        });
    }
}