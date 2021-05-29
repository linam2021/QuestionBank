<?php

namespace App\Http\Controllers\QuestionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showQuestions($id)
    {
        try
        {
            $course=DB::table('courses')
            ->join('departments','courses.department_id', '=','departments.id')
            ->select('courses.id','courses.course_name','courses.course_url','departments.department_name')
            ->where('courses.id',$id)
            ->first();

            $questions=DB::table('questions')
            ->select('id','question_text','answer_a','answer_b','answer_c','correct_answer','video_number','question_level')
           // ->where('course_id',$id)
            //->orderByDesc('coursesid')
            ->paginate(10);

            return view('layouts.question')->with(['course'=> $course,'questions'=>$questions]);
        } catch (\Throwable $th) {
            //return redirect()->route('showQuestions', ['id'=>$id])->with('error',$th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try
        {
            $user_id = Auth::id();
            $input = $request->all();
            $validator = Validator::make($input,[
                'question_text'=>'required|unique:questions,question_text',
                'answer_a'=>'required',
                'answer_b'=>'required',
                'answer_c'=>'required',
                'correct_answer'=>'required',
                'video_number'=>'required|numeric',
                'question_level'=>'required',
                'course_id'=>'required',
                'sub_question_text'=>'required|unique:questions,question_text',
                'sub_answer_a'=>'required',
                'sub_answer_b'=>'required',
                'sub_answer_c'=>'required',
                'sub_correct_answer'=>'required'
            ]);

            if( $validator->fails()) {
                Session::flash('question_text', $request->question_text);
                Session::flash('answer_a', $request->answer_a);
                Session::flash('answer_b', $request->answer_b);
                Session::flash('answer_c', $request->answer_c);
                Session::flash('correct_answer', $request->correct_answer);
                Session::flash('video_number', $request->video_number);
                Session::flash('question_level', $request->question_level);
                Session::flash('sub_question_text', $request->sub_question_text);
                Session::flash('sub_answer_a', $request->sub_answer_a);
                Session::flash('sub_answer_b', $request->sub_answer_b);
                Session::flash('sub_answer_c', $request->sub_answer_c);
                Session::flash('sub_correct_answer', $request->sub_correct_answer);
                return redirect()->back()->withErrors($validator);
            }
            else
            {
                $addPQues=Question::create([
                    'question_text'=>$request->question_text,
                    'answer_a'=>$request->answer_a,
                    'answer_b'=>$request->answer_b,
                    'answer_c'=>$request->answer_c,
                    'correct_answer'=>$request->correct_answer,
                    'user_id'=>$user_id,
                    'video_number'=>$request->video_number,
                    'question_level'=>$request->question_level,
                    'course_id'=>$request->course_id
                ]);

                $addSubQues=Question::create([
                    'question_text'=>$request->sub_question_text,
                    'answer_a'=>$request->sub_answer_a,
                    'answer_b'=>$request->sub_answer_b,
                    'answer_c'=>$request->sub_answer_c,
                    'correct_answer'=>$request->sub_correct_answer,
                    'user_id'=>$user_id,
                    'primary_question_id'=>$addPQues->id,
                    'course_id'=>$request->course_id
                ]);
            return redirect()->route('showQuestions', ['id'=>$request->course_id])->with('success','تم إضافة السؤال الأساسي والفرعي بنجاح');
            }
        }catch (\Throwable $th) {
            Session::flash('question_text', $request->question_text);
            Session::flash('answer_a', $request->answer_a);
            Session::flash('answer_b', $request->answer_b);
            Session::flash('answer_c', $request->answer_c);
            Session::flash('correct_answer', $request->correct_answer);
            Session::flash('video_number', $request->video_number);
            Session::flash('question_level', $request->question_level);
            Session::flash('sub_question_text', $request->sub_question_text);
            Session::flash('sub_answer_a', $request->sub_answer_a);
            Session::flash('sub_answer_b', $request->sub_answer_b);
            Session::flash('sub_answer_c', $request->sub_answer_c);
            Session::flash('sub_correct_answer', $request->sub_correct_answer);
            return redirect()->route('showQuestions', ['id'=>$request->course_id])->with('error',$th->getMessage());
        }
    }
}
