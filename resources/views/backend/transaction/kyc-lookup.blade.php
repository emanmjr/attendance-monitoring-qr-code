@extends('backend.layouts.app')

@section('title', app_name() . ' | KYC LOOKUP')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <kyc-lookup></kyc-lookup>
        </div><!--col-->
    </div><!--row-->
@endsection
