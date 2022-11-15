<template>
    <div class="my-component-livereport">
        <div :class="{ dark: dark }" class="w-full">
            <div class="w-full h-[400px] flex" v-if="loading">
                <div class="m-auto">
                    <svg
                        aria-hidden="true"
                        class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"
                        />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"
                        />
                    </svg>
                </div>
            </div>
            <div class="w-full grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10" v-else>
                <div
                    class="w-full rounded-md bg-white dark:bg-gray-800 p-5 shadow-sm"
                    v-for="(item, index, key) in participantWithAvailable"
                    :key="key"
                >
                    <div class="w-full flex flex-col items-center space-y-2">
                        <div
                            class="w-[100px] h-[100px] rounded-full bg-gray-300 overflow-hidden"
                        >
                            <img :src="item.user.image_url" :alt="item.name" />
                        </div>
                        <div class="flex flex-col items-center space-y-1">
                            <span
                                class="text-sm font-bold text-gray-900 dark:text-gray-300"
                                >{{ item.name }}</span
                            >
                        </div>
                        <div class="flex flex-col items-center space-y-1">
                            <span
                                class="text-sm font-bold text-gray-900 dark:text-gray-300"
                                >THIS MONTH</span
                            >
                            <span class="text-base font-bold text-blue-500"
                                >{{ item.thisMonth }} Slots Available</span
                            >
                        </div>
                        <div class="flex flex-col items-center space-y-1">
                            <span
                                class="text-sm font-bold text-gray-900 dark:text-gray-300"
                                >NEXT MONTH</span
                            >
                            <span class="text-base font-bold text-blue-500"
                                >{{ item.nextMonth }} Slots Available</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref, watch } from "vue";
import axios from "axios";
axios.defaults.baseURL = "https://api.dentally.co/v1/";
axios.defaults.headers.common["Authorization"] =
    "Bearer " + "VgcjQR3YAVYWgI-1CTh27ap-y4fyuokf8hwGNLmPZk0";

export default {
    setup() {
        const observer = ref(null);
        const dark = ref(false);

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
        });

        //
        const practitioners = ref([]);
        const loading = ref(false);
        const participantIds = ref([14615, 44633, 46230, 26362, 72952]);
        const participantAvaliable = ref([]);
        const participantWithAvailable = ref([]);
        const loadDentist = () => {
            loading.value = true;
            axios.get("practitioners").then((response) => {
                practitioners.value = response.data.practitioners;
                console.log(response.data);
                loadDentistAvailable();
            });
        };
        const idsCount = ref(0);
        const loadDentistAvailable = async () => {
            let start_time = new Date();
            start_time.setHours(start_time.getHours() + 1);
            let end_time = new Date(start_time.getFullYear(), start_time.getMonth() + 1, 0);
            let startTimeString = start_time.toISOString();
            let endTimeString = end_time.toISOString();
            let next_start_time = new Date(end_time.getFullYear(), end_time.getMonth() + 1, 1);
            let next_end_time = new Date(next_start_time.getFullYear(), next_start_time.getMonth() + 1, 0);
            let nextStartTimeString = next_start_time.toISOString();
            let nextEndTimeString = next_end_time.toISOString();
            loading.value = true;
            await axios
                .get(
                    "appointments/availability?practitioner_ids%5B%5D=" +
                        participantIds.value[[idsCount.value]] +
                        "&start_time=" +
                        startTimeString +
                        "&finish_time=" +
                        endTimeString
                )
                .then((response) => {
                    participantAvaliable.value.push({
                        id: participantIds[idsCount],
                        thisMonth: response.data.availability.length,
                        nextMonth: [],
                    });
                   
                    console.log(response.data);
                });
            await axios
                .get(
                    "appointments/availability?practitioner_ids%5B%5D=" +
                        participantIds.value[[idsCount.value]] +
                        "&start_time=" +
                        nextStartTimeString +
                        "&finish_time=" +
                        nextEndTimeString
                )
                .then((response) => {
                    participantAvaliable.value[[idsCount.value]].nextMonth =
                        response.data.availability.length;
                    
                    console.log(response.data);
                });
            idsCount.value = idsCount.value + 1;
            if (idsCount.value < participantIds.value.length) {
                loadDentistAvailable();
            } else {
                console.log("gg");
                loading.value = false;
                JoinParticipantWithAvailable();
            }
        };

        onMounted(() => {
            loadDentist();
        });

        const JoinParticipantWithAvailable = () => {
            participantWithAvailable.value = [];
            for (let i = 0; i < participantIds.value.length; i++) {
                for (let j = 0; j < practitioners.value.length; j++) {
                    if (participantIds.value[i] == practitioners.value[j].id) {
                        participantWithAvailable.value.push({
                            id: participantIds.value[i],
                            name:
                                practitioners.value[j].user.first_name +
                                " " +
                                practitioners.value[j].user.last_name,
                            user: practitioners.value[j].user,
                            thisMonth: participantAvaliable.value[i].thisMonth,
                            nextMonth: participantAvaliable.value[i].nextMonth,
                        });
                    }
                }
            }

            console.log(participantWithAvailable.value);
        };
        //Total conversions past 28 days
        const totalConversions = ref(0);
        watch(participantAvaliable, () => {
            JoinParticipantWithAvailable();
        });

        return {
            dark,
            loading,
            practitioners,
            participantIds,
            participantAvaliable,
            participantWithAvailable,
        };
    },
};
</script>

<style>
/* Scoped Styles */
</style>
