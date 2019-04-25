
import Vue from 'vue';

import VueRouter from 'vue-router';

import ads from './components/Ads.vue';
import categories from './components/Categories.vue';
import login from './components/LoginComponent.vue';
import profile from './components/UserInfos/profile.vue'; 
import store from './app.js'
Vue.use(VueRouter);
const router = new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/login',
            name:'login',
            component:login
        },
        {
            path:'/',
            name:'ads',
            component:ads,
            meta: {
                requiresAuth: true
            }
        },
        {
            path:'/categories',
            name:'categories',
            component:categories,
            meta: {
                requiresAuth: true
            }
        },
        {
            path:'/profile',
            name:'profile',
            component:profile,
            meta: {
                requiresAuth: true
            }
        }
    ]
});
// router.beforeEach((to,from,next)=>{
//     const requiresAuth=to.matched.some(record => record.meta.requiresAuth);
//     const currentUser=store.state.currentUser;

//     if(requiresAuth && !currentUser){
//         next('/');
//     }else if (to.path== '/login' &&currentUser){
//         next('/annonces');
//     }else{
//         next('');
//     }
// })
// meta{
// requiresAuth:true
// }
export default router;