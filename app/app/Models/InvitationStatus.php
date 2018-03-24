<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationStatus extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'key'];
}
