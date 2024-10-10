<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
     // Mass assignable attribútumok
     protected $fillable = ['subject'];

     // Kapcsolat a kérdésekkel (egy tantárgyhoz több kérdés tartozik)
     public function questions()
     {
         return $this->hasMany(Question::class);
     }
 
     // Kapcsolat a teszteredményekkel
     public function scores()
     {
         return $this->hasMany(Score::class);
     }
}
