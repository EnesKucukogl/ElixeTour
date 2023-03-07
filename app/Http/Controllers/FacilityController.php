<?php

namespace App\Http\Controllers;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FacilityController extends Controller
{
    public function index()
    {
        return view('admin.facility',);
    }

    public function datagrid()
    {
        $facility = Facility::FacilityList();
        return response()->json($facility);
    }

    public function edit($id)
    {
        $facilityDetail = Facility::find($id);
        return response()->json($facilityDetail);
    }

    public function store(Request $request)
    {
        $facility = DB::table('elx_facility')
            ->where("Id", "=", $request->Id)
            ->first();

        if ($facility !== null) {
            try {
                $resultFacility = DB::table('elx_facility')->where('Id', $request->Id)->update(array(
                    'active' => $request->active,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));

                foreach ($request->frmLang as $item) {
                    $queryName= DB::table('vew_language_translation')
                        ->where('text_content_id',$item['text_content_id_facility'])
                        ->where('language_id', $item['language_id'])->first();

                    $queryDesc= DB::table('vew_language_translation')
                        ->where('text_content_id',$item['text_content_id_description'])
                        ->where('language_id', $item['language_id'])->first();

                    if ($item['language_id'] == $this->default_lang) {
                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_facility'])->update(array(
                            'original_text' => $item['translation_facility'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_description'])->update(array(
                            'original_text' => $item['translation_description'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {

                        if ($queryName)
                        {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_facility'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_facility'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        }
                        else
                        {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_facility'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_facility'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }

                        if ($queryDesc)
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
                return $resultFacility ? response()->json(['message' => 'Otel hizmetleri başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Otel hizmetleri güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {
            try {

                foreach ($request->frmLang as $item) {

                    if ($item['id'] == $this->default_lang && isset($item['translation_facility'])&& isset($item['translation_description'])) {
                        $values = array('original_text' => $item['translation_facility'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContent = DB::table('elx_text_content')->insert($values);
                        $textContentLastInsertId = DB::getPdo()->lastInsertId();

                        $values = array('original_text' => $item['translation_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultDescriptionContent = DB::table('elx_text_content')->insert($values);
                        $textDescriptionLastInsertId= DB::getPdo()->lastInsertId();

                        if ($resultTextContent == 1 && $resultDescriptionContent ==1) {

                            $values = array('facility_name_content_id' => $textContentLastInsertId,'description_content_id' => $textDescriptionLastInsertId,  'active' => $request->active, 'created_user_id' => Auth::user()->Id);

                            $resultFacility = DB::table('elx_facility')->insert($values);

                            if (!$resultFacility) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$textDescriptionLastInsertId]);
                            }
                        }

                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_facility']) || !isset($item['translation_description']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    }
                    elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_facility'])) {
                            $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_facility'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        elseif (!isset($item['translation_facility'])) {
                            $values = array('text_content_id' => $textContentLastInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        if (isset($item['translation_description'])) {
                            $values = array('text_content_id' => $textDescriptionLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_description'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }  elseif (!isset($item['translation_description'])) {
                            $values = array('text_content_id' => $textDescriptionLastInsertId, 'language_id' => $item['id'], 'translation_description' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }

                    }
                }
                return $resultFacility ? response()->json(['message' => 'Otel hizmeti başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Otel hizmeti eklenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }


    }

    public function update(Request $request)
    {
        $active = DB::table('elx_facility')->where('Id', $request->Id)->update(array(
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
            'updated_date' => date("Y-m-d H:i:s"),
        ));

        return $active ? response()->json(['message' => 'Kayıt başarıyla güncellenmiştir.']) : response()->json(['message' => 'Kayıt güncellenirken bir hata oluşmuştur.']);

    }
}


