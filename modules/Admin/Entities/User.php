<?php

namespace Modules\Admin\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Pingpong\Trusty\Traits\TrustyTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, TrustyTrait, SoftDeletes;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * The fillable property.
     *
     * @var array
     */
    protected $fillable = array('id','name', 'username', 'email', 'password', 'status');
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * Get gravatar url.
     *
     * @param int    $size
     * @param string $default
     * @param string $rating
     *
     * @return string
     */
    public function gravatar($size = 60, $default = 'mm', $rating = 'g')
    {
        $email = $this->email;

        return 'http://www.gravatar.com/avatar/'.md5(strtolower(trim($email)))."?s={$size}&d={$default}&r={$rating}";
    }

    /**
     * Scope "today".
     *
     * @param mixed $query
     *
     * @return mixed
     */
    public function scopeToday($query)
    {
        $sql = 'date(created_at) = date(now())';

        if (db_is('sqlite')) {
            $sql = "date(created_at) = date('now')";
        }

        return $query->whereRaw($sql);
    }
}
