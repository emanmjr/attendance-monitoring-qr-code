<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div class="form-row">
                    <!-- <div class="col-md-2"><h3>Category Type:</h3></div> -->
                    <div class="col-md-3">
                      <select class="form-control" id="search_type" v-model="search.search_type_field">
                      <option value="" disabled selected hidden>Select Category</option>
                      <option value="COMPLIANCE_ID">Compliance ID</option>
                      <option value="PHONE_NUMBER">Phone Number</option>
                      <option value="MYWU_NUMBER">My WU Number</option>
                    </select>
                    </div>
                    <!-- <div class="col-md-3">
                      <select class="form-control" id="single_multifind" v-model="search.single_multifind">
                        <option value="" disabled selected hidden>Select Type</option>
                        <option value="S">Single</option>
                        <option value="M">Multiple Find</option>
                      </select>
                    </div> -->
                    
                </div>
                <div class="form-row mt-4">
                    <div v-if="showSearchFirstName" class="form-group col-md-2">
                      <label for="search_first_name">First Name
                      </label>
                      <input type="text" class="form-control" id="search_first_name" v-model="search.first_name" placeholder="">
                    </div>
                    <div v-if="showSearchLastName" class="form-group col-md-2">
                      <label for="search_last_name">Last Name
                      </label>
                      <input type="text" class="form-control" id="search_last_name" v-model="search.last_name" placeholder="">
                    </div>
                    <div v-if="showSearchMyWUNo"  class="form-group col-md-2">
                      <label for="search_my_wu_number">My WU No.
                      </label>
                      <input type="text" class="form-control" id="search_my_wu_number" v-model="search.my_wu_number" placeholder="">
                    </div>
                    <div v-if="showSearchIdType" class="form-group col-md-2">
                      <label for="search_id_type">ID Type
                      </label>
                      <select class="form-control" id="id_type" v-model="search.id_type">
                        <option value="null" disabled selected hidden>Select Search Type</option>
                        <option value="A">Passport</option>
                        <option value="B">National ID</option>
                        <option value="C">Drive License</option>
                        <option value="E">Work Permit</option>
                        <option value="Q">Asylum Seeker Temp Residence Permit</option>
                      </select>
                      <!-- <input type="text" class="form-control" id="search_id_type" v-model="search.id_type" placeholder=""> -->
                    </div>
                    <div v-if="showSearchIdNum" class="form-group col-md-2">
                      <label for="search_id_num">ID Number
                      </label>
                      <input type="text" class="form-control" id="search_id_num" v-model="search.id_num" placeholder="">
                    </div>
                    <div v-if="showSearchPhoneNum" class="form-group col-md-2">
                      <label for="search_phone_num">Phone Number
                      </label>
                      <input type="text" class="form-control" id="search_phone_num" v-model="search.phone_num" placeholder="">
                    </div>
                    <div v-if="showSearchTypeButton" class="form-group col-md-2">
                      <button type="button" style="margin-top: 28px;" class="btn btn-primary btn-dashboard" @click="searchKYC"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <hr>

                <h4 class="mt-3 mb-3">Customer Information</h4>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="reference_no">Reference No.
                        </label>
                        <input type="text" class="form-control" id="reference_no" v-model="form.reference_no" placeholder="" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="my_wu_no">My WU No.
                        </label>
                        <input type="text" class="form-control" id="my_wu_no" v-model="form.my_wu_no" placeholder="" readonly>
                    </div>
                </div>
                <div class="form-row" v-if="form.total_earned_points">
                    <div class="form-group col-md-3">
                        <label for="my_wu_no">Total Earned Points
                        </label>
                        <input type="text" class="form-control" id="total_earned_points" v-model="form.total_earned_points" placeholder="" readonly>
                    </div>
                    <!-- <div class="form-group col-md-3">
                        <label for="my_wu_no">Is KYCED?
                        </label>
                        <input type="text" class="form-control" id="is_kyced" v-model="form.is_kyced" placeholder="" readonly>
                    </div> -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" v-model="form.first_name" readonly>
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" v-model="form.middle_name">
                    </div> -->
                    <div class="form-group col-md-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" v-model="form.last_name" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="address_type">Address Type</label>
                        <input type="text" class="form-control" id="address_type" v-model="form.address_type" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" v-model="form.address" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" v-model="form.city" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" v-model="form.postal_code" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="contact_country_code">Contact No. Country Code</label>
                        <input type="text" class="form-control" id="contact_country_code" v-model="form.contact_country_code" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" v-model="form.phone_number" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_code">Country Code</label>
                        <input type="text" class="form-control" id="country_code" v-model="form.country_code" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_name">Country Name Code</label>
                        <input type="text" class="form-control" id="country_name" v-model="form.country_name" readonly>
                    </div>
                </div>
                <hr>
                <div v-if="this.receiversCount()">
                  <h4 class="mt-3 mb-3">Receivers Information</h4>
                  <div class="form-row" v-for="receiver in receivers">
                    <div class="form-group col-md-3">
                        <label for="contact_country_code">First Name</label>
                        <input type="text" class="form-control" id="contact_country_code" v-model="receiver.name.first_name" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone_number">Last Name</label>
                        <input type="text" class="form-control" id="phone_number" v-model="receiver.name.last_name" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_code">Country Code</label>
                        <input type="text" class="form-control" id="country_code" v-model="receiver.address.country_details.ctry_code" readonly>
                    </div>
                </div>
                </div>
                
                

                <!-- </form> -->
        </div><!--card-body-->
    </div><!--card-->
</template>

<script>
export default {
    data() {
      return {
        is_employed_wbusiness: false,
        is_permanent: false,
        receivers: {},
        form: {
          reference_no: '',
          my_wu_no: '',
          first_name: '',
          last_name: '',
          address: '',
          city: '',
          postal_code: '',
          country_code: '',
          country_name: '',
          phone_number: '',
          address_type: '',
          contact_country_code: '',
          total_earned_points: '',
          // is_kyced: ''
        },
        search: {
          first_name: '',
          last_name: '',
          my_wu_number: '',
          id_type: '',
          id_num: '',
          phone_num: '',
          search_type_field: '',
          single_multifind: '',
        },
        
        showSearchFirstName: false,
        showSearchLastName: false,
        showSearchMyWUNo: false,
        showSearchIdType: false,
        showSearchIdNum: false,
        showSearchPhoneNum: false,
        showSearchTypeButton: false,
      }
    },
    watch: {
        checkSearchParam(data){
        this.showSearchTypeButton = true;
        if(data == 'COMPLIANCE_ID') {
          this.showSearchFirstName = true;
          this.showSearchLastName = true;
          this.showSearchMyWUNo = false;
          this.showSearchIdType = true;
          this.showSearchIdNum = true;
          this.showSearchPhoneNum = false;
        }

        if(data == 'PHONE_NUMBER') {
          this.showSearchFirstName = true;
          this.showSearchLastName = true;
          this.showSearchMyWUNo = false;
          this.showSearchIdType = false;
          this.showSearchIdNum = false;
          this.showSearchPhoneNum = true;
          this.search.id_type = '';
          this.search.id_num = '';
          this.search.phone_num ='';
        }

        if(data == 'MYWU_NUMBER') {
          this.showSearchFirstName = true;
          this.showSearchLastName = true;
          this.showSearchMyWUNo = true;
          this.showSearchIdType = false;
          this.showSearchIdNum = false;
          this.showSearchPhoneNum = false;
          this.search.id_type = '';
          this.search.id_num = '';
          this.search.phone_num ='';
        }

      }
    },
    computed: {
      checkSearchParam() {
        return this.search.search_type_field;
      },
      checkEmployedBusiness() {
        return this.form.employed_wbusiness;
      },
      checkPermanentAdd() {
        return this.form.permanent_add;
      }
    },
    mounted() {
      document.getElementById('loading').style.display = 'none';
      this.receiversCount()
    },
    methods: {
      searchKYC() {
        document.getElementById('loading').style.display = 'block';
        axios.post('/admin/api/kyc-lookup', this.search)
        .then((response) => {
          // handle success
          
          if(response.data.faultstring){
            console.log(response.data)
            document.getElementById('loading').style.display = 'none';
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: '' + response.data.faultstring,
              footer: 'No Record found'
            })

            this.form.reference_no = '';
            this.form.my_wu_no = '';
            this.form.first_name = '';
            this.form.last_name = '';
            this.form.address = '';
            this.form.city = '';
            this.form.postal_code = '';
            this.form.country_code = '' ;
            this.form.country_name = '';
            this.form.phone_number = '';
            this.form.address_type = '';
            this.form.contact_country_code = ''
          }else {
            document.getElementById('loading').style.display = 'none';
            console.log(response.data);
          //   Swal.fire({
          //     position: 'top-end',
          //     icon: 'success',
          //     title: 'Customer has been successfully enrolled.',
          //     showConfirmButton: true,
          //   })

          if(this.search.search_type_field == "MYWU_NUMBER"){
            this.form.reference_no = response.data.foreign_remote_system.reference_no ? response.data.foreign_remote_system.reference_no : '';
            this.form.my_wu_no = response.data.customer.mywu_details.mywu_number ? response.data.customer.mywu_details.mywu_number : '';
            this.form.first_name = response.data.customer.name.first_name ? response.data.customer.name.first_name : '';
            this.form.last_name = response.data.customer.name.last_name ? response.data.customer.name.last_name : '';
            this.form.address = response.data.customer.address.addr_line1 ? response.data.customer.address.addr_line1 : '';
            this.form.city = response.data.customer.address.city ? response.data.customer.address.city : '';
            this.form.postal_code = response.data.customer.address.postal_code ? response.data.customer.address.postal_code : '';
            this.form.country_code = response.data.customer.address.country_details.ctry_code ? response.data.customer.address.country_details.ctry_code : '' ;
            this.form.country_name = response.data.customer.address.country_details.ctry_name ? response.data.customer.address.country_details.ctry_name : '';
            this.form.phone_number = response.data.customer.mobile_number ? response.data.customer.mobile_number.National_number : '';
            this.form.address_type = response.data.customer.address.addr_type ? response.data.customer.address.addr_type : '';
            this.form.contact_country_code = response.data.customer.mobile_number ? response.data.customer.mobile_number.ctry_code : ''
            this.form.total_earned_points = response.data.customer.mywu_details ? response.data.customer.mywu_details.current_yr_pts : ''
          } else {
            this.form.reference_no = response.data.foreign_remote_system.reference_no ? response.data.foreign_remote_system.reference_no : '';
            this.form.my_wu_no = response.data.customers.customer.mywu_details.mywu_number ? response.data.customers.customer.mywu_details.mywu_number : '';
            this.form.first_name = response.data.customers.customer.name.first_name ? response.data.customers.customer.name.first_name : '';
            this.form.last_name = response.data.customers.customer.name.last_name ? response.data.customers.customer.name.last_name : '';
            this.form.address = response.data.customers.customer.address.addr_line1 ? response.data.customers.customer.address.addr_line1 : '';
            this.form.city = response.data.customers.customer.address.city ? response.data.customers.customer.address.city : '';
            this.form.postal_code = response.data.customers.customer.address.postal_code ? response.data.customers.customer.address.postal_code : '';
            this.form.country_code = response.data.customers.customer.address.country_details.ctry_code ? response.data.customers.customer.address.country_details.ctry_code : '' ;
            this.form.country_name = response.data.customers.customer.address.country_details.ctry_name ? response.data.customers.customer.address.country_details.ctry_name : '';
            this.form.phone_number = response.data.customers.customer.mobile_number ? response.data.customers.customer.mobile_number.National_number : '';
            this.form.address_type = response.data.customers.customer.address.addr_type ? response.data.customers.customer.address.addr_type : '';
            this.form.contact_country_code = response.data.customers.customer.mobile_number ? response.data.customers.customer.mobile_number.ctry_code : ''
            this.form.total_earned_points = response.data.customers.customer.mywu_details ? response.data.customers.customer.mywu_details.current_yr_pts : ''
          }
            // this.form.iskyced = response.data.customer.kyc_details ? response.data.customer.kyc_details.is_kyced : ''

            this.receivers = response.data.receivers ? response.data.receivers.receiver : {};
          }
        })
        .catch((error) => {
          if( error.response.status == 422 ){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: 'All fields are required, kindly fill up all the fields.'
            })
            document.getElementById('loading').style.display = 'none';
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Can you please try again.',
              footer: '' + error
            })

            document.getElementById('loading').style.display = 'none';
          }

          
        })
      },
      receiversCount() {
        if(this.receivers.length > 0){
          return true;
        } else {
          return false;
        }
      }
    }
}
</script>

<style lang="scss" scoped>
    .no-transact {
        text-align: center;
    }

    .table-striped{
        font-size: 12px;
    }

    .table-striped td{
        padding-top: 0px;
        padding-bottom: 0px;
    }

    #loading {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        position: fixed;
        display: block;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
        text-align: center;
    }

    #loading-image {
        position: absolute;
        top: 50%;
        left: 54%;
        z-index: 100;
    }

    .tbl-main td {
        text-align: center;
    }   
</style>