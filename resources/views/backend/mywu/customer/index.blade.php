@extends('backend.layouts.app')

@section('title', app_name() . ' | Customer')



@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    Customer <small class="text-muted"></small>
                    <hr>
                </h4>
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-3">
            <div class="col-md-2">
                <div class="form-group">
                    <select class="form-control" v-model="field_type">
                        <option value="null" disabled selected hidden>Select Field</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="mobile">Mobile</option>
                        <option value="address">Address</option>
                        <option value="user_id">User ID</option>
                        <option value="registered_date">Registered Date of User</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="search_string">
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-light" @click="filterTransaction"><i class="fas fa-search"></i></button>
            </div>
            <div class="col-md-2"></div>
            
        </div>

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>User ID</th>
                            <th>Registered Date of User</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="btn-td"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{--  {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}  --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{--  {!! $users->render() !!}  --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
