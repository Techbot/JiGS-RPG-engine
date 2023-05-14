import Arena from "@colyseus/arena";
import { monitor } from "@colyseus/monitor";
import { Server } from "colyseus";
import express from "express";
import loaders from './loaders';
import globalEmitter from './loaders/eventEmitter';
/**
 * Import your Room files
 */
import { GameRoom } from "./rooms/GameRoom";

const fs                    = require('fs');
const app                   = express();
const { createServer }      = require("https")
const key                   = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/privkey.pem', 'utf8');
const cert                  = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/cert.pem', 'utf8');
const ca1                   = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/chain.pem', 'utf8');
const credentials = {
  key: key,
  cert: cert,
  ca: ca1
};
var roomNumber: [number, string][];
const cors                  = require("cors");

// import { uWebSocketsTransport}  from "@colyseus/uwebsockets-transport";
import { WebSocketTransport } from "@colyseus/ws-transport"

let gameServerRef: Server;
let latencySimulationMs: number = 0;

export default Arena({
    getId: () => "Your Colyseus App",
    initializeGameServer: (gameServer) => {
        /**
         * Define your room handlers:
         */
        //gameServer.define('part1_room', Part1Room);

        const roomNumber = new Map<number, string>( [
            [4, 'Dublin-001'],
            [18,'Dublin-002'],
            [12,'Dublin-003'],
            [22,'Dublin-004'],
            [9, 'Dublin-005'],
            [66,'Dublin-006'],
            [65,'Dublin-007'],
            [64,'Dublin-008'],
            [13,'Dublin-009'],
            [14,'Dublin-010'],
            [17,'Dublin-011'],
            [72,'Dublin-012'],
            [67,'Dublin-013'],
            [74,'Dublin-014'],
            [77,'Dublin-015'],
            [73,'Dublin-016'],
            [78,'Dublin-017'],
            [79,'Dublin-018'],
            [80,'Dublin-019'],
            [81,'Dublin-020'],
            [82,'Dublin-021'],
            [83,'Dublin-022'],


            [75, 'HyBrasil-001'],
            [76, 'HyBrasil-002'],





       ]);

        for (const [nodeNumber,nodeName] of [...roomNumber]) {
            gameServer.define(nodeName, GameRoom, { nodeNumber: nodeNumber, nodeName: nodeName });
        }
        //
        // keep gameServer reference, so we can
        // call `.simulateLatency()` later through an http route
        //
        gameServerRef = gameServer;
    },

    initializeExpress: (app) => {
        /**
         * Bind your custom express routes here:
         */

		app.use(cors());
        app.get("/", deliver);



        // these latency methods are for development purpose only.
        app.get("/latency", (req, res) => res.json(latencySimulationMs));
        app.get("/simulate-latency/:milliseconds", (req, res) => {
            latencySimulationMs = parseInt(req.params.milliseconds || "100");
            // enable latency simulation
            gameServerRef.simulateLatency(latencySimulationMs);
            res.json({ success: true });
        });

        /**
         * Bind @colyseus/monitor
         * It is recommended to protect this route with a password.
         * Read more: https://docs.colyseus.io/tools/monitor/
         */
        app.use("/colyseus", monitor());
    },
  initializeTransport: (options) => {

    const app = express()
    app.use(cors());
    app.use(express.json())
    app.use("/colyseus", monitor());
    // Prepare HTTPS server
    const secureServer = createServer({ key, cert }, app)
    console.log("secureServer created")
    return new WebSocketTransport({
        server: secureServer,
    });
},

    beforeListen: () => {
        /**
         * Before before gameServer.listen() is called.
         */
    }
});

function deliver(req: any, res: { send: (arg0: string) => void; }) {
    res.send(__dirname + 'game/dist/index.html');
    globalEmitter.emit('log_message', { time: Date.now(), message: 'A message' })
    globalEmitter.emit('heartbeat', { time: Date.now(), message: 'A Heartbeat' })
}
