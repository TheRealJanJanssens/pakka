<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Analytics;
use Illuminate\Support\Facades\Auth;


use Spatie\Analytics\Period;

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
        $week = Analytics::performQuery(Period::days(7), 'ga:sessions');

        if ($week->rows) {
            $week = $week->rows[0][0];
        } else {
            $week = "-";
        }

        $month = Analytics::performQuery(Period::days(28), 'ga:sessions');

        if ($month->rows) {
            $month = $month->rows[0][0];
        } else {
            $month = "-";
        }

        $bounceRate = Analytics::performQuery(Period::days(28), 'ga:bounceRate'); // %

        if ($bounceRate->rows) {
            $bounceRate = round($bounceRate->rows[0][0], 2);
        } else {
            $bounceRate = "-";
        }


        $avgSessionDuration = Analytics::performQuery(Period::days(28), 'ga:avgSessionDuration'); // seconds

        if ($avgSessionDuration->rows) {
            $avgSessionDuration = gmdate("H:i:s", $avgSessionDuration->rows[0][0]);
        } else {
            $avgSessionDuration = "-";
        }

        $analytics = [
            "weekVisits" => $week,
            "monthVisits" => $month,
            "bounceRate" => $bounceRate,
            "avgSessionDuration" => $avgSessionDuration,
        ];

        return view('pakka::admin.dashboard.index', compact('analytics'));
    }
}
