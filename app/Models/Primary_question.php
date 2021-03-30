<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Primary_question extends Model
{
    use HasFactory;

    protected $fillable = [

        'question_text',
        'answer_a',
        'answer_b',
        'answer_c',
        'correct_answer',
        'user_id',
        'video_number',
        'qestion_level',
        'course_id'
    ];


    public function sub_question ()
    {
    	return $this->hasOne('App\Models\Sub_question', 'primary_question_id','id');
    }

    public function user ()
    {
    	return $this->belongsTo('App\Models\User', 'user_id' ,'id');
    }


    public function course()
    {
    	return $this->belongsTo('App\Models\Primary_question ', 'course_id','id');
    }
}
