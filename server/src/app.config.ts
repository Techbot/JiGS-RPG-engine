import config from "@colyseus/tools";
import { monitor } from "@colyseus/monitor";
import { playground } from "@colyseus/playground";
import { auth, JWT } from "@colyseus/auth";

import { Server } from "colyseus";
import express from "express";
import loaders from './loaders';

import { createServer } from "http";
import globalEmitter from './loaders/eventEmitter';
import run from "./cron/run";
var gameModel = require('./models/game.ts');

/**
 * Import your Room files
 */
import { GameRoom } from "./Jigs/GameRoom";

const fs = require('fs');
const app = express();
//const { createServer }      = require("https")

//const key                   = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/privkey.pem', 'utf8');
//const cert                  = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/cert.pem', 'utf8');
//const ca1                   = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/chain.pem', 'utf8');
//const credentials = {
//  key: key,
//  cert: cert,
//  ca: ca1
//};

var roomNumber: [number, string][];
const cors = require("cors");

// import { uWebSocketsTransport}  from "@colyseus/uwebsockets-transport";
import { WebSocketTransport } from "@colyseus/ws-transport"

let gameServerRef: Server;
let latencySimulationMs: number = 0;

export default config({
    getId: () => "Your Colyseus App",
    initializeGameServer: (gameServer) => {
        /**
         * Define your room handlers:
         */
        //gameServer.define('part1_room', Part1Room);

        const roomNumber = new Map<number, string>([]);
      //  const thing = gameModel.getRooms;

        gameModel.getRooms().then((result: any) => {
            result.forEach(element => {
                console.log(element.nid + " " + element.title + '-' + padding(element.field_tiled_value, 3, 0));
                roomNumber.set(element.nid, element.title + '-' + padding(element.field_tiled_value, 3,0));
            });
            for (const [nodeNumber, nodeName] of [...roomNumber]) {

                gameServer.define(nodeName, GameRoom, { nodeNumber: nodeNumber, nodeName: nodeName });
            }
            gameServerRef = gameServer;

        });
        //
        // keep gameServer reference, so we can
        // call `.simulateLatency()` later through an http route
        //
    },

    initializeExpress: (app) => {
        /**
         * Bind your custom express routes here:
         */

        app.use(cors());
        app.get("/", deliver);
        run();

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
        //app.use(cron());
        app.use(express.json())
        app.use("/colyseus", monitor());
        // Prepare HTTPS server
        // const secureServer = createServer({ key, cert }, app)
        console.log("secureServer created")
        return new WebSocketTransport({

        });
    },
    beforeListen: () => {
        /**
         * Before before gameServer.listen() is called.
         */
    }
});

function padding(n, p, c) {
    var pad_char = typeof c !== 'undefined' ? c : '0';
    var pad = new Array(1 + p).join(pad_char);
    return (pad + n).slice(-pad.length);
}
function deliver(req: any, res: { send: (arg0: string) => void; }) {
    res.send(__dirname + 'game/dist/index.html');
    globalEmitter.emit('log_message', { time: Date.now(), message: 'A message' })
    globalEmitter.emit('heartbeat', { time: Date.now(), message: 'A Heartbeat' })
}
