<template>
  <MainLayouts>
    <template v-slot:slides>
      <div class="mt-auto mb-1">
        <p class="uppercase text-theme-gold">Step 3</p>
        <h1 class="text-white text-3xl mb-1">Available Slots</h1>
      </div>
    </template>
     <template v-slot:current-options>
      <ul class="uppercase text-white marker:text-theme-gold list-disc">
       <li class=" flex items-center space-x-2 text-xs">
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
        </li>
      </ul>
      
    </template>
    <template v-slot:body>
      <div class="p-10 space-y-8">
        <h1 class="uppercase font-semibold">Pick a date</h1>

        <div
          class="flex justify-between"
          style="justify-content: space-between"
        >
          <div>
            <button
              @click="next"
              aria-label="calendar backward"
              class="focus:text-gray-400 hover:text-gray-400 text-gray-800"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-chevron-left"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="15 6 9 12 15 18" />
              </svg>
            </button>
          </div>
          <div>
            <span tabindex="0" class="text-sm uppercase font-semibold"
              >{{ displayMonth }} {{ year }}</span
            >
          </div>
          <div>
            <button
              @click="back"
             
              aria-label="calendar forward"
              class="focus:text-gray-400 hover:text-gray-400 ml-3 text-gray-800"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-chevron-right"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="9 6 15 12 9 18" />
              </svg>
            </button>
          </div>
        </div>

        <div class="bg-white rounded-t w-full">
          <div
            class="
              w-full
              card
              flex flex-col
              items-start
              space-y-6
              h-full
              rounded-md
            "
          >
            <div class="w-full grid grid-cols-7 gap-10">
              <div
                class="text-mainback text-base font-bold"
                v-for="(item, index, key) in weekdays"
                :key="key"
              >
                {{ item.charAt(0) }}
              </div>
            </div>
            <div class="w-full grid grid-cols-7 gap-10">
              <div
                class="
                  text-mainsublack text-sm
                  font-normal
                  flex flex-col
                  relative
                  
                "
                :class="{'cursor-pointer':!item.past && !item.padding}"
                @click="SelectDate(item)"
                v-for="(item, index, key) in days"
                :key="key"
              >
                <div
                  class="
                    absolute
                    w-6
                    h-6
                    rounded-full
                    bg-gray-400
                    hover:bg-primary-100
                    flex
                  "
                  v-if="item.date == today"
                >
                  <span class="m-auto">{{ item.day }} </span>
                </div>
                <div
                  class="absolute w-6 h-6 rounded-full  flex"
                  :class="{
                    'text-mainsublack hover:bg-primary-100': !item.padding && !item.past,
                    ' text-gray-200': item.padding || item.past,
                    'bg-primary-100': selectedDate == item.date,
                  }"
                  v-else
                >
                  <span class="m-auto"> {{ item.day }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="ready">
               <SlotsTimes v-for="(date,index,key) in GroupByDate(appointments.availability)" :key="key" :index="1" :date="index" :dates="date" />
               <div class=" w-full flex py-10" v-if="ready && appointments.availability.length <= 0">
                <span class=" m-auto text-sm font-bold text-black">No Available Times at this Date {{selectedDate}}</span>
               </div>
        </div>
        <div class="w-full flex py-6" v-if="!ready & loading">
        <div class="m-auto">
          <LoadingSpiner />
        </div>
        </div>



        <div class="space-y-8">
          <ul class="grid gap-4 grid-cols-1 text-center leading-tight">
            <li>
              <a
                @click="nextAvailableSlot"
                href="javascript:void(0)"
                class="
                  uppercase
                  font-semibold
                  tracking-10
                  flex
                  p-2
                  rounded-full
                  border border-theme-gray-light
                  hover:border-theme-gold
                  text-sm
                "
                style="letter-spacing: 6px"
              >
              
              <div class=" flex items-center space-x-2 m-auto">
                  <svg
                  width="13"
                  height="13"
                  viewBox="0 0 13 13"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M9.56814 2.13982H3.17039C1.9926 2.13982 1.03781 3.11078 1.03781 4.30852V9.73025C1.03781 10.928 1.9926 11.8989 3.17039 11.8989H9.56814C10.7459 11.8989 11.7007 10.928 11.7007 9.73025V4.30852C11.7007 3.11078 10.7459 2.13982 9.56814 2.13982Z"
                    stroke="#BA812E"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M4.23668 1.05548V3.22417M8.50185 1.05548V3.22417M1.03781 5.39287H11.7007"
                    stroke="#BA812E"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>

                <span> Next Available Slot</span>
              </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </template>

    <template v-slot:pagination>
      <p class="text-theme-gray-light">4 of 5</p>
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
          href=""
          class="bg-theme-gold text-white rounded-full p-4 w-full hidden"
          >Next Step</a
        >
      </div>
    </template>
  </MainLayouts>
</template>


<script>
import MainLayouts from "@/components/layouts/MainLayouts.vue";
import LoadingSpiner from "@/components/icons/LoadingSpiner.vue";
import SlotsTimes from "@/components/wedets/SlotsTimes.vue";

import { useStore } from "@/stores/AppointmentStore.js";
const weekdays = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];
export default {
    
  components: {
    MainLayouts,
    LoadingSpiner,
    SlotsTimes,
  },
  data() {
    return {
      selectedDate: null,
      nav: 0,
      weekdays: weekdays,
      paddingDays: 0,
      daysInMonth: 0,
      lastpadding: 0,
      displayMonth: "",
      month: 0,
      lastPaddingDaysMonth: 0,
      nextPaddingDaysMonth: 0,
      year: new Date().getFullYear(),
      days: [],
      today: new Date().toLocaleDateString("en-US", {
        day: "numeric",
        month: "numeric",
        year: "numeric",
      }),

      //
      store: useStore(),
      loading: false,
      ready:false,
      appointments: [],
      stat_date: "",
      end_date: "",
      duration: 30,
      displayYear: new Date().getFullYear(),
    };
  },

  methods: {
    next() {
      this.nav++;
      this.load();
    },
    back() {
      this.nav--;
      this.load();
    },
    load() {
      const dt = new Date();
      if (this.nav !== 0) {
        dt.setMonth(dt.getMonth() - this.nav, 1);
        // dt.setMonth(new Date().getMonth() - this.nav)
        //last padding month
        this.lastPaddingDaysMonth = new Date(
          this.displayYear,
          dt.getMonth() + 1,
          0
        ).getDate();
      } else {
        this.lastPaddingDaysMonth = new Date(
          this.displayYear,
          dt.getMonth() + 1,
          0
        ).getDate();
      }

      const day = dt.getDay();
      this.month = dt.getMonth();
      this.year = dt.getFullYear();
      const firstDayOfMonth = new Date(this.year, this.month, 1);
      this.daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

      const dateString = firstDayOfMonth.toLocaleDateString("en-US", {
        weekday: "long",
        month: "numeric",
        day: "numeric",
        year: "numeric",
      });
      const monthDayString = new Date(
        this.year,
        this.month + 1,
        0
      ).toLocaleDateString("en-US", {
        weekday: "long",
        month: "numeric",
        day: "numeric",
        year: "numeric",
      });

      this.paddingDays = weekdays.indexOf(dateString.split(", ")[0]);

      this.displayMonth = dt.toLocaleDateString("en-US", { month: "long" });

      this.lastpadding = weekdays.indexOf(monthDayString.split(", ")[0]);

      this.days = [];
      let dtlast = new Date();
      let dtnext = new Date();

      dtlast.setMonth(new Date().getMonth() + this.nav - 1);
      dtnext.setMonth(new Date().getMonth() + this.nav + 1);

      //last padding month
      for (var i = 0; i < this.paddingDays; i++) {
        var Paddingday = this.lastPaddingDaysMonth--;
        this.days.unshift({
          day: Paddingday,
          month: dtlast.getMonth() + 1,
          year: dtlast.getFullYear(),
          date:
            dtlast.getMonth() +
            1 +
            "/" +
            Paddingday +
            "/" +
            dtlast.getFullYear(),
          padding: true,
        });
      }
      //current month
      for (var i = 1; i <= this.daysInMonth; i++) {
        this.days.push({
          day: i,
          month: this.month + 1,
          year: this.year,
          date: this.month + 1 + "/" + i + "/" + this.year,
          padding: false,
        });
      }
      //next padding month

      for (var i = 1; i < 7 - this.lastpadding; i++) {
        this.days.push({
          day: i,
          month: dtnext.getMonth() + 1,
          year: dtnext.getFullYear(),
          date: dtnext.getMonth() + 1 + "/" + i + "/" + dtnext.getFullYear(),
          padding: true,
        });
      }
      
      this.days.forEach((day) => {
        if (day.date === this.today) {
          day.today = true;
        }
        //if date is in past from today
        var today = new Date();
        var date = new Date(day.date);
        if (date < today) {
          day.past = true;
        }
        
      });

      console.log(this.days);
    },
    goBack() {
      this.store.step--;
      this.$router.push({
        name: "select-dentist",
      });
    },
    nextAvailableSlot() {
      this.$router.push({
        name: "available-slots",
      });
    },
    loadavailableTimes() {
     this.ready = false;
      this.loading = true;
      this.stat_date = new Date(this.selectedDate)
      this.stat_date.setHours(this.stat_date.getHours() + 1);
      let startTimeString = this.stat_date.toISOString();
      this.end_date = new Date(this.selectedDate);
      this.end_date.setHours(this.end_date.getHours() + 25);
      let endTimeString = this.end_date.toISOString();
      let duration = this.duration;
      var ids = [this.store.practitioner.id];
      this.axios
        .get(
          "appointments/availability?practitioner_ids%5B%5D=" +
            ids +
            "&start_time=" +
            startTimeString +
            "&finish_time=" +
            endTimeString +
            "&duration=" +
            duration
        )
        .then((response) => {
          this.appointments = response.data;
          if (this.appointments) {
            this.GroupByDate(this.appointments.availability);
          }
          this.loading = false;
          console.log(this.appointments.availability);
          this.ready = true
        });
    },
    GroupByDate(avaliableAppointments) {
      let grouped = {};
      avaliableAppointments.forEach(function (item) {
        let date = new Date(item.start_time);
        let dateString = date.toISOString().split("T")[0];
        if (!grouped[dateString]) {
          grouped[dateString] = [];
        }
        grouped[dateString].push(item);
      });
      return grouped;
    },
    CheckSteps() {
      if (this.store.step == 0) {
        this.$router.push({ path: "/" });
      }
    },
    SelectDate(date) {
        if(date.past){
            return;
        }
      this.selectedDate = date.date;
      this.loadavailableTimes();
    },
  },
  created() {
      this.CheckSteps();
    this.load();
  
    // this.loadavailableTimes();
  },
};
</script>