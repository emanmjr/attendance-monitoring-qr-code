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
  getTransactions(dateTransaction) {
    let url = "/admin/api/get-transactions?dateTransaction=" + dateTransaction;
      const options = {
          method: 'GET',
          url,
      }

      return axios(options);
    
  },
}
