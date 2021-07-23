<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Todolist', 'body', 'id');
    }
}
