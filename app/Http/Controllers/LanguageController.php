<?php

namespace App\Http\Controllers;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    public function getLanguage()
    {
        $language = DB::table('elx_language')->select('Id','name AS text','symbol')->get();
        return response()->json($language);
    }

}