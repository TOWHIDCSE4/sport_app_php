<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public $table = 'likes';

    public $orderable = [
        'source_id',
        'source_type',
        'target_id',
        'target_type',
    ];

    public $filterable = [
        'source_id',
        'source_type',
        'target_id',
        'target_type',
    ];

    protected $fillable = [
        'source_id',
        'source_type',
        'target_id',
        'target_type',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }
}
