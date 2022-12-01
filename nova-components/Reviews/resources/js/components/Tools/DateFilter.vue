<template>
    <div class="flex items-center relative">
        <button
            @click="SelectNextPeriode"
            class="h-10 px-2 bg-gray-500 rounded-l-2xl hover:bg-opacity-60"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 text-white"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5L8.25 12l7.5-7.5"
                />
            </svg>
        </button>
        <button
            @click="showDate = !showDate"
            class="h-10 px-8 whitespace-nowrap bg-gray-600 text-white text-xl font-medium hover:bg-opacity-60"
        >
            {{ FilterPeriode[PeriodeIndex].name }} 
        </button>
        <button
            @click="SelectPrevPeriode"
            class="h-10 px-2 bg-gray-500 rounded-r-2xl hover:bg-opacity-60"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 text-white"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
            </svg>
        </button>
        <div
            v-if="showDate"
            class="p-5 rounded-2xl absolute shadow-md bg-white dark:bg-gray-800 w-[200px] space-y-8 z-50 top-12 right-10"
        >
            <div class="flex flex-col items-start space-y-4 w-full">
                <div
                    class="flex items-center space-x-4 w-full"
                    v-for="(item, index) in FilterPeriode"
                    :key="index"
                >
                    <div
                        @click="SelectPeriode(item)"
                        :class="{ 'dark:bg-gray-600 bg-gray-800': item.active }"
                        class="w-full py-2 text-center flex dark:hover:bg-gray-600 hover:bg-gray-800 group rounded-xl cursor-pointer"
                    >
                        <span
                            class="text-xl dark:text-white text-center font-semibold m-auto group-hover:text-white whitespace-nowrap"
                            >{{ item.name }}</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
export default {
    setup(props, { emit }) {
        const showDate = ref(false);
        const FilterPeriode = [
            {
                name: "Today",
                active: false,
                start: new Date().setHours(0, 0, 0, 0),
                end: new Date().setHours(23, 59, 59, 999),
            },
            {
                name: "Yesterday",
                active: false,
                start: new Date(
                    new Date().setDate(new Date().getDate() - 1)
                ).setHours(0, 0, 0, 0),
                end: new Date(
                    new Date().setDate(new Date().getDate() - 1)
                ).setHours(23, 59, 59, 999),
            },
            {
                name: "This Week",
                active: false,
                start: new Date(
                    new Date().setDate(
                        new Date().getDate() - new Date().getDay()
                    )
                ).setHours(0, 0, 0, 0),
                end: new Date(
                    new Date().setDate(
                        new Date().getDate() + (6 - new Date().getDay())
                    )
                ).setHours(23, 59, 59, 999),
            },
            {
                name: "Last Week",
                active: false,
                start: new Date(
                    new Date().setDate(
                        new Date().getDate() - new Date().getDay() - 7
                    )
                ).setHours(0, 0, 0, 0),
                end: new Date(
                    new Date().setDate(
                        new Date().getDate() - new Date().getDay() - 1
                    )
                ).setHours(23, 59, 59, 999),
            },
            {
                name: "This Month",
                active: false,
                start: new Date(new Date().setDate(1)).setHours(0, 0, 0, 0),
                end: new Date(
                    new Date().setDate(
                        new Date().getDate() + (new Date().getDate() - 1)
                    )
                ).setHours(23, 59, 59, 999),
            },
            {
                name: "Last Month",
                active: false,
                start: new Date(
                    new Date().setMonth(new Date().getMonth() - 1)
                ).setHours(0, 0, 0, 0),
                end: new Date(
                    new Date().setDate(
                        new Date().getDate() - new Date().getDate()
                    )
                ).setHours(23, 59, 59, 999),
            },
        ];
        const PeriodeIndex = ref(0);

        const SelectPeriode = (item) => {
            FilterPeriode.forEach((element) => {
                element.active = false;
            });
            item.active = true;
            emit("change", item);
            showDate.value = false;
            PeriodeIndex.value = FilterPeriode.indexOf(item);
        };

        const SelectNextPeriode = () => {
            if (PeriodeIndex.value < FilterPeriode.length - 1) {
                PeriodeIndex.value++;
            } else {
                PeriodeIndex.value = 0;
            }
            SelectPeriode(FilterPeriode[PeriodeIndex.value]);
        };

        const SelectPrevPeriode = () => {
            if (PeriodeIndex.value > 0) {
                PeriodeIndex.value--;
            } else {
                PeriodeIndex.value = FilterPeriode.length - 1;
            }
            SelectPeriode(FilterPeriode[PeriodeIndex.value]);
        };

        return {
            showDate,
            FilterPeriode,
            PeriodeIndex,
            SelectPeriode,
            SelectNextPeriode,
            SelectPrevPeriode,
        };
    },
};
</script>
