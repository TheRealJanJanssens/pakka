<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
        //dd( auth()->user() );
    }

    public function index()
    {
        $week = "-";

        $month = "-";


        $bounceRate = "-";



        $avgSessionDuration = "-";

        $analytics = [
            "weekVisits" => $week,
            "monthVisits" => $month,
            "bounceRate" => $bounceRate,
            "avgSessionDuration" => $avgSessionDuration,
        ];

        return view(getAdminView(config('pakka.prefix.admin'). '.dashboard.index'), compact('analytics'));
    }
}
