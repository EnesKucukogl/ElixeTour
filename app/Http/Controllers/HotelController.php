<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Hotel;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class HotelController extends Controller
{
    public function index()
    {
        return view('admin.hotel');
    }

    public function datagrid()
    {
        $hotels = Hotel::hotelList();
        return response()->json($hotels);
    }

    public function datagridActive()
    {
        $hotels = Hotel::where("active","=","1")->get();
        return response()->json($hotels);
    }

    public function frontSideHotelDetail($slug)
    {
        $hotel = Hotel::hotelSingleSlug($slug);
        $otelFile = File::where("file_type_id", "3")->where("cover_image", "0")->where("general_id", $hotel->Id)->get();
        $hotel_id = $hotel->Id;
        $hotelFacility = Facility::hotelFacilityList($hotel_id);
        return view('hotel-detail', ['hotel' => $hotel,'otelFile' => $otelFile,'hotelFacility'=>$hotelFacility]);
    }

    public function edit($id)
    {
        $hotelDetail = Hotel::find($id);
        return response()->json($hotelDetail);
    }

    public function store(Request $request)
    {
        $hotel = DB::table('elx_hotel')->where('Id',  $request->Id)->first();

        if ($hotel !== null) {
            $slug = SlugService::createSlug(Hotel::class, 'slug',$request->name );
            DB::table('elx_hotel')->where('Id', $request->Id)->update([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'location' => $request->location,
                'slug' =>$slug,
                'highlighted' => $request['highlighted'],
                'updated_user_id' =>  Auth::user()->Id
            ]);
        } else {
            $slug = SlugService::createSlug(Hotel::class, 'slug',$request->name );
            DB::table('elx_hotel')->insert([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'location' => $request->location,
                'slug' =>$slug,
                'highlighted' => $request['highlighted'],
                'created_user_id' =>  Auth::user()->Id,
            ]);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {
        $hotelDetail = DB::table('elx_hotel')->find($request -> Id);
        DB::table('elx_hotel')->where('Id', $request->Id)->update([
            'active' => !($hotelDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
    public function uploadFile(Request $request)
    {

        $request = $request->json()->all();

        $values = array('general_id' => $request['general_id'], 'file_type_id' => $request['file_type_id'], 'cover_image' => $request['cover_image'], 'file_path' => $this->file_path."/".$request['name'], 'tmp_name' => $request['tmp_name'], 'name' => $request['name'], 'created_user_id' => Auth::user()->Id);
        $fileUpload = DB::table('elx_file')->insert($values);

        return $fileUpload ? response()->json(['message' => 'Resim başarıyla eklenmiştir.','type' => 'success']) : response()->json(['message' => 'Resim eklenirken bir hata oluşmuştur.','type' => 'error']);

    }
}
