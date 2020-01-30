<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo('App\Users');
    }
}
