<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Session;
use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\MenuItem;
use TheRealJanJanssens\Pakka\Models\Page;
use TheRealJanJanssens\Pakka\Models\Translation;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Session::get('menus');
        if (! checkAccess("permission_edit_app_menu")) {
            unset($menus[1]);
        }

        return view('pakka::admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (checkAccess("permission_add_menus")) {
            return view('pakka::admin.menu.createmenu');
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Menu::rules());

        Menu::create($request->all());
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Menu::findOrFail($id);

        return view('pakka::admin.menu.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Menu::findOrFail($id);
        $items = Menu::latest('updated_at')->get();

        if (checkAccess("permission_add_menus")) {
            return view('pakka::admin.menu.editmenu', compact('item', 'items'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Menu::rules(true, $id));

        $item = Menu::findOrFail($id);

        $item->update($request->all());
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return redirect()->route(config('pakka.prefix.admin').'.menu.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);

        $items = MenuItem::where('menu', $id)->get()->toArray();

        foreach ($items as $item) {
            $transId = $item['name'];
            Translation::where('translation_id', $transId)->delete();
            MenuItem::where('menu', $id)->delete();
        }
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }

    public function sort(Request $request)
    {
        if ($request->isMethod('post')) {
            $items = $request->all();
            $items = json_decode($items['data'], true);

            $query = "";
            foreach ($items as $item) {
                if (empty($item[0]['parent'])) {
                    $item[0]['parent'] = 'NULL';
                }

                MenuItem::find($item[0]['id'])->update(['position' => $item[0]['position'], 'parent' => $item[0]['parent'], 'menu' => $item[0]['menu']]);
            }

            Session::forget('menus');
        }
    }
}
