export const BACKEND_URL = (window.location.href.indexOf("localhost") === -1)
    ? `${window.location.protocol.replace("https", "wss")}//${window.location.hostname}${(window.location.port && `:${window.location.port}`)}`
    : "ws://localhost:2567"

export const BACKEND_HTTP_URL = BACKEND_URL.replace("ws", "http");
