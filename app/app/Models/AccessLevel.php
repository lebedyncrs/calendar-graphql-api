<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    const READ = 'read';
    const WRITE = 'write';
    /**
     * @var array
     */
    protected $fillable = ['name', 'key'];

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeRead(Builder $query): void
    {
        $query->where('key', self::READ);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeWrite(Builder $query)
    {
        $query->where('key', self::WRITE);
    }
}
