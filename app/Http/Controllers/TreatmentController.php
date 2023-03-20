<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.treatment');
    }
    public function frontSideTreatment()
    {
        $treatment = Treatment::treatmentListActive();
        $file = File::where("file_type_id","1")->where("cover_image","1")->get();
        return view('treatment', ['treatment' => $treatment,'treatmentFile'=>$file]);
    }
    public function datagrid()
    {
        $menu = Treatment::treatmentList();
        return response()->json($menu);
    }


    public function edit($id)
    {
        $treatmentDetail = Treatment::find($id);
        return response()->json($treatmentDetail);
    }


    public function store(Request $request)
    {
        $treatment = DB::table('elx_treatment')
            ->where("Id", "=", $request->Id)
            ->first();

        if ($treatment !== null) {
            try {

                $resultMenu = DB::table('elx_treatment')->where('Id', $request->Id)->update(array(
                    'active' => $request->active,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));

                foreach ($request->frmLang as $item) {
                    $dataName = DB::Table('vew_language_translation')
                        ->where('text_content_id', $item['text_content_id_treatment'])
                        ->where('language_id', $item['language_id'])
                        ->first();

                    $dataDesc = DB::Table('vew_language_translation')
                        ->where('text_content_id', $item['text_content_id_description'])
                        ->where('language_id', $item['language_id'])
                        ->first();
                    if ($item['language_id'] == $this->default_lang) {

                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_treatment'])->update(array(
                            'original_text' => $item['translation_treatment'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_description'])->update(array(
                            'original_text' => $item['translation_description'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {
                        if ($dataName)
                        {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_treatment'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => $item['translation_treatment'],
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        }
                        else
                        {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_treatment'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_treatment'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }

                        if ($dataDesc)
                        {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_description'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => $item['translation_description'],
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        }
                        else
                        {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_description'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_description'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }
                    }
                }
                return $resultMenu ? response()->json(['message' => 'Tedavi başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Tedavi güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {


            try {

                foreach ($request->frmLang as $item) {

                    /*  $json_str = '[{"translation":"'.$item["translation_package"].'"},{"translation":"'.$item["translation_description"].'"}]';
                      $json_arr = json_decode($json_str, true);
                     var_dump($json_arr);
                      if (is_array($json_arr) || is_object($json_arr)) {
                          foreach ($json_arr as $obj) {
                              $translation = $obj["translation"];
                              echo $translation . "<br>";
                          }
                      }*/

                    if ($item['id'] == $this->default_lang && isset($item['translation_treatment']) && isset($item['translation_description'])) {
                        $values = array('original_text' => $item['translation_treatment'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentTreatment = DB::table('elx_text_content')->insert($values);
                        $textContentLastTreatmentInsertId = DB::getPdo()->lastInsertId();
                        $values = array('original_text' => $item['translation_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentDesc = DB::table('elx_text_content')->insert($values);
                        $textContentLastDescInsertId = DB::getPdo()->lastInsertId();
                        if ($resultTextContentTreatment == 1 && $resultTextContentDesc == 1) {


                            $values = array('treatment_name_content_id' => $textContentLastTreatmentInsertId, 'description_content_id' => $textContentLastDescInsertId,  'active' => $request->active, 'created_user_id' => Auth::user()->Id);
                            $resultMenu = DB::table('elx_treatment')->insert($values);
                            if (!$resultMenu) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastTreatmentInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastDescInsertId]);
                            }


                        }

                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_treatment']) || !isset($item['translation_description']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    } elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_treatment'])) {
                            $values = array('text_content_id' => $textContentLastTreatmentInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_treatment'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        elseif (!isset($item['translation_treatment'])) {
                            $values = array('text_content_id' => $textContentLastTreatmentInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        if (isset($item['translation_description'])) {
                            $values = array('text_content_id' => $textContentLastDescInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_description'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }  elseif (!isset($item['translation_description'])) {
                            $values = array('text_content_id' => $textContentLastDescInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }

                    }


                }
                return $resultMenu ? response()->json(['message' => 'Tedavi başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Tedavi eklenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }


    }

    public function update(Request $request)
    {
        $visible = DB::table('elx_treatment')->where('Id', $request->Id)->update(array(
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
            'updated_date' => date("Y-m-d H:i:s"),
        ));

        return $visible ? response()->json(['message' => 'Kayıt başarıyla güncellenmiştir.']) : response()->json(['message' => 'Kayıt güncellenirken bir hata oluşmuştur.']);

    }
    public function uploadFile(Request $request)
    {

        $request = $request->json()->all();

        $values = array('general_id' => $request['general_id'], 'file_type_id' => $request['file_type_id'], 'cover_image' => $request['cover_image'], 'file_path' => $this->file_path."/".$request['name'], 'tmp_name' => $request['tmp_name'], 'name' => $request['name'], 'created_user_id' => Auth::user()->Id);
        $fileUpload = DB::table('elx_file')->insert($values);

        return $fileUpload ? response()->json(['message' => 'Resim başarıyla eklenmiştir.','type' => 'success']) : response()->json(['message' => 'Resim eklenirken bir hata oluşmuştur.','type' => 'error']);

    }
}
