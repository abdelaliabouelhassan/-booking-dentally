<template>
  <div class="pt-5 space-y-8">
    <h1 class="uppercase font-semibold" v-if="index == 0">
      Next Available Slots
    </h1>

    <div class="space-y-4">
      <strong class="text-theme-gray">{{ formateDate() }}</strong>
      <ul>
        <li>
          <div class="grid grid-cols-3 gap-5">
            <span
              @click="selectTime(item)"
              v-for="(item, index, key) in dates"
              :key="key"
              class="
                whitespace-nowrap
                bg-white
                border
                hover:border-theme-gold
                text-theme-gray
                rounded-full
                mx-1.5
                py-1
                px-3
                text-sm text-center
                inline-block
                cursor-pointer
              "
              :class="{
                'border-theme-gold':
                  store.availableTime.start_time == item.start_time,
                'border-theme-gray-light':
                  store.availableTime.start_time != item.start_time,
              }"
              >{{ formateTime(item.start_time) }}</span
            >
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>


<script>
import { useStore } from "@/stores/AppointmentStore.js";

export default {
  props: {
    dates: {
      type: Object,
      required: true,
    },
    date: {
      type: String,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      store: useStore(),
    };
  },
  methods: {
    selectTime(time) {
      this.store.availableTime.start_time = time.start_time;
      this.store.availableTime.finish_time = time.finish_time;
      this.store.availableTime.available_duration = time.available_duration;
      this.$router.push({ name: "details" });
    },
    formateDate() {
      //formate date to Wednesday, 20th July
      let date = this.date;
      let day = date.split("-")[2];
      let month = date.split("-")[1];
      let year = date.split("-")[0];
      let dayOfWeek = new Date(year, month - 1, day).getDay();
      let dayOfWeekString = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      let monthString = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      return (
        dayOfWeekString[dayOfWeek] + ", " + day + " " + monthString[month - 1]
      );
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
  },
};
</script>