<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'prepayments' => 'int',
        'cash' => 'float'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string|array $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(403, 'Esta acción no esta autorizada.');
        }

        return $this->hasRole($roles) ||
            abort(403, 'Esta acción no esta autorizada.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Get Name of user
     * @param int $id the user's id
     *
     * @return string
     */
    public static function getName(int $id)
    {
        return User::where('id', $id)->value('name');//->get()->first();
    }

    /**
     * Get Name of user
     *
     * @return array(
     */
    public static function getClients()
    {
        return User::all()->filter(function ($user) {
            return $user->hasRole('client');
        });
        // return User::whereNotIn('email', ['e.alvarez.alcocer@gmail.com','admin@hive.online'])->get();
    }

}
