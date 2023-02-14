<template>
  <MainLayouts>
    <template v-slot:slides>
      <div class="mt-auto mb-1">
        <p class="uppercase text-theme-gold">Step 2</p>
        <h1 class="text-white text-3xl mb-1">Select a dentist</h1>
      </div>
    </template>
    <template v-slot:current-options>
      <ul class="uppercase text-white marker:text-theme-gold list-disc pl-5">
        <li class="text-xs">{{ store.treatments.name }}</li>
      </ul>
    </template>
    <template v-slot:body>
      <div class="p-10 space-y-8" v-if="!loading">
        <h1 class="uppercase font-semibold">Select a dentist</h1>

        <ul class="divide-y divide-theme-gray-light">
          <li
            v-for="(Dentist, index, key) in Dentists"
            :key="key"
            v-show="
              (Dentist.id == 14615 && this.store.treatments.key == 1) ||
              (Dentist.id == 44633 && this.store.treatments.key == 1) ||
              (Dentist.id == 46230 && this.store.treatments.key == 1) || 
             // (Dentist.id == 26362 && this.store.treatments.key == 1) ||
              (Dentist.id == 87927 && this.store.treatments.key == 1) ||
              (Dentist.id == 86042 && this.store.treatments.key == 1) ||
              (Dentist.id == 85698 && this.store.treatments.key == 1) ||
              (Dentist.id == 72952 && this.store.treatments.key == 2) 
            "
            class="hover:px-2"
            :class="{ 'px-2': store.practitioner.id == Dentist.id }"
            @click="SelectDentist(Dentist)"
          >
            <a href="javascript:void(0)" class="flex items-center py-4">
              <img
                :src="Dentist.user.image_url"
                class="rounded-full w-10 h-10 mr-4"
              />

              <div class="flex flex-col leading-tight mr-2">
                <strong class="text-black"
                  >{{ Dentist.user.title == "Dr" ? "Dr" : "" }}
                  {{ Dentist.user.first_name }} {{ Dentist.user.middle_name }}
                  {{ Dentist.user.last_name }}</strong
                >
                <span class="text-theme-gray text-sm">{{
                  Dentist.user.role
                }}</span>
              </div>

              <span
               v-if="Dentist.id == 72952"
                class="
                  bg-theme-gold
                  text-white
                  rounded-full
                  py-1
                  px-3
                  text-sm text-center
                  inline-block
                  ml-auto
                  mr-2
                "
                >£60</span
              >
              <span
              v-else
                class="
                  bg-theme-gray
                  text-white
                  rounded-full
                  py-1
                  px-3
                  text-sm text-center
                  inline-block
                  ml-auto
                  mr-2
                "
                >FREE</span
              >
            </a>
          </li>
        </ul>
      </div>
      <div class="w-full flex py-6" v-else>
        <div class="m-auto">
          <LoadingSpiner />
        </div>
      </div>
    </template>

    <template v-slot:pagination>
      <p class="text-theme-gray-light">3 of 5</p>
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
import { useStore } from "@/stores/AppointmentStore.js";

export default {
  components: {
    MainLayouts,
    LoadingSpiner,
  },
  data() {
    return {
      store: useStore(),
      Dentists: [],
      loading: false,
    };
  },
  methods: {
    SelectDentist(Dentist) {
      this.store.practitioner.id = Dentist.id;
      this.store.practitioner.name =
        Dentist.user.title == "Dr"
          ? "Dr " + Dentist.user.first_name
          : "" + Dentist.user.first_name;
      this.store.practitioner.site_id = Dentist.site_id;
      this.store.practitioner.image = Dentist.user.image_url;
      this.store.step++;
      this.$router.push({ name: "available-slots" });
    },
    goBack() {
      this.store.step--;
      this.$router.push({
        name: "select-treatment",
      });
    },
    loadDentist() {
      this.loading = true;
      this.axios.get("practitioners?per_page=100").then((response) => {
        this.Dentists = response.data.practitioners;
        this.loading = false;
        console.log(response.data);
      });
    },
    CheckSteps() {
      if (this.store.step == 0) {
        this.$router.push({ path: "/" });
      }
    },
  },
  created() {
    this.CheckSteps();
    this.loadDentist();
  },
};
</script>