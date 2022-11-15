<template>
  <MainLayouts>
    <template v-slot:slides>
      <div class="mt-auto mb-1">
        <p class="uppercase text-theme-gold">Start your smile journey</p>
        <h1 class="text-white text-3xl mb-1">Book your consultation</h1>
      </div>
    </template>
    <template v-slot:current-options>
      <p class="uppercase text-white"></p>
    </template>
    <template v-slot:body>
      <div class="p-10 space-y-8" v-if="!loading">
        <h1 class="uppercase font-semibold">Select a treatment</h1>

        <ul class="grid gap-4 grid-cols-1 text-center leading-tight">
          <li
            v-for="(Treatment, index, key) in Treatments"
            :key="key"
            
          >
          <!-- v-show="Treatment.id == 144000" -->
            <a
              @click="SelectTreatment(Treatment)"
              href="javascript:void(0)"
              class="block p-4 rounded-full border-2 hover:border-theme-gold"
              :class="{
                'border-theme-gold': store.treatments.key == Treatment.key,
              }"
            >
              <!-- {{ Treatment.patient_nomenclature ?? Treatment.nomenclature }} -->
              {{ Treatment.name }}
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
      <p class="text-theme-gray-light">2 of 5</p>
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
      selectedTreatment: null,
      Treatments: [
        {
          name: "Smile Makeover",
          id: 144000,
          key: "1",
        },
        {
          name: "Implant Consultation",
          id: 144000,
           key: "2",
        },
      ],
      currentPage: 1,
      totalPages: 1,
      loading: false,
    };
  },
  methods: {
    SelectTreatment(Treatment) {
      this.store.treatments.id = Treatment.id;
      // this.store.treatments.name = Treatment.patient_nomenclature;
      this.store.treatments.name = Treatment.name;
      this.store.treatments.key = Treatment.key;
      this.store.step++;
      this.$router.push({ name: "select-dentist" });
    },
    // loadTreatment() {
    //   this.loading = true;
    //   this.axios.get("treatments?page=" + this.currentPage).then((response) => {
    //     this.Treatments = response.data.treatments;
    //     this.totalPages = response.data.meta.total_pages;
    //     this.currentPage = response.data.meta.current_page;
    //     console.log(response.data);
    //     this.loading = false;
    //   });
    // },
    LoadMore() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.loadTreatment();
        //scroll up
        window.scrollTo(0, 0);
      } else {
        this.currentPage = 1;
      }
    },
    CheckSteps() {
      if (this.store.step == 0) {
        this.$router.push({ path: "/" });
      }
    },
    goBack() {
      this.store.step--;
      this.$router.push({
        name: "index",
      });
    },
  },
  created() {
    // this.CheckSteps();
    //this.loadTreatment();
  },
};
</script>