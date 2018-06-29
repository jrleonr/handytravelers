<?php

namespace Handytravelers\Components\Images\Models;

use Handytravelers\Components\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUrl($size = '150')
    {
        return Storage::disk('s3')->url('profiles/'. $size .'/'.$this->url);
    }
}
