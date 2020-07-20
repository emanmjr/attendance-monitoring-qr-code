@extends('backend.layouts.app')

@section('title', app_name() . ' | PAY STATUS')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <pay-status :country-codes="{{ json_encode(config('wu-country-codes')) }}" :currency-codes="{{ json_encode(config('wu-currency-codes')) }}"></pay-status>
        </div><!--col-->
    </div><!--row-->
@endsection
