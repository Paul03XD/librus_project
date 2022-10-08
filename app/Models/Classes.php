<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function users() {
        return $this->hasMany('User::class')->orderBy('name', 'ASC');
    }

    public function classSubjects() {
        return $this->belongsToMany('ClassSubject::class');
    }
}
