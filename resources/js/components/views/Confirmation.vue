<template>
  <MainLayouts>
    <template v-slot:slides>
      <div class="mt-auto mb-1">
        <p class="uppercase text-theme-gold">Consultation Booked</p>
        <h1 class="text-white text-3xl mb-1">We’ll see you soon!</h1>
      </div>
    </template>
    <template v-slot:current-options>
      <p class="uppercase text-white"></p>
    </template>
    <template v-slot:body>
      <div class="p-10 space-y-8">
        <h1 class="uppercase font-semibold">Consultation details</h1>

        <div
          class="
            w-full
            flex flex-col
            items-start
            space-y-4
            divide-y divide-[#B4B4B480]
          "
        >
          <div class="w-full flex flex-col items-start space-y-1">
            <span class="text-xs font-normal text-[#B4B4B4]"
              >Selected consultation</span
            >
            <span class="font-bold text-black text-sm">{{
              store.treatments.name
            }}</span>
          </div>
          <div class="w-full grid grid-cols-2 gap-5 pt-4">
            <div class="w-full flex flex-col items-start space-y-1">
              <span class="text-xs font-normal text-[#B4B4B4]"
                >Your dentist</span
              >
              <span class="font-bold text-black text-sm">{{store.practitioner.name}}</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden">
              <img
                :src="store.practitioner.image"
                :alt="store.practitioner.name"
                class="w-full h-full"
              />
            </div>
          </div>
          <div class="w-full grid grid-cols-2 gap-5 pt-4">
            <div class="w-full flex flex-col items-start space-y-1">
              <span class="text-xs font-normal text-[#B4B4B4]">Date</span>
              <span class="font-bold text-black text-sm">
                <!-- June 29th, 2022 -->
                {{ formateDate(store.availableTime.start_time) }}
              </span>
            </div>
            <div class="w-full flex flex-col items-start space-y-1">
              <span class="text-xs font-normal text-[#B4B4B4]">Time</span>
              <span class="font-bold text-black text-sm">
                {{ formateTime(store.availableTime.start_time) }}
                <!-- 3.00 PM -->
              </span>
            </div>
          </div>
          <div class="w-full flex flex-col items-start space-y-1 pt-4">
            <span class="text-xs font-normal text-[#B4B4B4]"
              >Consultation location</span
            >
            <span class="font-bold text-black text-sm"
              >{{site.nickname}} - {{site.town}}</span
            >
            <span class="text-xs font-normal text-[#525252]"
              >{{site.address_line_1}}, {{site.address_line_2}},  {{site.town}}, {{site.postcode}}</span
            >
            <div class="pt-4 w-full">
              <button
               @click="getDirections"
                class="
                  text-sm
                  font-normal
                  text-[#525252]
                  bg-white
                  w-full
                  h-8
                  rounded-full
                  hover:bg-amber-500 hover:ring-2
                  ring-amber-500
                "
                style="border: 0.5px solid rgba(82, 82, 82, 0.5)"
              >
                Get Directions
              </button>
            </div>
          </div>
          <div class="w-full flex flex-col items-start space-y-1 pt-4">
            <span class="text-xs font-normal text-[#B4B4B4]"
              >Add to calendar</span
            >

            <button
             @click="AddToGoogelCalendar"
              class="
                text-sm
                font-normal
                text-[#525252]
                bg-white
                w-full
                h-8
                rounded-full
                hover:bg-amber-500 hover:ring-2
                ring-amber-500
                flex
                items-center
                justify-between
                px-4
              "
              style="border: 0.5px solid rgba(82, 82, 82, 0.5)"
            >
              <span></span>
              <span> Add to my calendar</span>
              <div>
                <svg
                  width="7"
                  height="12"
                  viewBox="0 0 7 12"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M6.77569 6.59698C7.06859 6.30409 7.06859 5.82921 6.77569 5.53632L2.00272 0.76335C1.70983 0.470456 1.23495 0.470456 0.942061 0.76335C0.649168 1.05624 0.649168 1.53112 0.942061 1.82401L5.1847 6.06665L0.942061 10.3093C0.649168 10.6022 0.649168 11.0771 0.942061 11.37C1.23495 11.6628 1.70983 11.6628 2.00272 11.37L6.77569 6.59698ZM6.05347 6.81665H6.24536V5.31665H6.05347V6.81665Z"
                    fill="#BA812E"
                  />
                </svg>
              </div>
            </button>
          </div>
          <div class="w-full flex flex-col items-start space-y-1 pt-4">
            <span class="text-xs font-normal text-[#B4B4B4]"
              >What to expect</span
            >
            <span class="font-bold text-black text-sm">Consent form</span>
            <span class="font-normal text-[#525252] text-sm"
              >Please fill out the provided consent form ahead of your
              appointment.
            </span>
          </div>
        </div>
      </div>
    </template>
  </MainLayouts>
</template>


<script>
import MainLayouts from "@/components/layouts/MainLayouts.vue";
import LoadingSpiner from "@/components/icons/LoadingSpiner.vue";
import { useStore } from "@/stores/AppointmentStore.js";
export default {
  components: {
    MainLayouts,
    LoadingSpiner,
  },

  data() {
    return {
      store: useStore(),
      site:{},
    };
  },
  methods: {
    CheckSteps() {
      if (this.store.step == 0) {
        this.$router.push({ path: "/" });
      }
    },
    formateTime(time) {
      let hour = time.split("T")[1].split(":")[0];
      let minute = time.split("T")[1].split(":")[1];
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
    async getAddress() {
     this.axios.defaults.baseURL = import.meta.env.VITE_APP_DENTALLY_API
      await this.axios
        .get("sites/" + this.store.practitioner.site_id)
        .then((response) => {
            this.site = response.data.site;
          console.log(response.data.site);
        });
    },
    AddToGoogelCalendar(){
        var start_date_time = this.store.availableTime.start_time;
        var end_date_time = this.store.availableTime.finish_time;
        var url = "";
       //(2014-08-01T12:00:00.000+01:00) to YYYYMMDD HHMMSS For example: 2014-08-01T12:00:00.000+01:00 to = 20190227T104500
    
        var start_date = start_date_time.split("T")[0];
        var start_time = start_date_time.split("T")[1];
        var start_time_formatted = (start_time.split(":")[0] - 1 ) + start_time.split(":")[1] + start_time.split(":")[2].split(".")[0];
        var start_date_formatted = start_date.split("-")[0] + start_date.split("-")[1] + start_date.split("-")[2];
        var start_date_time_formatted = start_date_formatted + 'T' + start_time_formatted  + 'Z';

        var end_date = end_date_time.split("T")[0];
        var end_time = end_date_time.split("T")[1];
        var end_time_formatted = (end_time.split(":")[0] - 1 )  + end_time.split(":")[1] + end_time.split(":")[2].split(".")[0];
        var end_date_formatted = end_date.split("-")[0] + end_date.split("-")[1] + end_date.split("-")[2];
        var end_date_time_formatted = end_date_formatted + 'T'+  end_time_formatted + 'Z';

       
     
      
 
        window.open(
            "https://calendar.google.com/calendar/r/eventedit?text=Consultation&dates="+start_date_time_formatted+"/"+end_date_time_formatted+"&location="+this.site.address_line_1+"%2C%20"+this.site.address_line_2+"%2C%20"+this.site.town+"%2C%20"+this.site.postcode+"&details=Consultation%20with%20"+this.store.practitioner.name+"&sf=true&output=xml"
        );
    },
    getDirections(){
        window.open("https://www.google.com/maps/dir/?api=1&destination="+this.site.address_line_1+"%2C%20"+this.site.address_line_2+"%2C%20"+this.site.town+"%2C%20"+this.site.postcode);
    }
  },
  created() {
    // this.CheckSteps();
     this.getAddress();
  },
};
</script>