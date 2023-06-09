<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function uploadImage(Request $request){

            $file = $request->file('File');


            $destinationPath = $this->file_path;


            $fileName = time() . '-' . $file->getClientOriginalName();


            $file->move($destinationPath, $fileName);


            return response()->json(['success' => true, 'message' => 'Dosya başarıyla yüklendi!', 'fileName'=>$fileName]);
        }

    public function uploadFile(Request $request){

        $data = array();
        if($request->file('Dosya')) {


            $file = $request->file('Dosya');

            $filename = time().'_'.$file->getClientOriginalName();

            //$extension = $file->getClientOriginalExtension();
            $tmp = $file->getFilename();

            $location = $this->file_path;

            $file->move($location,$filename);

            //$data['tmp'] = $tmp;
            //$data['name'] = $filename;
            $data['url'] = 'http://127.0.0.1:8000/img/elixelogo.png';

        }else{

            $data['imageUrl'] = 'Dosya yüklenememiştir';
        }


        return json_encode($data);
    }

    public function getFileList(Request $request)
    {

        $file = DB::table('elx_file')
            ->where("general_id", "=", $request->id,"and")
            ->where("file_type_id","=",$request->file_type_id)
            ->where("active","=","1")
            ->get();

        return $file;

    }

    public function coverFileCheck(Request $request)
    {

        $fileCheck = DB::table('elx_file')
            ->where("general_id", "=", $request->id,"and")
            ->where("file_type_id","=",$request->file_type_id)
            ->where("active","=","1")
            ->where("cover_image","=","1")
            ->first();

        return $fileCheck;

    }


    public function deleteFile(Request $request)
    {
       $deleteFile =  DB::table('elx_file')->where('Id', $request->Id)->update(array(
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
            'updated_date' => date("Y-m-d H:i:s"),
        ));


        return $deleteFile ? response()->json(['message' => 'Resim başarıyla silinmiştir.','type' => 'success']) : response()->json(['message' => 'Resim silinirken bir hata oluşmuştur.','type' => 'error']);


    }

    public function saveFile(Request $request)
    {

        $request = $request->json()->all();

        $values = array('general_id' => $request['general_id'], 'file_type_id' => $request['file_type_id'], 'cover_image' => $request['cover_image'], 'file_path' => $this->file_path . "/" . $request['name'], 'tmp_name' => $request['tmp_name'], 'name' => $request['name'], 'created_user_id' => Auth::user()->Id);
        $fileUpload = DB::table('elx_file')->insert($values);

        return $fileUpload ? response()->json(['message' => 'Resim başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Resim eklenirken bir hata oluşmuştur.', 'type' => 'error']);

    }

}
