@extends('backend.layouts.app')

@section('title', app_name() . ' | Enrollment')

@section('content')
    <div class="row mt-1">
        <div class="col">
            <div class="card">
                {{--  <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->  --}}
                <div class="card-body">
                    <form>
                        <h4 class="mt-3">Basic Information</h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="my_wu_no">My WU&#8480;
                                No.<span style="color:red;">*</span>
                                </label>
                                <input type="text" class="form-control" id="my_wu_no" placeholder="My WU&#8480; No.">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="last_name">Last Name<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="date_of_birth">Date of Birth<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="occupation_business">Occupation/Nature of Business<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="occupation_business" name="occupation_business">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position" name="position">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name_of_employer_business">Name of Employer/Name of Business<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="name_of_employer_business" name="name_of_employer_business">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Employed or With Business?</label>
                                <div class="col-md-12 mt-1">
                                    <div class="form-check" style="display: inline;">
                                        <input class="form-check-input" type="radio" name="employed_wbusiness" id="employed_wbusiness1" value="">
                                        <label class="form-check-label" for="employed_wbusiness1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check ml-2" style="display: inline;">
                                        <input class="form-check-input" type="radio" name="employed_wbusiness" id="employed_wbusiness2" value="">
                                        <label class="form-check-label" for="employed_wbusiness2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                    
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="tin">Tin</label>
                                <input type="text" class="form-control" id="tin" name="tin">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="sss_gsis">SSS OR GSIS</label>
                                <input type="text" class="form-control" id="sss_gsis" name="sss_gsis">
                            </div>
                        </div>
                        <h4 class="mt-3">Contact Information</h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="country_code">Country Code<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="country_code" name="country_code">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="area_mobile">Area Code + Mobile Number<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="area_mobile" name="area_mobile">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="present_add_1">Present Address (Line 1)<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="present_add_1" name="present_add_1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="present_add_2">Present Address (Line 2)</label>
                                <input type="text" class="form-control" id="present_add_2" name="present_add_2">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country_1">Country</label>
                                <input type="text" class="form-control" id="country_1" name="country_1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Is Permanet Address is the same with Present Address?</label>
                            <div class="col-md-12 mt-1">
                                <div class="form-check" style="display: inline;">
                                    <input class="form-check-input" type="radio" name="employed_wbusiness" id="employed_wbusiness1" value="">
                                    <label class="form-check-label" for="employed_wbusiness1">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check ml-2" style="display: inline;">
                                    <input class="form-check-input" type="radio" name="employed_wbusiness" id="employed_wbusiness2" value="">
                                    <label class="form-check-label" for="employed_wbusiness2">
                                        No
                                    </label>
                                </div>
                            </div> 
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="present_add_1">Present Address (Line 1)<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="present_add_1" name="present_add_1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="present_add_2">Present Address (Line 2)</label>
                                <input type="text" class="form-control" id="present_add_2" name="present_add_2">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country_1">Country</label>
                                <input type="text" class="form-control" id="country_1" name="country_1">
                            </div>
                        </div>

                        <h4 class="mt-3">Opt In / Opt Out</h4>
                        <hr>
                        <div class="form-group">
                            <label for="">How do you want us to get in touch with you and receive news and updates about My WU&#8480;
                            ?</label>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="opt_mobile_no">
                                    <label class="form-check-label" for="opt_mobile_no">
                                    Mobile Number
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="opt_email">
                                    <label class="form-check-label" for="opt_email">
                                    Email
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <button type="button" class="btn btn-primary btn-dashboard">Enroll Now</button>
                      </form>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
