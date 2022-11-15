import Tool from './pages/Tool'
import VueApexCharts from "vue3-apexcharts";




Nova.booting((app, store) => {
    app.component('apexchart', VueApexCharts);
  Nova.inertia('Report', Tool)
})
