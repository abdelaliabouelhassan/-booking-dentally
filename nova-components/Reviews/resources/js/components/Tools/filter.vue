<template>
    <div class="flex items-center space-x-4 relative">
        <div
            @click="showFilter = !showFilter"
            class="p-2 bg-gray-500 rounded-2xl cursor-pointer hover:bg-gray-600"
        >
            <svg
                width="10"
                height="10"
                viewBox="0 0 10 10"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M9.60768 8.1608C9.35683 7.59946 8.99281 7.08958 8.53588 6.65955C8.08034 6.22828 7.54071 5.88443 6.9468 5.64699C6.94148 5.64447 6.93616 5.64322 6.93084 5.6407C7.75929 5.07538 8.29785 4.15452 8.29785 3.11558C8.29785 1.39447 6.8218 0 5 0C3.1782 0 1.70215 1.39447 1.70215 3.11558C1.70215 4.15452 2.24071 5.07538 3.06916 5.64196C3.06384 5.64447 3.05852 5.64573 3.0532 5.64824C2.45746 5.88568 1.92289 6.22613 1.46412 6.6608C1.00762 7.09117 0.643652 7.60097 0.392318 8.16206C0.145408 8.71137 0.0122432 9.30031 3.32524e-05 9.89699C-0.000321672 9.91039 0.00216771 9.92373 0.00735478 9.93622C0.0125419 9.9487 0.0203216 9.96008 0.0302357 9.96968C0.0401498 9.97928 0.0519976 9.98691 0.0650809 9.99212C0.0781643 9.99732 0.0922186 10 0.106416 10H0.904283C0.962793 10 1.00934 9.95603 1.01066 9.90201C1.03726 8.93216 1.44949 8.02387 2.17821 7.33543C2.93219 6.62312 3.93352 6.23116 5 6.23116C6.06648 6.23116 7.06781 6.62312 7.82179 7.33543C8.55051 8.02387 8.96274 8.93216 8.98934 9.90201C8.99067 9.95729 9.03721 10 9.09572 10H9.89358C9.90778 10 9.92184 9.99732 9.93492 9.99212C9.948 9.98691 9.95985 9.97928 9.96976 9.96968C9.97968 9.96008 9.98746 9.9487 9.99265 9.93622C9.99783 9.92373 10.0003 9.91039 9.99997 9.89699C9.98667 9.29648 9.85502 8.71231 9.60768 8.1608ZM5 5.27638C4.38963 5.27638 3.81517 5.05151 3.38299 4.64322C2.95081 4.23492 2.71278 3.69221 2.71278 3.11558C2.71278 2.53894 2.95081 1.99623 3.38299 1.58794C3.81517 1.17965 4.38963 0.954774 5 0.954774C5.61037 0.954774 6.18483 1.17965 6.61701 1.58794C7.04919 1.99623 7.28722 2.53894 7.28722 3.11558C7.28722 3.69221 7.04919 4.23492 6.61701 4.64322C6.18483 5.05151 5.61037 5.27638 5 5.27638Z"
                    fill="white"
                />
            </svg>
        </div>
        <span
            @click="showFilter = !showFilter"
            class="text-xl font-semibold cursor-pointer hover:text-opacity-80 whitespace-nowrap"
            :class="{'text-red-200':filterd}"
            >{{label}}</span
        >

        <div
            v-if="showFilter"
            class="p-5 rounded-2xl absolute shadow-md bg-white dark:bg-gray-800 w-[400px] space-y-8 z-50 top-10"
        >
            <div class="w-full flex items-center justify-between">
                <span
                    class="font-medium text-2xl text-gray-900 dark:text-gray-100"
                    >{{title}}</span
                >
                <div class="flex items-center space-x-4">
                    <span
                        @click="ClearFilter"
                        class="text-blue-500 font-medium text-base cursor-pointer hover:text-opacity-70"
                        >Clear</span
                    >
                </div>
            </div>

            <div
                class="flex flex-col items-start space-y-4 max-h-96 overflow-y-auto"
            >
                <slot name="content" />
            </div>
        </div>
    </div>
    <div
        class="absolute w-full h-full top-0 left-0 z-40"
        @click="showFilter = false"
        v-if="showFilter"
    ></div>
</template>

<script>
import { ref } from "vue";

export default {
    props: {
        label: {
            type: String,
            default: "Filter",
        },
        title: {
            type: String,
            default: "Filter",
        },
        filterd:{
            type: Boolean,
            default: false,
        }
    },
    setup(props, { emit }) {
        const showFilter = ref(false);
        const ClearFilter = () => {
            emit("clearFilter");
        };
        return {
            showFilter,
            ClearFilter,
        };
    },
};
</script>
