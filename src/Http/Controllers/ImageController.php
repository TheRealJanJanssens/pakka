<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use ImageOptimizer;
use Session;
use Storage;

use TheRealJanJanssens\Pakka\Models\Images;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Cache::tags('content')->flush();
        
        constructGlobVars();
    }
    
    public function storeImage(Request $request)
    {
        if ($request) {
            $settings = Session::get('settings');
            
            //Get product id
            $itemId = Session::get('current_item_id');
            
            //image config
            $storageUrl = config('image.storage');
            $baseUrl = config('image.folder');
            $baseLocation = $baseUrl.'/'.$itemId.'/';
            $publicUrl = config('image.public');
            
            $this->validate($request, [
                'file' => 'required',
                'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ]);
            
            //Get all files
            $files = $request->file('file');

            $uploadImages = Session::get('uploadImages');
            
            //get the right key for positioning.
            if (isset($uploadImages)) {
                end($uploadImages);
                $key = key($uploadImages);
                $i = $key + 1; //adds one to existing last key
            } else {
                $i = 1;
            }

            foreach ($files as $file) {
                $img = Image::make($file->getRealPath())->orientate(); //->orientate() fixes wrong orientation from phone uploads
                $name = generateString(10);
                $ext = $file->getClientOriginalExtension();
                
                //Gets all the image formats in the config
                $formats = config('image.formats');
                
                foreach ($formats as $format) {
                    //Makes the head dir if not exists
                    if (! Storage::exists($storageUrl)) {
                        Storage::disk('public')->makeDirectory($baseLocation);
                    }
    
                    //Keeps same aspect ratio when resize
                    if ($format !== 0) {
                        $img->resize($format, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    
                    //$img->encode('webp', 90)->save(public_path('uploads/'  .  $filename . '.webp')

                    //encodes the image
                    $img->stream($file->getClientOriginalExtension(), $settings['image_compression']);

                    //Makes the format dir if not exists
                    if (! Storage::exists($storageUrl.$format)) {
                        Storage::disk('public')->makeDirectory($baseLocation.$format);
                    }

                    Storage::disk('public')->put($baseLocation.$format.'/'.$name.'.'.$ext, $img);
                    
                    //store webp if enabled
                    if ($settings['image_webp_convert'] == 1) {
                        $img->encode('webp')->save($baseLocation.$format.'/'.$name);
                    }

                    //optimize image (if turned on)
                    if ($settings['image_optimization']) {
                        $path = Storage::disk('public')->path($baseLocation.$format.'/'.$name.'.'.$ext);
                        ImageOptimizer::optimize($path);
                    }
                }
    
                $image["item_id"] = $itemId;
                $image["position"] = $i;
                $image["file"] = substr(md5(uniqid(rand(), true)), 0, 8) . '.' . $file->getClientOriginalExtension();
                
                
                $uploadImages[$i]["name"] = $name;
                Session::put('uploadImages', $uploadImages);
                
                $result[$i] = ['item_id' => $itemId, 'file' => $name.'.'.$ext, 'position' => $i];
                
                Images::create($result[$i]);
                
                //adds to position counter
                $i++;
            }
            
            return json_encode($result);
        }
    }
    
    public function orderImage(Request $request)
    {
        if ($_POST) {
            $images = json_decode($_POST['data'], true);
            //unset($images[0]);
            
            $query = "";
            foreach ($images as $image) {
                if (isset($image['item_id'])) {
                    $query .= "UPDATE images SET position = ".htmlspecialchars($image['position']).", updated_at = '".date('Y-m-d H:i:s')."' WHERE item_id ='".htmlspecialchars($image['item_id'])."' AND file = '".htmlspecialchars($image['file'])."';";
                }
            }
            
            if ($query) {
                DB::unprepared($query); //execute query Unprepared.. only use this in controlpanel
            }
        }
    }
    
    public function rotateImage(Request $request)
    {
        if ($_POST) {
            $image = json_decode($_POST['data'], true);

            //image config
            $storageUrl = config('image.storage');
            $baseUrl = config('image.folder');
            
            //image get information
            $id = $image["item_id"];
            $file = $image["file"];
            $baseLocation = $baseUrl.'/'.$id.'/';
            
            //Gets all the image formats in the config
            $formats = config('image.formats');
            
            foreach ($formats as $format) {
                $imagePath = $baseLocation . $format .'/'. $file;
                $img = Image::make(Storage::disk('public')->get($imagePath));
                $img->rotate(-90);
                $img->stream();
                Storage::disk('public')->put($imagePath, $img);
            }
        }
    }
    
    public function destroyImage(Request $request)
    {
        if ($_POST) {
            $images = json_decode($_POST['data'], true);
            
            //image config
            $storageUrl = config('image.storage');
            $baseUrl = config('image.folder');
            
            //image get information
            $id = $images["item_id"];
            $file = $images["file"];
            $baseLocation = $storageUrl.$id.'/';
            
            //Gets all the image formats in the config
            $formats = config('image.formats');
            
            foreach ($formats as $format) {
                $baseLocation = $baseUrl.'/'.$id.'/';
                $imagePath = $baseLocation . $format .'/'. $file;
                
                if (Storage::disk('public')->delete($imagePath)) {
                    //Uses disk syntaxt to manipulate the images in back-end (not publicly accesable)
                    Storage::disk('public')->delete($imagePath);
                }
                
                //delete format folders if empty
                if (empty(Storage::disk('public')->allFiles($baseLocation . $format))) {
                    //the folder is empty;
                    Storage::disk('public')->deleteDirectory($baseLocation . $format);
                }
            }
            
            //delete general folders if empty
            if (empty(Storage::disk('public')->allFiles($baseLocation))) {
                //the folder is empty;
                Storage::disk('public')->deleteDirectory($baseLocation);
            }
            
            $query = "DELETE FROM images WHERE item_id = '".htmlspecialchars($id)."' AND file = '".htmlspecialchars($file)."'; ";
            
            DB::unprepared($query); //execute query Unprepared.. only use this in controlpanel
        }
    }
}
