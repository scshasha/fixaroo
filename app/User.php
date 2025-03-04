<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


   /**
    * Undocumented variable
    *
    * @var string
    */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['user' => ['id' => $this->id]];
    }


    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
						if (!$this->isBcryptHash($value)) {
							$value = bcrypt($value);
						}
						$this->attributes['password'] = $value;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    // public function user_books() {
    //   return $this->belongsToMany(UserBook::class);
    // }
	
	
	/**
	 * Check if the string looks like a bcrypt hash (used by Laravel)
	 *
	 * @param $hash
	 * @return bool
	 */
		protected function isBcryptHash($hash) {
				$regex = '#^\$2y\$\d{2}\$[./A-Za-z0-9]{53}$#';
				return is_string($hash) && preg_match($regex, $hash) === 1;
		}
}
