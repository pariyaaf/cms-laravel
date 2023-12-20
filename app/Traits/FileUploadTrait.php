<?php 
namespace App\Traits;

use Illuminate\Http\Request;
use File;
use carbon\Carbon;
trait FileUploadTrait {
    
    function uploadImage($inputName, $oldPath=Null,  $path = "/uploads")  {

        if($inputName) {
            // $img = $request->{$inputName};
            $img = $inputName;
            //get extention of file
            $ext = $img->getClientOriginalExtension();

            //get date
            $time = Carbon::now();
            $imgName = 'media_'.$time.'.'.$ext;

            $path_300 = '/uploads/300/';
            $path_600 = '/uploads/600/';
            $path_900 = '/uploads/900/';

            $mainImage = $img->move(public_path($path), $imgName);
            copy(public_path($path)."/".$imgName, public_path($path_300).  'media_'.$time.'_'.'300.'.$ext);
            copy(public_path($path)."/".$imgName, public_path($path_600).  'media_'.$time.'_'.'600.'.$ext);
            copy(public_path($path)."/".$imgName, public_path($path_900).  'media_'.$time.'_'.'900.'.$ext);

            //delete old file if exists
            if(File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
            $images = [
                'thumb'=>$path.'/'.$imgName,
                'sizes' => [
                    $path.'/'.$imgName,
                    $path_300.'media_'.$time.'_'.'300.'.$ext,
                    $path_600.'media_'.$time.'_'.'600.'.$ext,
                    $path_900.'media_'.$time.'_'.'900.'.$ext
                ]

            ];
            return $images;    

        }
        return null;
    }


    function RemoveFile(array $path): void  {
        //delete old file if exists
        foreach($path['sizes'] as $path) {
            if(File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }

    }
}



?>