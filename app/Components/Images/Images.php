<?php

namespace Handytravelers\Components\Images;

use Auth;
use Handytravelers\Components\Images\Models\Image as Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;


class Images 
{
    private $path;
    private $url;
    private $resize = ['720'];
    private $cut = []; //[ ['534','400'] ];
    private $fit = ['300','150'];
    private $directories = ['720','300','150'];

    public function newPhoto($file = null, $user_id)
    {
        if(is_null($file))
            $file = Input::file('files')[0];

        $this->path = Config::get('filesystems.disks.local.root') .'/public/userImages';

        $this->createDirectories();

        $image = new Model();

        $image->url = Uuid::uuid4() .'.jpg';

        $this->resize($file, $image->url);

        $image->main = $this->isMain();
        $image->user_id = $user_id;

        foreach ( $this->getSizes() as $size)
        {
            $file = Storage::disk('local')->get("/public/userImages/{$size}/{$image->url}");
            Storage::disk('s3')->put("/profiles/{$size}/{$image->url}", $file, 'public' );

        }

        $image->save();

        return $image;
    }


    public function delete($id)
    {
        $user = Auth::user();

        $image = Model::whereRaw('id = ? and user_id = ?', [$id, $user->id])->firstOrFail();

        foreach ($this->getSizes() as $size)
        {
            Storage::disk('s3')->delete("/profiles/{$size}/{$image->url}");
        }

        $image->delete();


        if($image->main)
        {

            if ($newMainImage = Model::where('user_id', '=', $user->id )->first() )
            {
                $newMainImage->main = 1;
                $newMainImage->save();
            }

        }
    }


    public function resize($file, $url)
    {

        $image = Image::make($file);

        foreach($this->resize AS $size)
        {
            $image->resize(null,$size, function ($c)
            {
                $c->aspectRatio();
            })->save($this->path . "/$size/{$url}");
        }

        $image = Image::make($file);

        foreach($this->cut AS $size)
        {
            $image->fit($size[0],$size[1])->save($this->path ."/{$size[1]}/{$url}");

        }


        $image = Image::make($file);

        foreach($this->fit AS $size)
        {
            $image->fit($size)->save($this->path ."/{$size}/{$url}");

        }
    }

    private function createDirectories()
    {
        foreach($this->directories AS $dir)
        {
            Storage::disk('local')->makeDirectory('public/userImages/'.$dir);
        }
    }

    public function getSizes()
    {
        $sizes = array_merge($this->resize,$this->fit);

        foreach($this->cut AS $size)
        {
            $sizes[] = $size[1];
        }

        return $sizes;
    }

    public static function getUrl($size, $name = null)
    {
        if(!$name) {
            return "/img/unknown.jpg";
        }

        return Config::get('filesystems.disks.s3.endpoint') . $size .'/'.$name;
    }

    public function getUrls($size, $user_id = null)
    {
        $user_id = $user_id ?: Auth::id();

        $urls = [];
        $i = 0;

        $images = Model::where('user_id', '=', $user_id)
                        ->orderBy('main', 'desc')
                        ->orderBy('id', 'desc')
                        ->get();

        foreach($images as $image)
        {
            $urls[$i]['id'] = $image->id;
            $urls[$i]['url'] = self::getUrl($size, $image->url);
            $urls[$i]['main'] = $image->main;
            $i++;
        }

        if(empty($images)) {
            $urls[]['url'] = self::getUrl($size);
        }
        
     
        return $urls;
    }

    public function setMain($id)
    {
        $user = Auth::user();

        Model::where('user_id', '=', $user->id)->update(['main' => 0]);

        $image = Model::whereRaw('id = ? and user_id = ?', [$id, $user->id])->firstOrFail();
        $image->main = 1;
        $image->save();

    }

    protected function isMain()
    {
        if(Model::whereRaw('user_id = ? and main = 1', [ Auth::id() ])->first())
            return 0;
        
        return 1;
    }

}
