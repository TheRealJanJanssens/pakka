<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Session;
use TheRealJanJanssens\Pakka\Mails\GeneralMail;
use TheRealJanJanssens\Pakka\Models\Language;

class WebsiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //if no local isset try to get preference lang
        if (Session::get("locale") == null) {
            $lang = null;

            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            }

            $acceptLang = Language::getLangCodes()->toArray();

            if (contains($lang, $acceptLang)) {
                //browser preference language
                $locale = $lang;
            } else {
                //fallback on standard locale if no preference isset or reconized
                $locale = env('APP_LOCALE');
            }

            Session::put('locale', $locale);
            App::setLocale($locale);
        } else {
            foreach (Session::get("lang") as $lang) {
                if ($request->locale == $lang['language_code']) {
                    Session::put('locale', $lang['language_code']);

                    App::setLocale($lang['language_code']);

                    //forgets menu so the new one is loaded in
                    Session::forget('menus');
                }
            }
        }

        constructGlobVars();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageId = $request->route()->action['pageId'];
        $template = getTemplate($request->route()->action['template']);

        if (isset($request->param1)) {
            $param = $request->param1;
        } else {
            $param = null;
        }

        if (isset(auth()->user()->role)) {
            $page = constructPage($pageId, 2, $param); // edit mode
        } else {
            $page = constructPage($pageId, 1, $param); //normal mode
        }

        //if this param isset an item has to be loaded in
        /*
                if(isset($request->param1)){
                    $page['item'] = $param;
                }
        */
        return view($template, compact('page'));
    }

    public function sendMail(Request $request, $ajax = null)
    {
        if ($request->isMethod('post')) {
            $companyName = Session::get('settings')['company_email'];

            $data = $request->all();

            //filters out the set honeypot variables
            foreach ($data as $key => $value) {
                if (contains($key, ['valid_from','my_name'])) {
                    unset($data[$key]);
                }
            }

            $data['replyTo'] = $companyName;

            Mail::to($data['email'])->send(new GeneralMail($data));
            //Mail::to('debug@janjanssens.be')->send(new GeneralMail($data));

            $data['construct_company_mail'] = true;
            $data['replyTo'] = $data['email'];

            Mail::to($companyName)->send(new GeneralMail($data));
            //Mail::to('debug@janjanssens.be')->send(new GeneralMail($data));

            if ($ajax == 1) {
                return 1; //success
            } else {
                $previousUrl = app('url')->previous();

                return redirect()->to($previousUrl.'?'. http_build_query(['message' => 'succes']));
            }
        } else {
            if ($ajax == 1) {
                return 0; //error
            } else {
                return redirect('/');
            }
        }
    }
}
