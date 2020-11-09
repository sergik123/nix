import vueRouter from 'vue-router';
import Vue from 'vue';
import BookViewComponent from "./components/BookViewComponent";

Vue.use(vueRouter);

const routes = [
    {
        path: "api/examples",
        component: BookViewComponent
    }
];
export default new vueRouter({
    mode: "history",
    routes
});
