<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div class="form-row">
                    <div class="col-md-1"><h4>Search Type:</h4></div>
                    <div class="col-md-3">
                      <select class="form-control" id="search_type" v-model="search_type_field">
                      <option value="null" disabled selected hidden>Select Search Type</option>
                      <option value="COMPLIANCE_ID">Compliance ID</option>
                      <option value="PHONE_NUMBER">Phone Number</option>
                      <option value="MYWU_Number">My WU Number</option>
                    </select>
                    </div>
                    <div class="col-md-2">
                      <input type="text" class="form-control" id="search_type" v-model="search_type" placeholder="">
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary btn-dashboard" @click="refreshTransactions"><i class="fas fa-search"></i></button>
                    </div>
                </div>

                <hr>

                <h4 class="mt-3 mb-3">Basic Information</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reference_no">Reference No.
                        </label>
                        <input type="text" class="form-control" id="reference_no" v-model="form.reference_no" placeholder="" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="my_wu_no">My WU No.
                        </label>
                        <input type="text" class="form-control" id="my_wu_no" v-model="form.my_wu_no" placeholder="" readonly>
                    </div>
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
          contact_country_code: ''
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
    },
    mounted() {
      document.getElementById('loading').style.display = 'none';
    },
    methods: {
      submitEnroll() {
        document.getElementById('loading').style.display = 'block';
        axios.post('/admin/api/enroll-customer', this.form)
        .then((response) => {
          // handle success
          if(response.data.foreign_remote_system.reference_no) {
          document.getElementById('loading').style.display = 'none';

            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Customer has been successfully enrolled.',
              showConfirmButton: true,
            })

            this.form.first_name = '';
            this.form.last_name = '';
            this.form.address = '';
            this.form.city = '';
            this.form.postal_code = '';
            this.form.country_code = '';
            this.form.currency_code = '';
            this.form.destination_country_code = '';
            this.form.destination_currency_code = '';
            this.form.sender_currency_code = '';
            this.form.phone_number = '';

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
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: '' + error
            })
          }
          


          document.getElementById('loading').style.display = 'none';
        })
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