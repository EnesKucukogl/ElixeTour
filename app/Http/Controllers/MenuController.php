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
        $menu = Menu::menuList();
        return response()->json($menu);
    }

    public function upperMenuGetList()
    {
        $menu = Menu::menuUpperList();
        return response()->json($menu);
    }

    public function edit($id)
    {
        $menuDetail = Menu::find($id);
        return response()->json($menuDetail);
    }



    public function store(Request $request)
    {


        $menu = DB::table('elx_menu')
                ->where("Id", "=", $request->Id)
            ->first();

        if ($menu !== null) {
            try {
                if ($request->upper_menu_content_id) {

                    $menuDetailId = DB::table('elx_menu')
                        ->where("menu_name_content_id", "=", $request->upper_menu_content_id)
                        ->first();
                    $menuDetailId = $menuDetailId->Id;

                } else {

                    $menuDetailId = 0;
                }
                $resultMenu = DB::table('elx_menu')->where('Id', $request->Id)->update(array(
                    'url' => $request->url,
                    'visible' => $request->visible,
                    'sort_order' => $request->sort_order,
                    'upper_menu_id' => $menuDetailId,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));

                foreach ($request->frmLang as $item) {
                    if ($item['language_id'] == $this->default_lang) {

                        DB::table('elx_text_content')->where('Id', $item['text_content_id_menu'])->update(array(
                            'original_text' => $item['translation_menu'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {
                         if($item['translation_menu'] == ''){
                             DB::table('elx_translation')->where('text_content_id', $item['text_content_id_menu'])->where('language_id', $item['language_id'])->update(array(
                                 'translation' => '',
                                 'updated_user_id' => Auth::user()->Id,
                                 'updated_date' => date("Y-m-d H:i:s"),
                             ));
                         }else{
                             DB::table('elx_translation')->where('text_content_id', $item['text_content_id_menu'])->where('language_id', $item['language_id'])->update(array(
                                 'translation' => $item['translation_menu'],
                                 'updated_user_id' => Auth::user()->Id,
                                 'updated_date' => date("Y-m-d H:i:s"),
                             ));
                         }

                    }


                }
                return $resultMenu ? response()->json(['message' => 'Menü başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Menü güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {


            try {

                foreach ($request->frmLang as $item) {

                    if ($item['id'] == $this->default_lang && isset($item['translation_menu'])) {
                        $values = array('original_text' => $item['translation_menu'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContent = DB::table('elx_text_content')->insert($values);
                        $textContentLastInsertId = DB::getPdo()->lastInsertId();
                        if ($resultTextContent == 1) {

                            if ($request->upper_menu_content_id) {

                                $menuDetailId = DB::table('elx_menu')
                                    ->where("menu_name_content_id", "=", $request->upper_menu_content_id)
                                    ->first();
                                $menuDetailId = $menuDetailId->Id;

                            } else {

                                $menuDetailId = 0;
                            }

                            $values = array('upper_menu_id' => $menuDetailId, 'menu_name_content_id' => $textContentLastInsertId, 'url' => $request->url, 'sort_order' => $request->sort_order, 'visible' => $request->visible, 'created_user_id' => Auth::user()->Id);
                            $resultMenu = DB::table('elx_menu')->insert($values);
                            if (!$resultMenu) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastInsertId]);
                            }


                        }

                    } elseif ($item['id'] == $this->default_lang && !isset($item['translation_menu'])) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    } elseif ($item['id'] !== $this->default_lang && isset($item['translation_menu'])) {
                        $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_menu'], 'created_user_id' => Auth::user()->Id);
                        DB::table('elx_translation')->insert($values);
                    } elseif ($item['id'] !== $this->default_lang && !isset($item['translation_menu'])) {
                        $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                        DB::table('elx_translation')->insert($values);

                    }


                }
                return $resultMenu ? response()->json(['message' => 'Menü başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Menü eklenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }


    }

    public function update(Request $request)
    {
        $visible = DB::table('elx_menu')->where('Id', $request->Id)->update(array(
            'visible' => $request->visible,
            'updated_user_id' => Auth::user()->Id,
        ));

        return $visible ? response()->json(['message' => 'Kayıt başarıyla güncellenmiştir.']) : response()->json(['message' => 'Kayıt güncellenirken bir hata oluşmuştur.']);

    }
}
