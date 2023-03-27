<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog',);
    }

    public function frontSideBlog()
    {
        $blog = Blog::BlogListActive();
        $file = File::where("file_type_id","4")->where("cover_image","1")->get();
        return view('blog', ['blog' => $blog,'blogFile'=>$file]);
    }

    public function frontSideBlogDetail($slug)
    {
        $blog = Blog::BlogSingleSlug($slug);
        $blogRandom = Blog::blogRandomListActive();
        $blog_file = File::where("file_type_id","4")->where("cover_image","1")->get();
        return view('blogText', ['blog' => $blog,'blogFile'=>$blog_file, 'blogRandom'=>$blogRandom]);
    }

    public function datagrid()
    {
        $blog = Blog::BlogList();
        return response()->json($blog);
    }

    public function edit($id)
    {
        $BlogDetail = Blog::find($id);
        return response()->json($BlogDetail);
    }

    public function store(Request $request)
    {
        $blog = DB::table('elx_blog')
            ->where("Id", "=", $request->Id)
            ->first();

        if ($blog !== null) {
            try {

                foreach ($request->frmLang as $item) {
                    $queryTitle = DB::table('vew_language_translation')
                        ->where('text_content_id', $item['text_content_id_title'])
                        ->where('language_id', $item['language_id'])->first();

                    $queryShortDesc = DB::table('vew_language_translation')
                        ->where('text_content_id', $item['text_content_id_short_description'])
                        ->where('language_id', $item['language_id'])->first();

                    $queryLongDesc = DB::table('vew_language_translation')
                        ->where('text_content_id', $item['text_content_id_description'])
                        ->where('language_id', $item['language_id'])->first();

                    if ($item['language_id'] == $this->default_lang) {
                        $slug = SlugService::createSlug(Blog::class, 'slug', $item['translation_title']);
                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_title'])->update(array(
                            'original_text' => $item['translation_title'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                        // SD
                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_short_description'])->update(array(
                            'original_text' => $item['translation_short_description'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                        DB::Table('elx_text_content')->where('Id', $item['text_content_id_description'])->update(array(
                            'original_text' => $item['translation_description'],
                            'updated_user_id' => Auth::user()->Id,
                            'updated_date' => date("Y-m-d H:i:s"),
                        ));

                    } elseif ($item['language_id'] !== $this->default_lang) {

                        if ($queryTitle) {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_title'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_title'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        } else {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_title'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_title'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }
                        //SD
                        if ($queryShortDesc) {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_short_description'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_short_description'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        } else {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_short_description'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_short_description'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }

                        if ($queryLongDesc) {
                            DB::Table('elx_translation')
                                ->where('text_content_id', $item['text_content_id_description'])
                                ->where('language_id', $item['language_id'])
                                ->update(array(
                                    'translation' => $item['translation_description'],
                                    'updated_user_id' => Auth::user()->Id,
                                    'updated_date' => date("Y-m-d H:i:s"),
                                ));
                        } else {
                            DB::Table('elx_translation')->insert([
                                'text_content_id' => $item['text_content_id_description'],
                                'language_id' => $item['language_id'],
                                'translation' => $item['translation_description'],
                                'created_user_id' => Auth::user()->Id
                            ]);
                        }

                    }
                }
                $resultBlog = DB::table('elx_blog')->where('Id', $request->Id)->update(array(

                    'slug' => $slug,
                    'active' => $request->active,
                    'highlighted' => $request->highlighted,
                    'updated_user_id' => Auth::user()->Id,
                    'updated_date' => date("Y-m-d H:i:s"),
                ));

                return $resultBlog ? response()->json(['message' => 'Blog verileri başarıyla güncellenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Blog verileri güncellenirken bir hata oluştu.', 'type' => 'error']);

            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }
        } else {
            try {

                foreach ($request->frmLang as $item) {

                    if ($item['id'] == $this->default_lang && isset($item['translation_title']) && isset($item['translation_short_description']) && isset($item['translation_description'])) {
                        $slug = SlugService::createSlug(Blog::class, 'slug', $item['translation_title']);
                        $values = array('original_text' => $item['translation_title'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultTitleContent = DB::table('elx_text_content')->insert($values);
                        $TitleContentLastInsertId = DB::getPdo()->lastInsertId();

                        $values = array('original_text' => $item['translation_short_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultShortDescriptionContent = DB::table('elx_text_content')->insert($values);
                        $ShortDescriptionLastInsertId = DB::getPdo()->lastInsertId();

                        $values = array('original_text' => $item['translation_description'], 'language_id' => $this->default_lang, 'created_user_id' => Auth::user()->Id);
                        $resultDescriptionContent = DB::table('elx_text_content')->insert($values);
                        $DescriptionLastInsertId = DB::getPdo()->lastInsertId();

                        if ($resultTitleContent == 1 && $resultDescriptionContent == 1 && $resultShortDescriptionContent == 1) {

                            $values = array('title_content_id' => $TitleContentLastInsertId, 'short_description_content_id' => $ShortDescriptionLastInsertId, 'description_content_id' => $DescriptionLastInsertId, 'slug' => $slug, 'active' => $request->active, 'highlighted' => $request->highlighted, 'created_user_id' => Auth::user()->Id);

                            $resultBlog = DB::table('elx_blog')->insert($values);

                            if (!$resultBlog) {
                                DB::delete('delete from elx_text_content where Id = ?', [$TitleContentLastInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$ShortDescriptionLastInsertId]);
                                DB::delete('delete from elx_text_content where Id = ?', [$DescriptionLastInsertId]);
                            }
                        }

                    } elseif ($item['id'] == $this->default_lang && (!isset($item['translation_title']) || !isset($item['translation_short_description']) || !isset($item['translation_description']))) {
                        return response()->json(['message' => 'Lütfen ingilizce giriniz', 'type' => 'error']);
                    } elseif ($item['id'] !== $this->default_lang) {
                        if (isset($item['translation_title'])) {
                            $values = array('text_content_id' => $TitleContentLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_title'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        } elseif (!isset($item['translation_title'])) {
                            $values = array('text_content_id' => $TitleContentLastInsertId, 'language_id' => $item['id'], 'translation_title' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);
                        }

                        if (isset($item['translation_short_description'])) {
                            $values = array('text_content_id' => $ShortDescriptionLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_short_description'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        } elseif (!isset($item['translation_short_description'])) {
                            $values = array('text_content_id' => $ShortDescriptionLastInsertId, 'language_id' => $item['id'], 'translation_short_description' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }

                        if (isset($item['translation_description'])) {
                            $values = array('text_content_id' => $DescriptionLastInsertId, 'language_id' => $item['id'], 'translation' => $item['translation_description'], 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        } elseif (!isset($item['translation_description'])) {
                            $values = array('text_content_id' => $DescriptionLastInsertId, 'language_id' => $item['id'], 'translation_description' => '', 'created_user_id' => Auth::user()->Id);
                            DB::table('elx_translation')->insert($values);

                        }

                    }
                }
                return $resultBlog ? response()->json(['message' => 'Blog verileri başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Blog verileri eklenirken bir hata oluşmuştur.', 'type' => 'error']);

            } catch (\Exception $e) {

                return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
            }

        }
    }

    public function update(Request $request)
    {
        $active = DB::table('elx_blog')->where('Id', $request->Id)->update(array(
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
            'updated_date' => date("Y-m-d H:i:s"),
        ));

        return $active ? response()->json(['message' => 'Kayıt başarıyla güncellenmiştir.']) : response()->json(['message' => 'Kayıt güncellenirken bir hata oluşmuştur.']);

    }

    public function uploadFile(Request $request)
    {

        $request = $request->json()->all();

        $values = array('general_id' => $request['general_id'], 'file_type_id' => $request['file_type_id'], 'cover_image' => $request['cover_image'], 'file_path' => $this->file_path."/".$request['name'], 'tmp_name' => $request['tmp_name'], 'name' => $request['name'], 'created_user_id' => Auth::user()->Id);
        $fileUpload = DB::table('elx_file')->insert($values);

        return $fileUpload ? response()->json(['message' => 'Resim başarıyla eklenmiştir.','type' => 'success']) : response()->json(['message' => 'Resim eklenirken bir hata oluşmuştur.','type' => 'error']);

    }
}
