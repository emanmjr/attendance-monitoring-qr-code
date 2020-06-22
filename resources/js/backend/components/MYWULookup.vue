<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div class="form-row mt-4">
                    <div class="form-group col-md-3">
                      <label for="search_my_wu_number">My WU No.
                      </label>
                      <input type="text" class="form-control" id="search_my_wu_number" v-model="search.my_wu_number" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="search_sender_country_cod">Sender Country Code<small>(2 Digit ISO)</small>
                      </label>
                      <input type="text" class="form-control" id="search_sender_country_cod" v-model="search.sender_country_code" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="search_last_name">Update MyWU Card to Loyalty Card
                      </label>
                      <select class="form-control" id="mywucard_to_loyaltycard" v-model="search.mywucard_to_loyaltycard">
                        <option value="null" disabled selected hidden></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                    
                    <div class="form-group col-md-2">
                      <button type="button" style="margin-top: 28px;" class="btn btn-primary btn-dashboard" @click="searchMYWU"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <hr>
                <div v-if="showMYWUDetails">
                  <!-- <h4>Receiver Information</h4>
                  <div class="form-row mt-4">
                      <div class="form-group col-md-2">
                        <label>First Name
                        </label>
                        <input type="text" class="form-control" v-model="form.receiver.name.first_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Middle Name
                        </label>
                        <input type="text" class="form-control" v-model="form.receiver.name.middle_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Last Name
                        </label>
                        <input type="text" class="form-control" v-model="form.receiver.name.last_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Country Code
                        </label>
                        <input type="text" class="form-control" v-model="form.receiver.address.country_code.iso_code.country_code" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Currency Code
                        </label>
                        <input type="text" class="form-control" v-model="form.receiver.address.country_code.iso_code.currency_code" placeholder="" readonly>
                      </div>

                  </div> -->
                  <hr>
                  <h4>Sender Information</h4>
                  <div class="form-row mt-4">
                      <div class="form-group col-md-2">
                        <label>MYWU Number
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.preferred_customer.account_nbr" placeholder="" readonly>
                      </div>
                  </div>
                  <div class="form-row mt-4">
                      <div class="form-group col-md-2">
                        <label>First Name
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.name.first_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Middle Name
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.name.middle_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Last Name
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.name.last_name" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Mobile Number
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.contact_phone" placeholder="" readonly>
                      </div>
                  </div>
                  <div class="form-row mt-4">
                      <div class="form-group col-md-2">
                        <label>Address 1
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.addr_line1" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2" v-if="form.sender.address.addr_line2 > 0">
                        <label>Address 2
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.addr_line2" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Postal Code
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.postal_code" placeholder="" readonly>
                      </div>
                  </div>
                  <div class="form-row mt-4">
                      <div class="form-group col-md-2">
                        <label>City
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.city" placeholder="" readonly>
                      </div>
                      <div class="form-group col-md-2" v-if="form.sender.address.addr_line2.length > 0">
                        <label>State
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.state" placeholder="" readonly>
                      </div>
                      <!-- <div class="form-group col-md-2">
                        <label>Country
                        </label>
                        <input type="text" class="form-control" v-model="form.sender.address.country_code.country_name" placeholder="" readonly>
                      </div> -->
                      
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
                        <label for="phone_number">Middle Name</label>
                        <input type="text" class="form-control" id="phone_number" v-model="receiver.name.middle_name" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone_number">Last Name</label>
                        <input type="text" class="form-control" id="phone_number" v-model="receiver.name.last_name" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_code">Country Code</label>
                        <input type="text" class="form-control" id="country_code" v-model="receiver.address.country_code.iso_code.country_code" readonly>
                    </div>
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
        form: '',
        receivers: {},
        search: {
          mywucard_to_loyaltycard: '',
          sender_country_code: '',
          my_wu_number: '',
        },
        showMYWUDetails: false,
        
      }
    },
    watch: {
    },
    computed: {
    },
    mounted() {
      document.getElementById('loading').style.display = 'none';
      this.receiversCount()
    },
    methods: {
      receiversCount() {
        if(this.receivers.length > 0){
          return true;
        } else {
          return false;
        }
      },
      searchMYWU() {
        // this.showMYWUDetails = false;
        document.getElementById('loading').style.display = 'block';
        axios.post('/admin/api/mywu-lookup', this.search)
        .then((response) => {
          this.showMYWUDetails = true;
          document.getElementById('loading').style.display = 'none';
          console.log(response.data)
          this.form = response.data;

          this.receivers = response.data.receiver ? response.data.receiver : {};
        })
        .catch((error) => {
          if( error.response.status == 422 ){
          this.showMYWUDetails = false;
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: 'Please see fields that are required.'
            })

            this.errorResponse = error.response.data.errors;
          } else {
             Swal.fire({
              icon: 'error',
              title: 'Something went wrong!',
              text: 'Please check field values if it is/are correct.',
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