<?php

namespace App\Http\Controllers;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{

    public function index()
    {
        return view('admin.language',);
    }

    public function datagrid()
    {
        $language = Language::all();
        return response()->json($language);
    }

    public function getLanguage()
    {
        $language = DB::table('elx_language')->select('Id','name AS text','symbol')->get();
        return response()->json($language);
    }

    public function getLanguageEdit(Request $request)
    {
        $result = DB::table('vew_language_translation')
            ->select('text_content_id as text_content_id_'.$request->name, 'translation as translation_'.$request->name, 'symbol', 'language_id')
            ->where('text_content_id', "=", $request->id,)
            ->where("symbol", $request->symbol)
            ->first();
        return response()->json($result);
    }

    public function getLanguageCreate(Request $request)
    {
        $result = DB::table('elx_language')
            ->select('id', 'name', 'symbol')
            ->where("symbol", "=", $request->symbol)
            ->first();
        return response()->json($result);
    }

}
