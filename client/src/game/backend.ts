export const BACKEND_URL = (window.location.href.indexOf("www.eclecticmeme.com") === -1)
    ? `${window.location.protocol.replace("https", "wss")}//${window.location.hostname}${(window.location.port && `:${window.location.port}`)}`
    : "wss://www.eclecticmeme.com:2567"

export const BACKEND_HTTP_URL = BACKEND_URL.replace("wss", "https");
