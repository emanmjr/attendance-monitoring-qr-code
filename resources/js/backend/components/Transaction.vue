<template>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Transactions
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
                            <select class="form-control" v-model="transaction_type" @change="setSearchFieldType">
                                <option value="null" disabled selected hidden>Select Transaction</option>
                                <option value="wu">Western Union</option>
                                <option value="ipay">I-Pay Mobile</option>
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
                            <th>Transaction Reference Number</th>
                            <th>Date Money Sent</th>
                            <th>Sub Agent</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody >
                            <tr v-for="transaction in transactions">
                                <td>{{ transaction.mtcn }}</td>
                                <td>{{ transaction.sender_name }}</td>
                                <td>{{ transaction.receiver_name }}</td>
                                <td>{{ transaction.transaction_reference_number }}</td>
                                <td>{{ transaction.date_money_sent }}</td>
                                <td>{{ transaction.sub_agent }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" :data-mtcn="transaction.mtcn" @click="viewModalData">
                                        <i class="fas fa-eye" data-toggle="modal" data-target="#modal-information"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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
                            <h6 class="ml-2 mb-1">Transaction Reference No.: {{ modalData.transaction_reference_number }}</h6> 
                            <h6 class="ml-2 mb-1">Sub Agent: {{ modalData.sub_agent }}</h6> 
                            <hr>
                            <h6 class="ml-2 mb-3">Receiver</h6>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                    </tr>
                                    <tr>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                    </tr>
                                    <tr>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h6 class="ml-2 mb-3">Sender</h6>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                    </tr>
                                    <tr>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                    </tr>
                                    <tr>
                                        <td>Larry</td>
                                        <td>the Bird</td>
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

    export default {
        data() {
            return {
                'transactions': '',
                'modalData' : '',
                'options_type' : null,
                'filter_field' : '',
                'transaction_type' : null,
                'search_string': '',
            }
        },
        methods: {
            setTransactions() {
                this.transactions = this.$store.getters.getTransactionsFromGetters;
            },
            viewModalData(event) {

                let mtcn = event.currentTarget.getAttribute('data-mtcn');
                let transaction = this.transactions.filter(function(transaction) {
                    return transaction.mtcn == mtcn;
                });
                
                this.modalData = transaction[0];
            },
            setSearchFieldType() {

                if (this.transaction_type == 'wu') {
                    this.options_type = [
                        { 'name': 'MTCN', 'field': 'mtcn'},
                        { 'name': 'Sender Name', 'field': 'sender_name'},
                        { 'name': 'Receiver Name', 'field': 'receiver_name'},
                        { 'name': 'Transaction Reference Number', 'field': 'transaction_reference_number' },
                        { 'name': 'Date Money Sent', 'field': 'date_money_sent' },
                        { 'name': 'Sub Agent', 'field': 'sub_agent' },
                    ]
                }

                if (this.transaction_type == 'ipay') {
                    this.options_type = [
                        { 'name': 'Transaction Reference Number', 'field': 'transaction_reference_number' },
                        { 'name': 'User Name', 'field': 'user_name' },
                        { 'name': 'User Mobile', 'field': 'user_mobile' },
                    ]
                }

            },
            filterTransaction() {
               
                let field = this.filter_field;
                let filterType = this.options_type.filter(function(option) {
                    return option.name == field;
                });

                let fieldType = filterType[0].field;
                let searchString = this.search_string;

                this.setTransactions();
                let transaction = this.transactions.filter(function(transaction) {
                    return transaction[fieldType] == searchString;
                });

                this.transactions = transaction;

                if( searchString == '' ){
                    this.setTransactions();
                }

            }
        },
        mounted() {
            this.$store.dispatch("fetchTransactions")
            this.setTransactions();
        },
    }
</script>

<style lang="scss" scoped>

    .table-striped{
        font-size: 12px;
    }

    .table-striped td{
        padding-top: 0px;
        padding-bottom: 0px;
    }

</style>