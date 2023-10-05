export const BACKEND_URL = (window.location.href.indexOf("192.168.178.206") === -1)
    ? `${window.location.protocol.replace("http", "ws")}//${window.location.hostname}${(window.location.port && `:${window.location.port}`)}`
    : "ws://192.168.178.206:2567"

export const BACKEND_HTTP_URL = BACKEND_URL.replace("ws", "http");
