<template>
    <div class="card">
        <div class="card-body">
            <form>
                <h4 class="mt-3">Basic Information</h4>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="my_wu_no">My WU&#8480;
                        No.<span style="color:red;">*</span>
                        </label>
                        <input type="text" class="form-control" id="my_wu_no" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="first_name">First Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="first_name" v-model="form.first_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" v-model="form.middle_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Last Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="last_name" v-model="form.last_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="date_of_birth">Date of Birth<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="date_of_birth" v-model="form.date_of_birth">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="occupation_business">Occupation/Nature of Business<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="occupation_business" v-model="form.occupation_business">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" v-model="form.position">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name_of_employer_business">Name of Employer/Name of Business<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="name_of_employer_business" v-model="form.name_of_employer_business">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Employed or With Business?</label>
                        <div class="col-md-12 mt-1">
                            <div class="form-check" style="display: inline;">
                                <input class="form-check-input" type="radio" v-model="form.employed_wbusiness" id="employed_wbusiness1" value="1" >
                                <label class="form-check-label" for="employed_wbusiness1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check ml-2" style="display: inline;">
                                <input class="form-check-input" type="radio" v-model="form.employed_wbusiness" id="employed_wbusiness2" value="0">
                                <label class="form-check-label" for="employed_wbusiness2">
                                    No
                                </label>
                            </div>
                        </div>
                            
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label for="tin">Tin<span v-if="is_employed_wbusiness" style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="tin" v-model="form.tin">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sss_gsis">SSS OR GSIS<span v-if="is_employed_wbusiness" style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="sss_gsis" v-model="form.sss_gsis">
                    </div>
                </div>
                <h4 class="mt-3">Contact Information</h4>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="country_code">Country Code<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="country_code" v-model="form.country_code">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="area_mobile">Area Code + Mobile Number<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="area_mobile" v-model="form.area_mobile">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" v-model="form.email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="present_add_1">Present Address (Line 1)<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="present_add_1" v-model="form.present_add_1">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="present_add_2">Present Address (Line 2)</label>
                        <input type="text" class="form-control" id="present_add_2" v-model="form.present_add_2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="country_1">Country</label>
                        <input type="text" class="form-control" id="country_1" v-model="form.country_1">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Is Permanent Address is the same with Present Address?</label>
                    <div class="col-md-12 mt-1">
                        <div class="form-check" style="display: inline;">
                            <input class="form-check-input" type="radio" v-model="form.permanent_add" id="permanent_add1" value="1">
                            <label class="form-check-label" for="permanent_add1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check ml-2" style="display: inline;">
                            <input class="form-check-input" type="radio" v-model="form.permanent_add" id="permanent_add2" value="0">
                            <label class="form-check-label" for="permanent_add2">
                                No
                            </label>
                        </div>
                    </div> 
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="permanent_1">Permanent Address (Line 1)<span v-if="is_permanent" style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="permanent_add1" v-model="form.permanent_add1">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="permanent_2">Permanent Address (Line 2)</label>
                        <input type="text" class="form-control" id="permanent_add2" v-model="form.permanent_add2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="country_1">Country</label>
                        <input type="text" class="form-control" id="country_2" v-model="form.country_2">
                    </div>
                </div>

                <h4 class="mt-3">Opt In / Opt Out</h4>
                <hr>
                <div class="form-group">
                    <label for="">How do you want us to get in touch with you and receive news and updates about My WU&#8480;
                    ?</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="opt_mobile_no" v-model="form.opt_mobile_no">
                            <label class="form-check-label" for="opt_mobile_no">
                            Mobile Number
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="opt_email" v-model="form.opt_email">
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
</template>

<script>
export default {
    data() {
      return {
        is_employed_wbusiness: false,
        is_permanent: false,
        form: {
          employed_wbusiness: '1',
          permanent_add: '0',
          first_name: '',
          middle_name: '',
          last_name: '',
          date_of_birth: '',
          occupation_business: '',
          position: '',
          name_of_employer_business: '',
          employed_wbusiness: '',
          country_code: '',
          area_mobile: '',
          email: '',
          present_add_1: '',
          present_add_2: '',
          country_1: '',
          permanent_add1: '',
          country_2: '',
          countopt_mobile_nory_2: '',
          opt_email: '',
        }
      }
    },
    watch: {
      checkEmployedBusiness (data) {

        if(data == 1){
          this.is_employed_wbusiness = true;
        } else {
          this.is_employed_wbusiness = false;
        }
      },
      checkPermanentAdd (data) {
        console.log(data)
        if(data == 1){
          this.is_permanent = true;
        } else {
          this.is_permanent = false;
        }
      }
    },
    computed: {
      checkEmployedBusiness() {
        return this.form.employed_wbusiness;
      },
      checkPermanentAdd() {
        return this.form.permanent_add;
      }
    }
}
</script>