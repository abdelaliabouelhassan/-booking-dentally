<template>
    <div class=" w-full grid md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 2xl:grid-cols-7 gap-10">
        <!-- Search Input -->
        <div class="w-full">
            <input
                v-model="Search"
                type="text"
                class="w-full rounded-full bg-white dark:bg-[#F1F1F1] pl-4 h-[30px] outline-none"
                placeholder="Search"
            />
        </div>
        <div class="w-full">
            <Filter
                @clearFilter="ClearPractitionersFilter"
                label="Practitioner"
                title="Practitioner Member"
                :filterd="SelectedPractitioners != ''"
            >
                <template v-slot:content>
                    <div
                        class="flex items-center space-x-4"
                        v-for="(item, index, key) in Practitioners"
                        :key="key"
                    >
                        <input
                            :id="index"
                            type="radio"
                            v-model="SelectedPractitioners"
                            :value="item.id"
                            name="SelectedPractitioners"
                            class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label :for="index" class="text-xl font-semibold"
                            >{{ item.user.title == "Dr" ? "Dr" : "" }}
                            {{ item.user.first_name }}
                            {{ item.user.middle_name }}
                            {{ item.user.last_name }}</label
                        >
                    </div>
                </template>
            </Filter>
        </div>
        <div class="w-full">
            <Filter
                @clearFilter="ClearTCOFilter"
                label="TCO Seen"
                title="TCO Member"
                :filterd="SelectedTCO != ''"
            >
                <template v-slot:content>
                    <div
                        class="flex items-center space-x-4"
                        v-for="(item, index, key) in TCO"
                        :key="key"
                    >
                        <input
                            :id="index"
                            type="radio"
                            v-model="SelectedTCO"
                            :value="item.id"
                            name="SelectedPractitioners"
                            class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label :for="index" class="text-xl font-semibold"
                            >{{ item.name}}</label
                        >
                    </div>
                </template>
            </Filter>
        </div>
        <div class="w-full">
            <Filter
                @clearFilter="ClearConvetionUsers"
                label="Converted By"
                title="Cnverted By"
                :filterd="SelectedConvetionUsers != ''"
            >
                <template v-slot:content>
                    <div
                        class="flex items-center space-x-4"
                        v-for="(item, index, key) in ConvetionUsers"
                        :key="key"
                    >
                        <input
                            :id="index"
                            type="radio"
                            v-model="SelectedConvetionUsers"
                            :value="item.id"
                            name="SelectedPractitioners"
                            class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label :for="index" class="text-xl font-semibold"
                            >{{ item.name}}</label
                        >
                    </div>
                </template>
            </Filter>
        </div>
        <div class="w-full">
            <Filter
                @clearFilter="ClearSelectedOutcome"
                label="Outcome"
                title="Outcome"
                :filterd="SelectedOutcome != ''"
            >
                <template v-slot:content>
                    <div
                        class="flex items-center space-x-4"
                        v-for="(item, index, key) in Outcome"
                        :key="key"
                    >
                        <input
                            :id="index"
                            type="radio"
                            v-model="SelectedOutcome"
                            :value="item.value"
                            name="SelectedPractitioners"
                            class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label :for="index" class="text-xl font-semibold"
                            >{{ item.title }}</label
                        >
                    </div>
                </template>
            </Filter>
        </div>
        <div class=" w-full"> 
            <Datepicker v-model="SelectedDate" range @update:modelValue="handleDate"  placeholder="Select Date Range" /> 
        </div>
        <div class=" w-full">
            <button disabled class=" h-[40px] w-full rounded-md text-center text-xs border border-[#BA812E] text-gray-900 dark:text-gray-300 cursor-not-allowed">
                Add Patient
            </button>
        </div>
    </div>
</template>

<script>
import Filter from "../Tools/filter.vue";
import axios from "axios";
import {  ref, watch } from "vue";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
axios.defaults.baseURL = "https://api.dentally.co/v1/";
axios.defaults.headers.common["Authorization"] =
    "Bearer " + "VgcjQR3YAVYWgI-1CTh27ap-y4fyuokf8hwGNLmPZk0";

export default {
    components: {
        Filter,
        Datepicker,
    },
    setup(props, { emit }) {
        const Practitioners = ref([]);
        const TCO  = ref([]);
        const ConvetionUsers = ref([]);
        const Outcome = ref([
            {
                title:'Awaiting Treatment',
                value:'awaiting treatment'
            },
            {
                title:'Yes',
                value:'yes'
            },
            {
                title:'Did not attend',
                value:'did not attend'
            },
            {
                title:'Cancelled',
                value:'cancelled'
            },
             {
                title:'Not Suitable',
                value:'not suitable'
            },
             {
                title:'Attended and suitable',
                value:'attended and suitable'
            },
             {
                title:'Rebooked',
                value:'rebooked'
            },
        ]);
        const SelectedPractitioners = ref([]);
        const SelectedTCO = ref([]);
        const SelectedConvetionUsers = ref([]);
        const SelectedOutcome = ref([]);
        const SelectedDate = ref([]);
        const Search = ref("");
        const loadPractitioners = async () => {
            const response = await axios
                .get("practitioners?per_page=100")
                .then((response) => {
                    Practitioners.value = response.data.practitioners;
                    console.log(response.data);
                });
        };
        const loadTCO = async () => {
             axios.defaults.baseURL = "/api/";
            const response = await axios
                .get("tco")
                .then((response) => {
                    TCO.value = response.data;
                    console.log(response.data);
                });
        };

        const loadConvetionUsers = async () => {
             axios.defaults.baseURL = "/api/";
            const response = await axios
                .get("convetion-users")
                .then((response) => {
                    ConvetionUsers.value = response.data;
                    console.log(response.data);
                });
        };


        const ClearPractitionersFilter = () => {
            SelectedPractitioners.value = [];
        };

        const ClearTCOFilter = () => {
            SelectedTCO.value = [];
        };

        const ClearConvetionUsers = () => {
            SelectedConvetionUsers.value = [];
        }

        const ClearSelectedOutcome = () => {
            SelectedOutcome.value = [];
        }

     
        
        //watch SelectedPractitioners for changes
        watch(SelectedPractitioners, (newValue, oldValue) => {
              emit("practitioner", newValue);
        });
        //watch search for changes
        watch(Search, (newValue, oldValue) => {
             emit("search", newValue);
        });
        //watch SelectedTCO for changes
        watch(SelectedTCO, (newValue, oldValue) => {
             emit("tco", newValue);
        });
        //watch SelectedConvetionUsers for changes
        watch(SelectedConvetionUsers, (newValue, oldValue) => {
             emit("convention", newValue);
        });
        //watch SelectedOutcome for changes
        watch(SelectedOutcome, (newValue, oldValue) => {
             emit("outcome", newValue);
        });
        //watch SelectedDate for changes
        watch(SelectedDate, (newValue, oldValue) => {
                emit("date", newValue);
        });


        const handleDate = (date) => {
            if(date == null){
                emit("date",[]);
            }
        }

        loadPractitioners();
        loadTCO();
        loadConvetionUsers();
        return {
            Practitioners,
            SelectedPractitioners,
            ClearPractitionersFilter,
            ClearTCOFilter,
            ClearConvetionUsers,
            ClearSelectedOutcome,
            Search,
            TCO,
            SelectedTCO,
            ConvetionUsers,
            SelectedConvetionUsers,
            Outcome,
            SelectedOutcome,
            SelectedDate,
            handleDate
        };
    },
};
</script>
