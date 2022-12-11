<template>
    <div class="my-component-reviews">
        <div :class="{ dark: dark }" class="w-full space-y-8">
            <div class="w-full">
                <h1 class="text-gray-900 dark:text-gray-300 text-[22px]">
                    Convestion Tracking
                </h1>
            </div>
            <div class="w-full">
                <Filters @practitioner="getPractitioner" @search="getSearch" @tco="getTCO" @convention="getConvention" @outcome="getOutcome" @date="getDate" />
            </div>
             <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <table class="min-w-full spacing-table " cellpadding="10">
                  <thead>
                    <tr>
                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold  sm:pl-6 md:pl-0">Consultation Day</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">Patient Name</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">Called Day Before</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">practitioner</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">TCO SEEN</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">Converted By</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">Outcome</th>
                      <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold ">Value</th>
                      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                        <span class="sr-only">Edit</span>
                      </th>
                    </tr>
                  </thead>
               <tbody>
                  <tr class="w-full rounded-full bg-white" v-for=" (item,index,key) in convestion" :key="key">
                    <td
                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 rounded-l-[10px]"
                    >
                        <div class="pl-5">
                           {{item.appointment_start_date}}
                        </div>
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                        <div>{{item.patient_first_name + ' ' + item.patient_last_name}}</div>
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                        <div>{{item.called_by}}</div>
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-10 w-10"
                            >
                                <img
                                    class="h-10 w-10 rounded-full"
                                    :src="item.practitioner_image"
                                    alt=""
                                />
                            </div>
                            <div class="ml-4">
                                <div
                                    class="text-sm font-medium text-gray-900"
                                >
                                    {{item.practitioner_name}}
                                </div>
                                <div
                                    class="text-sm text-gray-500"
                                ></div>
                            </div>
                        </div>
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                       {{item.tco}}
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                       {{item.conveted_by}}
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                        <div
                            class="flex items-center space-x-2"
                        >
                            <div>
                               <outcomeIcon :type="item.outcome" />
                            </div>
                            <span>{{item.outcome ?? '-'}}</span>
                        </div>
                    </td>
                    <td
                        class="whitespace-nowrap py-4 px-3 text-sm text-gray-500"
                    >
                        {{ item.value != null ? '£'  + item.value :  '-'}}
                    </td>
                    <td
                        class="whitespace-nowrap py-4 text-sm text-gray-500 rounded-r-[10px]"
                    >
                        <button @click="openAddModal(item)">
                            <svg
                                width="4"
                                height="16"
                                viewBox="0 0 4 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <circle
                                    cx="2"
                                    cy="2"
                                    r="2"
                                    fill="#B4B4B4"
                                />
                                <circle
                                    cx="2"
                                    cy="8"
                                    r="2"
                                    fill="#B4B4B4"
                                />
                                <circle
                                    cx="2"
                                    cy="14"
                                    r="2"
                                    fill="#B4B4B4"
                                />
                            </svg>
                        </button>
                    </td>
                </tr>

                 <!-- More people... -->
              </tbody>
                </table>
            </div>
            </div>
             <div class="flex flex-1 justify-between sm:justify-end">
                    <button
                      href="#"
                      @click.prevent="PrevPage" 
                      class="
                        relative
                        inline-flex
                        items-center
                        rounded-md
                        border border-gray-300
                        bg-white
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-gray-700
                        hover:bg-gray-50
                        
                      "
                      :class="{'cursor-not-allowed':page == 1}"
                      :disabled="page == 1"
                      >Previous</button
                    >
                    <button
                      href="#"
                      @click.prevent="NextPage"
                      class="
                        relative
                        ml-3
                        inline-flex
                        items-center
                        rounded-md
                        border border-gray-300
                        bg-white
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-gray-700
                        hover:bg-gray-50
                      "
                      :class="{'cursor-not-allowed':page >= total}"
                      :disabled="page >= total"
                      >Next</button
                    >
                  </div>
        </div>
    </div>
    <AddModal ref="addModalRef" :selectedAppointment="selectedAppointment" @updateConvestion="getConvestion"/>
</div>
</template>

<script>
import { onMounted, ref } from "vue";
import Filters from "../components/reviews/filters.vue";
import outcomeIcon from "../components/Tools/outcomeIcon.vue"
import AddModal from "../components/modal/AddModal.vue"
import axios from "axios";
export default {
    components: {
        Filters,
        outcomeIcon,
        AddModal
    },
    setup() {
        const observer = ref(null);
        const dark = ref(false);
        const convestion = ref([]);
        const practitioner = ref([]);
        const search = ref("")
        const TCO =  ref([]);
        const Outcome = ref([]);
        const ConventionUser = ref([]);
        const DateFilter = ref([]);
        const addModalRef = ref(null);
        const selectedAppointment = ref(null);
        const page = ref(1);
        const total = ref(0);
        const openAddModal = (item) => {
            selectedAppointment.value = item;
            addModalRef.value.openModal();
        };
        
        const getConvestion = async () => {
            axios.defaults.baseURL = "/api/";
            const response = await axios
            .get(`/convestion?practitioner=${practitioner.value}&search=${search.value}&tco=${TCO.value}&convention_user=${ConventionUser.value}&outcome=${Outcome.value}&date=${DateFilter.value}&page=${page.value}`)
            .then((response) => {
                convestion.value = response.data.data;
                total.value = response.data.total;
                console.log(response);
            });
        }

        const NextPage = async () => {
            page.value = page.value + 1;
            getConvestion();
        }

        const PrevPage = async () => {
            page.value = page.value - 1;
            getConvestion();
        }
       
        const getPractitioner = (event) => {
            practitioner.value = event;
            getConvestion();
        }

        const getSearch = (event) => {
            search.value = event;
            getConvestion();
        }

        const getTCO = (event) => {
            TCO.value = event;
            getConvestion();
        }
        const getConvention = (event) => {
            ConventionUser.value = event;
            getConvestion();
        }

        const getOutcome = (event) => {
            Outcome.value = event;
            getConvestion();
        }

           const formatDate = (date) => {
            const d = new Date(date);
            let month = "" + (d.getMonth() + 1);
            let day = "" + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2) month = "0" + month;
            if (day.length < 2) day = "0" + day;

            return [year, month, day].join("-");
             
        }
        

        const getDate = (event) => {
           if(event){
            let start = formatDate(event[0]);
            let end = formatDate(event[1]);
            DateFilter.value = start + "," + end;
           }else{
             DateFilter.value = [];
           }
           
            getConvestion();
        }
        
         

        onMounted(() => {
            dark.value = document.documentElement.classList.contains("dark");

            observer.value = new MutationObserver((records) => {
                records.forEach((record) => {
                    dark.value = record.target.classList.contains("dark");
                });
            });

            observer.value.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ["class"],
                childList: false,
                characterData: false,
            });


            getConvestion();
        });

        return {
            dark,
            convestion,
            getPractitioner,
            getSearch,
            getTCO,
            getConvention,
            getOutcome,
            getDate,
            openAddModal,
            addModalRef,
            selectedAppointment,
            getConvestion,
            page,
            total,
            NextPage,
            PrevPage
        };
    },
};
</script>

<style>
.spacing-table {
    border-collapse: separate;
    border-spacing: 0 15px; /* this is the ultimate fix */
}
</style>
<style scoped>
.top {
    transform: rotate(50deg);
}
::-webkit-scrollbar {
    width: 5px;
    height: 5px;
}
/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
