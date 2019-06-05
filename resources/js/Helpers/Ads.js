export function postAd(credentials){
    return new Promise((res,rej) =>{
        axios.post("api/auth/ad/new", credentials)
        .then((response) => {
            res(response.data);
        })
        .catch(function (error) {
            rej("Une erreur s'est produite");
        })
    })
}

