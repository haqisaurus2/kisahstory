import { AppConfig } from "../config/config";
export const getComicPrepareList = (pagination: any) => {
    return fetch(AppConfig.baseUrl + "/api/get-prepare-list" + (pagination ? "?" + new URLSearchParams(pagination) : null)).then((response) =>
        response.json()
    );
};
export const syncComic = (uuid: string) => {
    return fetch(
        AppConfig.baseUrl + "/api/sync-comic/" + uuid
        // , {
        // method: "POST",
        // headers: {
        //     Accept: "application/json",
        //     "Content-Type": "application/json",
        // },
        // body: JSON.stringify({ uuid }),
        // }
    ).then((response) => response.json());
};
export const updateComic = (uuid: string) => {
    return fetch(
        AppConfig.baseUrl + "/api/update-comic"
        , {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ uuid }),
        }
    ).then((response) => response.json());
};
