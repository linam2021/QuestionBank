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
    <form action="{{ route('addDepartment') }}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2> <b>إضافة مسار جديد </b></h2></div>
                    <div class="col-md-12">
                        <div class="col-md-8 my-2">
                            <label class="form-label">اسم المسار</label>
                            <input type="text" class="form-control" name="department_name" value ="{{Session::get('department_name') }}" placeholder="ادخل اسم المسار">
                            @error('department_name')
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
            <div class="card-header"><h2> <b>المسارات المضافة</b></h2></div>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم المسار</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $dept)
                            <tr class="table-light">
                                <th scope="row">{{$dept->id}}</th>
                                <td>{{$dept->department_name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center" class="text-secondary">
                    {!! $departments->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center">
    <div class="form-group row mb-0 ">
        <div class="col-md-12 text-center my-2">
            <a class="btn btn-dark" href="{{route('showCourses')}}" role="button">إضافة دورات</a>
        </div>
    </div>
</div>

<div class="container">

</div>
@endsection
