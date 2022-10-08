<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function classSubjects() {
        return $this->belongsToMany('ClassSubject::class');
    }

    public function grades() {
        return $this->hasMany('Grades::class');
    }
}
