<?php
/**
 * Created by PhpStorm.
 * User: fahrur
 * Date: 15/03/20
 * Time: 9:46
 */

namespace App\Http\Controllers;


use App\Models\Institusi;

class InstitusiController extends Controller
{
    public function index()
    {
        $arrInstitusi = Institusi::orderBy('name', 'asc')->get();
        return response()->json($arrInstitusi, 200);
    }
}