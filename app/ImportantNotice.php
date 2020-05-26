<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportantNotice extends Model
{
    protected $fillable = ['title', 'description', 'status'];
}
