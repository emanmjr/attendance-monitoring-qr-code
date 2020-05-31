@extends('backend.layouts.app')

@section('title', app_name() . ' | Enrollment')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <my-wu-enrollment></my-wu-enrollment>
        </div><!--col-->
    </div><!--row-->
@endsection
