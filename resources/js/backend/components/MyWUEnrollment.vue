<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <h4 class="mt-3">Basic Information</h4>
                <hr>
                <div class="form-row">
                    <!-- <div class="form-group col-md-4">
                        <label for="my_wu_no">My WU&#8480;
                        No.<span style="color:red;">*</span>
                        </label>
                        <input type="text" class="form-control" id="my_wu_no" placeholder="">
                    </div> -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="first_name">First Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.first_name ? 'is-invalid' : ''" id="first_name" v-model="form.first_name" required>
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" v-model="form.middle_name">
                    </div> -->
                    <div class="form-group col-md-3">
                        <label for="last_name">Last Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.last_name ? 'is-invalid' : ''"  id="last_name" v-model="form.last_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">Gender<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.gender ? 'is-invalid' : ''" id="gender" v-model="form.gender">
                          <option value="null" disabled selected hidden></option>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="address">Address<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.address ? 'is-invalid' : ''" id="address" v-model="form.address" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city">City<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.city ? 'is-invalid' : ''" id="city" v-model="form.city">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="postal_code">Postal Code<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.postal_code ? 'is-invalid' : ''" id="postal_code" v-model="form.postal_code">
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                        <label for="phone_number">Phone Number<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.phone_number ? 'is-invalid' : ''" id="phone_number" v-model="form.phone_number" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_code">Country Code<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.country_code ? 'is-invalid' : ''" id="country_code" v-model="form.country_code" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="currency_code">Currency Code<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.currency_code ? 'is-invalid' : ''" id="currency_code" v-model="form.currency_code">
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="destination_country_code">Destination Country Code<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" :class="errorResponse.destination_country_code ? 'is-invalid' : ''" id="destination_country_code" v-model="form.destination_country_code">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="destination_currency_code">Currency Code of Destination Country <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" :class="errorResponse.destination_country_code ? 'is-invalid' : ''" id="destination_currency_code" v-model="form.destination_currency_code">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="sender_currency_code">Currency Code of  Money  Being Sent<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" :class="errorResponse.sender_currency_code ? 'is-invalid' : ''" id="sender_currency_code" v-model="form.sender_currency_code">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="originating_country_code">Originating Country Code<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" :class="errorResponse.originating_country_code ? 'is-invalid' : ''" id="originating_country_code" v-model="form.originating_country_code">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="receiver_type">Receiver Type </label>
                      <input type="text" class="form-control" :class="errorResponse.receiver_type ? 'is-invalid' : ''" id="receiver_type" v-model="form.receiver_type">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="transfer_frequency">Transfer Frequency</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_frequency ? 'is-invalid' : ''" id="transfer_frequency" v-model="form.transfer_frequency">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="wu_transfer_frequency">WU Transfer Frequency</label>
                      <input type="text" class="form-control" :class="errorResponse.wu_transfer_frequency ? 'is-invalid' : ''" id="wu_transfer_frequency" v-model="form.wu_transfer_frequency">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="interests">Interests </label>
                      <input type="text" class="form-control" :class="errorResponse.interests ? 'is-invalid' : ''" id="interests" v-model="form.interests">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="mode_to_receive">Mode to Receive</label>
                      <input type="text" class="form-control" :class="errorResponse.mode_to_receive ? 'is-invalid' : ''" id="mode_to_receive" v-model="form.mode_to_receive">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="transfer_reason_1">Transfer Reason 1</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_reason_1 ? 'is-invalid' : ''" id="transfer_reason_1" v-model="form.transfer_reason_1">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="transfer_reason_2">Transfer Reason 2</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_reason_2 ? 'is-invalid' : ''" id="transfer_reason_2" v-model="form.transfer_reason_2">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="id_on_file">ID On File (Y/N)</label>
                      <input type="text" class="form-control" :class="errorResponse.id_on_file ? 'is-invalid' : ''" id="id_on_file" v-model="form.id_on_file">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="preferred_language">Preferred Language (Ex. "EN, "ES")</label>
                      <input type="text" class="form-control" :class="errorResponse.preferred_language ? 'is-invalid' : ''" id="preferred_language" v-model="form.preferred_language">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="card_status">Card Status</label>
                      <input type="text" class="form-control" :class="errorResponse.card_status ? 'is-invalid' : ''" id="card_status" v-model="form.card_status">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="enrollment_source">Enroll Source</label>
                      <input type="text" class="form-control" :class="errorResponse.enrollment_source ? 'is-invalid' : ''" id="enrollment_source" v-model="form.enrollment_source">
                  </div>
                </div>
                <hr>

                <button type="button" class="btn btn-primary btn-dashboard" @click="submitEnroll()">Enroll Now</button>
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
          first_name: '',
          last_name: '',
          gender: '',
          address: '',
          city: '',
          postal_code: '',
          country_code: '',
          currency_code: '',
          destination_country_code: '',
          destination_currency_code: '',
          sender_currency_code: '',
          phone_number: '',
          originating_country_code: '',
          receiver_type: '',
          transfer_frequency: '',
          wu_transfer_frequency: '',
          interests: '',
          mode_to_receive: '',
          transfer_reason_1: '',
          transfer_reason_2: '',
          id_on_file: '',
          preferred_language: '',
          card_status: '',
          enrollment_source: '',
        },
        errorResponse: '',
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
              title: '<h4>Customer has been successfully enrolled.</h4>',
              text: 'MyWU Number: ' + response.data.sender.preferred_customer.account_nbr,
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
            this.form.originating_country_code = '',
            this.form.receiver_type = '',
            this.form.transfer_frequency = '',
            this.form.wu_transfer_frequency = '',
            this.form.interests = '',
            this.form.mode_to_receive = '',
            this.form.transfer_reason_1 = '',
            this.form.transfer_reason_2 = '',
            this.form.id_on_file = '',
            this.form.preferred_language = '',
            this.form.card_status = '',
            this.form.enrollment_source = ''
          }
        })
        .catch((error) => {
          if( error.response.status == 422 ){

            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: 'Please see fields that are required, kindly fill up all the fields.'
            })

            this.errorResponse = error.response.data.errors;
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