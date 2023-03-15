<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ExchangeRateController extends Controller
{
    public function index()
    {
        return view('admin.exchangeRate');
    }

    public function datagrid()
    {
        $exchangeRates = ExchangeRate::all();
        return response()->json($exchangeRates);
    }

    public function edit($id)
    {
        $exchangeRateDetail = ExchangeRate::find($id);
        return response()->json($exchangeRateDetail);
    }

    public function store(Request $request)
    {
        $exchangeRate = ExchangeRate::where('Id',  $request->Id)->first();

        if ($exchangeRate !== null) {
            ExchangeRate::where('Id', $request->Id)->update([
                'currency_id' => $request->currencyId,
                'exchange' => $request->exchange,
                'exchange_date' => $request->exchangeDate,
                'active' => $request->active,
                'updated_user_id' =>  Auth::user()->Id,
                'updated_date' => Date("Y-m-d H:i:s")
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        } else {
            ExchangeRate::create([
                'currency_id' => $request->currencyId,
                'exchange' => $request->exchange,
                'exchange_date' => $request->exchangeDate,
                'active' => $request->active,
                'created_user_id' =>  Auth::user()->Id,
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {
        $exchangeRateDetail = ExchangeRate::find($request -> Id);
        ExchangeRate::where('Id', $request->Id)->update([
            'active' => !($exchangeRateDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
            'updated_date' => Date("Y-m-d H:i:s")
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function getExchangeRates()
    {
        $date = Date("d-m-Y");
        $response = Http::acceptJson()->get('https://evds2.tcmb.gov.tr/service/evds/series=TP.DK.GBP.A-TP.DK.USD.A-TP.DK.EUR.A&startDate=' . $date . '&endDate=' . $date . '&type=json&key=dTAqyU2i3u');
        return $response;
    }
}
