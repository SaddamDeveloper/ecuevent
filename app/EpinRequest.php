<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpinRequest extends Model
{
    protected $table = 'epin_requests';
    protected $fillable = ['epin_request', 'comment', 'added_by'];
}
