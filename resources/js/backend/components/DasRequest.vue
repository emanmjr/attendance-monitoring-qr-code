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
                    <div class="col-md-2" v-if="this.isViewIsoCode1">
                        <div class="form-group">
                          <label for="search_first_name"><span v-if="this.isViewIsoCode2">Originating&nbsp;</span>Country </label>
                            <select class="form-control" v-model="countryCode1">
                                <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.countryCurrencies1">
                        <div class="form-group">
                          <label for="search_first_name">Currency</label>
                            <select class="form-control" v-model="currencyCode1">
                                <option v-for="(currency, index) in this.CurrencyCodes" :value="index">{{ currency }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.isViewIsoCode2">
                        <div class="form-group">
                          <label for="search_first_name"><span v-if="this.isViewIsoCode2">Destination&nbsp;</span>Country </label>
                            <select class="form-control" v-model="countryCode2">
                                <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.countryCurrencies2">
                        <div class="form-group">
                          <label for="search_first_name">Currency</label>
                            <select class="form-control" v-model="currencyCode2">
                                <option v-for="(currency, index) in this.CurrencyCodes" :value="index">{{ currency }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.templateId">
                        <div class="form-group">
                          <label for="search_template_id">Template ID</label>
                            <input type="text" class="form-control" v-model="search.template_id">
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.listName1">
                        <div class="form-group">
                          <label for="search_template_id">List Name 1</label>
                            <input type="text" class="form-control" v-model="search.list_name1">
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.listName2">
                        <div class="form-group">
                          <label for="search_template_id">List Name 2</label>
                            <input type="text" class="form-control" v-model="search.list_name2">
                        </div>
                    </div>
                    <div class="col-md-2" v-if="this.listName3">
                        <div class="form-group">
                          <label for="search_template_id">List Name 3</label>
                            <input type="text" class="form-control" v-model="search.list_name3">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
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
                            <tr v-for="infoDetail in paginatedData">
                                <td>{{ infoDetail.STATE_CODE }}</td>
                                <td>{{ infoDetail.STATE_NAME }}</td>
                            </tr>
                            <tr v-if="showNoDetails">
                              <td colspan="2">No Records</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="showPaginateBtns">
                  <button class="btn btn-primary btn-sm btn-dashboard" @click="prevPage" :disabled="pageNumber==0">
                    Previous
                  </button>
                  <button class="btn btn-primary btn-sm btn-dashboard" @click="nextPage" :disabled="pageNumber >= pageCount -1">
                    Next
                  </button>
                  <button v-if="showMoreDataBtn" class="btn btn-primary btn-sm btn-dashboard ml-4" @click="moreDataDasRequest">
                    More Data
                  </button>
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
        props: ['CountryCodes', 'CurrencyCodes'],
        data() {
            return {
                search: {
                  das_request_type: '',
                  queryFilter1: '',
                  queryFilter2: '',
                  queryFilter3: '',
                  template_id: '',
                  list_name1: '',
                  list_name2: '',
                  list_name3: '',
                },
                countryCode1: '',
                countryCode2: '',
                currencyCode1: '',
                currencyCode2: '',
                isoLanguageCode: '',
                isoLanguageCode1: '',
                isViewCountryCode: 'd-none',
                isViewSearchLoading: 'd-none',
                viewCountry: '',
                viewCurrency: '',
                responseInfoDetails: {},
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
                templateId: false,
                listName1: false,
                listName2: false,
                listName3: false,
                pageNumber: 0,
                size: {
                  default: 10
                },
                showPaginateBtns: false,
                showMoreDataBtn: false,
                moreDataFilterDas: "N",
                countryCurrencies1: false,
                countryCurrencies2: false,
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
        computed: {
          checkDasRequestTypeFields() {
            return this.search.das_request_type;
          },
          checkCurrencyCode1(){
            if(this.countryCode1 != ""){
              if(this.countryCode1 in this.countryNotListed){
                return isoCountryCurrency.getParamByISO(this.currencyOfNotListed[this.countryCode1], 'currency');
              }else{
                var currencyCode = isoCountryCurrency.getParamByISO(this.countryCode1, 'currency');
              }
            }
            return currencyCode;
          },
          checkCurrencyCode2(){
            if(this.countryCode2 != ""){
              if(this.countryCode2 in this.countryNotListed){
                return isoCountryCurrency.getParamByISO(this.currencyOfNotListed[this.countryCode2], 'currency');
              }else{
                var currencyCode = isoCountryCurrency.getParamByISO(this.countryCode2, 'currency');
              }
            }
            return currencyCode;
          },
          pageCount(){
            // console.log(this.responseInfoDetails);
              if(this.responseInfoDetails != undefined){
                let l = this.responseInfoDetails.length,
                  s = this.size.default;
              return Math.ceil(l/s);
              }
          },
          paginatedData(){
            const start = this.pageNumber * this.size.default,
                  end = start + this.size.default;
            if (this.responseInfoDetails == undefined || this.responseInfoDetails == false){
              return {};
            }else {
              if(this.responseInfoDetails.BANNER != undefined){
                this.showPaginateBtns =false;
                let response = [
                  this.responseInfoDetails
                ];
                return response.slice(start, end);
              }
              return this.responseInfoDetails.slice(start, end);
            }
            
          }
        },
        watch: {
          checkCurrencyCode1(data){
            this.currencyCode1 = data;
          },
          checkCurrencyCode2(data){
            this.currencyCode2 = data;
          },
          checkDasRequestTypeFields(data){

            if (data == 'GetDeliveryServices'){
              this.isViewIsoCode2 = true;
              this.templateId =false
              this.listName1 =false
              this.listName2 =false
              this.listName3 =false
              this.countryCurrencies1 = true;
              this.countryCurrencies2 = true;

            } else {
              
              this.isViewIsoCode2 = false;
              this.isViewIsoCode1 = true;
              this.templateId =false
              this.listName1 =false
              this.listName2 =false
              this.listName3 =false
              this.countryCurrencies2 = false;

              if(data == 'GetDeliveryOptionTemplate'){
                this.templateId =true;
                this.countryCurrencies2 = false;
              }
              

              if(data == 'GetMexicoCityState'){
                this.isViewIsoCode1 = false;
                this.countryCurrencies1 = false;
                this.countryCurrencies2 = false;
              }else{
                this.countryCurrencies1 = true;
                this.isViewIsoCode1 = true;
              }

              if(data == 'GetCascadeList'){
                this.listName1 =true;
                this.listName2 =true;
                this.listName3 =true;
                this.isViewIsoCode1 = false;
                this.isViewIsoCode2 = false;
                this.countryCurrencies1 = false;
              }

              if(data == 'GetStateList'){
                this.countryCurrencies1 = false;
                this.countryCurrencies2 = false;
              }



            }
            

            
          }
        },
        methods: {
          moreDataDasRequest(){

            this.pageNumber = 0;
            this.showPaginateBtns = false;
            this.showMoreDataBtn = false;

            let lastData = this.responseInfoDetails[this.responseInfoDetails.length-1];
            console.log(lastData)
            if (this.search.das_request_type == "GetCountriesCurrencies"){
              var data = {
                'das_request_type': this.search.das_request_type,
                'queryFilter1': lastData.ISO_COUNTRY_CD + " " + lastData.CURRENCY_CD,
                'queryFilter2': lastData.COUNTRY_LONG,
                'queryFilter3': lastData.CURRENCY_NAME,
              };

              this.countryCode1 = lastData.ISO_COUNTRY_CD;
            }

            if (this.search.das_request_type == "GetDeliveryOptionTemplate"){
              var data = {
                'das_request_type': this.search.das_request_type,
                'queryFilter1': this.search.queryFilter1,
                'queryFilter2': this.search.template_id,
                'queryFilter3': "", // lastData.T_INDEX
              };
            }

            this.isViewSearchLoading = 'd-block';
            axios.post('/admin/api/das-request', data)
                .then((response) => {

                  
                  this.isViewCountryCode = 'd-block';
                  this.isViewSearchLoading = 'd-none';
                  // handle success
                  if(response.data) {
                    
                    if(Object.keys(response.data).length > 0){
                      this.showNoDetails = false;
                      this.showPaginateBtns = true;
                      
                    } else {
                      this.showNoDetails = true;
                      this.showPaginateBtns = false;
                    }
                    
                    this.checkDasRequestType(this.search.das_request_type, response.data);
                  }
                })
                .catch((error) => {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Can you please try again.',
                      footer: '' + error
                    });
                  document.getElementById('loading').style.display = 'none';
                })

          },
          nextPage(){
            this.pageNumber++;

            if ((this.search.das_request_type == "GetCountriesCurrencies" || this.search.das_request_type == "GetDeliveryOptionTemplate") && (this.pageNumber >= this.pageCount -1)){
              this.showMoreDataBtn = true;
              
              if(this.moreDataFilterDas == "N"){
                this.showMoreDataBtn = false;
                
              }
            }

          },
          prevPage(){
            this.pageNumber--;
          },
          filterDasRequest() {

            this.dasRequestCountriesCurrencies = false;
            this.dasRequestCountryInfo = false;
            this.dasRequestDeliveryService = false;
            this.dasRequestDeliveryOptionTemplate = false;
            this.dasRequestCascadeList = false;
            this.dasRequestMexicoCityState = false;
            this.dasRequestStateList = false;
            // this.search.queryFilter1 = '';
            // this.search.queryFilter2 = '';
            
            this.pageNumber = 0;
            this.responseInfoDetails = '';
            this.showPaginateBtns = false;
            
              if(this.isViewIsoCode1 == true){
                this.search.queryFilter1 = this.countryCode1 + ' ' + this.currencyCode1;
              }
              
              if(this.isViewIsoCode2 == true){
                this.search.queryFilter2 = this.countryCode2 + ' ' + this.currencyCode2;
              }

              this.isViewSearchLoading = 'd-block';
              this.$nextTick(() => {
                axios.post('/admin/api/das-request', this.search)
                .then((response) => {
                  console.log(response);
                  
                  this.isViewCountryCode = 'd-block';
                  if(this.isViewIsoCode1 == true){
                    this.viewCountry = this.countryCode1;
                    this.viewCurrency = this.currencyCode1;
                  }
                  
                  // handle success
                  if(response.data) {
                    if(Object.keys(response.data).length > 0){
                      this.showNoDetails = false;
                      this.showPaginateBtns = true;
                    } else {
                      this.showNoDetails = true;
                      this.showPaginateBtns = false;
                    }
                    this.isViewSearchLoading = 'd-none';
                    this.checkDasRequestType(this.search.das_request_type, response.data);
                  }
                })
                .catch((error) => {
                  if( error.response.status == 422 ){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Fields are all required.',
                      // footer: ''
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
            
            // this.search.template_id = '';

            if(dasRequestType == 'GetCountriesCurrencies') {
              if(data.ERROR_RESPONSE != false){
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '' + data.ERROR_RESPONSE,
                })
                this.showPaginateBtns = false;
                this.showNoDetails = true;

              }
              this.dasRequestCountriesCurrencies = true;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;


              this.moreDataFilterDas = data.DATA_MORE
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

              this.moreDataFilterDas = "N";

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

              this.moreDataFilterDas = "N";

              // set Data
              this.responseInfoDetails = data.GETDELIVERYSERVICES;
            }

            if(dasRequestType == 'GetDeliveryOptionTemplate') {
              
              if(data.ERROR_RESPONSE != false){
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '' + data.ERROR_RESPONSE,
                })
                this.showPaginateBtns = false;
                this.showNoDetails = true;
              }
              this.dasRequestCountriesCurrencies = false;
              this.dasRequestCountryInfo = false;
              this.dasRequestDeliveryService = false;
              this.dasRequestDeliveryOptionTemplate = true;
              this.dasRequestCascadeList = false;
              this.dasRequestMexicoCityState = false;
              this.dasRequestStateList = false;

              this.moreDataFilterDas = data.DATA_MORE

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

              this.moreDataFilterDas = "N";
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

              this.moreDataFilterDas = "N";
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

              this.moreDataFilterDas = "N";
              // set Data
              this.responseInfoDetails = data.GETSTATELIST;
            }

            if (this.responseInfoDetails == undefined){
              this.showNoDetails = true;
            }

            if(this.pageNumber >= this.pageCount -1){
              this.showPaginateBtns = false;
            }
          },
        },
        mounted() {

        },
    }
</script>

<style lang="scss" scoped>
    .table-responsive td:not(.btn-td) {
      white-space: normal;
      vertical-align: middle;
    }
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