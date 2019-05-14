
// import Vue from 'vue';

// import VueRouter from 'vue-router';

import ads from './components/Ads.vue';
import categories from './components/Categories.vue';
import LoginComponent from './components/LoginComponent.vue';
import SpaTest from './components/SpaTest.vue';
import profile from './components/UserInfos/profile.vue'; 
import MesAnnonces from './components/UserInfos/Mesannonces.vue'; 
import MesFavoris from './components/UserInfos/MesFavoris.vue'; 
import MesParametres from './components/UserInfos/Mesparametres.vue'; 
import store from './app.js'
// Vue.use(VueRouter);
export const router = [

        {
            path:'/spa',
            name:'spatest',
            component:SpaTest
        },
        {
            path:'/login',
            name:'login',
            component:LoginComponent
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
            children: [
                {
                  // UserProfile will be rendered inside User's <router-view>
                  // when /user/:id/profile is matched
                path: 'mesannonces',
                component: MesAnnonces
                },
                {
                // UserPosts will be rendered inside User's <router-view>
                // when /user/:id/posts is matched
                path: 'mesfavoris',
                component: MesFavoris
                },
                {
                    path:'',
                    component:MesParametres
                }
            ],
            meta: {
                requiresAuth: true
            }
        },  
];
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