
import Ads from './components/Ads.vue';
import ContactUs from './components/ContactUs.vue';
import PostNewAd from './components/PostNewAd.vue';
import Categories from './components/Categories.vue';
import Login from './components/auth/Login.vue';
import SpaTest from './components/SpaTest.vue';
import Profile from './components/UserInfos/profile.vue'; 
import MesAnnonces from './components/UserInfos/Mesannonces.vue'; 
import MesFavoris from './components/UserInfos/MesFavoris.vue'; 
import MesParametres from './components/UserInfos/Mesparametres.vue'; 
import store from './app.js';

export const router = [
    {
        path:'/spa',
        name:'spatest',
        component:SpaTest
    },
    {
        path:'/login',
        name:'login',
        component:Login
    },
    {
        path:'/',
        name:'ads',
        component:Ads,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/newad',
        name:'newad',
        component:PostNewAd
    },
    {
        path:'/categories',
        name:'categories',
        component:Categories,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/contactus',
        name:'contactus',
        component:ContactUs,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/profile',
        name:'profile',
        component:Profile,
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
    }
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