<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Session;
use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\MenuItem;
use TheRealJanJanssens\Pakka\Models\Page;
use TheRealJanJanssens\Pakka\Models\Translation;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    public function create()
    {
        if (checkAccess("permission_edit_app_menu")) {
            $menuResults = Menu::get();
        } else {
            $menuResults = Menu::get()->where('id', '!=', 1);
        }


        foreach ($menuResults as $menu) {
            $menus[$menu['id']] = $menu['name'];
        }

        $pages = Page::getPagesLinks();

        return view('pakka::admin.menu_items.create', compact('menus', 'pages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, MenuItem::rules());

        //converts lang inputs
        $result = constructTranslations($request->all());

        $result['position'] = 10;
        if (! $result['permission']) {
            $result['permission'] = 0;
        }

        $menu = MenuItem::create($result);
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_store'));
    }

    public function edit($id)
    {
        $menuResults = Menu::get();

        foreach ($menuResults as $menu) {
            $menus[$menu['id']] = $menu['name'];
        }

        $pages = Page::getPagesLinks();

        $menuItem = MenuItem::findOrFail($id);
//dd($menuItem->translations()->name);
        return view('pakka::admin.menu_items.edit', compact('menus', 'menuItem', 'pages'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, MenuItem::rules(true, $id));
        Session::forget('menus');
        Cache::tags('translations')->flush();
        $item = MenuItem::findOrFail($id);

        //converts lang inputs
        $result = constructTranslations($request->all());

        $item->update($result);
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return redirect()->route(config('pakka.prefix.admin').'.menu.index')->withSuccess(trans('pakka::app.success_update'));
    }

    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id)->toArray();
        $transId = $item['name'];

        MenuItem::destroy($id);

        //only deletes the admin menu translations
        if ($item['menu'] == 1) {
            Translation::where('translation_id', $transId)->delete(); //ALSO deletes page name translation
        }

        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
