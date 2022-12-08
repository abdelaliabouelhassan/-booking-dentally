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
                                v-model="SelectedOutcome"
                            >
                                <option value="" disabled selected>Select Outcome</option>
                                <option :value="item.value" v-for="(item,index,key) in Outcome" :key="key">{{item.title}}</option>
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
                                v-model="SelectedPractitioners"
                            >
                                <option value="" disabled selected>Select Practitioner</option>
                                <option :value="item.id" v-for="(item,index,key) in Practitioners" :key="key">
                                    {{ item.user.title == "Dr" ? "Dr" : "" }}
                                    {{ item.user.first_name }}
                                    {{ item.user.middle_name }}
                                    {{ item.user.last_name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Called Day Before By</span
                            >
                            <select
                                name=""
                                id=""
                                v-model="SelectedCalledBy"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="" disabled selected>Select Called Day Before By </option>
                                <option  :value="item.id"   v-for="(item,index,key) in ConvetionUsers" :key="key">{{item.name}}</option>
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
                                <option value="" disabled selected>Select TCO </option>
                                <option   :value="item.id"   v-for="(item, index, key) in TCO" :key="key">{{ item.name}}</option>
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
                                <option value="" disabled selected>Select Converted By </option>
                                <option   :value="item.id" v-for="(item, index, key) in ConvetionUsers" :key="key">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full flex flex-col items-start space-y-4 max-h-60 overflow-y-auto">
                        <div class="flex flex-col items-start space-y-2" v-for="(item,index,key) in Notes" :key="key">
                            <span class="text-black text-sm font-bold"
                                >Note 10 / 11 / 22 12:22 NAME OF STAFF
                                MEMBER</span
                            >
                            <p class="text-base font-normal">
                                {{item.note}}
                            </p>
                        </div>
                    </div>

                    <div class=" w-full">
                        <textarea v-model="SelectedNote" name="" id="" cols="30"  class=" border outline-none p-4 w-full rounded-lg" placeholder="Add note.."></textarea>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3 lg:max-w-sm lg:float-right">
                        <button type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">Save Patient</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm" @click="AddNote">Add Note</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";
import { ref } from "vue";

export default {
    setup() {
        const open = ref(false);
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
        const SelectedPractitioners = ref(null);
        const SelectedTCO = ref(null);
        const SelectedConvetionUsers = ref(null);
        const SelectedOutcome = ref(null);
        const SelectedCalledBy = ref(null);
        const SelectedNote = ref(null);
        const Notes = ref([
            {
                note:'Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Nulla fermentum dui eu lorem  mattis, id porta metus fermentum. Donec vel  laoreet quam, ut lobortis ante. Interdum et  malesuada fames ac ante ipsum primis in  faucibus. Cras nec tristique leo. In imperdiet  pretium euismod. Aliquam ullamcorper  pellentesque maximus.',
            }
        ]);
        const loadPractitioners = async () => {
            axios.defaults.baseURL = "https://api.dentally.co/v1/";
            axios.defaults.headers.common["Authorization"] =
            "Bearer " + "VgcjQR3YAVYWgI-1CTh27ap-y4fyuokf8hwGNLmPZk0";
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
        const openModal = () => {
            open.value = true;
        };
        const closeModal = () => {
            open.value = false;
        };
        const AddNote = () => {
            Notes.value.push({
                note:SelectedNote.value
            });
            SelectedNote.value = null;
        }
        loadPractitioners();
        loadTCO();
        loadConvetionUsers();
        return {
            open,
            openModal,
            closeModal,
            Practitioners,
            TCO,
            Outcome,
            ConvetionUsers,
            SelectedPractitioners,
            SelectedTCO,
            SelectedConvetionUsers,
            SelectedOutcome,
            SelectedCalledBy,
            Notes,
            SelectedNote,
            AddNote
        };
    },
}
</script>