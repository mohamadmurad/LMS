<?php

namespace App\Http\Controllers;

use App\Models\HubFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    public function get_validations($type = "file")
    {
        if ($type == "file")
            return "3gp,7z,7zip,ai,apk,avi,bin,bmp,bz2,css,csv,doc,docx,egg,flv,gif,gz,h264,htm,html,ia,icns,ico,jpeg,jpg,m4v,markdown,md,mdb,mkv,mov,mp3,mp4,mpa,mpeg,mpg,mpga,octet-stream,odp,ods,odt,ogg,otf,pak,pdf,pea,png,pps,ppt,pptx,psd,rar,rm,rss,rtf,s7z,sql,svg,tar,targz,tbz2,tex,tgz,tif,tiff,tlz,ttf,vob,wav,webm,wma,wmv,xhtml,xlr,xls,xlsx,xml,z,zip,zipx,gif,png,jpeg,qt";
        else if ($type == "image")
            return "jpeg,bmp,png,gif";
        else
            return $type;
    }

    public function store_file($options)
    {
        $validation = Validator::make($options, ['source' => "required|mimes:" . $this->get_validations($options["validation"]) . "|max:250000"]);
        if ($validation->fails()) {
            $file = $options['source'];
            $filename = '';
            return [
                'success' => false,
                'filename' => $options['source'],

                // for new extension
                "hasWarnings" => true,
                "isSuccess" => false,
                "warnings" => ['لم نتمكن من رفع هذا الملف'],
                "files" => [
                    [
                        "date" => date('Y-m-d h:i:s'),
                        "extension" => $file->extension(),
                        "file" => $filename,
                        "format" => "application",
                        "name" => $filename,
                        "old_name" => "ملف",
                        "old_title" => "ملف",
                        "replaced" => false,
                        "size" => $file->getSize(),
//                        "size2" => "$file->getSize() KB",
                        "title" => $filename,
                        "type" => $file->getMimeType(),
                        "uploaded" => true
                    ]
                ]

            ];
        }
        $user_id = $options['user_id'];
        $file = $options["source"];
        $path = $options["path_to_save"]; // '/uploads/portfolios/';
        $path_small = $options["path_to_save"] . $options["small_path"];

        $filename = pathinfo(str_replace(' ', '-', $file->getClientOriginalName()), PATHINFO_FILENAME) . '-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6) . '.' . $file->getClientOriginalExtension();

        try {
            // File::put($path.$filename,$file);
            //  $file->move($path,$filename);
            Storage::disk($options["file_system_type"])
                ->put('/' . strtolower($options['visibility']) . $path . $filename,
                    File::get($file), $filename);
        } catch (\Exception $e) {
        }


        $s = HubFile::insert(
            [
                'user_id' => $user_id,
                'path' => $options["path_to_save"],
                'extension' => $file->extension(),
                'size' => $file->getSize(),
                'getMimeType' => $file->getMimeType(),
                'type' => $options["type"],
                'name' => $filename,
                'visibility' => $options["visibility"],
                'bucket_name' => $options["file_system_type"]
            ]
        );
        return [
            'success' => true,
            'filename' => $filename,

            // for new extension
            "hasWarnings" => false,
            "isSuccess" => true,
            "warnings" => [],
            "files" => [
                [
                    "date" => date('Y-m-d h:i:s'),
                    "extension" => $file->extension(),
                    "file" => $filename,
                    "format" => "application",
                    "name" => $filename,
                    "old_name" => "ملف",
                    "old_title" => "ملف",
                    "replaced" => false,
                    "size" => $file->getSize(),
                    "size2" => $file->getSize() . " KB",
                    "title" => $filename,
                    "type" => $file->getMimeType(),
                    "uploaded" => true
                ]
            ]
        ];

    }

    public function upload_image(Request $request){
        $file = $this->store_file([
            'source'=>$request->upload!=null?$request->upload:$request->file,
            'validation'=>"image",
            'path_to_save'=>'/uploads/images/',
            'type'=>'IMAGE',
            'user_id'=>Auth::user()->id,
            'resize'=>[500,1000],
            'small_path'=>'small/',
            'visibility'=>'PUBLIC',
            'file_system_type'=>env('FILESYSTEM_DRIVER'),
            /*'watermark'=>true,*/
            'compress'=>'auto'
        ]);
        return [
            'fileName'=>$file['filename'],
            'uploaded'=>1,
            'success'=>true,
            "hasWarnings"=>false,
            "isSuccess"=>true,
            "warnings"=>[],
            'location'=>env('STORAGE_URL')."/uploads/images/".$file['filename'],
            'file'=>env('STORAGE_URL')."/uploads/images/".$file['filename'],
            'url'=>env('STORAGE_URL')."\uploads\images\\".$file['filename'],
            'files'=>$file['files']

        ];


    }
}
