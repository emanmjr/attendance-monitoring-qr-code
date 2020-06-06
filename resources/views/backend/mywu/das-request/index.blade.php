@extends('backend.layouts.app')

@section('title', app_name() . ' | DAS Request')

@section('content')
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <das-request></das-request>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
