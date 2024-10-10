<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['email', 'subject_id', 'question_id', 'answer_id', 'is_correct', 'score'];

    // Kapcsolat a kérdéssel (egy teszteredmény egy kérdéshez kapcsolódik)
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Kapcsolat a válasszal (egy teszteredmény egy válaszhoz kapcsolódik)
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    // Kapcsolat a tantárggyal (egy teszteredmény egy tantárgyhoz kapcsolódik)
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
