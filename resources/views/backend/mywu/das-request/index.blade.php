@extends('backend.layouts.app')

@section('title', app_name() . ' | DAS Request')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <das-request :country-codes="{{ json_encode(config('wu-country-codes')) }}" :currency-codes="{{ json_encode(config('wu-currency-codes')) }}"></das-request>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
