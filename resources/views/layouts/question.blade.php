@extends('layouts.app')

@section('content')

<div class="container">

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif
    @if (\Session::has('error'))
    <div class="alert alert-danger">
        <p>{{\Session::get('error')}}</p>
    </div>
    @endif
    <br>

    <form action="{{ route('store') }}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2> <b>إضافة سؤال رئيسي وفرعي</b></h2></div>
                    <div class="container">
                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <div>
                                    <label for="exampleFormControlInput1" class="form-label">اسم القسم</label>
                                    <input type="text" class="form-control" value = "{{$course->department_name}}" name="course_name" readonly>
                                    <input type="hidden" class="form-control" value = "{{$course->id}}" name="course_id" >
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <label class="form-label">اسم الدورة</label>
                                <input type="text" class="form-control" value = "{{$course->course_name}}" name="course_name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">رابط الدورة</label>
                                <input type="text" class="form-control" value = "{{$course->course_url}}" name="course_url" readonly>
                            </div>
                        </div>

                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <label class="form-label">مستوى السؤال</label>
                                <select class="form-select" name =question_level aria-label="Default select example">
                                    <option selected value="meduim">متوسط</option>
                                    <option value="hard">صعب</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">رقم الفيديو</label>
                                <input type="text" class="form-control" name="video_number" value ="{{Session::get('video_number') }}" placeholder="رقم الفيديو">
                                @error('video_number')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">السؤال الأساسي</label>
                                <textarea class="form-control" name="question_text" placeholder="نص السؤال الأساسي" rows="2">{{Session::get('question_text') }}</textarea>
                                @error('question_text')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    الخيارات
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        الخيار
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        الجواب
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    A
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{Session::get('answer_a') }}" name="answer_a" placeholder="نص الخيار A">
                                        @error('answer_a')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('correct_answer')=='A')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="A">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    B
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{Session::get('answer_b') }}" name="answer_b" placeholder="نص الخيار B">
                                        @error('answer_b')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('correct_answer')=='B')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="B">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="B">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    C
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{Session::get('answer_c') }}" name="answer_c" placeholder="نص الخيار C">
                                        @error('answer_c')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('correct_answer')=='C')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="C">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="C">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @error('correct_answer')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">السؤال الفرعي</label>
                                <textarea class="form-control" name="sub_question_text" placeholder="نص السؤال الفرعي" rows="2">{{Session::get('sub_question_text') }}</textarea>
                                @error('sub_question_text')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    الخيارات
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        الخيار
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        الجواب
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    A
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{Session::get('sub_answer_a') }}" name="sub_answer_a" placeholder="نص الخيار A">
                                        @error('sub_answer_a')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('sub_correct_answer')=='A')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="A">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer" value="A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    B
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{Session::get('sub_answer_b') }}" name="sub_answer_b" placeholder="نص الخيار B">
                                        @error('sub_answer_b')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('sub_correct_answer')=='B')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="B">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer" value="B">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    C
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" name="sub_answer_c" value ="{{Session::get('sub_answer_c') }}" placeholder="نص الخيار C">
                                        @error('sub_answer_c')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if (Session::get('sub_correct_answer')=='C')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="C">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer"  value="C">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @error('sub_correct_answer')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group row mb-0 ">
                            <div class="col-md-12 text-center my-2">
                                <button type="submit" class="btn btn-dark ">
                                    إضافة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<br>
<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2> <b>الأسئلة المضافة</b></h2></div>

                <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">رقم السؤال</th>
                            <th scope="col">نص السؤال </th>
                            <th scope="col">الإجابة A</th>
                            <th scope="col">الإجابة B</th>
                            <th scope="col">الإجابة C</th>
                            <th scope="col">الإجابة الصحيحة</th>
                            <th scope="col">رقم الفيديو</th>
                            <th scope="col">مستوى السؤال</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            @if ($loop->odd)
                                <tr class="table-secondary">
                                    <th scope="row">{{$question->id}}-A </th>
                                    <th scope="row">{{$question->question_text}}</th>
                                    <th scope="row">{{$question->answer_a}}</th>
                                    <th scope="row">{{$question->answer_b}}</th>
                                    <th scope="row">{{$question->answer_c}}</th>
                                    <th scope="row">{{$question->correct_answer}}</th>
                                    <th scope="row">{{$question->video_number}}</th>
                                    <th scope="row">{{$question->question_level}}</th>
                                </tr>
                            @else
                            <tr class="table-light">
                                <th scope="row">{{$question->id-1}}-B</th>
                                <th scope="row">{{$question->question_text}}</th>
                                <th scope="row">{{$question->answer_a}}</th>
                                <th scope="row">{{$question->answer_b}}</th>
                                <th scope="row">{{$question->answer_c}}</th>
                                <th scope="row">{{$question->correct_answer}}</th>
                                <th scope="row">{{$question->video_number}}</th>
                                <th scope="row">{{$question->question_level}}</th>
                            </tr>

                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center" class="text-secondary">
                        {!! $questions->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
