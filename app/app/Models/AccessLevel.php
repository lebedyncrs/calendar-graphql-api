<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    const READ = 'read';
    const WRITE = 'write';

    protected $fillable = ['name', 'key'];

    public function scopeRead(Builder $query)
    {
        $query->where('key', self::READ);
    }

    public function scopeWrite(Builder $query)
    {
        $query->where('key', self::WRITE);
    }
}
