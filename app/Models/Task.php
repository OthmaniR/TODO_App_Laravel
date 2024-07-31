<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
            'id',
            'title',
            'description',
            'statut',
            'is_completed',
            'user_id',
            'created_at',
            'updated_at'

        ];

        protected $casts = [
                'is_completed' => 'datetime',
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
        ];
        public $timestamps = false;
}
