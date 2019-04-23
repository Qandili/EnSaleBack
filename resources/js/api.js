import axios from "axios";

export const api=axios.create({
    baseURL:"http://127.0.0.1:8001",
    headers:{
        'X-Requested-With': 'XMLHttpRequest',
    }
});

export function setToken(token){
    api.defaults.headers.common["Authorisation"]='Bearer '.concat(token);
}

export function clearToken(token){
    delete api.defaults.headers.common["Authorisation"];
}