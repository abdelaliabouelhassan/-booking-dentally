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
      <div class="p-10 space-y-8">
        <h1 class="uppercase font-semibold">Select a Practice</h1>

        <ul class="grid gap-4 grid-cols-1 text-center leading-tight">
          <li>
            <a
           
              @click="SelectPractice"
              href="javascript:void(0)"
              class="
                block
                p-4
                rounded-full
                border-2 
                hover:border-theme-gold
                border-theme-gold
              "
            >
             Space Dental - Wakefield
            </a>
          </li>

         
        </ul>
      </div>
    </template>

     <template v-slot:pagination>
          <p class="text-theme-gray-light">1 of 5</p>
    </template>  

     <template v-slot:buttons>
        <div class="space-x-4 flex flex-row ">
          
                <a href="index.html" class="border-2 border-theme-gray rounded-full p-4 w-full hidden">Back</a>
            </div>
    </template>
  </MainLayouts>
</template>


<script>
import MainLayouts from "@/components/layouts/MainLayouts.vue";
import LoadingSpiner from "@/components/icons/LoadingSpiner.vue";
import { useStore } from "@/stores/AppointmentStore.js"
export default {
  components: {
    MainLayouts,
    LoadingSpiner,
  },

  data(){
    return {
      store:useStore(),
      selectedTreatment: null,
      Treatments:[],
      currentPage:1,
      totalPages:1,
      loading:false,
    }
  },
  methods: {
    SelectPractice() {
      this.store.step++;
      this.$router.push({name:'select-treatment'})
     
    },
    CheckSteps(){
      if(this.store.step == 0){
        this.$router.push({path:'/'})
      }
    }
  },
  created(){
    //this.CheckSteps();
  },
};
</script>