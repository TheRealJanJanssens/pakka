<?php

use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeValue;
use TheRealJanJanssens\Pakka\Models\Component;
use TheRealJanJanssens\Pakka\Models\Forms;
use TheRealJanJanssens\Pakka\Models\Item;
use TheRealJanJanssens\Pakka\Models\Language;
use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\MenuItem;
use TheRealJanJanssens\Pakka\Models\Page;
use TheRealJanJanssens\Pakka\Models\Section;
use TheRealJanJanssens\Pakka\Models\Setting;
use TheRealJanJanssens\Pakka\Models\Stock;
use TheRealJanJanssens\Pakka\Models\Translation;
use TheRealJanJanssens\Pakka\Models\Variant;
use TheRealJanJanssens\Pakka\Models\VariantOption;
use TheRealJanJanssens\Pakka\Models\VariantValue;

/*
|--------------------------------------------------------------------------
| Generate string
|--------------------------------------------------------------------------
|
| generates random string
|
| $n = size of random string
|
*/

if (! function_exists('generateString')) {
    function generateString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}

/*
|--------------------------------------------------------------------------
| Contains
|--------------------------------------------------------------------------
|
| Searches if one of the element in $arr is contained in $str
|
| $str = string that has to be checked
| $arr = array that contains all the strings that will check against $str
|
*/
if (! function_exists('contains')) {
    function contains($str, array $arr)
    {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false) {
                return true;
            }
        }

        return false;
    }
}

/*
|--------------------------------------------------------------------------
| Slugify
|--------------------------------------------------------------------------
|
| Slugifies the given string based off the one in Symfony's Jobeet tutorial
|
| $str = string that will be slugified
|
*/
if (! function_exists('slugify')) {
    function slugify($str)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $str);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

if (! function_exists('deslugify')) {
    function deslugify($str)
    {
        // replace non letter or digits by -
        $text = str_replace('-', ' ', $str);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}

if (! function_exists('imgUrl')) {
    function imgUrl($id, $image, $size)
    {
        $publicUrl = config('image.public');

        if (isset($image) || ! empty($image)) {
            $url = $publicUrl.$id."/".$size."/".$image;
        } else {
            $url = config('placeholders.image'); //placeholder
        }

        return $url;
    }
}

if (! function_exists('formatDate')) {
    function formatDate($date, $format = "d-m-Y")
    {
        $date = strtotime($date);
        $result = date($format, $date);

        return $result;
    }
}

if (! function_exists('translateConfigArray')) {
    function translateConfigArray($string)
    {
        $array = config($string);
        if ($array) {
            foreach ($array as $key => $val) {
                $result[$key] = trans($val);
            }

            return $result;
        }
    }
}

if (! function_exists('getAuth')) {
    function getAuth()
    {
        $result = null;
        if (Auth::check()) {
            $user = Auth::user();
            $result = ['id' => $user->id, 'role' => $user->role, 'email' => $user->email];
        } else {
            if (Session::has('auth')) {
                $result = Session::get('auth');
            }
        }

        return $result;
    }
}

if (! function_exists('getAuthRole')) {
    function getAuthRole()
    {
        $auth = getAuth();
        if (! empty($auth)) {
            return $auth['role'];
        } else {
            return 0;
        }
    }
}

if (! function_exists('getRoleName')) {
    function getRoleName($id)
    {
        $roles = array_replace(config('pakka.roles'), config('pakka.adminRoles'));

        return $roles[$id];
    }
}

if (! function_exists('getPackageInfo')) {
    function getPackageInfo($name)
    {
        if (file_exists(base_path('vendor/composer/installed.json'))) {
            $json = json_decode(file_get_contents(base_path('vendor/composer/installed.json')), true);
            $i = array_search($name, array_column($json['packages'], 'name'));
            if ($i == false) {
                return null;
            }

            return $json['packages'][$i];
        } else {
            return null;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Get Base URL
|--------------------------------------------------------------------------
|
| Gets the base url for your app
|
*/
if (! function_exists('getBaseUrl')) {
    function getBaseUrl()
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];

        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);

        // output: localhost
        $hostName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "localhost";
        $serverProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : "http";

        // output: http://
        $protocol = strtolower(substr($serverProtocol, 0, 5)) == 'https' ? 'https' : 'http';
        $baseUrl = $protocol.'://'.$hostName.$pathInfo['dirname']."/";

        //filters out /public/ if in url
        $baseUrl = str_replace('/public/', '/', $baseUrl);

        // return: http://localhost/myproject/
        return $baseUrl;
    }
}

/*
|--------------------------------------------------------------------------
| Construct Module Assets
|--------------------------------------------------------------------------
|
| $array = the array constructed of the menu item
| Constructs all the assets needed which can be used within a module view like id and name
|
*/
if (! function_exists('constructModuleAssets')) {
    function constructModuleAssets($array)
    {
        $id = $array['id'];
        $storedId = Session::get('set_id');
        $route = config('pakka.prefix.admin') . '.' . $array['link'] . '.index';
        if ($array['link'] == 'items') {
            if (Route::currentRouteName() == $route && Route::current()->moduleId == $id) {
                Session::put('module_name', $array['name']);
                Session::put('module', $array['link']);
                Session::put('set_id', $id);
            }
        } else {
            if (Route::currentRouteName() == $route) {
                Session::put('module_name', $array['name']);
                Session::put('module', $array['link']);
                Session::put('set_id', $id);
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Construct Global variables
|--------------------------------------------------------------------------
|
*/

if (! function_exists('constructGlobVars')) {
    function constructGlobVars()
    {
        //redirects to cleaner url with no public in it.
        $baseUrl = getBaseUrl();
        $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
        if (contains($requestUri, ['/public/'])) {
            $redirect = str_replace('/public/', '/', $requestUri);

            header("Location: ".$baseUrl.ltrim($redirect, '/'));
            exit();
        }
        //dd(Session::getId());
        if (Auth::check()) {
            $userId = auth()->user()->id;

            if (Session::get('logged_in') == false) {
                //refreshes session variables when logged in and register it
                Session::forget('settings');
                Session::forget('menus');
                Session::put('logged_in', true);
            }
        } else {
            Session::put('logged_in', false);
        }

        if (! Session::has('lang')) {
            $lang = Language::get()->toArray();
            Session::put('lang', $lang);
        } else {
            $lang = Session::get('lang');
        }

        View::share('lang', $lang);

        if (! Session::has('locale') || Session::get('locale') == null) {
            $locale = App::getLocale();

            if (! $locale) {
                $locale = $lang[0]['language_code'];
                App::setLocale($locale);
            }

            Session::put('locale', $locale);
        } else {
            $locale = Session::get('locale');
        }

        //resets to default local when going back to the adminpanel
        //but don't do this action when store,insert,sort,edit,update,delete
        if (contains($requestUri, ['admin']) && ! contains($requestUri, ['store','insert','sort','edit','update','delete'])) {
            $locale = env('APP_FALLBACK_LOCALE', 'nl');

            Session::put('locale', $locale);
            App::setLocale($locale);

            //resets menu when going to admin panel
            if (Session::get('in_admin') == false) {
                Session::forget('menus');
                Session::forget('settings');
                Session::put('in_admin', true);
            }
        } else {
            Session::put('in_admin', false);
        }

        //get pakka version
        if (! Session::has('pakka_version')) {
            $package = getPackageInfo('therealjanjanssens/pakka');
            Session::put('pakka_version', $package['version'] ?? 'Version unknown');
        }

        if (! Session::has('menus') || empty(Session::get('menus'))) {
            $menus = Menu::constructMenu();
            //View::share('adminMenu', $menus[1]);
            Session::put('menus', $menus);
        }

        //remove settings if translation_ids are cached (it means the settings session was set on the adminpanel with no translations)
        if (Session::has('settings.translation_id')) {
            Session::forget('settings');
        }

        switch (true) {
            case ! Session::has('settings') && isset($userId):
                $settings = Setting::getSettings($locale, $userId);
                Session::put('settings', $settings);

                break;
            case ! Session::has('settings'):
                $settings = Setting::getSettings($locale);
                Session::put('settings', $settings);

                break;
        }

        if (Session::has('settings')) {
            View::share('settings', Session::get('settings'));
        }

        //get and set active module name
        $menus = Session::get('menus');
        $adminMenu = $menus[1];
        foreach ($adminMenu['items'] as $array) {
            constructModuleAssets($array);

            //controls the submenu items
            if (isset($array['items'])) {
                foreach ($array['items'] as $subArray) {
                    constructModuleAssets($subArray);
                }
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Constructs Language Select
|--------------------------------------------------------------------------
|
| Constructs the selection group where you can switch to another language for
| editing translatable inputs. Only visible if there are more then one languages
|
*/

if (! function_exists('constructTransSelect')) {
    function constructTransSelect()
    {
        $lang = Session::get('lang');
        if (count($lang) > 1) {
            ?>
			<div class="bgc-white p-20 mB-40 bd">
				<p><b> <?php echo trans('pakka::app.translation'); ?> :</b></p>
				<div class="list-group list-group-lang">
					<?php
                    $i = 0;

            foreach ($lang as $langItem) {
                if ($i == 0) {
                    $class = 'list-group-head active';
                } else {
                    $class = '';
                } ?>
						<a href="#" class="list-group-item list-group-item-action <?php echo $class; ?>" data-lang="<?php echo $langItem['language_code']; ?>"><?php echo $langItem['name']; ?></a>
						<?php
                        $i++;
            } ?>
				</div>

			</div>
			<?php
        }
    }
}

/*
|--------------------------------------------------------------------------
| Constructs Status Select
|--------------------------------------------------------------------------
|
|
*/

/*
if (! function_exists('constructStatusSelect')) {
    function constructStatusSelect($status) {
        ?>
        <div class="list-group list-group-status">

                <?php
                if(isset($status)){
                    switch($status){
                        case(1):
                            $onlineClass = "active";
                            $offlineClass = "";
                        break;

                        case(0):
                            $onlineClass = "";
                            $offlineClass = "active";
                        break;
                    }
                }else{
                    $onlineClass = "active";
                    $offlineClass = "";
                }
                ?>

                <a href="#" class="list-group-item list-group-item-action list-group-head <?php echo $onlineClass ; ?>" data-status="1"><?php echo trans('pakka::app.online'); ?></a>
                <a href="#" class="list-group-item list-group-item-action <?php echo $offlineClass ; ?>" data-status="0"><?php echo trans('pakka::app.offline'); ?></a>
            </div>

            <input class="status-input" name="status" type="hidden" value="<?php echo $status; ?>">

        <?php

        Form::myInput('hidden', 'status', '', ["class" => "status-input"]);
    }
}
*/

/*
|--------------------------------------------------------------------------
| Get Blade List
|--------------------------------------------------------------------------
|
| Constructs a array from the files within a certain map from resources/views
|
| $name = map name (string)
|
*/

if (! function_exists('getBladeList')) {
    function getBladeList($name, $emptyVal = false)
    {
        $result = [];
        $files = glob(resource_path()."/views/".$name."/*");

        foreach ($files as $file) {
            //Simply print them out onto the screen.

            $file = explode("/", $file);

            if (strpos(end($file), '.') !== false) {
                $file = explode(".", end($file));
                $result[$name.'.'.$file[0]] = $file[0];
            } else {
                $result[$name.'.'.end($file)] = end($file);
            }
        }

        if ($emptyVal == true) {
            array_unshift($result, ''); //puts an empty value in front for when you don't use components
        }

        //fallback if no view templates are set
        if (empty($result)) {
            $result = ["templates.component" => "component"];
        }

        return $result;
    }
}

/*
|--------------------------------------------------------------------------
| Get json
|--------------------------------------------------------------------------
|
| Gets and decodes json from a local file
| $path = file path
|
*/

if (! function_exists('getJson')) {
    function getJson($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}

/*
|--------------------------------------------------------------------------
| Gets component metadata
|--------------------------------------------------------------------------
|
| Gets the metadeta of the given component
|
| $name = component name
| $data = which meta data file you want to get
|
*/

if (! function_exists('getCompMeta')) {
    function getCompMeta($name, $data)
    {
        //Get File if exists in
        $path = resource_path('views/sections/'.$name.'/'.$data.'.json');
        if (file_exists($path)) {
            return getJson($path);
        }

        //Get File if exists in production package
        $path = base_path('vendor/therealjanjanssens/pakka/resources/views/sections/'.$name.'/'.$data.'.json');
        if (file_exists($path)) {
            return getJson($path);
        }

        //Get File if exists in development package
        $path = base_path('package/resources/views/sections/'.$name.'/'.$data.'.json');
        if (file_exists($path)) {
            return getJson($path);
        }
    }
}

/*
|--------------------------------------------------------------------------
| Is Option Input
|--------------------------------------------------------------------------
|
| Checks if given input is a select, radio, checkbox,...
|
| $inputType = input array
|
*/

if (! function_exists('isOptionInput')) {
    function isOptionInput($inputType)
    {
        $types = ["select","checkbox","radio"]; //illegal inputs
        if (contains($inputType, $types)) {
            return true;
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Constructs inputs
|--------------------------------------------------------------------------
|
| Constructs inputs
|
| $inputs = inputs array
| $mode = regular/settings mode (1), items mode (2)
| $trans = if true the labels will get passed through the trans() function
|
*/

if (! function_exists('constructInputs')) {
    function constructInputs($inputs, $mode = 1, $trans = false)
    {
        foreach ($inputs as $input) {
            $lang = Session::get('lang');

            //construct label
            if ($trans == true) {
                $label = trans("pakka::".$input['label']);
            } else {
                $label = $input['label'];
            }

            //construct extra hidden inputs
            $extra = "";
            switch ($mode) {
                case 1:
                    $extra .= Form::myInput('hidden', 'name[]', '', [], $input['name']);

                    break;
                case 2:
                    $extra .= Form::myInput('hidden', 'input_id[]', '', [], $input['input_id']);
                    $extra .= Form::myInput('hidden', 'input_type[]', '', [], $input['type']);

                    break;
            }

            //if options are present construct them
            if (isOptionInput($input['type'])) {
                foreach ($input as $key => $value) {
                    if (strpos($key, 'option') !== false) {
                        $options = $value;
                    }
                }
            } else {
                $options = null;
            }

            switch ($input['type']) {
                case "text":
                    foreach ($lang as $langItem) {
                        echo Form::myInput('text', $input['name'], $label, [], null, $langItem["language_code"]);
                        echo $extra;
                    }

                    break;
                case "textnolang":
                    echo Form::myInput('text', $input['name'], $label);
                    echo $extra;

                    break;
                case "number":
                    echo Form::myInput('number', $input['name'], $label, [], null);
                    echo $extra;

                    break;
                case "textarea":
                    foreach ($lang as $langItem) {
                        echo Form::myTextArea($input['name'], $label, [], null, $langItem["language_code"]);
                        echo $extra;
                    }

                    break;
                case "textareanolang":
                    echo Form::myTextArea($input['name'], $label);
                    echo $extra;

                    break;
                case "select":
                    echo Form::myItemsSelect($input['name'], $label, $options, null, ['class' => 'form-control select2 select-custom-input', 'data-search' => '-1']);
                    echo $extra;

                    break;
                case "checkbox":
                    foreach ($options as $option) {
                        echo Form::myCheckbox($input['name'].'[]', $option['value'], $option['option_id'], null, false);
                    }
                    echo $extra;

                    break;
                case "pageselect":
                    if (! Session::has('pages_select')) {
                        $pages = Page::getPagesLinks();
                        array_unshift($pages, trans('pakka::app.no_page_selected'));
                        Session::put('pages_select', $pages);
                    } else {
                        $pages = Session::get('pages_select');
                    }

                    echo Form::mySelect($input['name'], $label, $pages, null, ['class' => 'form-control select2 select-custom-input', 'data-search' => '-1']);
                    echo $extra;

                    break;
                case "switch":
                    echo Form::mySwitch($input['name'], $label, '', false);
                    echo $extra;

                    break;
                case "color":
                    echo Form::myColorPicker($input['name'], $label);
                    echo $extra;

                    break;
                case "file":
                    echo Form::myFile($input['name'], $label);

                    break;
                case "images":
                    ?>
			        <div class="form-group dropzone-input">
				    	<label for="<?php echo $input['name']."[]"; ?>"><?php echo $label; ?></label>

				    	<?php
                                if (! empty($item['images'])) {
                                    echo '<div id="dropzone__json">';
                                    $imgJSON = [];
                                    $i = 0;
                                    foreach ($item['images'] as $image) {
                                        $imgJSON[$i]["id"] = $itemId;
                                        $imgJSON[$i]["file"] = $image;
                                        $imgJSON[$i]["url"] = imgUrl($itemId, $image, 100);
                                        $i++;
                                    }
                                    echo json_encode($imgJSON);
                                    echo '</div>';
                                }
                    ?>

				       	<div id="dropzone__container" class="dropzone dropzone-previews">

							<div class="fallback">
								<input type="file" name="images[]" required="true" multiple/>
							</div>

							<div class="dz-default dz-message">
								<span>
									<i class="ti-image"></i>Sleep je afbeeldingen hierheen
								</span>
							</div>

							<div id="preview-template" style="display:none">
								<div class="dz-preview dz-file-preview">
									<div class="dz-overlay">
										<img src="/images/app/loading_white.gif" alt="loading" title="loading">
									</div>
									<div class="dz-image">
										<img data-dz-thumbnail />
									</div>

									<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
									<div class="dz-success-mark"><span>✔</span></div>
									<div class="dz-error-mark"><span>✘</span></div>
									<div class="dz-error-message"><span data-dz-errormessage></span></div>
									<div class="dz-edit">
										<a class="dz-rotate" href="javascript:undefined;">
											<i class="ti-back-right"></i>
										</a>
									</div>
								</div>
							</div>

						</div>
			    	</div>
					<?php
                    break;
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Lists existing images
|--------------------------------------------------------------------------
|
| Checks if given input is a select, radio, checkbox,...
|
| $itemId = Given item id (really necessary to defined it out the function? why not in?)
| $item = Item array (values)
| $name = Name of the image field
|
*/

if (! function_exists('listImages')) {
    function listImages($itemId, $item, $name)
    {
        if (! empty($item[$name])) {
            $imgJSON = [];
            $i = 0;
            foreach ($item['images'] as $image) {
                //failsafe to prevent non existing placeholder images in dropzone
                if ($image == null) {
                    break;
                }

                $imgJSON[$i]["id"] = $itemId;
                $imgJSON[$i]["file"] = $image;
                $imgJSON[$i]["url"] = imgUrl($itemId, $image, 100);
                $i++;
            }

            echo "<div id='dropzone__json'>".json_encode($imgJSON)."</div>";
        }
    }
}

/*
|--------------------------------------------------------------------------
| Slug controll
|--------------------------------------------------------------------------
|
|
*/

if (! function_exists('slugControl')) {
    function slugControl($post)
    {
        $slug = "";
        foreach ($post as $key => $item) {
            $illInputs = ["_token","_method","slug","status","input_id","input_type","translation_id","product_id"]; //illegal inputs
            $slugCheck = ["slug"];

            if ($slug == "" && ! contains($key, $illInputs)) {
                $slug = slugify($item);
            }

            if (contains($key, $slugCheck) && (empty($item) || $item = "")) {
                $post[$key] = $slug;
            }
        }

        return $post;
    }
}

/*
|--------------------------------------------------------------------------
| Checks acces
|--------------------------------------------------------------------------
|
| Checks acces to a certain resource
|
| $setting = the setting that could allow the resource to the user
|
*/

if (! function_exists('checkAccess')) {
    function checkAccess($setting = null)
    {
        if (isset(auth()->user()->role)) {
            $settings = Session::get('settings');
            if (! empty($settings) && array_key_exists($setting, $settings)) {
                switch (true) {
                    case auth()->user()->role == 10:
                        return true;

                        break;
                    case auth()->user()->role !== 10 && $settings[$setting] == 1:
                        return true;

                        break;
                    default:
                        return false;

                        break;
                }
            } else {
                if (auth()->user()->role == 10) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Checks edit acces
|--------------------------------------------------------------------------
|
| Checks edit acces
|
|
*/

if (! function_exists('checkEditAcces')) {
    function checkEditAcces()
    {
        if (isset(auth()->user()->role)) {
            if (auth()->user()->role >= 5) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Checks link (probably redundant)
|--------------------------------------------------------------------------
|
| Check if it is a genuine link
|
*/

if (! function_exists('checkLink')) {
    function checkLink($link)
    {
        if (isset($link) && $link !== "#") {
            return true;
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Checks Cookie
|--------------------------------------------------------------------------
|
| Check if cookie isset
|
*/

if (! function_exists('checkCookie')) {
    function checkCookie($string)
    {
        $cookie = Cookie::get($string);
        if ($cookie !== false && $cookie !== null) {
            return true;
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Constructs translation id & mode
|--------------------------------------------------------------------------
|
| Constructs translation id & mode. It outputs an array with trans_id
| & insert_mode keys. This function is only used in other adminpanel functions
|
| table translations or attribute_value
| $transId = insert translation id if exist for item
|
*/

if (! function_exists('constructTransId')) {
    function constructTransId($transId = null)
    {
        if (empty($transId) || ! isset($transId)) {
            $result = generateString(8);
        } else {
            $result = $transId;
        }

        return $result;
    }
}

/*
|--------------------------------------------------------------------------
| Constructs translations
|--------------------------------------------------------------------------
|
| $array = form post array
|
| Constructs, inserts or update the translatable inputs given in a form post.
| Automaticly reconizes translatable inputs and uses the right mode without defining it.
| This function replaces the older constructLangInputs($array, $mode) due to optimalisation reasons.
| Please update if your still using the older function
|
*/

//experimental translate function
function constructTranslations($array)
{
    //BASE VARIABLES
    $itemId = $array['set_id'] ?? $array['id']; //item_id
    $checklist = AttributeInput::getInputsChecklist();
    $langs = Session::get('lang');
    $optionsInputs = ["select", "checkbox","radio"];
    $result = [];
    $iT = 0; //translation_id count (used for debug)
    $iI = 0; //input count. used to keep track of the custom inputs

    //Quickfix for "type" is tried to be translated and therefore deleted in eventual request
    //NEED TO REFACTOR THIS METHOD
    // if(isset($checklist['type'])){
    //     unset($checklist['type']);
    // }

    // if(isset($checklist['label'])){
    //     unset($checklist['label']);
    // }

    foreach ($array as $key => $value) {
        //explodes key to extract name and language
        if (substr($key, 2, 1) === ':') {
            $expKey = explode(":", $key);
            $languageCode = $expKey[0];
            $inputName = $expKey[1];
        } else {
            $languageCode = null;
            $inputName = $key;
        }

        $translationId = isset($array["translation_id"][$inputName]) ? $array["translation_id"][$inputName] : null;
        $inputId = isset($array["input_id"][$iI]) ? $array["input_id"][$iI] : null;
        $inputType = isset($array["input_type"][$iI]) ? $array["input_type"][$iI] : null;

        if (substr($key, 2, 1) === ':' || isset($checklist[$inputName])) {
            $translatable = true;
        } else {
            $translatable = false;
        }

        switch (true) {
            case ! isset($checklist[$inputName]) && $translatable == true:
                /* TRANSLATION STATIC INPUT (INSERT) */
                //check if value is an array. This is used in translatable static table inputs (ex. collection conditions)
                if (is_array($value)) {
                    $vI = 0; // value array counter

                    foreach ($value as $item) {
                        //remove duplicate translation_ids and rekey so its the same format like the loop through the inputs
                        $xI = 0;
                        for ($x = 0; $x < count($translationId); $x++) {
                            if ($xI == 0) {
                                $temp[$x] = $translationId[$x];
                            }
                            $xI++;
                            if ($xI == count($langs)) {
                                $xI = 0;
                            }
                        }
                        $translationId = array_values($temp);

                        $itemTranslationId = constructTransId($translationId[$vI]);

                        //If multiple languages this prevents multiple translation ids for one input key (nl:title,en:title,fr:title -> key = title)
                        if (! isset($result[$inputName][$vI])) {
                            $result[$inputName][$vI] = $itemTranslationId; //stores trans_id per key
                        } else {
                            $itemTranslationId = $result[$inputName][$vI];
                        }

                        $debug['translations'][$iT] = ['mode' => 'static', 'translation_id' => htmlspecialchars($itemTranslationId), 'language_code' => htmlspecialchars($languageCode), 'input_name' => htmlspecialchars($inputName), 'text' => htmlspecialchars(addslashes($item)), '$iV' => $vI];

                        Translation::updateOrCreate(['translation_id' => htmlspecialchars($itemTranslationId), 'language_code' => htmlspecialchars($languageCode), 'input_name' => htmlspecialchars($inputName)], ['text' => htmlspecialchars(addslashes($item))]);
                        $vI++;
                        $iT++;
                    }
                } else {
                    $translationId = constructTransId($translationId);
                    //If multiple languages this prevents multiple translation ids for one input key (nl:title,en:title,fr:title -> key = title)
                    if (! isset($result[$inputName])) {
                        $result[$inputName] = $translationId; //stores trans_id per key
                    } else {
                        $translationId = $result[$inputName];
                    }

                    $debug['translations'][$iT] = ['mode' => 'static', 'translation_id' => htmlspecialchars($translationId), 'language_code' => htmlspecialchars($languageCode), 'input_name' => htmlspecialchars($inputName), 'text' => htmlspecialchars(addslashes($value))];

                    Translation::updateOrCreate(['translation_id' => htmlspecialchars($translationId), 'language_code' => htmlspecialchars($languageCode), 'input_name' => htmlspecialchars($inputName)], ['text' => htmlspecialchars(addslashes($value))]);
                    $iT++;
                }

                break;
            case isset($checklist[$inputName]) && $translationId == null && $translatable == true:
                /* TRANSLATION ATTRIBUTE INPUT */
                switch (true) {
                    case contains($inputType, $optionsInputs): //insert option
                        //dd($value);
                        if (is_array($value)) {
                            // loop through options if multiple are selected (CHECKBOXES)
                            foreach ($value as $option) {
                                AttributeValue::updateOrCreate(['input_id' => htmlspecialchars($inputId), 'item_id' => htmlspecialchars($itemId), 'language_code' => htmlspecialchars($languageCode) ], ['option_id' => htmlspecialchars($option) ]);
                            }
                        } else {
                            AttributeValue::updateOrCreate(['input_id' => htmlspecialchars($inputId), 'item_id' => htmlspecialchars($itemId), 'language_code' => htmlspecialchars($languageCode) ], ['option_id' => htmlspecialchars($value) ]);
                        }

                        break;
                    case ! contains($inputType, $optionsInputs) && $value !== null: //insert value
                        AttributeValue::updateOrCreate(['input_id' => htmlspecialchars($inputId), 'item_id' => htmlspecialchars($itemId), 'language_code' => htmlspecialchars($languageCode) ], ['value' => htmlentities($value) ]);

                        break;
                    case ! contains($inputType, $optionsInputs) && $value == null: //insert value null
                        AttributeValue::updateOrCreate(['input_id' => htmlspecialchars($inputId), 'item_id' => htmlspecialchars($itemId), 'language_code' => htmlspecialchars($languageCode) ], ['value' => null]);

                        break;
                }

                $debug['translations'][$iT] = ['mode' => 'custom', 'input_id' => htmlspecialchars($inputId), 'language_code' => htmlspecialchars($languageCode), 'input_name' => htmlspecialchars($inputName), 'value' => $value];

                $iT++;
                $iI++;

                break;
            default:
                //NON INPUTS (_token,status,...)
                //status is a general input for all items and is set with a hidden input
                $result[$key] = $value;

                break;
        }
    }

    $debug["checklist"] = $checklist;
    $debug["start_array"] = $array;
    $debug["end_array"] = $result;
    //dd($debug);
    return $result;
}

/*
|------------------------------------------------------------------------------------
| Construct translatable array items
|------------------------------------------------------------------------------------
|
| $array = array of items
| $inputs = array of inputs who needs to be translated. Format: array("slug","title","description")
| $ascon = associate construct on or off (example: collection conditions needs a sociate construct to proper function)
|
*/

if (! function_exists('constructTranslatableValues')) {
    function constructTranslatableValues($array, $inputs, $ascon = false)
    {
        $i = 0;

        foreach ($array as $item) {
            if (isset($item['language_code'])) {
                $languageCodes = explode("(~)", $item['language_code']);
            }

            foreach ($item->getAttributes() as $key => $value) {
                //foreach($item as $key => $value){
                $iI = 0;
                switch (true) {
                    case in_array($key, $inputs) && isset($languageCodes):
                        //Translatable Value
                        $options = explode("(~)", $value);

                        foreach ($languageCodes as $languageCode) {
                            $result[$i]['translation_id'][$key] = $array[$i][$key.'_trans'];
                            $result[$i][$languageCode.':'.$key] = $options[$iI];
                            $iI++;
                        }

                        unset($array[$i][$key.'_trans']);
                        unset($array[$i][$key]);

                        break;
                    case in_array($key, $inputs):
                        //Translatable Value with no translations present so use available value and set as with default language
                        //(Happens mainly when editing inputs and their labels)
                        $result[$i][Session::get('lang.0.language_code').':'.$key] = $value;
                        unset($array[$i][$key.'_trans']);

                        break;
                    default:
                        // Regular Value
                        $result[$i][$key] = $value;

                        break;
                }
            }
            $i++;
        }

        if (isset($result)) {
            //removes associate construct if it is a single result
            if (count($result) == 1 && $ascon == false) {
                $result = $result[0];
            }

            return $result;
        } else {
            return null;
        }
    }
}

/*
|------------------------------------------------------------------------------------
| Construct the attributes (and images) of items
|------------------------------------------------------------------------------------
|
| $items = array of items
| $mode = construct attributes for display (1) or edit (2) purpose
|
*/

// if (! function_exists('constructAttributes')) {
// 	function constructAttributes($items,$mode = 1){
// 		$items->map(function ($item, $mode) {

// 			dd($item);

// 			if(isset($item->images)){
// 				//CONSTRUCT IMAGES
// 				if($item['images'] !== null){
// 					$images = explode("(~)", $item['images']);
// 					$item["images"] = $images;
// 				}else{
// 					//fixes PHP Laravel Error: Trying to access array offset on value of type null introduced in php 7.4. This fix doesn't throw an error but is not a clean solution. This same fixed is not made within mode 2 because it will display an image in the dropzone editor that is not present.
// 					$item['images'][0] = null;
// 				}
// 			}

// 			$item[$key] = $val;
// 			$item["attributes"][$key] = $val; //gets used in product sections

// 			dd($item);

// 			return $item;
// 		});
// 	}
// }

if (! function_exists('constructAttributes')) {
    function constructAttributes($items, $mode = 1)
    {
        $i = 0;
        foreach ($items as $item) {
            //CONSTRUCT IMAGES
            $images = [0 => null]; //fixes PHP Laravel Error: Trying to access array offset on value of type null introduced in php 7.4. This fix doesn't throw an error but is not a clean solution. This same fixed is not made within mode 2 because it will display an image in the dropzone editor that is not present.
            if (isset($item->images) && ! empty($item->images)) {
                $images = explode("(~)", $item['images']);
            }
            $items[$i]->setAttribute("images", $images);

            if (isset($item->attributes)) {
                $attributes = explode("(~)", $item['attributes']);
                unset($items[$i]["attributes"]);

                switch ($mode) {
                    case 1:
                        //CONSTRUCT ATTRIBUTES
                        if (! empty($attributes[0]) && $attributes[0] !== null) {
                            $iA = 0; // general attribute int
                            foreach ($attributes as $attribute) {
                                $attribute = explode("(:)", $attribute);
                                if (isset($attribute[1])) {
                                    $key = $attribute[0];
                                    $val = $attribute[1];
                                    $items[$i]->setAttribute($key, $val);

                                    $getAttr = [];
                                    if ($items[$i]->getAttribute("attributes")) {
                                        $getAttr = $items[$i]->getAttribute("attributes");
                                    }

                                    $items[$i]->setAttribute("attributes", array_merge($getAttr, [$key => $val])); //gets used in product sections
                                }

                                $iA++;
                            }
                        }

                        break;
                    case 2:
                        //CONSTRUCT SLUG
                        if (isset($item['slug']) && ! empty($item['slug']) && isset($items[$i]['translation_id_slug'])) {
                            $langs = Session::get('lang');

                            $slugs = explode("(~)", $item['slug']);
                            $iS = 0;

                            foreach ($langs as $lang) {
                                //SAFETY INCASE OF NEW LANGUAGES
                                if (! isset($slugs[$iS])) {
                                    $slugs[$iS] = null;
                                }

                                $items[$i][$lang["language_code"].":slug:translation_id"] = $items[$i]['translation_id_slug'];
                                $items[$i][$lang["language_code"].":slug"] = $slugs[$iS];
                                $iS++;
                            }
                            unset($items[$i]['translation_id_slug']);
                        }

                        //CONSTRUCT ATTRIBUTES
                        if (! empty($attributes[0])) {
                            $iA = 0; // general attribute int
                            foreach ($attributes as $attribute) {
                                $attribute = explode("(:)", $attribute);

                                //Revision: isset($attribute[2]) on 1281 and !empty($key) 1291
                                //These exists because a currently unknown bug where attributes sometime exist without a key or a language code

                                //if lang code is empty remove and reset the array
                                if (empty($attribute[0]) && isset($attribute[2])) {
                                    unset($attribute[0]);
                                    $attribute = array_values($attribute);
                                }

                                //if attribute[2] exists it's a translatable attribute
                                $key = (isset($attribute[2])) ? $attribute[0].':'.$attribute[1] : $attribute[0];
                                $val = (isset($attribute[2])) ? $attribute[2] : $attribute[1];

                                //if value isset or key doesn't exists (to prevent duplicate empty attributes overwriting the true values)
                                if (! empty($key) && (! empty($val) || ! isset($items[$i][$key]))) {
                                    $items[$i][$key] = $val;
                                }
                            }

                            unset($items[$i]["attributes"]);
                        }

                        break;
                }
            }
            $i++;
        }

        return $items;
    }
}

/*
|------------------------------------------------------------------------------------
| Constructs all variant of Products
|
| $id = product id
| $array = complete product array
|------------------------------------------------------------------------------------
*/

function constructVariants($id, $array)
{
    $iV = 0; //incr variants
    $iS = 0; //incr stocks
    //dd($array);
    $variants = $array['variants'];
    $variant_ids = $variants['variant_ids'];
    $variant_values = $variants['variant_values'];
    $option_ids = $variants['option_ids'];
    $option_values = $variants['option_values'];
    $insert['product_id'] = $id;

    if ($array['remove_variants'] == 1) {
        Stock::where('product_id', $id)->delete();
        Variant::where('product_id', $id)->delete();
        VariantOption::where('product_id', $id)->delete();
        VariantValue::where('product_id', $id)->delete();
    }

    //Step 1: Create Stock record
    //if(isset($array['stocks'])){
    //Variant stock record
    foreach ($array['stocks']['sku'] as $stock) {
        $stockResult = Stock::updateOrCreate([
                'sku' => $stock,
                'product_id' => $id,
            ], [
                'price' => $array['stocks']['price'][$iS],
                'quantity' => $array['stocks']['quantity'][$iS],
                'weight' => $array['stocks']['weight'][$iS],
            ]);

        $stockArray[$iS] = $stockResult->id;
        $iS++;
    }
    //}

    //Step 2: Create Variant
    foreach ($variant_values as $variant_value) {
        if ($variant_value) {
            if ($variant_ids[$iV] == 0) {
                $variantResult = Variant::create([
                    'product_id' => $id,
                    'name' => $variant_value,
                ]);
            } else {
                $variantResult = Variant::updateOrCreate([
                    'id' => $variant_ids[$iV],
                    'product_id' => $id,
                ], [
                    'name' => $variant_value,
                ]);
            }

            //temporarly stores variant in array
            $variantArray[$iV]['id'] = $variantResult->id;
            $variantArray[$iV]['name'] = $variant_value;

            //Step 3: Create Variant Option
            $variantOptionIds = explode(',', $option_ids[$iV]);
            $variantOptionValues = explode(',', $option_values[$iV]);

            if (is_array($variantOptionValues)) {
                $iVO = 0;
                foreach ($variantOptionValues as $value) {
                    if (! isset($variantOptionIds[$iVO])) {
                        $variantOptResult = VariantOption::create([
                            'variant_id' => $variantResult->id,
                            'product_id' => $id,
                            'name' => $value,
                        ]);
                    } else {
                        $variantOptResult = VariantOption::updateOrCreate([
                            'id' => $variantOptionIds[$iVO],
                            'variant_id' => $variantResult->id,
                            'product_id' => $id,
                        ], [
                            'name' => $value,
                        ]);
                    }
                    //temporarly stores variant option in array
                    $variantArray[$iV]['options'][$value] = $variantOptResult->id;

                    $iVO++;
                }
            }

            $iV++;
        }
    }

    //Step 4: Create Variant Values
    $iS = 0;
    if (count($array['stocks']['sku']) > 1) { //indication of variants being made
        foreach ($array['stocks']['sku'] as $stock) {
            $option_ids = explode(',', $array['stocks']['option_ids'][$iS]);
            $option_values = explode(',', $array['stocks']['option_values'][$iS]);
            $iO = 0;
            foreach ($option_values as $option_value) {
                if (! isset($option_ids[$iO])) {
                    VariantValue::create([
                        'variant_id' => $variantArray[$iO]["id"],
                        'product_id' => $id,
                        'option_id' => $variantArray[$iO]["options"][$option_value],
                        'stock_id' => $stockArray[$iS],
                    ]);
                } else {
                    //dd($option_ids[$iO]);
                    VariantValue::updateOrCreate([
                        'id' => $option_ids[$iO],
                    ], [
                        'variant_id' => $variantArray[$iO]["id"],
                        'product_id' => $id,
                        'option_id' => $variantArray[$iO]["options"][$option_value],
                        'stock_id' => $stockArray[$iS],
                    ]);
                }



                $iO++;
            }
            $iS++;
        }
    }
}

if (! function_exists('getOrderFinancialStatus')) {
    function getOrderFinancialStatus($status)
    {
        switch ($status) {
            case 0:
                $class = "badge-warning";
                $icon = '<i class="fa fa-dot-circle mr-2"></i>';
                $text = trans('pakka::app.open');

                break;
            case 1:
                $class = "badge-success";
                $icon = '<i class="fa fa-check-circle mr-2"></i>';
                $text = trans('pakka::app.paid');

                break;
            case 2:
                $class = "badge-danger";
                $icon = '<i class="fa fa-times-circle mr-2"></i>';
                $text = trans('pakka::app.canceled');

                break;
            default:
                $class = "badge-danger";
                $icon = '<i class="fa fa-exclamation-circle mr-2"></i>';
                $text = trans('pakka::app.status').' '.trans('pakka::app.unknown');

                break;
        }

        echo "<span class='badge badge-pill ".$class." ml-2'>".$icon.$text."</span>";
    }
}

if (! function_exists('getOrderFulfillmentStatus')) {
    function getOrderFulfillmentStatus($status)
    {
        switch ($status) {
            case 0:
                $class = "badge-warning";
                $icon = '<i class="fa fa-dot-circle mr-2"></i>';
                $text = trans('pakka::app.reserved');

                break;
            case 1:
                $class = "badge-success";
                $icon = '<i class="fa fa-check-circle mr-2"></i>';
                $text = trans('pakka::app.send');

                break;
            case 2:
                $class = "badge-danger";
                $icon = '<i class="fa fa-times-circle mr-2"></i>';
                $text = trans('pakka::app.canceled');

                break;
            case 3:
                $class = "badge-warning";
                $icon = '<i class="fa fa-arrow-alt-circle-left mr-2"></i>';
                $text = trans('pakka::app.retour');

                break;
            default:
                $class = "badge-danger";
                $icon = '<i class="fa fa-exclamation-circle mr-2"></i>';
                $text = trans('pakka::app.status').' '.trans('pakka::app.unknown');

                break;
        }

        echo "<span class='badge badge-pill ".$class." ml-2'>".$icon.$text."</span>";
    }
}

/*
|--------------------------------------------------------------------------
| Is Json
|--------------------------------------------------------------------------
|
| Sees if given string is Valid Json array
|
| $string = inputs string
|
*/

if (! function_exists('isJson')) {
    function isJson($string)
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }
}

/*
|--------------------------------------------------------------------------
| Construct Page Structure
|--------------------------------------------------------------------------
|
| Constructs the structure of the page with an json array input
|
| $array = inputs array
|
*/

if (! function_exists('constructPageStructure')) {
    function constructPageStructure($array, $page_id)
    {
        if (isJson($array)) {
            $langs = Session::get('lang');
            $array = json_decode($array, true);

            if (empty($page_id)) {
                dd("no page id set");
            }

            $iS = 1;
            foreach ($array['sections'] as $section) {
                $sectionResult = Section::create([
                    'page_id' => $page_id,
                    'type' => $section['type'] ?? 2,
                    'name' => $section['name'],
                    'status' => $section['status'] ?? 1,
                    'section' => $section['section'] ?? null,
                    'classes' => $section['classes'] ?? null,
                    'attributes' => $section['attributes'] ?? null,
                    'extras' => $section['extras'] ?? null,
                    'position' => $iS,
                ]);

                if (isset($section['components'])) {
                    $iC = 1;
                    foreach ($section['components'] as $component) {
                        $compResult = Component::create([
                            'id' => generateString(8),
                            'page_id' => $page_id,
                            'section_id' => $sectionResult->id,
                            'position' => $iC,
                            'slug' => $component['slug'],
                            'name' => $component['name'],
                        ]);

                        $iI = 1;
                        foreach ($component['inputs'] as $input) {
                            $types = ["select","checkbox","radio"]; //illegal inputs

                            if (contains($input['type'], $types) && isset($input['options'])) {
                                //inputs with options
                            } else {
                                $inputInsert = AttributeInput::create([
                                    'input_id' => generateString(8),
                                    'set_id' => $compResult->id,
                                    'position' => $iI,
                                    'label' => $input['label'],
                                    'name' => $input['name'],
                                    'type' => $input['type'],
                                ]);
                                foreach ($langs as $lang) {
                                    if (isset($input['default']) && ! empty($input['default'])) {
                                        $input = AttributeValue::create([
                                            'input_id' => $inputInsert->input_id,
                                            'item_id' => $compResult->id,
                                            'language_code' => $lang["language_code"],
                                            'value' => $input['default'],
                                        ]);
                                    }
                                }
                            }
                            $iI++;
                        }

                        $iC++;
                    }
                }
                $iS++;
            }
        }
    }
}

/*
|------------------------------------------------------------------------------------
| Construct the page
|------------------------------------------------------------------------------------
|
| $id = page id
| $mode = 1 display, 2 edit
|
*/

if (! function_exists('constructPage')) {
    function constructPage($id, $mode = 1, $param = null)
    {
        $page = Page::getPage($id, 1);
        $settings = session('settings');

        //get general site settings or page settings
        $site_title = $page['meta_title'] ? $page['meta_title'] : $settings['site_title'];
        $site_description = $page['meta_description'] ? $page['meta_description'] : $settings['site_description'];
        $site_keywords = $page['meta_keywords'] ? $page['meta_keywords'] : $settings['site_keywords'];

        $result['meta']['id'] = $id; //page id
        $result['meta']['mode'] = $mode;
        $result['meta']['title'] = ucfirst($site_title)." - ".ucfirst($page['name']);
        $result['meta']['description'] = $site_description;
        $result['meta']['keywords'] = $site_keywords;
        $result['meta']['settings'] = $settings;
        $result['meta']['slug'] = $page['slug'];
        $result['meta']['url'] = URL::to('/');

        //get an item if one is requested
        if (! empty($param)) {
            $item = Item::getItem($param);
            if ($item) {
                $result['item'] = $item;
            }
        }

        //gives extra meta data for editing purposes
        if (isset(auth()->user()->role)) {
            //Construct all defined menus
            $menus = Session::get('menus');
            foreach ($menus as $menu) {
                $menuId = $menu['id'];
                if ($menuId !== 1) {
                    $menusResult[$menuId] = $menu['name'];
                }
            }

            $result['meta']['menus'] = json_encode($menusResult);

            $result['meta']['forms'] = json_encode(Forms::getFormsLinks());

            //Construct all defined pages
            $result['meta']['pages'] = json_encode(Page::getPagesLinks());

            //Constructs json of all items defined
            $items = $menus[1];

            foreach ($items['items'] as $item) {
                if ($item['link'] == "items") {
                    $itemsResult[$item['id']] = $item['name'];

                    //sub items
                    if (isset($item['items'])) {
                        foreach ($item['items'] as $subItem) {
                            if ($item['link'] == "items") {
                                $itemsResult[$subItem['id']] = $subItem['name'];
                            }
                        }
                    }
                }
            }

            if (! empty($itemsResult)) {
                $result['meta']['items'] = json_encode($itemsResult);

                //Construct array with all item variables
                $iV = 0;
                foreach ($itemsResult as $key => $item) {
                    $set_id = $key; //set_id
                    $inputs = AttributeInput::getInputs($set_id);
                    foreach ($inputs as $input) {
                        $key = $input['name'];
                        $value = $input['label'];
                        $inputsResult[$item][$key] = $value;
                    }
                    $iV++;
                }
                if (! empty($inputsResult)) {
                    $result['meta']['inputs'] = json_encode($inputsResult);
                }
            }
        }

        $css = [];
        $js = [];

        $status = ($mode != 2 ? 1 : null);

        $sectionsHeader = Section::getSectionsByType(1, null, $status)->toArray();
        $sectionsFooter = Section::getSectionsByType(3, null, $status)->toArray();

        $sections = Section::getSectionsByType(2, $id, $status)->toArray();

        if (! empty($sectionsHeader)) {
            $sectionsHeader = array_reverse($sectionsHeader); //to make sure the position is correct otherwise it pushes the last item on top
            foreach ($sectionsHeader as $section) {
                array_unshift($sections, $section);
            }
        }

        if (! empty($sectionsFooter)) {
            foreach ($sectionsFooter as $section) {
                array_push($sections, $section);
            }
        }

        $i = 0;
        foreach ($sections as $section) {
            //Construct Metadata
            $sectionMeta = getCompMeta($section['section'], "assets");

            if (! empty($sectionMeta)) {
                $css = array_merge($css, $sectionMeta["css"]);
                $js = array_merge($js, $sectionMeta["js"]);
            }

            if (! isset($sectionMeta["editable"])) {
                $sectionMeta["editable"] = [];
            }

            $result['sections'][$i] = $section;
            $result['sections'][$i]['editable'] = json_encode(array_merge(config('pakka.base_section_editables'), $sectionMeta["editable"]));

            //construct classes and attributes
            $result['sections'][$i]['classes'] = unserialize($section['classes']);
            $result['sections'][$i]['attributes'] = unserialize($section['attributes']);
            $result['sections'][$i]['extras'] = unserialize($section['extras']);

            //Construct Content
            $component = Component::getSectionContent($section["id"], 1);
            $result['sections'][$i]['component'] = $component;

            $iC = 0;
            foreach ($result['sections'][$i]['component'] as $content) {
                $key = $content['slug'];

                /*
                                if(!empty($content['attributes'])){
                                    $values = array_filter($content['attributes']);
                                }else{
                                    $values = array("");
                                }
                */

                /*
                                if(!empty($content['images'])){
                                    $values['images'] = $content['images'];
                                }else{
                                    $values['images'] = array("");
                                }
                                $values['id'] = $content['id'];
                */

                $result['sections'][$i][$key] = $content;
                $iC++;
            }

            $i++;
        }

        if (strpos($page['template'], 'component') !== false) {
            //Component resources
            if ($mode == 2) {
                $css = array_merge([
                //below standard resources
                "vendor/css/components/bootstrap.css",
                "vendor/css/components/stack-interface.css",
                "vendor/css/components/slick.css",
                "vendor/css/components/theme.css",
                "vendor/css/components/custom.css",], $css); //places the css on top to prevent overwritting
                $js = array_merge($js, [
                //below standard resources
                "vendor/js/components/parallax.js",
                "vendor/js/components/slick.min.js",
                "vendor/js/components/smooth-scroll.min.js",
                "vendor/js/components/scripts.js", ]);
            }
        }

        //Standard editor resources
        if ($mode == 2) {
            $css = array_merge([
            "vendor/css/dropzone.css",
            //"vendor/css/components/vanilla-color-picker.min.js",
            "vendor/css/components/builder.css",
            "vendor/css/components/builder-icons.css",
            "vendor/css/components/themify-icons-min.css",
            "vendor/css/components/mediumEditor.css", ], $css); //places the css on top to prevent overwritting
            $js = array_merge([
            "vendor/js/components/jquery-3.1.1.min.js",
            "vendor/js/components/jquery-ui-1.12.js",
            "vendor/js/components/vanilla-color-picker.min.js",
            "vendor/js/components/custom-item-picker.js",
            "vendor/js/components/mediumEditor.min.js",
            "vendor/js/dropzone.js",
            "vendor/js/components/builder.js", ], $js);
        }

        //Custom script resources (set in settings)
        if (! empty($settings['script_css'])) {
            $customCSS = explode(',', $settings['script_css']);
            $css = array_merge($css, $customCSS);
        }

        if (! empty($settings['script_js'])) {
            $customJS = explode(',', $settings['script_js']);
            $js = array_merge($js, $customJS);
        }

        $result['meta']["css"] = array_unique($css);
        $result['meta']["js"] = array_unique($js);

        /*
                if (strpos($page['template'], 'component') !== false) {
                    //Component template


                }else{
                    //Custom template

                }
        */

        return $result;
    }
}

/*
|--------------------------------------------------------------------------
| Check Section Attributes
|--------------------------------------------------------------------------
|
| Checks if given section attribute exist or not. returns true/false
|
| $element = element
| $array = the section array
|
|
*/

if (! function_exists('checkSecAttr')) {
    function checkSecAttr($element, $array)
    {
        if (isset($array[$element])) {
            return true;
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Parse Section Attributes
|--------------------------------------------------------------------------
|
| Parses the given section attributes
| optional: parse a given value if section attribute exists
|
| $element = element
| $array = the section array
| $parseValue = optional value that will be parsed instead of the asked section attribute
|
*/

if (! function_exists('parseSecAttr')) {
    function parseSecAttr($element, $array)
    {
        if (isset($array[$element])) {
            echo $array[$element];
        }
    }
}

/*
|--------------------------------------------------------------------------
| Parse Value if Section Attributes exists
|--------------------------------------------------------------------------
|
| Parse a given value if section attribute exists
|
| $element = element
| $array = the section array
| $value = optional value that will be parsed instead of the asked section attribute
| $condition = condition which it would compare to
|
*/

if (! function_exists('parseAltAttr')) {
    function parseAltAttr($element, $array, $value, $condition = true)
    {
        if (checkSecAttr($element, $array) == $condition) {
            echo $value;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Parse Edit Section Attributes
|--------------------------------------------------------------------------
|
| Parses the necessary section attributes used in the live editing mode
|
| $mode = mode of page
| $array = the section array
|
|
*/
if (! function_exists('parseEditSecAttr')) {
    function parseEditSecAttr($mode, $array)
    {
        if ($mode == 2) {
            echo "data-id='". $array['id'] ."' data-status='". $array['status'] ."' data-position='". $array['position'] ."' data-section='". $array['section'] ."' data-editable='". $array['editable'] ."' ";

            if ($array['extras']) {
                foreach ($array['extras'] as $key => $value) {
                    echo "data-".$key."='".$value."' ";
                }
            }
        }
    }
}

if (! function_exists('checkAdjustable')) {
    function checkAdjustable()
    {
        if (checkAccess("permission_layout_edit")) {
            echo "adjustable";
        }
    }
}

if (! function_exists('checkManageable')) {
    function checkManageable()
    {
        if (checkAccess("permission_section_edit")) {
            echo "manageable";
        }
    }
}

if (! function_exists('getSection')) {
    function getSection($page, $id, $mode = 1)
    {
        if ($mode == 2) {
            dd($page);
        }

        if (isset($page['sections'][$id])) {
            return $page['sections'][$id];
        }
    }
}

/**
 * getAdminView
 */

if (! function_exists('getAdminView')) {
    function getAdminView($name)
    {
        $resource = 'views/'.str_replace('.', '/', $name).'.blade.php';
        switch (true) {
            //Get File if exists on app level
            case file_exists(resource_path($resource)):
                return $name;

                break;
                //Catch Placeholder sections
            case substr($name, 0, 1) == "_":
                //Get File if exists on package level
            case file_exists(base_path('vendor/therealjanjanssens/pakka/resources/'.$resource)):
            case file_exists(base_path('package/resources/'.$resource)):
                return 'pakka::'.$name;

                break;
        }
    }
}

if (! function_exists('getSectionView')) {
    function getSectionView($name)
    {
        $resource = 'views/sections/'.$name.'/section.blade.php';
        switch (true) {
            //Get File if exists on app level
            case file_exists(resource_path($resource)):
                return 'sections.'.$name.'.section';

                break;
                //Catch Placeholder sections
            case substr($name, 0, 1) == "_":
                //Get File if exists on package level
            case file_exists(base_path('vendor/therealjanjanssens/pakka/resources/'.$resource)):
            case file_exists(base_path('package/resources/'.$resource)):
                return 'pakka::sections.'.$name.'.section';

                break;
        }
    }
}

if (! function_exists('getTemplate')) {
    function getTemplate($name)
    {
        $resource = 'views/templates/'.str_replace('templates.', '', $name).'.blade.php';
        switch (true) {
            //Get File if exists on app level
            case file_exists(resource_path($resource)):
                return $name;

                break;
                //Catch Placeholder sections
            case substr($name, 0, 1) == "_":
                //Get File if exists on package level
            case file_exists(base_path('vendor/therealjanjanssens/pakka/resources/'.$resource)):
            case file_exists(base_path('package/resources/'.$resource)):
                return 'pakka::'.$name;

                break;
        }
    }
}

if (! function_exists('getLayout')) {
    function getLayout($name)
    {
        $resource = 'views/layouts/'.$name.'.blade.php';
        switch (true) {
            //Get File if exists on app level
            case file_exists(resource_path($resource)):
                return 'layouts.'.$name;

                break;
                //Catch Placeholder sections
            case substr($name, 0, 1) == "_":
                //Get File if exists on package level
            case file_exists(base_path('vendor/therealjanjanssens/pakka/resources/'.$resource)):
            case file_exists(base_path('package/resources/'.$resource)):
                return 'pakka::layouts.'.$name;

                break;
        }
    }
}

if (! function_exists('getSectionImage')) {
    function getSectionImage($name)
    {
        $vendorResource = 'vendor/images/sections/'.$name.'.png';
        $customResource = 'images/sections/'.$name.'.png';

        switch (true) {
            //Get File if exists on app level
            case file_exists(public_path($customResource)):
                return $customResource;

                break;
            default:
                return $vendorResource;

                break;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Checks link (probably redundant)
|--------------------------------------------------------------------------
|
| Check if the content isset and links are not #
| If you have edit premission you also get acces
|
*/

if (! function_exists('checkContent')) {
    function checkContent($array, $key)
    {
        if ((isset($array[$key]) && $array[$key] !== "#" && ! empty($array[$key])) || checkEditAcces()) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('parseContent')) {
    function parseContent($array, $key, $editable = true)
    {
        //$user = auth()->user()->role;
        $locale = Session::get('locale');
        $empty = false;
        if (empty($array[$key]) || ! isset($array[$key])) {
            if (! isset(auth()->user()->role)) {
                //reverts to the default locale value when website is displayed to fill in the website for the user
                //Doubles the total of queries (? possibly a better solution ?)
                //detects item content and sets the right id to edit in live editor
                if (isset($array['module_id'])) {
                    $input = AttributeInput::where("name", $key)->where('set_id', $array['module_id'])->get()->toArray();
                } else {
                    $input = AttributeInput::where("name", $key)->where('set_id', $array['id'])->get()->toArray();
                }

                if (! empty($input)) {
                    $value = AttributeValue::where("item_id", $array["id"])->where('input_id', $input[0]['input_id'])->get()->toArray();
                    $value = $value[0]['value'] ?? "";
                }

            //commented this out because it is possibly not needed check this
            // else {
                //     $value = trans("pakka::app.insert_here");
                //     $empty = true;
            // }
            } else {
                //Your logged in and in the live editor. Your value you try to parse is empty.
                $value = trans("pakka::app.insert_here");
                $empty = true;
            }
        } else {
            //Parses values already in the record (title, slug, meta, images)
            $value = $array[$key];
        }

        if (! isset(auth()->user()->role) || $editable !== true) {
            echo nl2br(htmlspecialchars_decode($value));
        } else {
            //detects item content and sets the right id to edit in live editor
            if (isset($array['module_id'])) {
                echo "<data contenteditable='true' data-id='".$array["id"]."' data-module='".$array["module_id"]."' data-key='".$key."' data-locale='".$locale."' data-empty='".$empty."'>".nl2br(htmlspecialchars_decode($value))."</data>";
            } else {
                echo "<data contenteditable='true' data-id='".$array["id"]."' data-key='".$key."' data-locale='".$locale."' data-empty='".$empty."'>".nl2br(htmlspecialchars_decode($value))."</data>";
            }
        }
    }
}

if (! function_exists('bladeCompile')) {
    function bladeCompile($value, array $args = [])
    {
        $generated = \Blade::compileString($value);

        ob_start() and extract($args, EXTR_SKIP);

        // We'll include the view contents for parsing within a catcher
        // so we can avoid any WSOD errors. If an exception occurs we
        // will throw it out to the exception handler.
        try {
            eval('?>'.$generated);
        }

        // If we caught an exception, we'll silently flush the output
        // buffer so that no partially rendered views get thrown out
        // to the client and confuse the user with junk.
        catch (\Exception $e) {
            ob_get_clean();

            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}

/*
|--------------------------------------------------------------------------
| Parse Image
|--------------------------------------------------------------------------
|
| Parse the image content with or without a uploadable wrapper
| output: src='..' (contenteditable="true" id="..")
|
| $id = item id
| $file = (string) filename and extention
| $size = image size (see config for sizes (default: 200, 500, 900)
|
|
*/

if (! function_exists('parseImage')) {
    function parseImage($array, $file, $size, $lazyLoad = false)
    {
        //$user = auth()->user()->role;
        $locale = Session::get('locale');

        $url = imgUrl($array['id'], $file, $size);
        $id = $array['id'];

        if ($lazyLoad == true) {
            $lazyLoad = "src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
         data-";
        } else {
            $lazyLoad = "";
        }

        //If product detected add module id
        if (isset($array['base_price'])) {
            $module = MenuItem::where('link', "products")->first();
            $array['module_id'] = $module->id;
        }

        if (! isset(auth()->user()->role)) {
            echo $lazyLoad."src='".$url."'";
        } else {
            //detects is element array is an item/product/content element
            switch (true) {
                case isset($array['base_price']):
                    //product element
                    echo $lazyLoad."src='".$url."' contenteditable='true' data-id='".$id."' data-module-id='".$array['module_id']."' data-module='products'";

                    break;
                case isset($array['module_id']):
                    //item element
                    echo $lazyLoad."src='".$url."' contenteditable='true' data-id='".$id."' data-module-id='".$array['module_id']."'";

                    break;
                default:
                    //content element
                    echo $lazyLoad."src='".$url."' contenteditable='true' data-id='".$id."'";
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Check if directory is empty
|--------------------------------------------------------------------------
|
| Is used in the deletion of files to prevent empty maps on the server.
|
*/
/*
function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL;
  return (count(scandir($dir)) == 2);
}
*/


/*
|--------------------------------------------------------------------------
| Is Localhost
|--------------------------------------------------------------------------
|
| Check if website is running on a local enviroment
|
*/
if (! function_exists('isLocalhost')) {
    function isLocalhost($whitelist = ['127.0.0.1', '::1'])
    {
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }
}

/*
|--------------------------------------------------------------------------
| Construct google font link
|--------------------------------------------------------------------------
|
| Construct google font link
|
*/
if (! function_exists('constructGoogleFontLink')) {
    function constructGoogleFontLink()
    {
        $settings = session('settings');
        $fontList = config('_fonts');

        $fonts = "";
        foreach ($fontList as $font) {
            if ($settings['body_font'] == $font['option_id'] && $font['gfont'] == true) {
                $fonts .= $font['slug'].'|';
            }

            //last condition prevents duplicates in the fonts variable
            if ($settings['heading_font'] == $font['option_id'] && $font['gfont'] == true && strpos($fonts, $font['slug']) == false) {
                $fonts .= $font['slug'].'|';
            }
        }

        $fonts = substr($fonts, 0, -1);
        $link = '<link href="https://fonts.googleapis.com/css?family='.$fonts.'&display=swap" rel="stylesheet">';

        return $link;
    }
}

/*
|--------------------------------------------------------------------------
| Construct style variables
|--------------------------------------------------------------------------
|
| Construct google font link
|
*/
if (! function_exists('constructStyleVar')) {
    function constructStyleVar()
    {
        $settings = session('settings');
        $fontList = config('_fonts');

        foreach ($fontList as $font) {
            if ($settings['body_font'] == $font['option_id']) {
                $body_font = $font['value'];
            }

            //last condition prevents duplicates in the fonts variable
            if ($settings['heading_font'] == $font['option_id']) {
                $heading_font = $font['value'];
            }
        }

        return "<style>
					:root {
						--primary-color: ".$settings['primary_color'].";
						--secondary-color: ".$settings['secondary_color'].";
                        --highlight-color: ".$settings['highlight_color'].";
                        --dark-color: ".$settings['dark_color'].";
                        --grey-color: ".$settings['grey_color'].";

						--body-font: ".$body_font.";
						--heading-font: ".$heading_font.";
					}
				</style>";
    }
}

/*
|--------------------------------------------------------------------------
| Construct Tracking codes
|--------------------------------------------------------------------------
|
| Construct tracking codes like gtm and fb pixel
|
*/
if (! function_exists('constructTrackers')) {
    function constructTrackers($position = "head")
    {
        if (checkCookie('laravel_cookie_consent')) {
            $settings = session('settings');
            switch ($position) {
                case "head":
                    if (isset($settings['track_gtm_head'])) {
                        echo $settings['track_gtm_head'];
                    }

                    if (isset($settings['track_fbpxl'])) {
                        echo $settings['track_fbpxl'];
                    }

                    break;
                case "body":
                    if (isset($settings['track_gtm_body'])) {
                        echo $settings['track_gtm_body'];
                    }

                    break;
            }
        }
    }
}

if (! function_exists('constructDividers')) {
    function constructDividers($array)
    {
        if (isset($array['classes'])) {
            $sClasses = $array['classes'];
        }

        if (isset($array['extras'])) {
            $extras = $array['extras'];
        }

        if (isset($extras['divider_shape_top'])) {
            $orientation = isset($extras['divider_shape_top']) ? "divider-top" : "";
            $shape = isset($extras['divider_shape_top']) ? $extras['divider_shape_top'] : "";
            $classes = isset($sClasses['.divider-top']) ? $sClasses['.divider-top'] : "";
            $classes = "$orientation $classes";
            echo view('pakka::partials.dividers.'.$shape, ['classes' => $classes]);
        }

        if (isset($extras['divider_shape_bottom'])) {
            $orientation = isset($extras['divider_shape_bottom']) ? "divider-bottom" : "";
            $shape = isset($extras['divider_shape_bottom']) ? $extras['divider_shape_bottom'] : "";
            $classes = isset($sClasses['.divider-bottom']) ? $sClasses['.divider-bottom'] : "";
            $classes = "$orientation $classes";
            echo view('pakka::partials.dividers.'.$shape, ['classes' => $classes]);
        }
    }
}

/*
|--------------------------------------------------------------------------
| Construct social media links
|--------------------------------------------------------------------------
|
| Construct google font link
|
*/
if (! function_exists('constructSocialMediaLinks')) {
    function constructSocialMediaLinks()
    {
        $settings = session('settings');
        $links = [];

        if (! empty($settings['social_facebook'])) {
            array_push($links, ['icon' => 'fa fa-facebook', 'email_icon' => 'facebook-icon_24x24.png', 'name' => 'Facebook', 'link' => $settings['social_facebook']]);
        }

        if (! empty($settings['social_instagram'])) {
            array_push($links, ['icon' => 'fa fa-instagram', 'email_icon' => 'instagram-icon_24x24.png', 'name' => 'Instagram', 'link' => $settings['social_instagram']]);
        }

        if (! empty($settings['social_twitter'])) {
            array_push($links, ['icon' => 'fa fa-twitter', 'email_icon' => 'twitter-icon_24x24.png', 'name' => 'Twitter', 'link' => $settings['social_twitter']]);
        }

        if (! empty($settings['social_youtube'])) {
            array_push($links, ['icon' => 'fa fa-youtube', 'email_icon' => 'youtube-icon_24x24.png', 'name' => 'Youtube', 'link' => $settings['social_youtube']]);
        }

        if (! empty($settings['social_linkedin'])) {
            array_push($links, ['icon' => 'fa fa-linkedin', 'email_icon' => 'linkedin-icon_24x24.png', 'name' => 'Linkedin', 'link' => $settings['social_linkedin']]);
        }

        if (! empty($settings['social_behance'])) {
            array_push($links, ['icon' => 'fa fa-behance', 'email_icon' => null, 'name' => 'Behance', 'link' => $settings['social_behance']]);
        }

        if (! empty($settings['social_pinterest'])) {
            array_push($links, ['icon' => 'fa fa-pinterest-p', 'email_icon' => 'pintrest-icon_24x24.png', 'name' => 'Pinterest', 'link' => $settings['social_pinterest']]);
        }

        if (! empty($settings['social_tumblr'])) {
            array_push($links, ['icon' => 'fa fa-tumblr', 'email_icon' => null, 'name' => 'Tumblr', 'link' => $settings['social_tumblr']]);
        }

        return $links;
    }
}

if (! function_exists('constructVariantSelect')) {
    function constructVariantSelect($variants, $classes)
    {
        if (! empty($variants)) {
            foreach ($variants as $variant) {
                $ids = explode(',', $variant['option_ids']);
                $values = explode(',', $variant['option_values']); ?>
				<div class="select-group" data-group="<?php echo $variant['id']; ?>">
	            	<b class="d-block mb-2"><?php echo $variant['name']; ?></b>
	            	<?php
                        $i = 0;
                foreach ($values as $value) {
                    ?>
			        	<div class="select-item d-inline-block p-3 boxed e
						<?php
                            echo $classes;
                    if ($i == 0) {
                        echo " ml-0 mr-2 my-2 active";
                    } else {
                        echo " m-2";
                    } ?>">
		                	<div class="input-radio">
		                		<div class="select-item-label hidden">
		                			<input type="radio" class="cart-delivery" value="<?php echo $ids[$i]; ?>" id="input-assigned-<?php echo $ids[$i]; ?>">
									<label for="input-assigned-<?php echo $ids[$i]; ?>"></label>
		                		</div>

		                		<div class="select-item-text ml-0">
			                		<b><?php echo $value; ?></b>
								</div>
		                	</div>
		            	</div>
			        <?php
                        $i++;
                } ?>

		        </div>
				<?php
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| GET IG FEED
|--------------------------------------------------------------------------
|
| Construct google font link
|
*/
function url_get_contents($url)
{
    if (! function_exists('curl_init')) {
        die('The cURL library is not installed.');
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    //dd($output);
    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);

    return $output;
}

if (! function_exists('getIGInfo')) {
    function getIGInfo()
    {
        $settings = session('settings');
        $account = $settings['social_instagram'];

        if (! empty($account)) {
            $profileUrl = $settings['social_instagram']."?__a=1";
            $response = Cache::tags('collections')->remember('instagram_feed', 60 * 60 * 24 * 7, function () use ($profileUrl) {
                return url_get_contents($profileUrl);
            });

            if (! empty($response)) {
                //$response = file_get_contents($profileUrl);
                $data = json_decode($response, true);

                if ($data) {
                    $media = $data['graphql']['user']['edge_owner_to_timeline_media']['edges'];
                    if (is_array($media)) {
                        $result['username'] = $data['graphql']['user']['username'];
                        $result['biography'] = $data['graphql']['user']['biography'];
                        $result['followers'] = $data['graphql']['user']['edge_followed_by']['count'];
                        $result['media'] = $media;

                        return $result;
                    } else {
                        //echo "<p class='text-danger text-center mx-auto'>Er liep iets mis bij het ophalen van de informatie.</p>";
                    }
                } else {
                    //echo "<p class='text-danger text-center mx-auto'>Ongeldig account. Kopieer de url van je Instagram account en kopieer deze in de instellingen.</p>";
                }
            }
        } else {
            //echo "<p class='text-danger text-center mx-auto'>Geen account aanwezig.</p>";
        }
    }
}

/*
function checkActiveAdminRoute($array){
    $id = $array['id'];
    $storedId = Session::get('set_id');
    $route = config('pakka.prefix.admin'). '.' . $array['link'] . '.index';
    $output['link_class'] = "";
    $output['icon_class'] = "";

    if($array['link'] == 'items'){
        $output['route'] = route($route,$id);

        if(Route::currentRouteName() == $route && $storedId == $id){
            $output['link_class'] = "active";
            $output['icon_class'] = "c-blue-500";
            //Session::put('module_name', $array['name']);
        }
    }else{
        $output['route'] = route($route);

        if(Route::currentRouteName() == $route){
            $output['link_class'] = "active";
            $output['icon_class'] = "c-blue-500";
            //Session::put('module_name', $array['name']);
            //Session::put('set_id', $id);
        }
    }

    return $output;
}
*/

/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $output = "active", $id = null)
{
    if (isset($id)) {
        if (Route::currentRouteName() == $route && $id == Session::get('set_id')) {
            return $output;
        }
    } else {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function areActiveRoutes(array $routes, $output = "active")
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

function constructAdminMenu($array)
{
    foreach ($array as $item) {
        $liClass = "";
        $aClass = "";
        $iClass = $item['icon'].' ';
        $route = "javascript:void(0);"; //default

        if (! isset($item['items'])) {
            if ($item['link'] == 'items') {
                $route = route(config('pakka.prefix.admin') . '.' . $item['link'] . '.index', $item['id']);
                $liClass .= isActiveRoute('admin.' . $item['link'] . '.index', 'active', $item['id']);
                $iClass .= isActiveRoute('admin.' . $item['link'] . '.index', 'c-blue-500', $item['id']);
            } else {
                $route = route(config('pakka.prefix.admin') . '.' . $item['link'] . '.index');
                $liClass .= isActiveRoute('admin.' . $item['link'] . '.index', 'active');
                $iClass .= isActiveRoute('admin.' . $item['link'] . '.index', 'c-blue-500');
            }
        } else {
            $liClass .= " dropdown";
            $aClass .= "dropdown-toggle";
        }  ?>

		<li class="nav-item mT-20 <?php echo $liClass; ?>">
			<a class="<?php echo $aClass; ?>" href="<?php echo $route; ?>">
				<span class="icon-holder"><i class="<?php echo $iClass; ?>"></i> </span>
				<span class="title"><?php //echo $item['name'];?>need fixing</span>
				<?php
                    if (isset($item['items'])) {
                        ?>
					<span class="arrow"><i class="ti-angle-right"></i></span>
					<?php
                    } ?>
			</a>

			<?php
                if (isset($item['items'])) {
                    ?>
				<ul class="dropdown-menu">
					<?php
                        foreach ($item['items'] as $subItem) {
                            if ($subItem['link'] == 'items') {
                                $subRoute = route(config('pakka.prefix.admin') . '.' . $subItem['link'] . '.index', $subItem['id']);
                            } else {
                                $subRoute = route(config('pakka.prefix.admin') . '.' . $subItem['link'] . '.index');
                            } ?>
						<li><a class="sidebar-link" href="<?php echo $subRoute; ?>"><?php echo $subItem['name']; ?></a></li>
					<?php
                        } ?>
				</ul>
			<?php
                } ?>
		</li>

		<?php
    }
}

/*
|--------------------------------------------------------------------------
| Format numbers
|--------------------------------------------------------------------------
|
| Format numbers two decimals after comma | French notation (only used in views)
|
*/

if (! function_exists('formatNumber')) {
    function formatNumber($number, $allowDec = true)
    {
        if ($allowDec == false && fmod($number, 1) == 0.00) {
            $number = number_format(floatval($number), 0, ',', ' ');
        } else {
            $number = number_format(floatval($number), 2, ',', ' ');
        }

        return $number;
    }
}

if (! function_exists('getExclAmount')) {
    function getExclAmount($amount, $vat = null)
    {
        if ($vat == null) {
            $settings = session('settings');
            $vat = $settings['shop_general_vat'];
        }

        $vatMultiplier = floatval($vat) + 100;

        //het bedrag inclusief BTW/121 x 21
        if ($vat !== 0) {
            $amount = $amount - (floatval($amount) / $vatMultiplier * floatval($vat));
        }

        //Usage of 3 decimals for accurate calculations when amount gets rounded
        return number_format($amount, 3);
    }
}

if (! function_exists('getInclAmount')) {
    function getInclAmount($amount, $vat = null)
    {
        if ($vat == null) {
            $settings = session('settings');
            $vat = $settings['shop_general_vat'];
        }

        $vatMultiplier = (floatval($vat) + 100) / 100;

        //het bedrag inclusief BTW/121 x 21
        if ($vat !== 0) {
            $amount = $vatMultiplier * floatval($amount);
        }

        //Usage of 3 decimals for accurate calculations when amount gets rounded
        return number_format($amount, 3);
    }
}

if (! function_exists('shopStatus')) {
    function shopStatus()
    {
        $settings = session('settings');

        if ($settings['shop_status'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Darken
|--------------------------------------------------------------------------
|
| Darken hex colors
|
*/
function darken_color($rgb, $darker = 2)
{
    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if (strlen($rgb) != 6) {
        return $hash.'000000';
    }
    $darker = ($darker > 1) ? $darker : 1;

    list($R16, $G16, $B16) = str_split($rgb, 2);

    $R = sprintf("%02X", floor(hexdec($R16) / $darker));
    $G = sprintf("%02X", floor(hexdec($G16) / $darker));
    $B = sprintf("%02X", floor(hexdec($B16) / $darker));

    return $hash.$R.$G.$B;
}

/*
|--------------------------------------------------------------------------
| Moves files
|--------------------------------------------------------------------------
|
| not sure what it does maybe move avatar
|
*/

if (! function_exists('move_file')) {
    function move_file($file, $type = 'app', $withWatermark = false)
    {
        // Grab all variables
        $destinationPath = config('image.'.$type.'.folder'); //app
        $width = config('image.' . $type . '.width');
        $height = config('image.' . $type . '.height');
        $full_name = generateString(16) . '.' . $file->getClientOriginalExtension();

        // Create the Image
        $image = Image::make($file->getRealPath());

        if ($width == null && $height == null) { // Just move the file
            Storage::disk('public')->put($destinationPath . '/' . $full_name, (string) $image->encode());

            return $full_name;
        }

        if ($width == null || $height == null) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->fit($width, $height);
        }

        if ($withWatermark) {
            $watermark = Image::make(public_path() . '/img/watermark.png')->resize($width * 0.5, null);

            $image->insert($watermark, 'center');
        }

        Storage::disk('public')->put($destinationPath . '/' . $full_name, (string) $image->encode());

        return $full_name;
    }
}
