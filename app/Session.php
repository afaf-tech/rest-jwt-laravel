<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $table = 'session';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
