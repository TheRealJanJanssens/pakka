<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\Service;
use TheRealJanJanssens\Pakka\Models\ServiceAssignment;
use TheRealJanJanssens\Pakka\Models\Translation;

class ServicesController extends Controller
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
        $services = Service::getServices();

        return view('pakka::admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($result, Service::rules());
        $array = $request->all();
        $result = constructTranslations($request->all());

        $service = Service::create($result);
        if (isset($array['providers'])) {
            ServiceAssignment::storeAssignments($service->id, $array['providers']);
        }

        return redirect()->route(config('pakka.prefix.admin'). '.services.index')->withSuccess(trans('pakka::app.success_store'));
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
        $service = Service::getService($id, 2);

        return view('pakka::admin.services.edit', compact('service'));
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
        //$this->validate($request, Service::rules(true, $id));

        $array = $request->all();
        $service = Service::findOrFail($id);

        //converts lang inputs
        $result = constructTranslations($request->all());
        $service->update($request->all());

        if (isset($array['providers'])) {
            ServiceAssignment::storeAssignments($id, $array['providers']);
        }

        return redirect()->route(config('pakka.prefix.admin'). '.services.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Service::where('id', $id)->get();

        foreach ($items as $item) {
            $transName = $item->name;
            $transDescription = $item->description;

            Translation::where('translation_id', $transName)->delete();
            Translation::where('translation_id', $transDescription)->delete();
        }

        Service::destroy($id);
        //ServiceSchedule::where('Service_id',$id)->delete();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
