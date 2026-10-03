<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceStandard extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'konten',
        'icon',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function scopeAktif($query)
    {
        return $query->where('status', true)->orderBy('urutan');
    }
}
