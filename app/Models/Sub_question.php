<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_question extends Model
{
    use HasFactory;

    protected $fillable = [

        'question_text',
        'answer_a',
        'answer_b',
        'answer_c',
        'correct_answer',
        'primary_question_id'
    ];


    public function primary_question()
    {
    	return $this->belongsTo('App\Models\Primary_question', 'primary_question_id','id');
    }


}
