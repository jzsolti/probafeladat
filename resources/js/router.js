import { createWebHistory, createRouter } from "vue-router";
import Dashboard from './modules/Dashboard.vue';
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
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active'
});

export default router;