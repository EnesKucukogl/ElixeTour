<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\File;
use App\Models\Questions;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;



class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package');
    }

    public function frontSidePackages()
    {
        $package = Package::packageListActive();
        $file = File::where("file_type_id","1")->where("cover_image","1")->get();
        return view('packages', ['package' => $package,'packageFile'=>$file]);
    }

    public function frontSidePackagesDetail($slug)
    {
        $package = Package::packageSingleSlug($slug);
        $questions = Questions::questionsListSlug($slug);
        $package_Id = $package->Id;
        $package_treatment = Treatment::packageTreatmentList($package_Id);
        $package_file = File::where("file_type_id","1")->where("cover_image","1")->get();
        return view('package-detail', ['package' => $package,'package_treatment'=>$package_treatment,'questions'=>$questions,'packageFile'=>$package_file]);
    }

    public function datagrid()
    {
        $package = Package::packageList();
        return response()->json($package);
    }

    public function edit($id)
    {
        $packageDetail = Package::find($id);
        return response()->json($packageDetail);
    }



    public function store(Request $request)
    {

        $request = $request->json()->all();

        if (isset($request['Id'])) {
            try {
                foreach ($request['frmLang'] as $item) {
                    if ($item['language_id'] == $this->default_lang) {
                        $slug = SlugService::createSlug(Package::class, 'slug', $item['translation_package']);
                        DB::table('elx_text_content')
                            ->where('Id', $item['text_content_id_package'])
                            ->update(array(
                            'original_text' => $item['translation_package'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                        DB::table('elx_text_content')->where('Id', $item['text_content_id_description'])->update(array(
                            'original_text' => $item['translation_description'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {
                        if ($item['translation_package'] == '') {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_package'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => '',
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        } else {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_package'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => $item['translation_package'],
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        }

                        if ($item['translation_description'] == '') {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_description'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => '',
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        } else {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_description'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                'translation' => $item['translation_description'],
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));
                        }

                    }


                }
                $resultPackage = DB::table('elx_package')
                    ->where('Id', $request['Id'])
                    ->update(array(
                    'slug' => $slug,
                    'highlighted' => $request['highlighted'],
                    'package_start_date' => $request['package_start_date'],
                    'package_expiry_date' => $request['package_expiry_date'],
                    'duration' => $request['duration'],
                    'cost' => $request['cost'],
                    'cost_currency_id' => $request['cost_currency_id'],
                    'price' => $request['price'],
                    'price_currency_id' => $request['price_currency_id'],
                    'discount_rate' => $request['discount_rate'],
                    'hotel_id' => $request['hotel_id'],
                    'active' => $request['active'],
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));
                return $resultPackage ? response()->json(['message' => 'Paket başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Paket güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {
            try {

                foreach ($request['frmLang'] as $item) {

                    /*  $json_str = '[{"translation":"'.$item["translation_package"].'"},{"translation":"'.$item["translation_description"].'"}]';
                      $json_arr = json_decode($json_str, true);
                     var_dump($json_arr);
                      if (is_array($json_arr) || is_object($json_arr)) {
                          foreach ($json_arr as $obj) {
                              $translation = $obj["translation"];
                              echo $translation . "<br>";
                          }
                      }*/

                    if ($item['id'] == $this->default_lang && isset($item['translation_package']) && isset($item['translation_description'])) {
                        $slug = SlugService::createSlug(Package::class, 'slug', $item['translation_package']);
                        $values = array('original_text' => $item['translation_package'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentPackage = DB::table('elx_text_content')->insert($values);
                        $textContentLastPackageInsertId = DB::getPdo()->lastInsertId();

                        $values = array('original_text' => $item['translation_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentDesc = DB::table('elx_text_content')->insert($values);
                        $textContentLastDescInsertId = DB::getPdo()->lastInsertId();

                        if ($resultTextContentPackage == 1 && $resultTextContentDesc == 1) {


                            $values = array('highlighted' => $request['highlighted'],'slug'=> $slug,'package_name_content_id' => $textContentLastPackageInsertId, 'description_content_id' => $textContentLastDescInsertId, 'cost' => $request['cost'], 'cost_currency_id' => $request['cost_currency_id'], 'price' => $request['price'], 'price_currency_id' => $request['price_currency_id'], 'hotel_id' => $request['hotel_id'], 'duration' => $request['duration'], 'discount_rate' => $request['discount_rate'], 'package_start_date' => $request['package_start_date'], 'package_expiry_date' => $request['package_expiry_date'], 'active' => $request['active'], 'created_user_id' => Auth::user()->Id);
                            $resultMenu = DB::table('elx_package')->insert($values);
                            if (!$resultMenu) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastPackageInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastDescInsertId]);
                            }


                        }

                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_package']) || !isset($item['translation_description']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    }
                    elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_package'])) {
                            $values = array('text_content_id' => $textContentLastPackageInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_package'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        elseif (!isset($item['translation_package'])) {
                            $values = array('text_content_id' => $textContentLastPackageInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
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
                return $resultMenu ? response()->json(['message' => 'Paket başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Paket eklenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }


    }

    public function update(Request $request)
    {
        $visible = DB::table('elx_package')->where('Id', $request->Id)->update(array(
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
