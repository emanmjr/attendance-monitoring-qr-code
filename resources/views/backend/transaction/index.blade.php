@extends('backend.layouts.app')

@section('title', app_name() . ' | Transactions')

@section('breadcrumb-links')
    {{--  @include('backend.auth.user.includes.breadcrumb-links')  --}}
@endsection

@section('content')
<div class="card">
    
    <transactions current-page="{{ ucfirst(Request::segment(3)) }}"></transactions>
</div><!--card-->
@endsection
