<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the contact for the user.
     */
    public function contact()
    {
        return $this->hasMany('App\Contact');
    }

    /**
     * Get the address for the user.
     */
    public function address()
    {
        return $this->hasMany('App\Address');
    }

    /**
     * Get the license for the user.
     */
    public function license()
    {
        return $this->hasMany('App\License');
    }
}
