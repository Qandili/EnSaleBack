import {setAuthorization} from '../helpers/general';
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
export function Logout(){
    var user=getLocalUser();
    setTokenapi(user.access_token);

    return new Promise((res,rej) =>{
        api.get("api/auth/logout")
        .then((response) => {
            // setAuthorization(response.data.access_token);
            res(response);
            console.log(response);
            // location.reload();
        })
        .catch(function (error) {
            rej("Error occured");
        })
        })
}
export function getLocalUser(){
    const userStr=localStorage.getItem("user");
    if(!userStr){
        return null;
    }
    return JSON.parse(userStr);
}