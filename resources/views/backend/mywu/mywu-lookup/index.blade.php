@extends('backend.layouts.app')

@section('title', app_name() . ' | MYWU LOOKUP')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <my-wu-lookup></my-wu-lookup>
        </div><!--col-->
    </div><!--row-->
@endsection
