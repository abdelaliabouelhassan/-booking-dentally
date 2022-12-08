<template>
    <div
        class="relative z-50"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true" v-if="open"
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
                        >{{selectedAppointment.patient_first_name + ' ' + selectedAppointment.patient_last_name}} - Dentally Patient ID {{selectedAppointment.patient_id ?? '#####'}}</span
                    >
                    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Consultation Date</span
                            >
                            <input
                                type="text"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Consultation Date" :value="selectedAppointment ? selectedAppointment.appointment_start_date : ''"
                                disabled
                            />
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base">Value</span>
                            <input
                                type="text"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                v-model="SelectedValue"
                                placeholder="£## ### ##"
                            />
                            <span class=" text-sm text-red-500" v-if="Errors.value">{{Errors.value[0]   }} </span>
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
                             <span class=" text-sm text-red-500" v-if="Errors.outcome">{{Errors.outcome[0]   }} </span>
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
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white cursor-not-allowed"
                                placeholder="Practitioner"
                                v-model="SelectedPractitioners" disabled
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
                             <span class=" text-sm text-red-500" v-if="Errors.called_by">{{Errors.called_by[0]   }} </span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >TCO Assigned to Patient</span
                            >
                            <select
                                name=""
                                id=""
                                 v-model="SelectedTCO"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="" disabled selected>Select TCO </option>
                                <option   :value="item.id"   v-for="(item, index, key) in TCO" :key="key">{{ item.name}}</option>
                            </select>
                            <span class=" text-sm text-red-500" v-if="Errors.tco">{{Errors.tco[0]   }} </span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span class="text-black text-base"
                                >Converted By</span
                            >
                            <select
                                name=""
                                id=""
                                 v-model="SelectedConvetionUsers"
                                class="w-full border-0 border-b-2 outline-none h-11 bg-white"
                                placeholder="Practitioner"
                            >
                                <option value="" disabled selected>Select Converted By </option>
                                <option   :value="item.id" v-for="(item, index, key) in ConvetionUsers" :key="key">{{item.name}}</option>
                            </select>
                            <span class=" text-sm text-red-500" v-if="Errors.conveted_by">{{Errors.conveted_by[0]   }} </span>
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
                        <span class=" text-sm text-red-500" v-if="Errors.note">{{Errors.note[0]   }} </span>
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3 lg:max-w-sm lg:float-right">
                        <button :disabled="Loading" type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm" @click.prevent="UpdateAppointment">
                            <div role="status" v-if="Loading">
                                <svg class="inline mr-2 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            Save Patient</button>
                        <button :disabled="LoadingNote" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm" @click="AddNote">Add Note</button>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";
import { ref,watchEffect } from "vue";

export default {
    props:{
        selectedAppointment:{
            type:[Object],
            default:null
        }
    },
    setup(props, { emit }) {
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
        const SelectedValue = ref(null);
        const SelectedNote = ref(null);
        const Errors = ref([]);
        const Loading = ref(false);
        const LoadingNote = ref(false);
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
            Errors.value = [];
        };
       
        loadPractitioners();
        loadTCO();
        loadConvetionUsers();
        
        

      
        watchEffect(() => {
            if(props.selectedAppointment){
                console.log(props.selectedAppointment);
                SelectedOutcome.value = props.selectedAppointment.outcome;
                SelectedCalledBy.value = props.selectedAppointment.called_by_id;
                SelectedConvetionUsers.value = props.selectedAppointment.conveted_by_id;
                SelectedTCO.value = props.selectedAppointment.tco_id;
                SelectedPractitioners.value = props.selectedAppointment.practitioner_id;
                SelectedValue.value = props.selectedAppointment.value;
                loadNotes();
                
            }
        })


        const UpdateAppointment = async () => {
           
            if(Loading.value){
                return;
            }
            Loading.value = true;
            axios.defaults.baseURL = "/api/";
            const response = await axios
                .post("update-appointment",{
                    id:props.selectedAppointment.id,
                    outcome:SelectedOutcome.value,
                    called_by:SelectedCalledBy.value,
                    conveted_by:SelectedConvetionUsers.value,
                    tco:SelectedTCO.value,
                    practitioners:SelectedPractitioners.value,
                    value:SelectedValue.value,
                })
                .then((response) => {
                    console.log(response.data);
                    open.value = false;
                    Loading.value = false;
                    Errors.value = [];
                     emit('updateConvestion');
                }).catch((error) => {
                    Errors.value = error.response.data.errors;
                    console.log(Errors.value);
                    Loading.value = false;
                });
        }

        const AddNote = async () => {
            if(LoadingNote.value){
                return;
            }
            LoadingNote.value = true;
            axios.defaults.baseURL = "/";
            const response = await axios
                .post("create-note",{
                    booked_api_record_id:props.selectedAppointment.id,
                    note:SelectedNote.value,
                })
                .then((response) => {
                    console.log(response.data);
                    LoadingNote.value = false;
                    SelectedNote.value = '';
                    Errors.value = [];
                    loadNotes();
                }).catch((error) => {
                    Errors.value = error.response.data.errors;
                    LoadingNote.value = false;
                });
        }


        const loadNotes = async () => {
            axios.defaults.baseURL = "/api/";
            const response = await axios
                .get("load-notes/"+props.selectedAppointment.id)
                .then((response) => {
                    Notes.value = response.data;
                    console.log(response.data);
                    console.log(response.data);
                });
        };

        

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
            SelectedValue,
            Notes,
            SelectedNote,
            AddNote,
            UpdateAppointment,
            Errors,
            Loading,
            LoadingNote
        };
    },
}
</script>