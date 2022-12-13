<template>
    <DarkModel>
        <div class=" pb-10 w-full flex items-center justify-between">
            <div class="w-full">
                <h1 class="text-gray-900 dark:text-gray-300 text-[22px]">
                   Convestion Statistics
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
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Cancelled Appointments</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Did not attend</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Not Suitable</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Attended and suitable</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                    </div>
                    <div class=" flex flex-col items-start space-y-5">
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Number of Converted</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Patients Converted on first visit </span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Patients Converted by AftersAles</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">00</span>
                        </div>
                    </div>
                    <div class=" flex flex-col items-start space-y-5">
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£00,000.00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of TCO conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£00,000.00</span>
                        </div>
                         <div class=" w-full flex justify-between items-center">
                            <span class=" text-sm text-[#5E5E5E] font-normal">Total Value of After Sales conversions</span>
                            <span class=" text-sm  text-[#BA812E] font-bold">£00,000.00</span>
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
                        <tbody>
                            <tr class="bg-white ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                  Laura T
                                </th>
                                <td class="py-4 px-6">
                                    00
                                </td>
                                <td class="py-4 px-6">
                                    00
                                </td>
                                <td class="py-4 px-6">
                                    00.00%
                                </td>
                                <td class="py-4 px-6">
                                    £00,000.00
                                </td>
                            </tr>
                          
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 ">
                                <th scope="row" class="py-3 px-6 text-base">Total</th>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6">£21,000</td>
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
                        <tbody>
                            <tr class="bg-white ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                  Dr Zeb
                                </th>
                                <td class="py-4 px-6">
                                    00
                                </td>
                                <td class="py-4 px-6">
                                    00
                                </td>
                                <td class="py-4 px-6">
                                    00.00%
                                </td>
                                <td class="py-4 px-6">
                                    £00,000.00
                                </td>
                            </tr>
                          
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-900 ">
                                <th scope="row" class="py-3 px-6 text-base">Total</th>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6"></td>
                                <td class="py-3 px-6">£21,000</td>
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
import { ref } from 'vue';
export default {
    setup(){
        const SelectedDate = ref(null);
        return {
            SelectedDate,
        }
    },
    components: {
        DarkModel,
        Datepicker
    }
    
}
</script>