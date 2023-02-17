<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('admin.menu',);

    }
    public function datagrid()
    {
        $menu = Menu::all();
        return response()->json($menu);
    }

    public function edit($id)
    {
        $menuDetail = Menu::find($id);
        return response()->json($menuDetail);
    }

    public function store(Request $request)
    {
        $menu = Menu::where('Id',  $request->Id)->first();

        if ($menu !== null) {
            $menu->where('Id', $request->Id)->update([
                'url' => $request->url,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        } else {
                Menu::create([
                'url' => $request->url,
                'upper_menu_id' => 0,
                'menu_name_content_id' => 1,
                'created_user_id' =>  Auth::user()->Id,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        }


        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {

        Menu::where('Id', $request->Id)->update([
            'visible' => $request->visible,
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }

}
