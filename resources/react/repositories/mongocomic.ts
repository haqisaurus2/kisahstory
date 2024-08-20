import { AppConfig } from "../config/config";
export const getComicPrepareList = () => {
    return fetch(AppConfig.baseUrl + "/api/get-prepare-list").then((response) =>
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
