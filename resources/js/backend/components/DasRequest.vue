<template>
    <div class="card-body">
        
        <!-- <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
        </div> -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="card-title mb-0">
                    DAS Request
                </h4>
                <h6 v-if="this.isViewIsoCode1" :class="this.isViewCountryCode" style="float: right;margin-top: -15px;">Country: {{ viewCountry }},&nbsp;&nbsp;Currency: {{ viewCurrency }}</h6> 
                <hr>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="search_first_name">Category</label>
                            <select class="form-control" v-model="search.das_request_type">
                                <option value="null" disabled selected hidden>Select Category</option>
                                <option value="GetDeliveryOptionTemplate">Get Delivery Option Template</option>
                                <option value="GetDeliveryServices">Get Delivery Services</option>
                                <option value="GetCascadeList">Get Cascade List</option>
                                <option value="GetCountriesCurrencies">Get Countries Currencies</option>
                                <option value="GetCountryInfo">Get Country Info</option>
                                <option value="GetMexicoCityState">Get Mexico City State</option>
                                <option value="GetStateList">Get State List</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" v-if="this.isViewIsoCode1">
                        <div class="form-group">
                          <label for="search_first_name"><label v-if="this.isViewIsoCode2">Originating&nbsp;</label>Country Code <small>(2 Digit ISO)</small></label>
                            <input type="text" class="form-control" v-model="isoLanguageCode">
                        </div>
                    </div>
                    <div class="col-md-3" v-if="this.isViewIsoCode2">
                        <div class="form-group">
                          <label for="search_first_name"><label v-if="this.isViewIsoCode2">Destination&nbsp;</label>Country Code <small>(2 Digit ISO)</small></label>
                            <input type="text" class="form-control" v-model="isoLanguageCode1">
                        </div>
                    </div>
                    <div class="col-md-1">
                          <button type="button" class="btn btn-light" style="margin-top:27px;" @click="filterDasRequest"><i class="fas fa-search"></i></button>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                      <div :class="this.isViewSearchLoading" class="mt-2 mb-2">
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Please Wait...
                      </div>
                    </div>
                    <div class="col-md-3" :class="this.isViewFilterBy">
                          <div class="form-group">
                            <label for="search_first_name">Filter By</label>
                              <select class="form-control" v-model="filterType">
                                  <option value="null" disabled selected hidden></option>
                                  <option value="COUNTRY_LONG">Country Long</option>
                                  <option value="CURRENCY_CD">Currency CD</option>
                                  <option value="CURRENCY_NAME">Currency Name</option>
                                  <option value="ISO_COUNTRY_CD">ISO Country CD</option>
                                  <option value="ISO_COUNTRY_NUM_CD">ISO Country Number CD</option>
                                  <option value="ISO_CURRENCY_NUM_CD">ISO Currency Number CD</option>
                              </select>
                          </div>
                    </div>
                    <div class="col-md-3" :class="this.isViewFilterBy">
                        <div class="form-group">
                          <label for="search_first_name" class="invisible">val</label>
                            <input type="text" class="form-control" v-model="filterValue">
                        </div>
                    </div>
                    <div class="col-md-1" :class="this.isViewFilterBy">
                          <label for="search_first_name1" class="invisible">Search</label>
                          <!-- <button type="button" class="btn btn-light" @click="filterByVal"><i class="fas fa-search"></i></button> -->
                    </div>
                </div>
                <!-- Countries Currencies -->
                <div class="table-responsive" v-if="this.dasRequestCountriesCurrencies">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>Country Long</th>
                            <th>Currency CD</th>
                            <th>Currency Name</th>
                            <th>ISO Country CD</th>
                            <th>ISO Country Number CD</th>
                            <th>ISO Currency Number CD</th>
                        </tr>
                        
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.COUNTRY_LONG }}</td>
                                <td>{{ infoDetail.CURRENCY_CD }}</td>
                                <td>{{ infoDetail.CURRENCY_NAME }}</td>
                                <td>{{ infoDetail.ISO_COUNTRY_CD }}</td>
                                <td>{{ infoDetail.ISO_COUNTRY_NUM_CD }}</td>
                                <td>{{ infoDetail.ISO_CURRENCY_NUM_CD }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="6">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                

                <!-- Country Info -->
                <div class="table-responsive" v-if="this.dasRequestCountryInfo">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>RECORD NUMBER</th>
                            <th>INFO</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.REC_NUMBER }}</td>
                                <td>{{ infoDetail.INFO }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="2">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Delivery Services -->
                <div class="table-responsive" v-if="this.dasRequestDeliveryService">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>Banner</th>
                            <th>Country View Filter</th>
                            <th>Description</th>
                            <th>Destination Code</th>
                            <th>EXCL Flag</th>
                            <th>Route</th>
                            <th>SVC Code</th>
                            <th>SVC Name</th>
                            <th>Template</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.BANNER }}</td>
                                <td>{{ infoDetail.CTRY_VIEW_FILTER }}</td>
                                <td>{{ infoDetail.DESCRIPTION }}</td>
                                <td>{{ infoDetail.DESTINATION_CODE }}</td>
                                <td>{{ infoDetail.EXCL_FLAGS }}</td>
                                <td>{{ infoDetail.ROUTE }}</td>
                                <td>{{ infoDetail.SVC_CODE }}</td>
                                <td>{{ infoDetail.SVC_NAME }}</td>
                                <td>{{ infoDetail.TEMPLT }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="9">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <!-- Delivery Option Template -->
                <div class="table-responsive" v-if="this.dasRequestDeliveryOptionTemplate">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>Category</th>
                            <th>Description</th>
                            <th>Product</th>
                            <th>T Index</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.CATEGORY }}</td>
                                <td>{{ infoDetail.DESCRIPTION }}</td>
                                <td>{{ infoDetail.PRODUCT }}</td>
                                <td>{{ infoDetail.T_INDEX }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="4">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Cascade List -->
                <div class="table-responsive" v-if="this.dasRequestCascadeList">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>List Text</th>
                            <th>List Value</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.LIST_TEXT }}</td>
                                <td>{{ infoDetail.LIST_VALUE }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="2">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mexico City State -->
                <div class="table-responsive" v-if="this.dasRequestMexicoCityState">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>City</th>
                            <th>State Code</th>
                            <th>State Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.CITY }}</td>
                                <td>{{ infoDetail.STATE_CODE }}</td>
                                <td>{{ infoDetail.STATE_NAME }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="3">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- State List -->
                <div class="table-responsive" v-if="this.dasRequestStateList">
                    <table class="table tbl-main">
                        <thead>
                        <tr class="text-center">
                            <th>State Code</th>
                            <th>State Name</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="infoDetail in responseInfoDetails">
                                <td>{{ infoDetail.STATE_CODE }}</td>
                                <td>{{ infoDetail.STATE_NAME }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="2">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                

                <!-- <div class="no-transact" v-if="transactionsData.length == 0">No Transactions </div> -->
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</template>

<script>
    import { mapState } from 'vuex';
    var isoCountryCurrency = require('iso-country-currency');
    export default {
        data() {
            return {
                search: {
                  das_request_type: '',
                  queryFilter1: '',
                  queryFilter2: '',
                },
                isoLanguageCode: '',
                isoLanguageCode1: '',
                isViewCountryCode: 'd-none',
                isViewSearchLoading: 'd-none',
                viewCountry: '',
                viewCurrency: '',
                responseInfoDetails : '',
                filterByVal: '',
                filterValue: '',
                filterType: '',
                isViewFilterBy: 'd-none',
                dasRequestCountryInfo: false,
                dasRequestCountriesCurrencies: false,
                dasRequestDeliveryService: false,
                dasRequestDeliveryOptionTemplate: false,
                dasRequestCascadeList: false,
                dasRequestMexicoCityState: false,
                dasRequestStateList: false,
                isViewIsoCode2: false,
                isViewIsoCode1: true,
                showNoDetails: false,
                
            }
        },
        computed: {
          checkDasRequestTypeFields() {
            return this.search.das_request_type;
          },
        },
        watch: {
          checkDasRequestTypeFields(data){
            if (data == 'GetDeliveryServices'){
              this.isViewIsoCode2 = true;
            } else {
              this.isViewIsoCode2 = false;
              this.isViewIsoCode1 = true;

              if(data == 'GetCascadeList' || data == 'GetMexicoCityState'){
                this.isViewIsoCode1 = false;
              }else{
                this.isViewIsoCode1 = true;
              }

            }

            
          }
        },
        methods: {
          checkDataResponse(data) {
            if(Object.keys(data).length > 0){
              this.showNoDetails = false;
            } else {
              this.showNoDetails = true;
            }
          },
          filterDasRequest() {
            this.dasRequestCountriesCurrencies = false;
            this.dasRequestCountryInfo = false;
            this.dasRequestDeliveryService = false;
            this.dasRequestDeliveryOptionTemplate = false;
            this.dasRequestCascadeList = false;
            this.dasRequestMexicoCityState = false;
            this.dasRequestStateList = false;

            
            if(this.isViewIsoCode1 == true){
              var  country = isoCountryCurrency.getParamByISO(this.isoLanguageCode, 'countryName');
              var  currency = isoCountryCurrency.getParamByISO(this.isoLanguageCode, 'currency');
            }


            if(this.isViewIsoCode2 == true) {
              var country1 = isoCountryCurrency.getParamByISO(this.isoLanguageCode1, 'countryName');
              var currency1 = isoCountryCurrency.getParamByISO(this.isoLanguageCode1, 'currency');
            }

              if(this.isViewIsoCode1 == true){
                this.search.queryFilter1 = this.isoLanguageCode + ' ' + currency;
              }
              
              if(this.isViewIsoCode2 == true){
                this.search.queryFilter2 = this.isoLanguageCode1 + ' ' + currency1;
              }

              this.isViewSearchLoading = 'd-block';
              this.$nextTick(() => {
                axios.post('/admin/api/das-request', this.search)
                .then((response) => {

                  this.isViewSearchLoading = 'd-none';
                  this.isViewCountryCode = 'd-block';
                  if(this.isViewIsoCode1 == true){
                    this.viewCountry = country;
                    this.viewCurrency = currency;
                  }

                  

                  // handle success
                  if(response.data) {

                    this.checkDasRequestType(this.search.das_request_type, response.data);
                    this.checkDataResponse(response.data);
                    
                  }
                })
                .catch((error) => {
                  if( error.response.status == 422 ){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                      footer: 'Please choose category for this request.'
                    })
                    this.isViewCountryCode = 'd-none';
                    this.isViewSearchLoading = 'd-none';
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
              })
              
            

            // document.getElementById('loading').style.display = 'block';
            
          },
          checkDasRequestType(dasRequestType, data) {
            console.log(data)
            if(dasRequestType == 'GetCountriesCurrencies') {
              this.dasRequestCountriesCurrencies = true;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;



              //set Data
              this.responseInfoDetails = data.GETCOUNTRIESCURRENCIES;
            }

            if(dasRequestType == 'GetCountryInfo') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = true;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;



              // set Data
              this.responseInfoDetails = data.GETCOUNTRYINFO;
            }

            if(dasRequestType == 'GetDeliveryServices') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = true;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;



              // set Data
              this.responseInfoDetails = data.GETDELIVERYSERVICES;
            }

            if(dasRequestType == 'GetDeliveryOptionTemplate') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = true;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;



              // set Data
              this.responseInfoDetails = data.GETDELIVERYOPTIONTEMPLATE;
            }

            if(dasRequestType == 'GetCascadeList') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestCascadeList = true;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;


              // set Data
              this.responseInfoDetails = data.GETCASCADELIST;
            }

            if(dasRequestType == 'GetMexicoCityState') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = true;
              this.dasRequestStateList = false;


              // set Data
              this.responseInfoDetails = data.GETMEXICOCITYSTATE;
            }

            if(dasRequestType == 'GetStateList') {
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = true;

              // set Data
              this.responseInfoDetails = data.GETSTATELIST;
            }
            
          },
        },
        mounted() {

        },
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