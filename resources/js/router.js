import { createWebHistory, createRouter } from "vue-router";
import Dashboard from './modules/Dashboard.vue';
import Vehicles from './modules/vehicles/Vehicles.vue';
import VehicleForm from './modules/vehicles/VehicleForm.vue';
import VehicleDetails from './modules/vehicles/VehicleDetails.vue';
import CheckSheetForm from './modules/checkseets/CheckSheetForm.vue';
import CheckSheetDetail from './modules/checkseets/CheckSheetDetail.vue';


import Login from './auth/Login.vue';
import Logout from './auth/Logout.vue';
import NotFound from './components/NotFound.vue';

import store from './store/store.js';

const routes = [
    { path: '/:pathMatch(.*)*', alias: ['/_404'], name: 'NotFound', component: NotFound },
    {
        name: 'login',
        path: '/login',
        component: Login,
        beforeEnter: (to, from, next) => {
            if (store.state.isAuthenticated) next({ name: 'dashboard' })
            else next()
        }
    },
    {
        name: 'logout',
        path: '/logout',
        component: Logout,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'dashboard',
        path: '/',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'vehicles',
        path: '/vehicles',
        component: Vehicles,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'vehicles-create',
        path: '/vehicles/create',
        component: VehicleForm,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'vehicles-details',
        path: '/vehicles/edit/:id',
        component: VehicleDetails,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'check-sheet-create',
        path: '/check-sheets/create/:vehicleId',
        component: CheckSheetForm,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
    {
        name: 'check-sheet-details',
        path: '/check-sheets/:checkSheetId',
        component: CheckSheetDetail,
        beforeEnter: (to, from, next) => {
            if (!store.state.isAuthenticated) next({ name: 'login' })
            else next()
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active'
});

export default router;