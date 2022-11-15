import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
const pinia = createPinia()
import Theapp from '@/components/app.vue'
import router from '@/router/routes.js'
import axios from 'axios'
import VueAxios from 'vue-axios'

const app = createApp(Theapp)
.use(pinia)
.use(router)
.use(VueAxios, axios)


axios.defaults.baseURL = import.meta.env.VITE_APP_DENTALLY_API

axios.defaults.headers.common['Authorization'] = 'Bearer ' + import.meta.env.VITE_APP_DENTALLY_API_TOKEN


app.mount('#app')