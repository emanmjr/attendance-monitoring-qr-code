<template>
    <div class="card">
        <div class="card-header">
            <!-- <i class="fas fa-code"></i>  -->
            Attendance
        </div>
        <div class="card-body">
          <div v-if="showBtns">
            <button class="btn btn-warning btn-sm" @click="scanQRCode('in')">Time In</button>
            <button class="btn btn-warning btn-sm" @click="scanQRCode('out')">Time Out</button>
          </div>
          <div v-if="!showBtns">
            <button class="btn btn-warning btn-sm" @click="cancelRecord">Cancel</button>
            <p></p>
            <p>Show your QR Code in front of camera</p>
          </div>
          <hr>
          <div v-if="showScanner">
            <qrcode-stream @decode="onDecode"></qrcode-stream>
          </div>

          <div v-if="showLoading">
            Please wait ... <div class="spinner-border" id="loading-image"></div>
          </div>

          <div>
            {{ responseMessage }}
          </div>

        </div>
    </div>
</template>

<script>

    export default {
      data() {
        return {
          showBtns: true,
          showScanner: false,
          status: '',
          showLoading: false,
          responseMessage: '',
          showResponseMessage: true
        }
      },
      methods: {
        cancelRecord(){
          this.showScanner = false;
          this.showBtns = true;
          
        },
        scanQRCode(status){
          this.status = status;
          this.showScanner = true;
          this.showBtns = false;
          this.showLoading = false;

        },
        onDecode (decodedString) {
          if(decodedString){
            this.showLoading = true;
            this.showScanner = false;
            let data = {
              'status': this.status,
              'qr_code': decodedString
            };

            axios.post('/api/record/attendance', data)
            .then((response) => {
              console.log(response)
              if(response){
                this.responseMessage = response.data.data.message;
                this.showLoading = false;
                this.showBtns = true;

                
              }

              setTimeout(() => {
                  this.responseMessage = ''
                }, 3000);
                
            })
            .catch((err) => {
              console.log(err)
            })
          }
        }
      },
      mounted() {
      }
    }
</script>
