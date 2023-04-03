<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Hotel;
use App\Models\File;
use App\Models\Package;
use App\Models\Treatment;
use App\Models\AccomodationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{

    public function frontSideProcess($package_id, $hotel_id)
    {

        $hotel = Hotel::find($hotel_id);
        $package = Package::find($package_id);
        $packageFile = File::where("file_type_id", "1")->where("cover_image", "1")->get();
        $package_treatment = Treatment::packageTreatmentList($package_id);
        $hotelPackage = Package::hotelPackageList($hotel_id);
        $otelPackageFile = File::where("file_type_id", "1")->where("cover_image", "1")->get();
        $hotelAccomodation = Accomodation::hotelAccomodationList($hotel_id);
        $otelAccomodationFile = File::where("file_type_id", "6")->where("cover_image", "1")->get();
        $hotelAccomodationType = AccomodationType::hotelAccomodationTypeList($hotel_id);
        return view('process', ['hotelAccomodationType'=>$hotelAccomodationType,'otelAccomodationFile'=>$otelAccomodationFile,'hotelAccomodation'=>$hotelAccomodation,'hotelPackage'=>$hotelPackage,'otelPackageFile'=>$otelPackageFile,'hotel' => $hotel, 'package' => $package, 'packageFile' => $packageFile,'package_treatment'=>$package_treatment]);
    }

}
