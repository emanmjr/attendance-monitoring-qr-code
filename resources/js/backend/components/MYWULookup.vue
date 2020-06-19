<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div class="form-row">
                    <div class="col-md-2"><h3>Search Type:</h3></div>
                    <div class="col-md-3">
                      <select class="form-control" id="search_type" v-model="search.search_type_field">
                      <option value="null" disabled selected hidden>Select Search Type</option>
                      <option value="COMPLIANCE_ID">Compliance ID</option>
                      <option value="PHONE_NUMBER">Phone Number</option>
                      <option value="MYWU_NUMBER">My WU Number</option>
                    </select>
                    </div>
                    
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
        },
        search: {
          first_name: '',
          last_name: '',
          my_wu_number: '',
          id_type: '',
          id_num: '',
          phone_num: '',
          search_type_field: '',
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
      //   checkSearchParam(data){
      //   this.showSearchTypeButton = true;
      //   if(data == 'COMPLIANCE_ID') {
      //     this.showSearchFirstName = true;
      //     this.showSearchLastName = true;
      //     this.showSearchMyWUNo = true;
      //     this.showSearchIdType = true;
      //     this.showSearchIdNum = true;
      //     this.showSearchPhoneNum = false;
      //   }

      //   if(data == 'PHONE_NUMBER') {
      //     this.showSearchFirstName = true;
      //     this.showSearchLastName = true;
      //     this.showSearchMyWUNo = true;
      //     this.showSearchIdType = false;
      //     this.showSearchIdNum = false;
      //     this.showSearchPhoneNum = true;
      //   }

      //   if(data == 'MYWU_NUMBER') {
      //     this.showSearchFirstName = true;
      //     this.showSearchLastName = true;
      //     this.showSearchMyWUNo = true;
      //     this.showSearchIdType = false;
      //     this.showSearchIdNum = false;
      //     this.showSearchPhoneNum = false;
      //   }

      // }
    },
    computed: {
      // checkSearchParam() {
      //   return this.search.search_type_field;
      // },
      // checkEmployedBusiness() {
      //   return this.form.employed_wbusiness;
      // },
      // checkPermanentAdd() {
      //   return this.form.permanent_add;
      // }
    },
    mounted() {
      document.getElementById('loading').style.display = 'none';
    },
    methods: {
      searchMYWU() {
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