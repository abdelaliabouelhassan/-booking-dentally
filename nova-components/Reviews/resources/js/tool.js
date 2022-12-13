import Tool from './pages/Tool'
import Statistics from './pages/Statistics'
Nova.booting((app, store) => {
  Nova.inertia('Reviews', Tool);
  Nova.inertia('statistics', Statistics);

})

