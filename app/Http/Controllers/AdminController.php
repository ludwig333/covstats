<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CovidDataController;
use App\Models\banners;
use File;

class AdminController extends Controller
{
	// Symptoms page
	public function index(Request $request)
    {
        $overview_images = banners::where('page_name','overview')->get();
        $countries_images = banners::where('page_name','countries')->get();
        $prevention_images = banners::where('page_name','prevention')->get();
        $symptoms_images = banners::where('page_name','symptoms')->get();
        $faqs_images = banners::where('page_name','faqs')->get();
        $images = banners::get();        
        return view('dashboard',compact('overview_images','countries_images','prevention_images','symptoms_images','faqs_images','images'));
    }

    public function upload(Request $request){
        return view('upload');
    }

    public function upload_image(Request $request){
       if($request->hasFile('image')){  
            $files = $request->file('image');
            $folderName = $request->page;
            $folder_path = 'images/slides/'.$folderName;
                foreach ($files as $file) {
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).time().'.'.$extension; 
                    $file->move(public_path($folder_path), $fileName);  
                    $banner = new banners();
                    $banner->page_name = $folderName; 
                    $banner->path = $folder_path.'/'.$fileName; 
                    $banner->save();
                }

        }
        return back()
            ->with('success','You have successfully file uplaod.'); 
    }

    public function updateimage(Request $request){
        $id = $request->id;
       if($request->hasFile('file')){ 

                    $banner = banners::where('id',$id)->first();
                    if (File::exists($banner->path)) {
                        unlink($banner->path);
                    }

            $file = $request->file('file');
            $folderName = $banner->page_name;
            $folder_path = 'images/slides/'.$folderName;
                    $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).time().'.'.$extension; 
                    $file->move(public_path($folder_path), $fileName);  
                    $banner->page_name = $folderName; 
                    $banner->path = $folder_path.'/'.$fileName; 
                    $banner->save();


        }
        return back()
            ->with('success','You have successfully file uplaod.');         
    }

    public function deleteimage($id){
        $image = banners::find($id);
            if (File::exists($image->path)) {
                unlink($image->path);
            }

        $image->delete();
        return back()
            ->with('success','You have successfully deleted image.');         
    }


}