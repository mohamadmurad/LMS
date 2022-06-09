<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        self::deleting(function (Module $module) {


        });;
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'subject_id',
    ];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
