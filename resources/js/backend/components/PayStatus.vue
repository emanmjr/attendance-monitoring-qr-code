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
                      <label for="search_sender_country_cod">Recording Country Code
                      </label>
                      <!-- <input type="text" class="form-control" id="recording_country_code" v-model="search.recording_country_code" placeholder=""> -->
                      <select class="form-control" v-model="countryCode">
                          <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="search_sender_country_cod">Recording Currency Country Code
                      </label>
                      <!-- <input type="text" class="form-control" id="recording_currency_country_code" v-model="search.recording_currency_country_code" placeholder=""> -->
                      <select class="form-control" v-model="currencyCode">
                          <option v-for="(currency, index) in this.CurrencyCodes" :value="index">{{ currency }}</option>
                      </select>
                    </div>
                    <!-- <div class="form-group col-md-3">
                      <label for="search_last_name">Pay Without ID Indicator
                      </label>
                      <select class="form-control" id="pay_wo_indicator" v-model="search.pay_wo_indicator">
                        <option value="null" disabled selected hidden></option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                      </select>
                    </div> -->
                    
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
var isoCountryCurrency = require('iso-country-currency');
export default {
    props: ['CountryCodes', 'CurrencyCodes'],
    data() {
      return {
        form: '',
        pay_transactions: {},
        search: {
          mtcn: '',
          recording_country_code: '',
          recording_currency_country_code: '',
        },
        countryCode: '',
        currencyCode: '',
        showMYWUDetails: false,
        countryNotListed: {
            'XP' : 'Afghanistan US Military Base',
            'XB' : 'Bahrain US Military Base',
            'QQ' : 'Belgium US Military Base',
            'QS' : 'Cuba US Military Base',
            'C2' : 'Cyprus (Northern)',
            'QV' : 'Djibouti US Military Base',
            'TP' : 'East Timor',
            'XQ' : 'England',
            'QO' : 'Germany US Military Base',
            'QZ' : 'Greece US Military Base',
            'XY' : 'Guam US Military Base',
            'QR' : 'Honduras US Military Base',
            'XM' : 'Iceland US Military Base',
            'X0' : 'International Test Country',
            'QX' : 'Iraq US Military Base',
            'QP' : 'Italy US Military Base',
            'QM' : 'Japan US Military Base',
            'QN' : 'Korea US Military Base',
            'XF' : 'Kosovo US Military Base',
            'QU' : 'Kuwait US Military Base',
            'AA' : 'Kyrghyz Republic US Military Base',
            'QT' : 'Netherlands US Military Base',
            'XZ' : 'North Ireland',
            'XT' : 'Portugal US Military Base',
            'QY' : 'Qatar US Military Base',
            'XW' : 'Rota CNMI',
            'XU' : 'Saipan CNMI',
            'XS' : 'Scotland',
            'AB' : 'Spain US Military Base',
            'S1' : 'St Maarten',
            'XD' : 'St Thomas',
            'XV' : 'Tinian CNMI',
            'XN' : 'Turkey US Military Base',
            'XE' : 'UAE US Military Base',
            'QW' : 'United Kingdom US Military Base',
            'XR' : 'Wales',
          },
          currencyOfNotListed: {
            'XP' : 'AF',
            'XB' : 'BH',
            'QQ' : 'BE',
            'QS' : 'CU',
            'C2' : 'CY',
            'QV' : 'DJ',
            'TP' : 'US',
            'XQ' : 'VG',
            'QO' : 'DE',
            'QZ' : 'GR',
            'XY' : 'GU',
            'QR' : 'HN',
            'XM' : 'IS',
            'X0' : 'US',
            'QX' : 'IQ',
            'QP' : 'IT',
            'QM' : 'JP',
            'QN' : 'KR',
            'XF' : 'XK',
            'QU' : 'KW',
            'AA' : 'KG',
            'QT' : 'NL',
            'XZ' : 'IE',
            'XT' : 'PT',
            'QY' : 'QA',
            'XW' : 'US',
            'XU' : 'US',
            'XS' : 'VG',
            'AB' : 'ES',
            'S1' : 'NL',
            'XD' : 'US',
            'XV' : 'US',
            'XN' : 'TR',
            'XE' : 'AE',
            'QW' : 'GB',
            'XR' : 'VG',
          }
        
      }
    },
    watch: {
      checkCurrencyCode(data){
        
        this.search.recording_currency_country_code = data;
        this.currencyCode = data;
      },
    },
    computed: {
      checkCurrencyCode(){
        if(this.countryCode != ""){
          this.search.recording_country_code = this.countryCode;
          
          if(this.countryCode == 'BY'){
            return 'BYN';
          }
          if(this.countryCode == 'YE'){
            return 'YER';
          }
          if(this.countryCode == 'MR'){
            return 'MRO';
          }
          if(this.countryCode == 'PA'){
            return 'USD';
          }
          if(this.countryCode == 'ST'){
            return 'STN';
          }
          if(this.countryCode == 'ZM'){
            return 'ZMW';
          }
          if(this.countryCode == 'ZW'){
            return 'ZWD';
          }
          
          if(this.countryCode in this.countryNotListed){
            return isoCountryCurrency.getParamByISO(this.currencyOfNotListed[this.countryCode], 'currency');
          }else{
            return isoCountryCurrency.getParamByISO(this.countryCode, 'currency');
          }
         
        }
      },
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