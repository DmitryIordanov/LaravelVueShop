<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'title',
        'price',
        'availability',
        'delivery',
        'image',
        'content'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y в H:i');
    }
}
