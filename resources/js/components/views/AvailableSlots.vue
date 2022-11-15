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
        </li>
      </ul>
    </template>
    <template v-slot:body>
      <div v-if="!loading">
        <div class="p-10">
          <SlotsTimes
            v-for="(date, index, key) in GroupByDate(appointments.availability)"
            :key="key"
            :index="key"
            :date="index"
            :dates="date"
          />
        </div>
        <div class="space-y-8 px-8 pb-4">
          <ul class="grid gap-4 grid-cols-1 text-center leading-tight">
            <li>
              <a
                @click="PickDate"
                href="javascript:void(0)"
                class="
                  text-sm
                  uppercase
                  font-semibold
                  flex
                  p-2
                  rounded-full
                  border border-theme-gray-light
                  hover:border-theme-gold
                "
                style="letter-spacing: 6px"
              >
                <div  class=" flex items-center space-x-2 m-auto">
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
                  <span> Pick a date</span>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="w-full flex py-6" v-else>
        <div class="m-auto">
          <LoadingSpiner />
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

export default {
  components: {
    MainLayouts,
    LoadingSpiner,
    SlotsTimes,
  },
  data() {
    return {
      store: useStore(),
      loading: false,
      appointments: [],
      stat_date: "",
      end_date: "",
      duration: 30,
    };
  },

  methods: {
    goBack() {
      this.store.step--;
      this.$router.push({
        name: "select-dentist",
      });
    },
    PickDate() {
      this.store.step++;
      this.$router.push({
        name: "pick-date",
      });
    },
    loadavailableTimes() {
      this.loading = true;
      this.stat_date = new Date();
      this.stat_date.setHours(this.stat_date.getHours() + 1);
      let startTimeString = this.stat_date.toISOString();
      this.end_date = new Date();
      this.end_date.setHours(this.end_date.getHours() + 24 * 7);
      let endTimeString = this.end_date.toISOString();
      let duration = this.duration
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
  },
  created() {
    this.CheckSteps();
    this.loadavailableTimes();
  },
};
</script>