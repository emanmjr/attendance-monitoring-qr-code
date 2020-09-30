@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.users.management')
                    {{-- <small class="text-muted">@lang('labels.backend.access.users.view')</small> --}}
                    <small class="text-muted">View Attendance</small>
                </h4>
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-4">
            <div class="col-sm-5">
                <a href="{{ route('admin.file-export.employee.attendance', $user->id) }}"><button class="btn btn-primary btn-sm">Export Attendance</button></a>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                {{-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        @include('backend.auth.user.show.tabs.overview')
                    </div><!--tab-->
                </div><!--tab-content--> --}}
                <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Date and Time</th>
                      <th>Time In</th>
                      <th>Time Out</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($userAttendance as $value)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('Y-d-m') }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->time_in)->format('g:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->time_out)->format('g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                {{-- {{ $userAttendance->links() }} --}}
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            {{-- <div class="col">
                <small class="float-right text-muted">
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ timezone()->convertToLocal($user->created_at) }} ({{ $user->created_at->diffForHumans() }}),
                    <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ timezone()->convertToLocal($user->updated_at) }} ({{ $user->updated_at->diffForHumans() }})
                    @if($user->trashed())
                        <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ timezone()->convertToLocal($user->deleted_at) }} ({{ $user->deleted_at->diffForHumans() }})
                    @endif
                </small>
            </div><!--col--> --}}
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection
