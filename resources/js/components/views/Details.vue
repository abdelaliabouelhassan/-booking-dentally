<template>
  <MainLayouts>
    <template v-slot:slides>
      <div class="mt-auto mb-1">
        <p class="uppercase text-theme-gold">Step 4</p>
        <h1 class="text-white text-3xl mb-1">Your details</h1>
      </div>
    </template>
    <template v-slot:current-options>
      <ul class="uppercase text-white marker:text-theme-gold list-disc">
        <li class="flex items-center space-x-2 text-xs">
          <span>{{ store.treatments.name }}</span>
          <svg
            width="10"
            height="10"
            viewBox="0 0 4 4"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="1.85995" cy="2.03817" r="1.34237" fill="#BA812E" />
          </svg>
          <span>{{ store.practitioner.name }}</span>
          <svg
            width="10"
            height="10"
            viewBox="0 0 4 4"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="1.85995" cy="2.03817" r="1.34237" fill="#BA812E" />
          </svg>
          <span>{{ formatDateToTime(store.availableTime.start_time) }}</span>
          <svg
            width="10"
            height="10"
            viewBox="0 0 4 4"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="1.85995" cy="2.03817" r="1.34237" fill="#BA812E" />
          </svg>
          <span>{{ formateDate(store.availableTime.start_time) }}</span>
        </li>
      </ul>
    </template>
    <template v-slot:body>
           <div
                v-if="store.treatments.key == 2"
                class="w-full bg-[#C3948D] p-5 text-start text-white font-normal text-base"
            >
                Please note there is a consultation fee of £60.00 payable on
                confirmation of the booking. This amount will be deducted from
                your final treatment invoice.
            </div>
            <!-- <div  v-if="store.treatments.key == 1" class="w-full bg-[#C3948D] p-5 text-start text-white font-normal text-base">
                Our Smile Makeover consultations are FREE and your card will not 
                be charged if you attend your consultation. If you do not attend 
                your consultation you will be charged a fee of £60.00 unless 
                cancelled 48 hours prior to the appointment.
            </div> -->
      <div class="p-10 space-y-8">
        <h1 class="uppercase font-semibold">Your details</h1>

        <div class="w-full flex flex-col items-start space-y-4">
          <div class="flex flex-col items-start space-y-1 w-full">
            <span class="text-xs font-medium text-red-600">{{
              errors.title
            }}</span>
            <select
              v-model.trim="store.details.title"
              name=""
              id=""
              class="
                text-xs text-[#525252]
                font-bold
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.title }"
            >
              <option value="" selected disabled>Title</option>
              <option value="Mr">Mr</option>
              <option value="Mrs">Mrs</option>
              <option value="Miss">Miss</option>
              <option value="Ms">Ms</option>
              <option value="Dr">Dr</option>
            </select>
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.first_name
            }}</span>
            <input
              v-model.trim="store.details.first_name"
              type="text"
              placeholder="First Name"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.first_name }"
            />
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.last_name
            }}</span>
            <input
              v-model.trim="store.details.last_name"
              type="text"
              placeholder="Last Name"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.last_name }"
            />
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-sm text-[#525252] font-bold">Date of birth</span>
            <div class="w-full grid grid-cols-3 gap-5">
              <div class="flex flex-col items-start space-y-1">
                <span class="text-xs font-medium text-red-600">{{
                  errors.day
                }}</span>
                <select
                  v-model.trim="store.details.day"
                  name=""
                  id=""
                  class="
                    text-xs text-[#525252]
                    font-bold
                    placeholder-[#D9D9D9]
                    w-full
                    py-4
                    px-4
                    outline-none
                    rounded-full
                    border-[0.5px] border-[#52525280]
                    hover:border-[#BA812E]
                    focus:border-[#BA812E]
                  "
                  :class="{ 'border-red-500': errors.day }"
                >
                  <option value="" selected disabled>Day</option>
                  <option :value="item" v-for="item in days" :key="item">
                    {{ item }}
                  </option>
                </select>
              </div>
              <div class="flex flex-col items-start space-y-1">
                <span class="text-xs font-medium text-red-600">{{
                  errors.month
                }}</span>
                <select
                  v-model.trim="store.details.month"
                  name=""
                  id=""
                  class="
                    text-xs text-[#525252]
                    font-bold
                    placeholder-[#D9D9D9]
                    w-full
                    py-4
                    px-4
                    outline-none
                    rounded-full
                    border-[0.5px] border-[#52525280]
                    hover:border-[#BA812E]
                    focus:border-[#BA812E]
                  "
                  :class="{ 'border-red-500': errors.month }"
                >
                  <option value="" selected disabled>Month</option>
                  <option :value="item" v-for="item in months" :key="item">
                    {{ item }}
                  </option>
                </select>
              </div>
              <div class="flex flex-col items-start space-y-1">
                <span class="text-xs font-medium text-red-600">{{
                  errors.year
                }}</span>
                <select
                  v-model.trim="store.details.year"
                  name=""
                  id=""
                  class="
                    text-xs text-[#525252]
                    font-bold
                    placeholder-[#D9D9D9]
                    w-full
                    py-4
                    px-4
                    outline-none
                    rounded-full
                    border-[0.5px] border-[#52525280]
                    hover:border-[#BA812E]
                    focus:border-[#BA812E]
                  "
                  :class="{ 'border-red-500': errors.year }"
                >
                  <option value="" selected disabled>Year</option>
                  <option :value="item" v-for="item in years" :key="item">
                    {{ item }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.phone_number
            }}</span>
            <input
              v-model.trim="store.details.phone_number"
              type="text"
              placeholder="Contact Number"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.phone_number }"
            />
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.email
            }}</span>
            <input
              v-model.trim="store.details.email"
              type="text"
              placeholder="Email Address"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.email }"
            />
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.postcode
            }}</span>
            <input
              v-model.trim="store.details.postcode"
              type="text"
              placeholder="Postcode"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.postcode }"
            />
          </div>
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600">{{
              errors.address
            }}</span>
            <input
              v-model.trim="store.details.address"
              type="text"
              placeholder="Address"
              class="
                text-xs
                font-bold
                text-[#525252]
                placeholder-[#D9D9D9]
                w-full
                py-4
                px-4
                outline-none
                rounded-full
                border-[0.5px] border-[#52525280]
                hover:border-[#BA812E]
                focus:border-[#BA812E]
              "
              :class="{ 'border-red-500': errors.address }"
            />
          </div>
            <div class="w-full flex flex-col items-start space-y-1" v-if="store.treatments.key == 2">
            <span class="text-sm text-[#525252] font-bold">Card Info</span>
            <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-medium text-red-600"></span>
            
           <div class=" w-full">
            <div class="form-row w-full">
            <div id="card-element" class=" w-full">
              <!-- A Stripe Element will be inserted here. -->
            </div>        
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert" class="text-red-600"></div>
          </div>
        </div>
          </div>
          </div>
          
        </div>
      </div>
    </template>

    <template v-slot:pagination>
      <p class="text-theme-gray-light">5 of 5</p>
    </template>

    <template v-slot:buttons>
      <div class="space-x-4 flex flex-row">
        <a
          @click="goBack"
          href="javascript:void(0)"
          class="border-2 border-theme-gray rounded-full p-4 w-full"
          >Back</a
        >
        <a
          href="javascript:void(0)"
          @click="validate"
          class="
            bg-[#BA812E]
            hover:bg-opacity-90
            text-white
            rounded-full
            p-4
            w-full
          "
        >
          <LoadingSpiner v-if="loading" />
          <span v-else>Confirm and Book</span></a
        >
      </div>
    </template>
  </MainLayouts>
</template>


<script>
const api = import.meta.env.VITE_APP_DENTALLY_API;
import MainLayouts from "@/components/layouts/MainLayouts.vue";
import LoadingSpiner from "@/components/icons/LoadingSpiner.vue";
import { useStore } from "@/stores/AppointmentStore.js";

const stripe = window.Stripe(import.meta.env.VITE__PUBLIC_STRIPE_API_KEY);
var elements = stripe.elements();
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    },
    height: '60px'
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
var card = elements.create('card', {style: style});

export default {
  components: {
    MainLayouts,
    LoadingSpiner,
  },

  data() {
    return {
      loading: false,
      store: useStore(),
      days: [
        1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
        21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
      ],
      months: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      years: [],
      sites: [],
      errors: [
        {
          title: "",
          first_name: "",
          last_name: "",
          email: "",
          phone_number: "",
          postcode: "",
          address: "",
          day: "",
          month: "",
          year: "",
        },
      ],
    };
  },
  methods: {
    CheckSteps() {
      if (this.store.step == 0) {
        this.$router.push({ path: "/" });
      }
    },
    validate() {
      this.errors = [];
      var valid = true;
      if (this.store.details.title == "") {
        this.errors.title = "Title is required";
        valid = false;
      }
      if (this.store.details.first_name == "") {
        this.errors.first_name = "First Name is required";
        valid = false;
      }
      if (this.store.details.last_name == "") {
        this.errors.last_name = "Last Name is required";
        valid = false;
      }
      //validate email format
      var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (!re.test(this.store.details.email)) {
        this.errors.email = "Email is not valid";
        valid = false;
      }
      if (this.store.details.email == "") {
        this.errors.email = "Email is required";
        valid = false;
      }
      if (this.store.details.phone_number == "") {
        this.errors.phone_number = "Phone Number is required";
        valid = false;
      }
      if (this.store.details.postcode == "") {
        this.errors.postcode = "Postcode is required";
        valid = false;
      }
      if (this.store.details.address == "") {
        this.errors.address = "Address is required";
        valid = false;
      }
      if (this.store.details.day == "") {
        this.errors.day = "Day is required";
        valid = false;
      }
      if (this.store.details.month == "") {
        this.errors.month = "Month is required";
        valid = false;
      }
      if (this.store.details.year == "") {
        this.errors.year = "Year is required";
        valid = false;
      }

     if(valid){
        this.checkEmailAndPhone();
     }
    },
    clearError() {
      this.errors = [
        {
          first_name: "",
          last_name: "",
          email: "",
          phone_number: "",
          postcode: "",
          address: "",
          day: "",
          month: "",
          year: "",
        },
      ];
    },
    formatDateToTime(date) {
      let hour = date.split("T")[1].split(":")[0];
      let minute = date.split("T")[1].split(":")[1];
      let ampm = hour >= 12 ? "PM" : "AM";
      hour = hour % 12;
      hour = hour ? hour : 12;
      minute = minute < 10 ? minute : minute;
      return hour + ":" + minute + " " + ampm;
    },
    formateDate(date) {
      let month = date.split("-")[1];
      let year = date.split("-")[0];
      let day = date.split("-")[2].split("T")[0];
      let monthName = new Date(year, month - 1, day).toLocaleString("en-us", {
        month: "long",
      });
      return monthName + " " + day + ", " + year;
    },
    goBack() {
      this.store.step--;
      this.$router.push({
        name: "available-slots",
      });
    },
    async checkEmailAndPhone() {
      this.loading = true;
      this.axios.defaults.baseURL = "/api/";
      await this.axios
        .post("check", {
          email: this.store.details.email,
          phone: this.store.details.phone_number,
        })
        .then((response) => {
          this.loading = false;
          console.log(response.data.found);
          if (response.data.found == true) {
            
            this.$router.push({ name: "already-booked" });
            return false
          } else {
            this.Submit();
          }

          
        });
    },
    async Confirm() {
      if (this.loading) {
        return;
      }
      this.clearError();
      this.loading = true;
      this.axios.defaults.baseURL = api;
      await this.axios
        .post("patients", {
          title: this.store.details.title,
          first_name: this.store.details.first_name,
          last_name: this.store.details.last_name,
          date_of_birth:
            this.store.details.year +
            "-" +
            this.store.details.month +
            "-" +
            this.store.details.day,
          gender: true,
          ethnicity: "99",
          address_line_1: this.store.details.address,
          postcode: this.store.details.postcode,
          payment_plan_id: 4438,
          dentist_id: this.store.practitioner.id,
          email_address: this.store.details.email,
          mobile_phone: this.store.details.phone_number,
          home_phone: this.store.details.phone_number,
        })
        .then((response) => {
          //collect data
          this.store.details.id = response.data.patient.id;
          this.store.details.image = response.data.patient.image_url;
          //ceate appointment
          this.createaApointment();
          console.log(response.data);
        });
    },
    async createaApointment() {
      var start_date_time = this.store.availableTime.start_time;
      var finish_date_time = null;
      //add 30 minutes to finish_date_time
      var min = 20;
      if(this.store.practitioner.id == 14615){ // dr affan
        min = 15;
      }else if(this.store.practitioner.id == 72952){ //dr joe
        min = 40;
      }
      else{
        min = 20;
      }
      var date = new Date(start_date_time);
      date.setMinutes(date.getMinutes() + min);
      finish_date_time = date.toISOString();
      this.axios.defaults.baseURL = api;
      await this.axios
        .post("appointments", {
          start_time: this.store.availableTime.start_time,
          finish_time: finish_date_time,
          practitioner_id: this.store.practitioner.id,
          reason: "New Consultation",
          patient_id: this.store.details.id,
        })
        .then((response) => {
          this.StoreData();
          console.log(response.data);
        });
    },
    async StoreData() {
      //change axsios base url
      this.axios.defaults.baseURL = "/api/";
      await this.axios
        .post("booked-record-store", {
          treatments: this.store.treatments,
          details: this.store.details,
          availableTime: this.store.availableTime,
          practitioner: this.store.practitioner,
        })
        .then((response) => {
          this.loading = false;
          console.log(response.data);
          //redirect to confirmation page
          this.$router.push({
            name: "confirmation",
          });
        })
        .catch((error) => {
          alert("something went wrong, please try again later");
        });
    },
    loadSite() {
      this.axios.defaults.baseURL = api;
      this.axios
        .get("sites/" + this.store.practitioner.site_id)
        .then((response) => {
          this.sites = response.data;
        });
    },
    Submit(){
      if(this.store.treatments.key == 1){
        this.Confirm();
      }else{
        let vm = this;
        vm.loading = true;
        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            vm.loading = false;
          } else {
            // Send the token to your backend.
            vm.loading = true;
            vm.axios.defaults.baseURL = "/api/";
            vm.axios.post('stripe', {
              stripeToken: result.token.id,
              email: vm.store.details.email,
              name: vm.store.details.first_name + ' ' + vm.store.details.last_name,
              treatments: vm.store.treatments.key, // 2 = pay 60poound and  and 1 = store card info
            }).then((response) => {
              console.log(response.data);
              vm.loading = false;
              vm.Confirm();
            }).catch((error) => {
              console.log(error.response.data.message);
              vm.loading = false;
              alert("Payment failed: " +  error.response.data.message);
            });
            
          }
        });
      }
    },
  },
  created() {
    this.CheckSteps();
    //set years 1950 - current year
    let currentYear = new Date().getFullYear();
    for (let i = 1950; i <= currentYear; i++) {
      this.years.push(i);
    }
  },
  mounted() {
    if(this.store.treatments.key == 2){
      card.mount('#card-element');
      // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });
    }
  },
};
</script>