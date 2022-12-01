<template>
    <div class=" w-full grid md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 2xl:grid-cols-7 gap-10">
        <!-- Search Input -->
        <div class="w-full">
            <input
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
                @clearFilter="ClearPractitionersFilter"
                label="TCO Seen"
                title="TCO Member"
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
                @clearFilter="ClearPractitionersFilter"
                label="Converted By"
                title="Cnverted By"
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
                @clearFilter="ClearPractitionersFilter"
                label="Outcome"
                title="Outcome"
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
        <div class=" w-full"> 
            <DateFilter /> 
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
import DateFilter from "../Tools/dateFilter.vue";
import axios from "axios";
import {  ref } from "vue";
axios.defaults.baseURL = "https://api.dentally.co/v1/";
axios.defaults.headers.common["Authorization"] =
    "Bearer " + "VgcjQR3YAVYWgI-1CTh27ap-y4fyuokf8hwGNLmPZk0";

export default {
    components: {
        Filter,
        DateFilter,
    },
    setup() {
        const Practitioners = ref([]);
        const SelectedPractitioners = ref([]);
        const loadPractitioners = async () => {
            const response = await axios
                .get("practitioners?per_page=100")
                .then((response) => {
                    Practitioners.value = response.data.practitioners;
                    console.log(response.data);
                });
        };
        const ClearPractitionersFilter = () => {
            SelectedPractitioners.value = [];
        };

        loadPractitioners();
        return {
            Practitioners,
            SelectedPractitioners,
            ClearPractitionersFilter,
        };
    },
};
</script>
