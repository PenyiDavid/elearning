<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['question', 'subject_id', 'score'];

    // Kapcsolat a válaszokkal (egy kérdéshez több válasz tartozik)
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Kapcsolat a tantárggyal (egy kérdés egy tantárgyhoz tartozik)
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Kapcsolat a teszteredményekkel (egy kérdéshez több eredmény kapcsolódhat)
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
