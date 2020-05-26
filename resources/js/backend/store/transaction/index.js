import TransactionService from "../../services/Transactionservice.js"

export default {
	state: {

       transactions: []

	},

	getters: {

        getTransactionsFromGetters(state){ //take parameter state
          return state.transactions
       }
	},

	actions: {
        fetchTransactions({commit}){
        //     commit("SET_TRANSACTIONS",[
        //         {
        //             'mtcn' : 1111111111,
        //             'sender_name': 'John Doe1',
        //             'receiver_name' : 'John Dei1',
        //             'transaction_reference_number': 'ref111',
        //             'date_money_sent': '2010-12-01',
        //             'sub_agent' : 'Test Agent'
        //         },
        //         {
        //             'mtcn' : 2222222222,
        //             'sender_name': 'John Doe2',
        //             'receiver_name' : 'John Dei2',
        //             'transaction_reference_number': 'ref222',
        //             'date_money_sent': '2010-12-02',
        //             'sub_agent' : 'Test Agent'
        //         },
        //         {
        //             'mtcn' : 3333333333,
        //             'sender_name': 'John Doe3',
        //             'receiver_name' : 'John Dei3',
        //             'transaction_reference_number': 'ref333',
        //             'date_money_sent': '2010-12-03',
        //             'sub_agent' : 'Test Agent3'
        //         },
    
        // ]) // Transactions

        TransactionService.getTransactions()
        .then(response => {
            commit("SET_TRANSACTIONS", JSON.parse(response.data.send_money_store_logs))
        })
        .catch(error => {
        })

        

        
            
        },
    },

	mutations: {
       SET_TRANSACTIONS(state,data) {
          return state.transactions = data
       }
	}
}