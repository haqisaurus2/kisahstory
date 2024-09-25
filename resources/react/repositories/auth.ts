import { AppConfig } from "../config/config";
import { getCookie } from "../util/util";

export const loginUsingGoogle = (tokenId: string) => {
    return fetch(
        AppConfig.baseUrl + "/api/auth/google"
        , {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ tokenId }),
        }
    ).then((response) => response.json());
};


export const getUserDetail = () => {
    const token = getCookie('credentials');
    return fetch(
        AppConfig.baseUrl + "/api/me"
        , {
        method: "GET",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token
        },
         
        }
    ).then((response) => response.json());
}