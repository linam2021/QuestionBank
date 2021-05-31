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
        <form action="{{ route('addCourse') }}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2> <b>إضافة دورة جديدة </b></h2></div>
                        <div class="col-md-12">
                            <div class="col-md-8 my-2">
                                <label for="exampleFormControlInput1" class="form-label">اسم المسار</label>
                                <select class="form-select" name =department_id aria-label="Default select example">
                                    @foreach ($departments as $department)
                                        @if ($department->id == Session::get('department_id'))
                                            <option selected value="{{$department->id}}">{{$department->department_name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8 my-2">
                                <label class="form-label">اسم الدورة</label>
                                <input type="text" class="form-control" name="course_name" value ="{{Session::get('course_name') }}" placeholder="ادخل اسم الدورة">
                                @error('course_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-8 my-2">
                                <label class="form-label">رابط الدورة</label>
                                <input type="text" class="form-control" name="course_url" value ="{{Session::get('course_url') }}" placeholder="ادخل رابط الدورة">
                                @error('course_url')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group row mb-0 ">
                                    <div class="col-md-12 text-center my-2">
                                        <button type="submit" class="btn btn-dark">
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
    </div>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2> <b>الدورات المضافة</b></h2></div>
                    <table class="table table-dark table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم المسار</th>
                            <th scope="col">اسم الدورة</th>
                            <th scope="col">رابط الدورة</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="table-light">
                                    <th scope="row">{{$course->id}}</th>
                                    <td>{{$course->department_name}}</td>
                                    <td>{{$course->course_name}}</td>
                                    <td>{{$course->course_url}}</td>
                                    <td>
                                        <a href="{{route('showQuestions', ['id'=>$course->id])}}" class="btn btn-dark"> إضافة أسئلة</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center" class="text-secondary">
                        {!! $courses->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
