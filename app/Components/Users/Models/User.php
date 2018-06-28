<?php

namespace Handytravelers\Components\Users\Models;

use Carbon\Carbon;
use Handytravelers\Components\Homes\Models\Home;
use Handytravelers\Components\Homes\Models\Invitation;
use Handytravelers\Components\Homes\Models\Request;
use Handytravelers\Components\Images\Models\Image;
use Handytravelers\Components\Payments\Models\Payment;
//use Handytravelers\Components\Payments\Traits\Billable;
use Handytravelers\Components\Places\Models\Place;
use Handytravelers\Components\Users\Models\Language;
use Handytravelers\Components\Users\Traits\Messagable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Messagable, SoftDeletes; //Billable

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'username', 'gender', 'date_of_birth', 'about', 'place_id',
        'facebook_id', 'locale', 'timezone', 'verified'
    ];

    protected $dates = ['date_of_birth'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'stripe_id', 'facebook_id'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['first_name', 'gender', 'uuid'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->verified) {
                $user->token = str_random(30);
            }
        });
    }
    
    /**
     * Fetch a user by their email.
     * 
     * @param  string $email
     * @return User
     */
    public static function byFacebookId($id)
    {
        return static::where('facebook_id', '=', $id)->first();
    }

    /**
     * Fetch a user by their email.
     * 
     * @param  string $email
     * @return User
     */
    public static function byEmail($email)
    {
        return static::where('email', '=', $email)->first();
    }

    public static function getByWordpressId($wordpressId)
    {
        return static::where('wordpress_id', '=', $wordpressId)->first();
    }
    

    public static function getHomeId($userId)
    {
        return static::where('id', $userId)->firstOrFail()->home_id;
    }

    /**
     * Set Date of Birth when register or edit
     * @param $dateOfBirth
     */
    public function setDateOfBirthAttribute($dateOfBirth)
    {
        if (!$dateOfBirth) {
            return true;
        }
        
        if ($dateOfBirth instanceof Carbon) {
            $this->attributes['date_of_birth'] = $dateOfBirth;

            return true;
        }

        try {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat('m/d/Y', $dateOfBirth)->toDateString();
        } catch (\InvalidArgumentException $e) {
            try {
                $this->attributes['date_of_birth'] = Carbon::parse($dateOfBirth)->toDateString();
            } catch (\Exception $e) {
                return true;
            }
        } catch (\Exception $e) {
            return true;
        }

        return true;
    }

    public function filled()
    {
        if ($this->about && $this->date_of_birth && $this->place_id && $this->last_name) {
            return true;
        }

        return false;
    }

    public function isNew()
    {
        if ($this->created_at->isToday()) {
            return true;
        }

        return false;
    }

    public function getMainPhoto($size = '150')
    {
        if ($this->images->first()) {
            return $this->images->first()->getUrl($size);
        }

        return "/img/unknown.jpg";
    }

    public function getNameAttribute()
    {
        return $this->attributes['first_name'];
    }

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    public function from()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->latest('main');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'sent_by');
    }
}
