@extends('backend.layouts.app')

@section('title', app_name() . ' | PAY STATUS')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <pay-status></pay-status>
        </div><!--col-->
    </div><!--row-->
@endsection
