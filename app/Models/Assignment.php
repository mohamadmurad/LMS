<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Assignment extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'name',
        'description',
        'module_id',
        'subject_id',
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
