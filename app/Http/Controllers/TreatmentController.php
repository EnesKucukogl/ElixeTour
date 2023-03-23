<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;


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


    public function datagrid()
    {
        $menu = Treatment::treatmentList();
        return response()->json($menu);
    }
    public function datagridActive()
    {
        $hotels = Treatment::treatmentListActive();
        return response()->json($hotels);
    }

    public function edit($id)
    {
        $treatmentDetail = Treatment::find($id);
        return response()->json($treatmentDetail);
    }

    public function frontSideTreatmentsDetail($slug)
    {
        $treatment = Treatment::treatmentSingleSlug($slug);
        $treatmentRandom = Treatment::treatmentRandomListActive();
        $treatment_file = File::where("file_type_id", "2")->where("cover_image", "1")->get();
        return view('treatment-detail', ['treatment' => $treatment, 'treatment_file' => $treatment_file, 'treatmentRandom' => $treatmentRandom]);
    }

    public function store(Request $request)
    {
        $lookupController = new LookupController();
        $treatment = DB::table('elx_treatment')
            ->where("Id", "=", $request->Id)
            ->first();

        if ($treatment !== null) {
            try {
                foreach ($request->frmLang as $item) {
                    if ($item['language_id'] == $this->default_lang) {
                        if ($request['highlighted'] == 1) {
                            $slug = SlugService::createSlug(Treatment::class, 'slug', $item['translation_treatment']);
                        } elseif ($request['highlighted'] == 0) {
                            $slug = "";
                        }


                    $lookupController->storeLanguage($item['text_content_id_treatment'],$item['language_id'], $item['translation_treatment']);

                    $lookupController->storeLanguage($item['text_content_id_description'],$item['language_id'], $item['translation_description']);

                    }
                }

                $resultMenu = DB::table('elx_treatment')->where('Id', $request->Id)->update(array(
                    'active' => $request->active,
                    'highlighted' => $request['highlighted'],
                    'slug' => $slug,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));
                return $resultMenu ? response()->json(['message' => 'Tedavi başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Tedavi güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {
            try {
                foreach ($request->frmLang as $item) {
                    if ($item['id'] == $this->default_lang && isset($item['translation_treatment']) && isset($item['translation_description'])) {


                        if($request['highlighted'] == 1) {
                            $slug = SlugService::createSlug(Treatment::class, 'slug', $item['translation_treatment']);
                        } elseif ($request['highlighted'] == 0) {
                            $slug = "";
                        }

                        //Treatment TextContent Insert
                        $values = array('original_text' => $item['translation_treatment'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentTreatment = DB::table('elx_text_content')->insert($values);
                        $textContentLastTreatmentInsertId = DB::getPdo()->lastInsertId();

                        //Treatment Description TextContent Insert
                        $values = array('original_text' => $item['translation_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentDesc = DB::table('elx_text_content')->insert($values);
                        $textContentLastDescInsertId = DB::getPdo()->lastInsertId();

                        //Treatment Insert olmazsa
                        if ($resultTextContentTreatment == 1 && $resultTextContentDesc == 1) {


                            $values = array('highlighted' => $request['highlighted'], 'slug' => $slug, 'treatment_name_content_id' => $textContentLastTreatmentInsertId, 'description_content_id' => $textContentLastDescInsertId, 'active' => $request->active, 'created_user_id' => Auth::user()->Id);
                            $resultTreatment = DB::table('elx_treatment')->insert($values);
                            if (!$resultTreatment) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastTreatmentInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastDescInsertId]);
                            }
                        }
                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_treatment']) || !isset($item['translation_description']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    } elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_treatment'])) {
                            $lookupController->storeLanguage($textContentLastTreatmentInsertId,$item['id'], $item['translation_treatment']);
                        }
                        elseif (!isset($item['translation_treatment'])) {
                            $lookupController->storeLanguage($textContentLastTreatmentInsertId,$item['id'], '');
                        }
                        if (isset($item['translation_description'])) {
                            $lookupController->storeLanguage($textContentLastDescInsertId,$item['id'], $item['translation_description']);
                        }  elseif (!isset($item['translation_description'])) {
                            $lookupController->storeLanguage($textContentLastDescInsertId,$item['id'], '');
                        }
                    }
                }
                return $resultTreatment ? response()->json(['message' => 'Tedavi başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Tedavi eklenirken bir hata oluşmuştur.', 'type' => 'error']);

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

        $values = array('general_id' => $request['general_id'], 'file_type_id' => $request['file_type_id'], 'cover_image' => $request['cover_image'], 'file_path' => $this->file_path . "/" . $request['name'], 'tmp_name' => $request['tmp_name'], 'name' => $request['name'], 'created_user_id' => Auth::user()->Id);
        $fileUpload = DB::table('elx_file')->insert($values);

        return $fileUpload ? response()->json(['message' => 'Resim başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Resim eklenirken bir hata oluşmuştur.', 'type' => 'error']);

    }
}
