<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\User;
use TheRealJanJanssens\Pakka\Models\UserDetail;

class ClientController extends Controller
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
        $items = User::getUsers(1);

        return view(getAdminView(config('pakka.prefix.admin'). '.clients.index'), compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(getAdminView(config('pakka.prefix.admin'). '.clients.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = $request->firstname." ".$request->lastname;
        $request->request->add(['name' => $username, 'role' => 1]);

        //create user
        $this->validate($request, User::rules());
        $user = User::create($request->all());

        //creating user details
        $request->request->add(['user_id' => $user->id]);
        $this->validate($request, UserDetail::rules());
        UserDetail::create($request->all());

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::getUser($id);

        //dd($item);
        return view(getAdminView(config('pakka.prefix.admin'). '.clients.edit'), compact('item'));
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
        $username = $request->firstname." ".$request->lastname;
        $request->request->add(['name' => $username, 'user_id' => $id]);

        //update user
        $this->validate($request, User::rules(true, $id));
        $user = User::findOrFail($id);
        $user->update($request->all());

        //update user details
        $this->validate($request, UserDetail::rules(true, $id));
        $userDetail = UserDetail::updateOrCreate(['user_id' => $id], $request->all());

        return redirect()->route(getAdminView(config('pakka.prefix.admin'). '.clients.index'))->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        UserDetail::where('user_id', $id)->delete();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }

    public function getInfo($id)
    {
        $user = User::getUser($id);

        return json_encode($user);
    }
}
