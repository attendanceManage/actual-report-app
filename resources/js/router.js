import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

// Layout file
import Dashboard from "./views/backend/TemplateUploade.vue";


const routes = [
  
    {
      path: "/",  
      name: "dashboard",
      component: Dashboard,
    }
];

const router = new VueRouter({
  mode: "history", 
  routes,
    
});

export default router;
