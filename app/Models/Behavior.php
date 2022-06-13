<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hidden',
    ];
    protected $appends = ['human_name'];

    public function getHumanNameAttribute()
    {
        return strtoupper(str_replace('_', ' ', $this->name));
    }

    public function ScopeShowing($query)
    {
        return $query->where('hidden', 0);
    }
}
