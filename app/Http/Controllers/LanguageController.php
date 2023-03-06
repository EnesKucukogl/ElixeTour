<?php

namespace App\Http\Controllers;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function edit($id)
    {
        $currencyDet = Language::find($id);
        return response()->json($currencyDet);
    }
    public function store(Request $request)
    {
        $currency = Language::where('Id', $request->Id)->first();

        if ($currency !== null) {
            $currency->where('Id', $request->Id)->update([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'active' => $request->active,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        } else {
            Language::create([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'created_user_id' =>  Auth::user()->Id,
            ]);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }
    public function update(Request $request)
    {
        Language::where('Id', $request->Id)->update([
            'active' => $request->active,
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }

    // injection the language into other pages
    public function getLanguage()
    {
        $language = DB::table('elx_language')->select('Id','name AS text','symbol','active')->get();
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
            ->select('id', 'name', 'symbol','active')
            ->where("symbol", "=", $request->symbol)
            ->first();
        return response()->json($result);
    }

}
