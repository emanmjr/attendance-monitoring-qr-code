<template>
    <div class="card">
        <div class="card-body">
          <div id="loading">
            <div class="spinner-border" id="loading-image"></div>
          </div>
            <!-- <form> -->
                <div>
                  <button type="button" class="btn btn-primary btn-dashboard float-right" v-if="isEnrollNewCustomerBtn" @click="enrollNewCustomer()">Enroll New Customer</button>
                </div>
                <div v-if="isEnrollNewCustomerBtn">
                  <h4 class="mt-3">WU Information</h4>
                  <hr>
                  MyWU Number: <b>{{ enrolledMyWuNumber }}</b>
                  <br><br>
                </div>
                
                <h4 class="mt-3">Basic Information</h4>
                <hr>
                <div class="form-row">
                    <!-- <div class="form-group col-md-4">
                        <label for="my_wu_no">My WU&#8480;
                        No.<span style="color:red;">*</span>
                        </label>
                        <input type="text" class="form-control" id="my_wu_no" placeholder="">
                    </div> -->
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="first_name">First Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.first_name ? 'is-invalid' : ''" id="first_name" v-model="form.first_name" :readonly="this.isReadOnly" required>
                        <span v-if="errorResponse.first_name" style="color:red;">{{ errorResponse.first_name[0] }}</span>
                    </div>
                    <!-- <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" v-model="form.middle_name">
                    </div> -->
                    <div class="form-group col-md-3">
                        <label for="last_name">Last Name<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.last_name ? 'is-invalid' : ''"  id="last_name" v-model="form.last_name" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.last_name" style="color:red;">{{ errorResponse.last_name[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">Gender<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.gender ? 'is-invalid' : ''" id="gender" v-model="form.gender" :readonly="this.isReadOnly">
                          <option value="null" disabled selected hidden></option>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                        </select>
                        <span v-if="errorResponse.gender" style="color:red;">{{ errorResponse.gender[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">Email<span style="color:red;"></span></label>
                        <input type="text" class="form-control" :class="errorResponse.email ? 'is-invalid' : ''"  id="email" v-model="form.email" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.email" style="color:red;">{{ errorResponse.email[0] }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="address">Address<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.address ? 'is-invalid' : ''" id="address" v-model="form.address" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.address" style="color:red;">{{ errorResponse.address[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city">City<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" :class="errorResponse.city ? 'is-invalid' : ''" id="city" v-model="form.city" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.city" style="color:red;">{{ errorResponse.city[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="postal_code">Postal Code<span style="color:red;">*</span></label>
                        <input type="text" @keypress="onlyNumber" class="form-control" :class="errorResponse.postal_code ? 'is-invalid' : ''" id="postal_code" v-model="form.postal_code" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.postal_code" style="color:red;">{{ errorResponse.postal_code[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="originating_country_code">Originating Country Code<span style="color:red;">*</span></label>
                      <select class="form-control" :class="errorResponse.originating_country_code ? 'is-invalid' : ''" v-model="form.originating_country_code" :readonly="this.isReadOnly">
                          <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                      </select>
                      <span v-if="errorResponse.originating_country_code" style="color:red;">{{ errorResponse.originating_country_code[0] }}</span>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="phone_number">Mobile Number(9XXXXXXXXX)<span style="color:red;">*</span></label>
                        <input type="text" class="form-control" @keypress="onlyNumber" :class="errorResponse.phone_number ? 'is-invalid' : ''" id="phone_number" v-model="form.phone_number" :readonly="this.isReadOnly">
                        <span v-if="errorResponse.phone_number" style="color:red;">The mobile number field is required</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="country_code">Country Code<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.country_code ? 'is-invalid' : ''" v-model="form.country_code" :readonly="this.isReadOnly">
                          <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                      </select>
                      <span v-if="errorResponse.country_code" style="color:red;">{{ errorResponse.country_code[0] }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="currency_code">Currency Code<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.currency_code ? 'is-invalid' : ''" v-model="form.currency_code" :readonly="this.isReadOnly">
                          <option v-for="(currencyCode, index) in this.CurrencyCodes" :value="index">{{ currencyCode }}</option>
                      </select>
                      <span v-if="errorResponse.currency_code" style="color:red;">{{ errorResponse.currency_code[0] }}</span>
                    </div>
                    <div class="form-group col-md-3" v-if="form.country_code == 'PH'">
                        <label for="postal_code">Province<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.province ? 'is-invalid' : ''" v-model="form.province" :readonly="this.isReadOnly">
                          <option v-for="province in this.Provinces" :value="province">{{ province }}</option>
                        </select>
                        <span v-if="errorResponse.province" style="color:red;">The province field is required</span>
                    </div>
                    <div class="form-group col-md-3" v-if="form.country_code == 'US' || form.country_code == 'MX'">
                        <label for="currency_code">State<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.province ? 'is-invalid' : ''" v-model="form.province" :readonly="this.isReadOnly">
                          <option v-for="(stateCode, index) in getStateCodes1" :value="form.country_code == 'US' ? index : stateCode" >{{ stateCode }}</option>
                      </select>
                      <span v-if="errorResponse.province" style="color:red;">The state field is required</span>
                    </div>
                    
                    
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="destination_country_code">Destination Country Code<span style="color:red;">*</span></label>
                      <select class="form-control" :class="errorResponse.destination_country_code ? 'is-invalid' : ''" v-model="form.destination_country_code" :readonly="this.isReadOnly">
                          <option v-for="(countryCode, index) in this.CountryCodes" :value="index">{{ countryCode }}</option>
                      </select>
                      <span v-if="errorResponse.destination_country_code" style="color:red;">{{ errorResponse.destination_country_code[0] }}</span>
                  </div>
                  <div class="form-group col-md-3">
                      <label for="destination_currency_code">Currency Code of Destination Country <span style="color:red;">*</span></label>
                      <select class="form-control" :class="errorResponse.destination_currency_code ? 'is-invalid' : ''" v-model="form.destination_currency_code" :readonly="this.isReadOnly">
                          <option v-for="(currencyCode, index) in this.CurrencyCodes" :value="index">{{ currencyCode }}</option>
                      </select>
                      <span v-if="errorResponse.destination_currency_code" style="color:red;">The destination country currency field is required</span>
                  </div>
                  <div class="form-group col-md-3" v-if="form.destination_country_code == 'US' || form.destination_country_code == 'MX'">
                        <label for="currency_code">State Code<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.state_code ? 'is-invalid' : ''" v-model="form.state_code" :readonly="this.isReadOnly">
                          <option v-for="(stateCode, index) in getStateCodes" :value="form.destination_country_code == 'US' ? index : stateCode" >{{ stateCode }}</option>
                      </select>
                      <span v-if="errorResponse.state_code" style="color:red;">{{ errorResponse.state_code[0] }}</span>
                    </div>
                    <div class="form-group col-md-3" v-if="form.destination_country_code == 'MX'">
                        <label for="currency_code">Expected City<span style="color:red;">*</span></label>
                        <select class="form-control" :class="errorResponse.expected_city ? 'is-invalid' : ''" v-model="form.expected_city" :readonly="this.isReadOnly">
                          <option v-for="mexicoCity in getMexicoCities" :value="mexicoCity">{{ mexicoCity }}</option>
                      </select>
                      <span v-if="errorResponse.expected_city" style="color:red;">{{ errorResponse.expected_city[0] }}</span>
                    </div>
                  
                  <!-- <div class="form-group col-md-3">
                      <label for="sender_currency_code">Currency Code of  Money  Being Sent<span style="color:red;">*</span></label>
                      <select class="form-control" :class="errorResponse.sender_currency_code ? 'is-invalid' : ''" v-model="form.sender_currency_code" :readonly="this.isReadOnly">
                          <option v-for="(currencyCode, index) in this.CurrencyCodes" :value="index">{{ currencyCode }}</option>
                      </select>
                      <span v-if="errorResponse.sender_currency_code" style="color:red;">The money being sent currency</span>
                  </div> -->
                </div>
                <div class="form-row">
                  
                  <!-- <div class="form-group col-md-3">
                      <label for="receiver_type">Receiver Type </label>
                      <input type="text" class="form-control" :class="errorResponse.receiver_type ? 'is-invalid' : ''" id="receiver_type" v-model="form.receiver_type" :readonly="this.isReadOnly">
                  </div> -->
                  <!-- <div class="form-group col-md-3">
                      <label for="id_on_file">ID On File (Y/N)</label>
                      <input type="text" class="form-control" :class="errorResponse.id_on_file ? 'is-invalid' : ''" id="id_on_file" v-model="form.id_on_file" :readonly="this.isReadOnly">
                  </div> -->
                  <!-- <div class="form-group col-md-3">
                      <label for="transfer_frequency">Transfer Frequency</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_frequency ? 'is-invalid' : ''" id="transfer_frequency" v-model="form.transfer_frequency" :readonly="this.isReadOnly">
                  </div> -->
                </div>
                <!-- <div class="form-row">
                  <div class="form-group col-md-3">
                      <label for="wu_transfer_frequency">WU Transfer Frequency</label>
                      <input type="text" class="form-control" :class="errorResponse.wu_transfer_frequency ? 'is-invalid' : ''" id="wu_transfer_frequency" v-model="form.wu_transfer_frequency" :readonly="this.isReadOnly">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="interests">Interests </label>
                      <input type="text" class="form-control" :class="errorResponse.interests ? 'is-invalid' : ''" id="interests" v-model="form.interests" :readonly="this.isReadOnly">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="mode_to_receive">Mode to Receive</label>
                      <input type="text" class="form-control" :class="errorResponse.mode_to_receive ? 'is-invalid' : ''" id="mode_to_receive" v-model="form.mode_to_receive" :readonly="this.isReadOnly">
                  </div>
                </div> -->
                <div class="form-row">
                  <!-- <div class="form-group col-md-3">
                      <label for="transfer_reason_1">Transfer Reason 1</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_reason_1 ? 'is-invalid' : ''" id="transfer_reason_1" v-model="form.transfer_reason_1" :readonly="this.isReadOnly">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="transfer_reason_2">Transfer Reason 2</label>
                      <input type="text" class="form-control" :class="errorResponse.transfer_reason_2 ? 'is-invalid' : ''" id="transfer_reason_2" v-model="form.transfer_reason_2" :readonly="this.isReadOnly">
                  </div> -->
                  <!-- <div class="form-group col-md-3">
                      <label for="id_on_file">ID On File (Y/N)</label>
                      <input type="text" class="form-control" :class="errorResponse.id_on_file ? 'is-invalid' : ''" id="id_on_file" v-model="form.id_on_file" :readonly="this.isReadOnly">
                  </div> -->
                </div>
                <div class="form-row">
                  <!-- <div class="form-group col-md-3">
                      <label for="preferred_language">Preferred Language (Ex. "EN, "ES")</label>
                      <input type="text" class="form-control" :class="errorResponse.preferred_language ? 'is-invalid' : ''" id="preferred_language" v-model="form.preferred_language" :readonly="this.isReadOnly">
                  </div> -->
                  <!-- <div class="form-group col-md-3">
                      <label for="card_status">Card Status</label>
                      <input type="text" class="form-control" :class="errorResponse.card_status ? 'is-invalid' : ''" id="card_status" v-model="form.card_status" :readonly="this.isReadOnly">
                  </div>
                  <div class="form-group col-md-3">
                      <label for="enrollment_source">Enroll Source</label>
                      <input type="text" class="form-control" :class="errorResponse.enrollment_source ? 'is-invalid' : ''" id="enrollment_source" v-model="form.enrollment_source" :readonly="this.isReadOnly">
                  </div> -->
                </div>
                <hr>

                <button type="button" class="btn btn-primary btn-dashboard" v-if="isEnrollBtn" @click="submitEnroll()">Enroll Now</button>
                <!-- </form> -->
        </div><!--card-body-->
    </div><!--card-->
</template>

<script>
var isoCountryCurrency = require('iso-country-currency');
export default {
    props: ['CountryCodes', 'CurrencyCodes', 'Provinces'],
    data() {
      return {
        is_employed_wbusiness: false,
        is_permanent: false,
        form: {
          first_name: '',
          last_name: '',
          gender: '',
          email: '',
          address: '',
          city: '',
          postal_code: '',
          country_code: '',
          currency_code: '',
          destination_country_code: '',
          destination_currency_code: '',
          // sender_currency_code: '',
          phone_number: '',
          originating_country_code: '',
          receiver_type: '',
          transfer_frequency: '',
          wu_transfer_frequency: '',
          interests: '',
          mode_to_receive: '',
          transfer_reason_1: '',
          transfer_reason_2: '',
          id_on_file: '',
          preferred_language: '',
          card_status: '',
          enrollment_source: '',
          state_code: '',
          expected_city: '',
          province: '',
        },
        errorResponse: '',
        enrolledMyWuNumber: '',
        isEnrollBtn: true,
        isEnrollNewCustomerBtn: false,
        isReadOnly: false,
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
        },
        mexicoStateCodeCities: [
          'GUANAJUATO',
          'TAMAULIPAS',
          'VERACRUZ',
          'PUEBLA',
          'VERACRUZ',
          'CHIAPAS',
          'GUANAJUATO',
          'ESTADO DE MEXICO',
          'YUCATAN',
          'CHIAPAS',
          'NAYARIT',
          'GUERRERO',
          'GUERRERO',
          'JALISCO',
          'PUEBLA',
          'OAXACAFIGUEROA',
          'PUEBLA',
          'HIDALGO',
          'VERACRUZ',
          'ESTADO DE MEXICO',
          'SONORA',
          'HIDALGO',
          'VERACRUZ',
          'MICHOACAN',
          'ESTADO DE MEXICO',
          'QUINTANA ROOHUERTA',
          'SINALOA',
          'HIDALGO',
          'VERACRUZ',
          'SONORA',
          'SINALOA',
          'NUEVO LEON',
          'SINALOA',
          'AGUASCALIENTES',
          'MICHOACAN',
          'COAHUILA',
          'SINALOA',
          'NAYARIT',
          'QUERETARO',
          'SAN LUIS POTOSI',
          'JALISCO',
          'PUEBLA',
          'JALISCO',
          'GUERRERO',
          'YUCATAN',
          'VERACRUZ',
          'SONORA',
          'SAN LUIS POTOSI',
          'GUERRERO',
          'CHIHUAHUA',
          'TAMAULIPAS',
          'CAMPECHE',
          'SINALOA',
          'COAHUILA',
          'NUEVO LEON',
          'VERACRUZ',
          'ESTADO DE MEXICO',
          'ESTADO DE MEXICO',
          'ESTADO DE MEXICO',
          'GUERRERO',
          'TAMAULIPAS',
          'CHIAPAS',
          'VERACRUZ',
          'VERACRUZ',
          'VERACRUZ',
          'MICHOACAN',
          'MORELOS',
          'ESTADO DE MEXICO',
          'CHIAPAS',
          'JALISCO',
          'NAYARIT',
          'VERACRUZREYES',
          'QUERETARO',
          'JALISCO',
          'ESTADO DE MEXICO',
          'PUEBLA',
          'NUEVO LEON',
          'CHIAPAS',
          'VERACRUZ',
          'SINALOA',
          'TAMAULIPAS',
          'VERACRUZ',
          'HIDALGO',
          'GUANAJUATO',
          'GUANAJUATO',
          'MICHOACAN',
          'ESTADO DE MEXICO',
          'GUERRERO',
          'TLAXCALA',
          'NUEVO LEON',
          'SAN LUIS POTOSI',
          'NUEVO LEON',
          'JALISCO',
          'GUERRERO',
          'MICHOACAN',
          'SONORA',
          'COLIMA',
          'CHIAPAS',
          'TABASCO',
          'QUERETARO',
          'COAHUILA',
          'MICHOACAN',
          'CHIHUAHUA',
          'CHIHUAHUA',
          'AGUASCALIENTES',
          'VERACRUZ',
          'OAXACA',
          'OAXACA',
          'OAXACA',
          'GUANAJUATO',
          'CAMPECHE',
          'PUEBLA',
          'PUEBLA',
          'JALISCO',
          'HIDALGO',
          'ESTADO DE MEXICO',
          'ESTADO DE MEXICO',
          'VERACRUZ',
          'HIDALGO',
          'MORELOS',
          'PUEBLA',
          'GUERRERO',
          'JALISCO',
          'HIDALGO',
          'VERACRUZ',
          'GUERRERO',
          'VERACRUZ',
          'VERACRUZ',
          'JALISCO',
          'CHIHUAHUA',
          'MORELOS',
          'SAN LUIS POTOSI',
          'VERACRUZ',
          'OAXACA',
          'JALISCO',
          'PUEBLA',
          'OAXACA',
          'JALISCO',
          'GUERREROLIBRES',
          'GUERRERO',
          'YUCATAN',
          'SONORA',
          'QUINTANA ROO',
          'SONORA',
          'SONORA',
          'SINALOA',
          'BAJA CALIFORNIA SUR',
          'NAYARIT',
          'SONORA',
          'BAJA CALIFORNIA SUR',
          'TABASCO',
          'CHIHUAHUA',
          'SONORA',
          'VERACRUZ',
          'TAMAULIPAS',
          'OAXACASOLEDAD',
          'CAMPECHE',
          'CHIAPASAMERICAS',
          'GUERRERO',
          'MICHOACAN',
          'QUINTANA ROO',
          'VERACRUZ',
          'COAHUILA',
          'SINALOAGOBIERNO',
          'TABASCOCARLOS',
          'SONORA',
          'DURANGO',
          'CHIAPAS',
          'VERACRUZ',
          'CHIAPAS',
          'CHIHUAHUA',
          'JALISCO',
          'CAMPECHE',
          'NAYARIT',
          'YUCATAN',
          'CHIHUAHUA',
          'BAJA CALIFORNIA SUR',
          'COAHUILA',
          'MICHOACAN',
          'TAMAULIPAS',
          'CAMPECHE',
          'JALISCO',
          'BAJA CALIFORNIA SUR',
          'SONORA',
          'CHIAPAS',
          'YUCATAN',
          'QUERETARO',
          'NUEVO LEON',
          'SONORA',
          'CAMPECHE',
          'ZACATECASROSALES',
          'OAXACA',
          'ESTADO DE MEXICOGONZALEZ',
          'CAMPECHE',
          'HIDALGO',
          'TLAXCALA',
          'AGUASCALIENTES',
          'BAJA CALIFORNIA NORTE',
          'OAXACA',
          'CAMPECHE',
          'SONORA',
          'DURANGO',
          'QUINTANA ROO',
          'COAHUILA',
          'CAMPECHE',
          'OAXACA',
          'DURANGO',
          'ZACATECASPESCADOR',
          'YUCATAN',
          'MICHOACAN',
          'SONORA',
          'SAN LUIS POTOSI',
          'TABASCO',
          'VERACRUZ',
          'JALISCO',
          'COAHUILA',
          'CHIAPAS',
          'VERACRUZ',
          'SAN LUIS POTOSI',
          'VERACRUZ',
          'DURANGO',
          'SAN LUIS POTOSI',
          'GUANAJUATO',
          'YUCATAN',
          'YUCATAN',
          'TABASCO',
          'GUANAJUATO',
          'NUEVO LEON',
          'SAN LUIS POTOSI',
          'VERACRUZ',
          'COLIMA',
          'VERACRUZ',
          'OAXACA',
          'OAXACA',
          'PUEBLA',
          'ZACATECAS',
          'ESTADO DE MEXICO',
          'ESTADO DE MEXICO',
          'CAMPECHE',
          'ESTADO DE MEXICO',
          'JALISCO',
          'HIDALGO',
          'MICHOACAN',
          'SAN LUIS POTOSI',
          'MICHOACAN',
          'YUCATAN',
          'MICHOACAN',
          'QUINTANA ROO',
          'CHIAPAS',
          'ESTADO DE MEXICO',
          'PUEBLA',
          'GUERRERO',
          'QUERETARO',
          'PUEBLA',
          'ESTADO DE MEXICO',
          'CHIAPAS',
          'ESTADO DE MEXICO',
          'VERACRUZ',
          'YUCATAN',
          'PUEBLA',
          'PUEBLA',
          'CHIHUAHUA',
          'NAYARIT',
          'GUERRERO',
          'CHIAPAS',
          'GUERRERO',
          'ESTADO DE MEXICO',
          'NUEVO LEON',
          'MORELOS',
          'VERACRUZ',
          'VERACRUZ',
          'CHIHUAHUA',
          'JALISCO',
          'VERACRUZ',
          'YUCATAN',
          'SINALOA',
          'PUEBLA',
          'YUCATAN',
          'MICHOACAN',
          'MICHOACAN',
          'NUEVO LEON',
          'OAXACA',
          'JALISCO',
          'CHIAPAS',
          'VERACRUZ',
          'COAHUILA',
          'GUERRERO',
          'MORELOS',
          'NUEVO LEON',
          'CHIHUAHUA',
          'TAMAULIPAS',
          'VERACRUZ',
          'CAMPECHE',
          'BAJA CALIFORNIA SUR',
          'CHIHUAHUA',
          'TAMAULIPAS',
          'TLAXCALA',
          'CAMPECHE',
          'SAN LUIS POTOSI',
          'SAN LUIS POTOSI',
          'TAMAULIPASORDAZ',
          'JALISCO',
          'CHIAPAS',
          'MICHOACAN',
        ],
        mexicoCities: [
          'ABASOLO',
          'ABASOLO',
          'ABASOLO DEL VALLE',
          'ACAJETE',
          'ACAJETE',
          'ACALA',
          'ACAMBARO',
          'ACAMBAY',
          'ACANCEH',
          'ACAPETAHUA',
          'ACAPONETA',
          'ACAPULCO',
          'ACATEPEC',
          'ACATLAN DE JUAREZ',
          'ACATLAN DE OSORIO',
          'ACATLAN DE PEREZ FIGUEROA',
          'ACATZINGO',
          'ACAXOCHITLAN',
          'ACAYUCAN',
          'ACOLMAN',
          'ACONCHI',
          'ACTOPAN',
          'ACTOPAN',
          'ACUITZIO DEL CANJE',
          'ACULCO DE ESPINOZA',
          'ADOLFO DE LA HUERTA',
          'ADOLFO RUIZ CORTINES',
          'AGUA BLANCA HIDALGO',
          'AGUA DULCE',
          'AGUA PRIETA',
          'AGUA VERDE',
          'AGUALEGUAS',
          'AGUARUTO',
          'AGUASCALIENTES',
          'AGUILILLA',
          'AGUJITA',
          'AHOME',
          'AHUACATLAN',
          'AHUACATLAN DE GUADALUPE',
          'AHUALULCO',
          'AHUALULCO DE MERCADO',
          'AJALPAN',
          'AJIJIC',
          'AJUCHITLAN DEL PROGRESO',
          'AKIL',
          'ALAMO',
          'ALAMOS',
          'ALAQUINES',
          'ALCOZAUCA DE GUERRERO',
          'ALDAMA',
          'ALDAMA',
          'ALFREDO V BONFIL',
          'ALHUEY',
          'ALLENDE',
          'ALLENDE',
          'ALLENDE',
          'ALMOLOYA DE ALQUISIRAS',
          'ALMOLOYA DE JUAREZ',
          'ALMOLOYA DEL RIO',
          'ALPOYECA',
          'ALTAMIRA',
          'ALTAMIRANO',
          'ALTO LUCERO',
          'ALTOTONGA',
          'ALVARADO',
          'ALVARO OBREGON',
          'AMACUZAC',
          'AMANALCO DE BECERRA',
          'AMATAN',
          'AMATITAN',
          'AMATLAN DE CANAS',
          'AMATLAN DE LOS REYES',
          'AMEALCO DE BONFIL',
          'AMECA',
          'AMECAMECA',
          'AMOZOC',
          'ANAHUAC',
          'ANGEL ALBINO CORZO',
          'ANGEL R CABADA',
          'ANGOSTURA',
          'ANTIGUO MORELOS',
          'ANTON LIZARDO',
          'APAN',
          'APASEO EL ALTO',
          'APASEO EL GRANDE',
          'APATZINGAN',
          'APAXCO',
          'APAXTLA DE CASTREJON',
          'APIZACO',
          'APODACA',
          'AQUISMON',
          'ARAMBERRI',
          'ARANDAS',
          'ARCELIA',
          'ARIO DE ROSALES',
          'ARIZPE',
          'ARMERIA',
          'ARRIAGA',
          'ARROYO HONDO ABEJONAL',
          'ARROYO SECO',
          'ARTEAGA',
          'ARTEAGA',
          'ASCENCION',
          'ASCENSION',
          'ASIENTOS',
          'ASTACINGA',
          'ASUNCION ATOYAQUILLO',
          'ASUNCION NOCHIXTLAN',
          'ASUNCION OCOTLAN',
          'ATARJEA',
          'ATASTA',
          'ATEMPAN',
          'ATENCINGO',
          'ATENGUILLO',
          'ATITALAQUIA',
          'ATIZAPAN DE ZARAGOZA',
          'ATLACOMULCO',
          'ATLAHUILCO',
          'ATLAPEXCO',
          'ATLATLAHUCAN',
          'ATLIXCO',
          'ATLIXTAC',
          'ATOTONILCO EL ALTO',
          'ATOTONILCO EL GRANDE',
          'ATOYAC',
          'ATOYAC DE ALVAREZ',
          'ATZACAN',
          'ATZALAN',
          'AUTLAN DE NAVARRO',
          'AVALOS',
          'AXOCHIAPAN',
          'AXTLA DE TERRAZAS',
          'AYAHUALULCO',
          'AYOQUEZCO DE ALDAMA',
          'AYOTLAN',
          'AYOTOXCO DE GUERRERO',
          'AYOTZINTEPEC',
          'AYUTLA',
          'AYUTLA DE LOS LIBRES',
          'AZOYU',
          'BACA',
          'BACADEHUACHI',
          'BACALAR',
          'BACOBAMPO',
          'BACUM',
          'BADIRAGUATO',
          'BAHIA ASUNCION',
          'BAHIA DE BANDERAS',
          'BAHIA DE KINO',
          'BAHIA TORTUGAS',
          'BALANCAN',
          'BALLEZA',
          'BANAMICHI',
          'BANDERILLA',
          'BARRETAL',
          'BARRIO DE LA SOLEDAD',
          'BECAL',
          'BENEMERITO DE LAS AMERICAS',
          'BENITO JUAREZ',
          'BENITO JUAREZ',
          'BENITO JUAREZ',
          'BENITO JUAREZ',
          'BENITO JUAREZ ACUNA',
          'BENITO JUAREZ CAMPO GOBIERNO',
          'BENITO JUAREZ SAN CARLOS',
          'BENJAMIN HILL',
          'BERMEJILLO',
          'BERRIOZABAL',
          'BOCA DEL RIO',
          'BOCHIL',
          'BOCOYNA',
          'BOLANOS',
          'BOLONCHEN DE REJON',
          'BUCERIAS',
          'BUCTZOTZ',
          'BUENAVENTURA',
          'BUENAVISTA',
          'BUENAVISTA PIEDRA',
          'BUENAVISTA TOMATLAN',
          'BURGOS',
          'CABANCUY',
          'CABO CORRIENTES',
          'CABO SAN LUCAS',
          'CABORCA',
          'CACAHOATAN',
          'CACALCHEN',
          'CADEREYTA',
          'CADEREYTA DE JIMENEZ',
          'CAJEME',
          'CALAKMUL',
          'CALERA DE VICTOR ROSALES',
          'CALIHUALA',
          'CALIMAYA DE DIAZ GONZALEZ',
          'CALKINI',
          'CALNALI',
          'CALPULALPAN',
          'CALVILLO',
          'CAMALU',
          'CAMOTINCHAN',
          'CAMPECHE',
          'CANANEA',
          'CANATLAN',
          'CANCUN',
          'CANDELA',
          'CANDELARIA',
          'CANDELARIA LOXICHA',
          'CANELAS',
          'CANITAS DE FELIPE PESCADOR',
          'CANSAHCAB',
          'CARACUARO DE MORELOS',
          'CARBO',
          'CARDENAS',
          'CARDENAS',
          'CARLOS A CARRILLO',
          'CASIMIRO CASTILLO',
          'CASTANOS',
          'CATAZAJA',
          'CATEMACO',
          'CATORCE',
          'CAZONES DE HERRERA',
          'CEBALLOS',
          'CEDRAL',
          'CELAYA',
          'CELESTUN',
          'CENOTILLO',
          'CENTLA',
          'CERANO',
          'CERRALVO',
          'CERRITOS',
          'CERRO AZUL',
          'CERRO DE ORTEGA',
          'CHACALTIANGUIS',
          'CHAHUITES',
          'CHALCATONGO DE HIDALGO',
          'CHALCHICOMULA DE SESMA',
          'CHALCHIHUITES',
          'CHALCO',
          'CHALCO MEX',
          'CHAMPOTON',
          'CHAPA DE MOTA',
          'CHAPALA',
          'CHAPULHUACAN',
          'CHARAPAN',
          'CHARCAS',
          'CHAVINDA',
          'CHEMAX',
          'CHERAN',
          'CHETUMAL',
          'CHIAPA DE CORZO',
          'CHIAUTLA',
          'CHIAUTLA DE TAPIA',
          'CHICHIHUALCO',
          'CHICHIMEQUILLAS',
          'CHICHIQUILA',
          'CHICOLOAPAN DE JUAREZ',
          'CHICOMUSELO',
          'CHICONCUAC',
          'CHICONTEPEC',
          'CHICXULUB PUEBLO',
          'CHIETLA',
          'CHIGNAHUAPAN',
          'CHIHUAHUA',
          'CHILAPA',
          'CHILAPA DE ALVAREZ',
          'CHILON',
          'CHILPANCINGO',
          'CHIMALHUACAN',
          'CHINA',
          'CHINAMECA',
          'CHINAMECA',
          'CHINANTLA',
          'CHINIPAS DE ALMADA',
          'CHIQUILISTLAN',
          'CHOCAMAN',
          'CHOCHOLA',
          'CHOIX',
          'CHOLULA',
          'CHUBURNA PUERTO',
          'CHUCANDIRO',
          'CHURINTZIO',
          'CIENEGA DE FLORES',
          'CIENEGA DE ZIMATLAN',
          'CIHUATLAN',
          'CINTALAPA',
          'CITLALTEPEC',
          'CIUDAD ACUNA',
          'CIUDAD ALTAMIRANO',
          'CIUDAD AYALA',
          'CIUDAD BENITO JUAREZ',
          'CIUDAD CAMARGO',
          'CIUDAD CAMARGO',
          'CIUDAD CARDEL',
          'CIUDAD CONCORDIA',
          'CIUDAD CONSTITUCION',
          'CIUDAD CUAUHTEMOC',
          'CIUDAD CUAUHTEMOC',
          'CIUDAD DE NANACAMILPA',
          'CIUDAD DEL CARMEN',
          'CIUDAD DEL MAIZ',
          'CIUDAD FERNANDEZ',
          'CIUDAD GUSTAVO DIAZ ORDAZ',
          'CIUDAD GUZMAN',
          'CIUDAD HIDALGO',
          'CIUDAD HIDALGO',
        ]
      }
    },
    watch: {
      checkMexicoStateCode(data){
        if (this.form.destination_country_code == 'MX'){
          let indexOfMexicoState = this.mexicoStateCodeCities.indexOf(data);
          this.form.expected_city = this.mexicoCities[indexOfMexicoState];
        }else{
          this.form.expected_city = "";
        }
      },
      checkCurrencyCode(data){
        this.form.currency_code = data;
      },
      checkDestinationCurrencyCode(data){
        this.form.destination_currency_code = data;
      },
      checkEmployedBusiness (data) {

        if(data == 1){
          this.is_employed_wbusiness = true;
        } else {
          this.is_employed_wbusiness = false;
        }
      },
      checkPermanentAdd (data) {
        if(data == 1){
          this.is_permanent = true;
        } else {
          this.is_permanent = false;
        }
      }
    },
    computed: {
      checkCurrencyCode(){

        if(this.form.country_code != ""){

        if(this.form.country_code == 'BY'){
          return 'BYN';
        }
        if(this.form.country_code == 'YE'){
          return 'YER';
        }
        if(this.form.country_code == 'MR'){
          return 'MRO';
        }
        if(this.form.country_code == 'PA'){
          return 'USD';
        }
        if(this.form.country_code == 'ST'){
          return 'STN';
        }
        if(this.form.country_code == 'ZM'){
          return 'ZMW';
        }
        if(this.form.country_code == 'ZW'){
          return 'ZWD';
        }
          if(this.form.country_code in this.countryNotListed){
            return isoCountryCurrency.getParamByISO(this.currencyOfNotListed[this.form.country_code], 'currency');
          }else{
            var currencyCode = isoCountryCurrency.getParamByISO(this.form.country_code, 'currency');
          }
        }
        return currencyCode;
      },
      checkDestinationCurrencyCode(){

        if(this.form.destination_country_code != ""){

        if(this.form.destination_country_code == 'BY'){
          return 'BYN';
        }
        if(this.form.destination_country_code == 'YE'){
          return 'YER';
        }
        if(this.form.destination_country_code == 'MR'){
          return 'MRO';
        }
        if(this.form.destination_country_code == 'PA'){
          return 'USD';
        }
        if(this.form.destination_country_code == 'ST'){
          return 'STN';
        }
        if(this.form.destination_country_code == 'ZM'){
          return 'ZMW';
        }
        if(this.form.destination_country_code == 'ZW'){
          return 'ZWD';
        }
          if(this.form.destination_country_code in this.countryNotListed){
            return isoCountryCurrency.getParamByISO(this.currencyOfNotListed[this.form.destination_country_code], 'currency');
          }else{
            var currencyCode = isoCountryCurrency.getParamByISO(this.form.destination_country_code, 'currency');
          }
        }
        return currencyCode;
      },
      checkEmployedBusiness() {
        return this.form.employed_wbusiness;
      },
      checkPermanentAdd() {
        return this.form.permanent_add;
      },
      checkMexicoStateCode(){
        return this.form.state_code;
      },
      getMexicoCities(){
        return this.mexicoCities;
      },
      getStateCodes(){

        if(this.form.destination_country_code == 'MX'){
          return this.mexicoStateCodeCities;
        }

        return {
          'AL': 'Alabama',
          'AK': 'Alaska',
          'AZ': 'Arizona',
          'AR': 'Arkansas',
          'CA': 'California',
          'CO': 'Colorado',
          'CT': 'Connecticut',
          'DE': 'Delaware',
          'DC': 'District of Columbia',
          'FL': 'Florida',
          'GA': 'Georgia',
          'HI': 'Hawaii',
          'ID': 'Idaho',
          'IL': 'Illinois',
          'IN': 'Indiana',
          'IA': 'Iowa',
          'KS': 'Kansas',
          'KY': 'Kentucky',
          'LA': 'Louisiana',
          'ME': 'Maine',
          'MD': 'Maryland',
          'MA': 'Massachusetts',
          'MI': 'Michigan',
          'MN': 'Minnesota',
          'MS': 'Mississippi',
          'MO': 'Missouri',
          'MT': 'Montana',
          'NE': 'Nebraska',
          'NV': 'Nevada',
          'NH': 'New Hampshire',
          'NJ': 'New Jersey',
          'NM': 'New Mexico',
          'NY': 'New York',
          'NC': 'North Carolina',
          'ND': 'North Dakota',
          'OH': 'Ohio',
          'OK': 'Oklahoma',
          'OR': 'Oregon',
          'PA': 'Pennsylvania',
          'PR': 'Puerto Rico',
          'RI': 'Rhode Island',
          'SC': 'South Carolina',
          'SD': 'South Dakota',
          'TN': 'Tennessee',
          'TX': 'Texas',
          'AA': 'US Military Atlantic',
          'AE': 'US Military Europe',
          'AP': 'US Military Pacific',
          'UT': 'Utah',
          'VT': 'Vermont',
          'VI': 'Virgin Islands',
          'VA': 'Virginia',
          'WA': 'Washington',
          'WV': 'West Virginia',
          'WI': 'Wisconsin',
          'WY': 'Wyoming',
        };
      },getStateCodes1(){

        if(this.form.country_code == 'MX'){
          return this.mexicoStateCodeCities;
        }

        return {
          'AL': 'Alabama',
          'AK': 'Alaska',
          'AZ': 'Arizona',
          'AR': 'Arkansas',
          'CA': 'California',
          'CO': 'Colorado',
          'CT': 'Connecticut',
          'DE': 'Delaware',
          'DC': 'District of Columbia',
          'FL': 'Florida',
          'GA': 'Georgia',
          'HI': 'Hawaii',
          'ID': 'Idaho',
          'IL': 'Illinois',
          'IN': 'Indiana',
          'IA': 'Iowa',
          'KS': 'Kansas',
          'KY': 'Kentucky',
          'LA': 'Louisiana',
          'ME': 'Maine',
          'MD': 'Maryland',
          'MA': 'Massachusetts',
          'MI': 'Michigan',
          'MN': 'Minnesota',
          'MS': 'Mississippi',
          'MO': 'Missouri',
          'MT': 'Montana',
          'NE': 'Nebraska',
          'NV': 'Nevada',
          'NH': 'New Hampshire',
          'NJ': 'New Jersey',
          'NM': 'New Mexico',
          'NY': 'New York',
          'NC': 'North Carolina',
          'ND': 'North Dakota',
          'OH': 'Ohio',
          'OK': 'Oklahoma',
          'OR': 'Oregon',
          'PA': 'Pennsylvania',
          'PR': 'Puerto Rico',
          'RI': 'Rhode Island',
          'SC': 'South Carolina',
          'SD': 'South Dakota',
          'TN': 'Tennessee',
          'TX': 'Texas',
          'AA': 'US Military Atlantic',
          'AE': 'US Military Europe',
          'AP': 'US Military Pacific',
          'UT': 'Utah',
          'VT': 'Vermont',
          'VI': 'Virgin Islands',
          'VA': 'Virginia',
          'WA': 'Washington',
          'WV': 'West Virginia',
          'WI': 'Wisconsin',
          'WY': 'Wyoming',
        };
      }
    },
    mounted() {
      document.getElementById('loading').style.display = 'none';
      this.isEnrollNewCustomerBtn = false;
      this.isEnrollBtn = true;
      this.isReadOnly = false;
    },
    methods: {
      onlyNumber ($event) {
        //console.log($event.keyCode); //keyCodes value
        let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
        if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
            $event.preventDefault();
        }
      },
      enrollNewCustomer() {
            this.form.first_name = '';
            this.form.last_name = '';
            this.form.gender = '';
            this.form.email = '';
            this.form.address = '';
            this.form.city = '';
            this.form.postal_code = '';
            this.form.country_code = '';
            this.form.currency_code = '';
            this.form.destination_country_code = '';
            this.form.destination_currency_code = '';
            this.form.sender_currency_code = '';
            this.form.phone_number = '';
            this.form.originating_country_code = '',
            // this.form.receiver_type = '',
            // this.form.transfer_frequency = '',
            // this.form.wu_transfer_frequency = '',
            // this.form.interests = '',
            // this.form.mode_to_receive = '',
            // this.form.transfer_reason_1 = '',
            // this.form.transfer_reason_2 = '',
            // this.form.id_on_file = '',
            // this.form.preferred_language = '',
            // this.form.card_status = '',
            // this.form.enrollment_source = ''

            this.isEnrollNewCustomerBtn = false;
            this.isEnrollBtn = true;
            this.isReadOnly = false;
      },
      submitEnroll() {
        document.getElementById('loading').style.display = 'block';
        axios.post('/admin/api/enroll-customer', this.form)
        .then((response) => {
          document.getElementById('loading').style.display = 'none';
          if(response.data.error){
              Swal.fire({
              icon: 'error',
              title: 'Something went wrong!',
              text: '' + response.data.error,
            })
            
          }


          this.enrolledMyWuNumber = response.data.sender.preferred_customer.mywu_number;
          // handle success
          if(response.data.foreign_remote_system.reference_no) {
            document.getElementById('loading').style.display = 'none';
            this.errorResponse = '';
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: '<h4>Customer has been successfully enrolled.</h4>',
              html: '<table class="table table-striped">' +
                    '<tbody style="text-align:left; font-size:12px;">' +
                    '<tr>' +
                    '<td>MYWU Number: ' + response.data.sender.preferred_customer.mywu_number + '</td>' +
                    '<td>Email: ' + this.form.email + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>First Name: ' + this.form.first_name + '</td>' +
                    '<td>Last Name: ' + this.form.last_name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Phone Number: ' + this.form.phone_number + '</td>' +
                    '<td>Gender: ' + this.form.gender + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Address: ' + this.form.address + '</td>' +
                    '<td>City: ' + this.form.city + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Province: ' + this.form.province + '</td>' +
                    '<td>Postal Code: ' + this.form.postal_code + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Country Code: ' + this.form.country_code + '</td>' +
                    '<td>Sender Currency Code: ' + this.form.sender_currency_code + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Destination Country Code: ' + this.form.destination_country_code + '</td>' +
                    '<td>Destination Currency Code: ' + this.form.destination_currency_code + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Origination Currency Code: ' + this.form.originating_country_code + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table> ',
              // text: 'MyWU Number: ' + response.data.sender.preferred_customer.mywu_number,
              // html: '<span style="font-size: 12px;>MyWU Number: ' + response.data.sender.preferred_customer.mywu_number  + '</span><br><span style="font-size: 12px;>Mobile Number: ' + this.form.phone_number + '</span>', 
              showConfirmButton: true,
            })
            
            // Show Enroll new customer
            this.isEnrollNewCustomerBtn = true;
            this.isEnrollBtn = false;
            this.isReadOnly = true;
          }

        })
        .catch((error) => {
          if(error){
            if( error.response.status == 422 ){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              footer: 'Please see fields that are required.'
            })
            this.errorResponse = error.response.data.errors;
          } else {
             Swal.fire({
              icon: 'error',
              title: 'Something went wrong!',
              text: 'Please check field values if it is/are correct.',
              footer: '' + error
            })
          }
          }

          document.getElementById('loading').style.display = 'none';
        })
      }
    }
}
</script>

<style lang="scss" scoped>
    #swal2-content {
      text-align: left;
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