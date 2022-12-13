<template>
    <DarkModel>
        <div class=" pb-10 w-full flex items-center justify-between">
            <div class="w-full">
                <h1 class="text-gray-900 dark:text-gray-300 text-[22px]">
                   Conversion Statistics
                </h1>
            </div>
            <div>
                 <Datepicker v-model="SelectedDate" range  placeholder="Select Date Range"/> 
            </div>
        </div>
       <div class=" w-full space-y-10">
         <div class=" w-full bg-white p-5 rounded-lg flex flex-col items-start space-y-6">
                <span class=" text-lg font-normal text-[#1B1B1B]">Consultations</span>
                <div class=" w-full grid grid-cols-3 gap-10">
                    <div class=" flex flex-col items-start space-y-5">
                        <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">ConsultationS</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.Consultations ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Cancelled Appointments</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.Cancelled ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Did not attend</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.DidNotAttend ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Not Suitable</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.NotSuitable ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Attended and suitable</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.AttendedAndSuitable ?? '00'}}</span>
                        </div>
                    </div>
                    <div class=" flex flex-col items-start space-y-5">
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Number of Converted</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.TotalNumberofConverted ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Patients Converted on first visit </span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.FirstVisitConverted ?? '00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Patients Converted by After Sales</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">{{stats.AfterSalesConverted ?? '00'}}</span>
                        </div>
                    </div>
                    <div class=" flex flex-col items-start space-y-5">
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£{{stats.TotalValueofConverted ?? '00,000.00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of TCO conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£{{stats.TotalValueofTCO ?? '00,000.00'}}</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of After Sales conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£{{stats.TotalValueofASC ?? '00,000.00'}}</span>
                        </div>
                    </div>
                </div>
         </div>
         <div class=" w-full bg-white p-5 rounded-lg flex flex-col items-start space-y-6">
                <span class=" text-lg font-normal text-[#1B1B1B]">Conversions</span>
                
                <div class="overflow-x-auto relative w-full">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                            <tr>
                                <th scope="col" class="py-3 px-6 rounded-l-lg">
                                   Converted by
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Patients seen
                                </th>
                                <th scope="col" class="py-3 px-6 ">
                                    Patients Converted
                                </th>
                                <th scope="col" class="py-3 px-6 ">
                                   Conversion Percentage
                                </th>
                                 <th scope="col" class="py-3 px-6 rounded-r-lg">
                                    Conversion Value
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="stats.Conversions">
                            <tr class="bg-white " v-for="(item,index,key) in stats.Conversions" :key="key">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                  {{item.converted_by_name}}
                                </th>
                                <td class="py-4 px-6">
                                    {{item.patients_seen}}
                                </td>
                                <td class="py-4 px-6">
                                      {{item.patients_converted}}
                                </td>
                                <td class="py-4 px-6">
                                     {{item.conversion_percentage}}%
                                </td>
                                <td class="py-4 px-6">
                                    £{{item.conversion_value}}
                                </td>
                            </tr>
                          
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 ">
                                <th scope="row" class="py-3 px-6 text-base">Total</th>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6">£{{stats.ConversionsTotalValue ?? '00'}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

         </div>
          <div class=" w-full bg-white p-5 rounded-lg flex flex-col items-start space-y-6">
                <span class=" text-lg font-normal text-[#1B1B1B]">Consultations by practitioner</span>
                
                <div class="overflow-x-auto relative w-full">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                            <tr>
                                <th scope="col" class="py-3 px-6 rounded-l-lg">
                                   Consultation with
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Patients seen
                                </th>
                                <th scope="col" class="py-3 px-6 ">
                                    Patients Converted
                                </th>
                                <th scope="col" class="py-3 px-6 ">
                                   Conversion Percentage
                                </th>
                                 <th scope="col" class="py-3 px-6 rounded-r-lg">
                                    Conversion Value
                                </th>
                            </tr>
                        </thead>
                         <tbody v-if="stats.ConsultationsByPractitioner">
                            <tr class="bg-white " v-show="item.practitioner_name != ''" v-for="(item,index,key) in stats.ConsultationsByPractitioner" :key="key">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                  {{item.practitioner_name}}
                                </th>
                                <td class="py-4 px-6">
                                    {{item.patients_seen}}
                                </td>
                                <td class="py-4 px-6">
                                      {{item.patients_converted}}
                                </td>
                                <td class="py-4 px-6">
                                     {{item.conversion_percentage}}%
                                </td>
                                <td class="py-4 px-6">
                                    £{{item.conversion_value}}
                                </td>
                            </tr>
                          
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 ">
                                <th scope="row" class="py-3 px-6 text-base">Total</th>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6">£{{stats.ConsultationsByPractitionerTotalValue ?? '00'}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

         </div>
       </div>
    </DarkModel>
</template>

<script>
import DarkModel from '../components/layouts/darkMode.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { ref,onMounted,watch } from 'vue';
import axios from "axios";

export default {
    setup(){
        const SelectedDate = ref(null);
        const stats = ref([])
        const loadStatistics = () => {
            axios.defaults.baseURL = "/api/";
             let start = null;
              let end = null;
            if(SelectedDate.value != null){
             start =  formatDate(SelectedDate.value[0])
             end =  formatDate(SelectedDate.value[1])
            }
               
            axios.get(`/statistics?date=${ start + "," + end}`).then((response) => {
                console.log(response.data);
                stats.value = response.data
            });
        }
        watch(SelectedDate, (newValue, oldValue) => {
           loadStatistics();
        });
         const formatDate = (date) => {
            const d = new Date(date);
            let month = "" + (d.getMonth() + 1);
            let day = "" + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) month = "0" + month;
            if (day.length < 2) day = "0" + day;

            return [year, month, day].join("-");
        };
        onMounted(() => {
            loadStatistics();
        });
        return {
            SelectedDate,
            stats
        }
    },
    components: {
        DarkModel,
        Datepicker
    }
    
}
</script>