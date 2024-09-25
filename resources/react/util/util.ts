export function setCookie(name: string, value: string, seconds: number) {
    const date = new Date();
    // Set the time to 1 hour from now
    date.setTime(date.getTime() + (seconds * 1000));
    
    // Create the expires string in UTC format
    const expires = "expires=" + date.toUTCString();
    
    // Set the cookie
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

export function getCookie(name: string) {
    // Create a regex pattern to match the cookie name
    const pattern = new RegExp('(^|; )' + name + '=([^;]*)');
    const match = document.cookie.match(pattern);
    
    // Return the cookie value or null if not found
    return match ? decodeURIComponent(match[2]) : null;
}


export function removeCookie(name: string) {
    // Create a regex pattern to match the cookie name
   document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
// // Example: Setting a cookie named 'username' with the value 'JohnDoe', expiring in 1 hour
// setCookie("username", "JohnDoe", 1);