<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('admin.menu',);

    }
    public function datagrid()
    {
        $menu = Menu::all();
        return response()->json($menu);
    }

    public function edit($id)
    {
        $menuDetail = Menu::find($id);
        return response()->json($menuDetail);
    }

    public function getLanguageEdit(Request $request)
    {
        $result = DB::table('vew_menu')
            ->select('text_content_id', 'translation', 'symbol','language_id')
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

    public function store(Request $request)
    {


        $menu = DB::table('elx_menu')
                ->where("Id", "=", $request->Id)
            ->first();

        if ($menu !== null) {

            DB::table('elx_menu')->where('Id',$request->Id)->update(array(
                'url' => $request->url,
                'updated_user_id' => Auth::user()->Id,
            ));

            foreach ($request->frmLang as $item)
            {
                if ($item['language_id'] == $this->default_lang ) {

                    DB::table('elx_text_content')->where('Id',$item['text_content_id'])->update(array(
                        'original_text' => $item['translation'],
                        'updated_user_id' => Auth::user()->Id,
                    ));

                }
                elseif ($item['language_id'] !== $this->default_lang) {

                    DB::table('elx_translation')->where('text_content_id',$item['text_content_id'])->where('language_id',$item['language_id'])->update(array(
                        'translation' => $item['translation'],
                        'updated_user_id' => Auth::user()->Id,
                    ));
                }


            }

        }
        else {

            foreach ($request->frmLang as $item) {

                if ($item['id'] == $this->default_lang && isset($item['translation'])) {
                    $values = array('original_text' => $item['translation'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                    $resultTextContent = DB::table('elx_text_content')->insert($values);
                    $textContentLastInsertId = DB::getPdo()->lastInsertId();
                    if ($resultTextContent == 1) {
                        $values = array('upper_menu_id' => 0, 'menu_name_content_id' => $textContentLastInsertId, 'url' => $request->url, 'sort_order' => 4, 'created_user_id' => Auth::user()->Id);
                        $resultMenu = DB::table('elx_menu')->insert($values);
                        if ($resultMenu != 1) {
                            DB::delete('delete from elx_text_content where id = ?', [$textContentLastInsertId]);
                        }

                    }

                }
                elseif($item['id'] == $this->default_lang && !isset($item['translation']))
                {
                    return response()->json(['success' => 'Lütfen ingilizce giriniz']);
                }
                elseif ($item['id'] !== $this->default_lang && isset($item['translation'])) {
                    $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation'], 'created_user_id' => Auth::user()->Id);
                    DB::table('elx_translation')->insert($values);
                }
                elseif ($item['id'] !== $this->default_lang && !isset($item['translation']))
                {
                    $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                    DB::table('elx_translation')->insert($values);

                }

            }

        }


    }

    public function update(Request $request)
    {

        Menu::where('Id', $request->Id)->update([
            'visible' => $request->visible,
            'updated_user_id' => Auth::user()->Id,
        ]);
        return response()->json(['success' => 'Record saved successfully.']);
    }
}
