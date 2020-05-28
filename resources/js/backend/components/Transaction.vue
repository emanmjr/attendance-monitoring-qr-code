<template>
    <div class="card-body">
        
        <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Transactions <small class="text-muted">{{ currentPage }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" class="form-control" v-model="dateTransaction">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" @click="refreshTransactions"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" v-model="transaction_type">
                                <option value="null" disabled selected hidden>Select Transaction</option>
                                <option value="4">Western Union</option>
                                <option value="7">I-Pay Mobile</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <select class="form-control" v-model="filter_field">
                                <option value="null" disabled selected hidden>Select Field</option>
                                <option v-for="option in options_type">{{ option.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="search_string">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-light" @click="filterTransaction"><i class="fas fa-search"></i></button>
                    </div>
                    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>MTCN</th>
                            <th>Sender Name</th>
                            <th>Receiver Name</th>
                            <th>Transaction Type </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody >
                            <tr v-for="transaction in transactionsData">
                                <td>{{ transaction.mtcn }}</td>
                                <td>{{ transaction.senderName }}</td>
                                <td>{{ transaction.receiverName }}</td>
                                <td>{{ transaction.client_id != '' ?  ((transaction.client_id == 4 ? 'Western Union' : 'N/A')) :  'IPAY Mobile' }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" :data-mtcn="transaction.mtcn" @click="viewModalData">
                                        <i class="fas fa-eye" data-toggle="modal" data-target="#modal-information"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="no-transact" v-if="transactionsData.length == 0">No Transactions </div>
                <!-- <div><jw-pagination :items="exampleItems" @changePage="onChangePage"></jw-pagination></div> -->
                <!-- Modal -->
                <div class="modal fade" id="modal-information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <!-- <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> -->
                        <div class="modal-body">
                            <h6 class="ml-2 mb-1 mt-4">MTCN: {{ modalData.mtcn }}</h6> 
                            <h6 class="ml-2 mb-1 mt-4">Account No.: {{ modalData.accountNumber }}</h6> 
                            <h6 class="ml-2 mb-1">Transaction Type: {{ this.setTransactionType(modalData.client_id) }} </h6> 
                            <h6 class="ml-2 mb-1">Amount: {{ modalData.currencyCode }} {{ modalData.amount }} </h6> 
                            <h6 class="ml-2 mb-1">Country Destination: {{ modalData.destinationCountry }}</h6> 
                            <hr>
                            <h6 class="ml-2 mb-3">Sender</h6>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ modalData.senderName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td>{{ modalData.birthDate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ modalData.address}} {{ modalData.city}} {{ modalData.province}} {{ modalData.postalCode }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td>{{ modalData.phoneNum }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ modalData.gender }}</td>
                                    </tr>
                                    <tr>
                                        <td>Occupation</td>
                                        <td>{{ modalData.occupation }}</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose of Transaction</td>
                                        <td>{{ modalData.transactionReason }}</td>
                                    </tr>
                                    <tr>
                                        <td>Source of Funds</td>
                                        <td>{{ modalData.fundSource }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Number:</td>
                                        <td>{{ modalData.idNum }}</td>
                                    </tr>
                                    <tr>
                                        <td>Issue Date:</td>
                                        <td>{{ modalData.issueDate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Relation to Receiver</td>
                                        <td>{{ modalData.relationshiptoReceiver }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h6 class="ml-2 mb-3">Receiver</h6>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ modalData.receiverName }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

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
    import JwPagination from 'jw-vue-pagination';
    Vue.component('jw-pagination', JwPagination);
    export default {
        props: ['currentPage', 'items'],
        data() {
            return {
                'transactionsData': '',
                'modalData' : '',
                'options_type' : null,
                'filter_field' : '',
                'transaction_type' : null,
                'search_string': '',
                'dateTransaction': '',
                'exampleItems' : '',
                'pageOfItems': [],
            }
        },
        computed: mapState(['transactions']),
        watch: {
            transactions(data) {
              this.transactionsData = data;
              this.$nextTick(()=>{
                  this.exampleItems = this.transactionsData;
              })

              if(data){
                  document.getElementById('loading').style.display = 'none';
              }
            },
        },
        methods: {
            refreshTransactions() {

                document.cookie = "date-tranasction=" + this.dateTransaction;
                
                this.$store.dispatch("fetchTransactions", window.location.pathname.split("/").pop())
                document.getElementById('loading').style.display = 'block';
            },
            setDateTransaction() {
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
                this.dateTransaction = today;

                document.cookie = "date-tranasction=" + today;
            },
            setTransactionType(type) {

                if (!type) return 'N/A';

                if (type == 4) return 'Western Union';
                
                if (type == 7) return 'IPAY Mobile';

            },
            setTransactions() {
                this.transactionsData = this.$store.getters.getTransactionsFromGetters;   
                
            },
            viewModalData(event) {

                let mtcn = event.currentTarget.getAttribute('data-mtcn');
                let transaction = this.transactions.filter(function(transaction) {
                    return transaction.mtcn == mtcn;
                });
                
                this.modalData = transaction[0];
            },
            setSearchFieldType() {
                this.options_type = [
                    { 'name': 'MTCN', 'field': 'mtcn'},
                    { 'name': 'Sender Name', 'field': 'senderName'},
                    { 'name': 'Receiver Name', 'field': 'receiverName'},
                ]
            },
            filterTransaction() {
               
                let field = this.filter_field;
                let filterType = this.options_type.filter(function(option) {
                    return option.name == field;
                });

                let fieldType = filterType[0].field;

                let searchString = this.search_string;
                let transactionType = this.transaction_type

                this.setTransactions();
                let transaction = this.transactions.filter(function(transaction) {
                    return transaction[fieldType] == searchString &&  transactionType == transaction.client_id;
                });

                this.transactionsData = transaction;

                if( searchString == '' ){
                    this.setTransactions();
                }

            },
            onChangePage(pageOfItems) {
                // update page of items
                this.pageOfItems = pageOfItems;
            }
        },
        mounted() {
                // document.getElementById('loading').style.display = 'none';


                this.setDateTransaction();
                this.setSearchFieldType();

                this.$store.dispatch("fetchTransactions", window.location.pathname.split("/").pop())

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
</style>