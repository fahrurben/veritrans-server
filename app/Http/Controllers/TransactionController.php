<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 17:45
 */

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $arrTransaction = Transaction::where('user_id', $user->id)->orderBy('date', 'desc')->get();
        return response()->json($arrTransaction, 200);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $rules = Transaction::getValidationRules();

        $req_params = request()->all();
        $req_params['user_id'] = $user->id;
        $validator = Validator::make($req_params, $rules);

        return $this->submitAction(
            $req_params,
            $validator,
            function($req_params) use ($user) {
                $trans = new Transaction();
                $trans->fill($req_params);
                $trans->save();
            },
            'Transaksi berhasil disubmit, dan akan segera diverifikasi');
    }
}