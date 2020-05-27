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
        fetchTransactions({commit} , transactionType){
              TransactionService.getTransactions()
              .then(response => {
                     if(transactionType == 'send') {
                            commit("SET_TRANSACTIONS", JSON.parse(response.data.send_money_store_logs))
                     }

                     if(transactionType == 'receive') {
                            commit("SET_TRANSACTIONS", JSON.parse(response.data.receive_money_pay_logs))
                     }
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