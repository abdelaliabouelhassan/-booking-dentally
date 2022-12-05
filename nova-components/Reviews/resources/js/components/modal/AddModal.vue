<template>
    <div
        class="relative z-50"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true" v-show="open"
    >
        <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        ></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div
                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
            >
                <div
                    class="relative transform space-y-8 overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-7xl sm:p-6"
                >   
                    <button @click="closeModal" class="absolute top-5 right-5 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-red-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <span class="text-lg text-black"
                        >Patient Name - Dentally Patient ID ########</span
                    >
                    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Consultation Date</span
                            >
                            <input
                                type="text"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Consultation Date"
                                disabled
                            />
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base">Value</span>
                            <input
                                type="text"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="£## ### ##"
                            />
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base">OUTCOME</span>
                            <select
                                name=""
                                id=""
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="OUTCOME"
                            >
                                <option value="">ff</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-1  md:grid-cols-3  lg:grid-cols-4 gap-10">
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Practitioner</span
                            >
                            <select
                                name=""
                                id=""
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="">ff</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Called Day Before By</span
                            >
                            <select
                                name=""
                                id=""
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="">ff</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >TCO Assigned to Patient</span
                            >
                            <select
                                name=""
                                id=""
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="">ff</option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Converted By</span
                            >
                            <select
                                name=""
                                id=""
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="">ff</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full flex flex-col items-start space-y-4">
                        <div class="flex flex-col items-start space-y-2">
                            <span class="text-black text-sm font-bold"
                                >Note 10 / 11 / 22 12:22 NAME OF STAFF
                                MEMBER</span
                            >
                            <p class="text-base font-normal">
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Nulla fermentum dui eu lorem
                                mattis, id porta metus fermentum. Donec vel
                                laoreet quam, ut lobortis ante. Interdum et
                                malesuada fames ac ante ipsum primis in
                                faucibus. Cras nec tristique leo. In imperdiet
                                pretium euismod. Aliquam ullamcorper
                                pellentesque maximus.
                            </p>
                        </div>
                    </div>

                    <div class=" w-full">
                        <textarea name="" id="" cols="30"  class=" border outline-none p-4 w-full rounded-lg" placeholder="Add note.."></textarea>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3 lg:max-w-sm lg:float-right">
                        <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Save Patient</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm">Add Note</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { ref } from "vue";

export default {
    setup() {
        const open = ref(false);
        const openModal = () => {
            open.value = true;
        };
        const closeModal = () => {
            open.value = false;
        };
        return {
            open,
            openModal,
            closeModal,
        };
    },
}
</script>