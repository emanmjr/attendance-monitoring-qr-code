<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div class="form-row mt-4">
                    <div class="form-group col-md-2">
                      <label for="search_my_wu_number">MTCN
                      </label>
                      <input type="text" class="form-control" id="mtcn" v-model="search.mtcn" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="search_sender_country_cod">Recording Country Code<small>(2 Digit ISO)</small>
                      </label>
                      <input type="text" class="form-control" id="recording_country_code" v-model="search.recording_country_code" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="search_sender_country_cod">Recording Currency Country Code<small>(3 Digit ISO)</small>
                      </label>
                      <input type="text" class="form-control" id="recording_currency_country_code" v-model="search.recording_currency_country_code" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="search_last_name">Pay Without ID Indicator
                      </label>
                      <select class="form-control" id="pay_wo_indicator" v-model="search.pay_wo_indicator">
                        <option value="null" disabled selected hidden></option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                      </select>
                    </div>
                    
                    <div class="form-group col-md-1">
                      <button type="button" style="margin-top: 28px;" class="btn btn-primary btn-dashboard" @click="searchPayStatus"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <hr>
                <div v-if="showMYWUDetails">
                  <div v-if="this.transactionsCount()">
                    <h4 class="mt-3 mb-3">Pay Transactions</h4>
                      <div  v-for="transaction in pay_transactions">
                        <div class="form-row">
                          <div class="form-group col-md-2">
                              <label for="contact_country_code">Filing Date</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.filing_date" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Filing Time</label>
                              <input type="text" class="form-control" id="phone_number" v-model="transaction.filing_time" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Originators Principal Amount</label>
                              <input type="text" class="form-control" id="phone_number" v-model="transaction.financials.originators_principal_amount" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Money Transfer Key</label>
                              <input type="text" class="form-control" id="phone_number" v-model="transaction.money_transfer_key" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Pay Status Description</label>
                              <input type="text" class="form-control" id="phone_number" v-model="transaction.pay_status_description" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                              <label for="contact_country_code">Originating Country Code</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.payment_details.originating_country_currency.iso_code.country_code" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Originating Country Code</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.payment_details.originating_country_currency.iso_code.currency_code" readonly>
                          </div>
                        </div>
                        <h6 class="mt-3 mb-3">Receiver</h6>
                        <div class="form-row">
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.receiver.name.first_name" readonly>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.receiver.name.last_name" readonly>
                          </div>
                        </div>
                        <h6 class="mt-3 mb-3">Sender</h6>
                        <div class="form-row">
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.sender.name.first_name" readonly>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="transaction.sender.name.last_name" readonly>
                          </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                  </div>



                  <div v-if="!this.transactionsCount()">
                    <h4 class="mt-3 mb-3">Pay Transactions</h4>
                      <!-- <div  v-for="transaction in pay_transactions"> -->
                        <div class="form-row">
                          <div class="form-group col-md-2">
                              <label for="contact_country_code">Filing Date</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.filing_date" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Filing Time</label>
                              <input type="text" class="form-control" id="phone_number" v-model="pay_transactions.filing_time" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Originators Principal Amount</label>
                              <input type="text" class="form-control" id="phone_number" v-model="pay_transactions.financials.originators_principal_amount" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Money Transfer Key</label>
                              <input type="text" class="form-control" id="phone_number" v-model="pay_transactions.money_transfer_key" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Pay Status Description</label>
                              <input type="text" class="form-control" id="phone_number" v-model="pay_transactions.pay_status_description" readonly>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                              <label for="contact_country_code">Originating Country Code</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.payment_details.originating_country_currency.iso_code.country_code" readonly>
                          </div>
                          <div class="form-group col-md-2">
                              <label for="phone_number">Originating Country Code</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.payment_details.originating_country_currency.iso_code.currency_code" readonly>
                          </div>
                        </div>
                        <h6 class="mt-3 mb-3">Receiver</h6>
                        <div class="form-row">
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.receiver.name.first_name" readonly>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.receiver.name.last_name" readonly>
                          </div>
                        </div>
                        <h6 class="mt-3 mb-3">Sender</h6>
                        <div class="form-row">
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.sender.name.first_name" readonly>
                          </div>
                          <div class="form-group col-md-3">
                              <label for="contact_country_code">First Name</label>
                              <input type="text" class="form-control" id="contact_country_code" v-model="pay_transactions.sender.name.last_name" readonly>
                          </div>
                        </div>
                        <br>
                        <hr>
                    <!-- </div> -->
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
        pay_transactions: {},
        search: {
          mtcn: '',
          recording_country_code: '',
          recording_currency_country_code: '',
          pay_wo_indicator: '',
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
      this.transactionsCount()
    },
    methods: {
      transactionsCount() {
        if(this.pay_transactions.length > 0){
          return true;
        } else {
          return false;
        }
      },
      searchPayStatus() {
          this.showMYWUDetails = false;

        // this.showMYWUDetails = false;
        document.getElementById('loading').style.display = 'block';
        axios.post('/admin/api/pay-status', this.search)
        .then((response) => {
          this.showMYWUDetails = true;
          document.getElementById('loading').style.display = 'none';
          console.log(response.data)
          this.pay_transactions = response.data.payment_transactions.payment_transaction;

          // this.receivers = response.data.receiver ? response.data.receiver : {};
        })
        .catch((error) => {
          if( error.response.status == 422 ){
          this.showMYWUDetails = false;
            Swal.fire({
              icon: 'error',
              title: 'Something went wrong',
              text: 'Transaction Failed Validation',
              footer: 'All fields are mandatory.'
            })

            this.errorResponse = error.response.data.errors;
          } else {
             Swal.fire({
              icon: 'error',
              title: 'Something went wrong!',
              text: 'Transaction not found.',
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