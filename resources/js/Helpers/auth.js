import {setAuthorization} from '../Helpers/general';
import {api} from '../api.js';
import {setToken} from '../api.js';

export function login(credentials){
    return new Promise((res,rej) =>{
        axios.post("api/auth/login", credentials)
        .then((response) => {
            setAuthorization(response.data.access_token);
            res(response.data);
        })
        .catch(function (error) {
            rej("wrong email or password");
        })
        })
}
export function verify(credentials){
    return new Promise((res,rej) =>{
        axios.put("api/auth/signup", credentials)
        .then((response) => {
            setAuthorization(response.data.access_token);
            res(response.data);
        })
        .catch(function (error) {
            rej("An error was occured");
        })
        })
}
export function Logout(){
    var user=getLocalUser();
    const AuthStr='Bearer '.concat(user.token);
    // console.log(AuthStr);    
    return new Promise((res,rej) =>{
        axios.get("api/auth/logout",{
            headers:{
                Authorization: AuthStr,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then((response) => {
            res(response);
            console.log(response);
        }).catch(function (error) {
            rej("an error occured");
        });
        // api.get("api/auth/logout")
        // .then((response) => {
        //     // setAuthorization(response.data.access_token);
        //     res(response);
        //     console.log(response);
        //     // location.reload();
        // });
        })
}
export function getLocalUser(){
    const userStr=localStorage.getItem("user");
    if(!userStr){
        return null;
    }
    return JSON.parse(userStr);
}