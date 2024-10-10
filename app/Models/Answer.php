<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['answer', 'is_correct', 'question_id'];

    // Kapcsolat a kérdéssel (egy válasz egy kérdéshez tartozik)
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }

    // Kapcsolat a teszteredményekkel (egy válasz több teszteredményben szerepelhet)
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
