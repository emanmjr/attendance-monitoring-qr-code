@extends('backend.layouts.app')

@section('title', app_name() . ' | Enrollment')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <my-wu-enrollment :provinces="{{ json_encode(config('wu-provinces')) }}" :country-codes="{{ json_encode(config('wu-country-codes')) }}" :currency-codes="{{ json_encode(config('wu-currency-codes')) }}"></my-wu-enrollment>
        </div><!--col-->
    </div><!--row-->
@endsection
