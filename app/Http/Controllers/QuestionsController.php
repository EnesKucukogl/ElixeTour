<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.questions');
    }


    public function datagrid()
    {
        $questions = Questions::questionsList();
        return response()->json($questions);
    }



    public function edit($id)
    {
        $questionsDetail = Questions::find($id);
        return response()->json($questionsDetail);
    }



    public function store(Request $request)
    {

        $request = $request->json()->all();

        if (isset($request['Id'])) {
            try {
                foreach ($request['frmLang'] as $item) {
                    if ($item['language_id'] == $this->default_lang) {
//                        $slug = SlugService::createSlug(Questions::class, 'slug', $item['translation_question']);
                        DB::table('elx_text_content')
                            ->where('Id', $item['text_content_id_question'])
                            ->update(array(
                                'original_text' => $item['translation_question'],
                                'updated_user_id' => Auth::user()->Id,
                                'updated_date' => date("Y-m-d H:i:s"),
                            ));

                        DB::table('elx_text_content')->where('Id', $item['text_content_id_answer'])->update(array(
                            'original_text' => $item['translation_answer'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {
                        if ($item['translation_question'] == '') {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_question'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => '',
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        } else {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_question'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_question'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        }

                        if ($item['translation_answer'] == '') {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_answer'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => '',
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        } else {
                            DB::table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_answer'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_answer'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        }

                    }


                }
                $resultQuestions = DB::table('elx_questions')
                    ->where('Id', $request['Id'])
                    ->update(array(
//                        'slug' => $slug,
                        'package_id' => $request['package_id'],
                        'sort_order' => $request['sort_order'],
                        'active' => $request['active'],
                        'updated_user_id' => Auth::user()->Id,
                        'updated_date' => date("Y-m-d H:i:s"),
                    ));
                return $resultQuestions ? response()->json(['message' => 'Başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {
            try {

                foreach ($request['frmLang'] as $item) {

                    if ($item['id'] == $this->default_lang && isset($item['translation_question']) && isset($item['translation_answer'])) {

//                        $slug = SlugService::createSlug(Questions::class, 'slug', $item['translation_question']);

                        $values = array('original_text' => $item['translation_question'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentQue = DB::table('elx_text_content')->insert($values);
                        $textContentLastQueInsertId = DB::getPdo()->lastInsertId();

                        $values = array('original_text' => $item['translation_answer'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTextContentAnswer = DB::table('elx_text_content')->insert($values);
                        $textContentLastAnswerInsertId = DB::getPdo()->lastInsertId();

                        if ($resultTextContentQue == 1 && $resultTextContentAnswer == 1) {


                            $values = array(
//                                'slug'=> $slug,
                                'question_content_id' => $textContentLastQueInsertId,
                                'answer_content_id' => $textContentLastAnswerInsertId,
                                'package_id' => $request['package_id'],
                                'sort_order' => $request['sort_order'],
                                'active' => $request['active'],
                                'created_user_id' => Auth::user()->Id);
                            $resultMenu = DB::table('elx_questions')->insert($values);
                            if (!$resultMenu) {
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastQueInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$textContentLastAnswerInsertId]);
                            }


                        }

                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_question']) || !isset($item['translation_answer']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    }
                    elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_question'])) {
                            $values = array('text_content_id' => $textContentLastQueInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_question'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        elseif (!isset($item['translation_question'])) {
                            $values = array('text_content_id' => $textContentLastQueInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }
                        if (isset($item['translation_answer'])) {
                            $values = array('text_content_id' => $textContentLastAnswerInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_answer'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }  elseif (!isset($item['translation_answer'])) {
                            $values = array('text_content_id' => $textContentLastAnswerInsertId, 'language_id' => $item['id'], 'translation' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }

                    }
                }
                return $resultMenu ? response()->json(['message' => 'Ekleme işlemi başarılı', 'type' => 'success']) : response()->json(['message' => 'Eklenirken hata oluşmuştur', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }


    }

    public function update(Request $request)
    {
        $visible = DB::table('elx_questions')->where('Id', $request->Id)->update(array(
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
            'updated_date' => date("Y-m-d H:i:s"),
        ));

        return $visible ? response()->json(['message' => 'Kayıt başarıyla güncellenmiştir.']) : response()->json(['message' => 'Kayıt güncellenirken bir hata oluşmuştur.']);

    }

}
