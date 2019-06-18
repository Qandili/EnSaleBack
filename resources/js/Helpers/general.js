import {baseURL} from '../app.js';

export function initialize(store, router) {
    console.log("jank");
    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const currentUser = store.state.currentUser;
        if(requiresAuth && !currentUser) {

            // next('/login');
            // window.location.href="http://127.0.0.1:8000/login";
            window.location.href=baseURL+"/login";
            console.log("not logged in");
        } else if(to.path == '/login' && currentUser) {

            // next('/annonces');
            // window.location.href="http://127.0.0.1:8000/";
            window.location.href=baseURL+"/";
            console.log("logged in");
        } else {
            next();
        }
    });
    
    axios.interceptors.response.use(null, (error) => {
        if (error.resposne.status == 401) {
            console.log("not logged in");

            store.commit('logout');
            router.push('/login');
        }

        return Promise.reject(error);
    });

    if (store.getters.currentUser) {
        setAuthorization(store.getters.currentUser.token);
    }
}
export function setAuthorization(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}
