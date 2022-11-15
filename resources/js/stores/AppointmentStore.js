import { defineStore } from 'pinia'


export const useStore = defineStore('AppointmentStore', {
    state: () => {
        return {
            treatments:{
                id:50,
                name:'',
                key:null
            },
            practitioner:{
                id:null,
                name:'',
                site_id:'',
                image:'',
            },
            availableTime:{
                start_time:'',
                finish_time:'',
                available_duration:'',
            },
            details:{
                id:null,
                image:null,
                title:'',
                first_name:'',
                last_name:'',
                email:'',
                phone_number:'',
                address:'',
                postcode:'',
                day:'',
                month:'',
                year:'',
            },
            step:0,
        } 
    },
  
 
})