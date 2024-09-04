import { AppConfig } from "../config/config";

export const getStoryList = () => {
    return fetch(AppConfig.baseUrl + "/api/get-story-list").then((response) =>
        response.json()
    );
};

export const getCategoryDropdown = () => {
    return fetch(AppConfig.baseUrl + "/api/get-category-dropdown").then((response) =>
        response.json()
    );
};

export const addStory = (addStory: any) => {
    return fetch(
        AppConfig.baseUrl + "/api/add-story"
        , {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(addStory),
        }
    ).then((response) => response.json());
};

export const getChapterList = (id: number, pagination: any) => {
    return fetch(AppConfig.baseUrl + "/api/get-chapter-list/" + id + (pagination ? "?" + new URLSearchParams(pagination) : null)).then((response) =>
        response.json()
    );
};

export const addChapter = (addStory: any) => {
    return fetch(
        AppConfig.baseUrl + "/api/add-chapter"
        , {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(addStory),
        }
    ).then((response) => response.json());
};