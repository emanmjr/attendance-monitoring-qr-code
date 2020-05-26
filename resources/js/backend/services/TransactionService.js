import axios from "axios"

// const apiClient = axios.create({
//   baseURL: `http://localhost:3000`,
//   withCredentials: false, // This is the default
//   headers: {
//     Accept: "application/json",
//     "Content-Type": "application/json"
//   }
// })

export default {
  getTransactions() {
    // return {
    //     'mtcn' : 12312312312,
    //     'sender_name': 'John Doe',
    //     'receiver_name' : 'John Dei',
    //     'transaction_reference_number': '123123123',
    //     'date_money_sent': '2010-12-12',
    //     'sub_agent' : 'Test Agent'
    // }
    let url = "/admin/api/get-transactions";
      const options = {
          method: 'GET',
          url,
      }

      return axios(options);
    
  },
}
