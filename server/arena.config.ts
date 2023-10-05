import Arena from "@colyseus/arena";
import { monitor } from "@colyseus/monitor";
import { Server } from "colyseus";
import express from "express";
import loaders from './loaders';
import { createServer } from "http";
import globalEmitter from './loaders/eventEmitter';



















import run from "./cron/run"


/**
 * Import your Room files
 */
import { GameRoom } from "./rooms/GameRoom";

const fs                    = require('fs');
const app                   = express();
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

            [386,'Global-999'],

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

            [143, 'NewWashington-001'],
            [149, 'NewWashington-002'],
            [199, 'NewWashington-003'],
            [200, 'NewWashington-004'],
            [340, 'NewWashington-005'],
            [341, 'NewWashington-006'],
            [342, 'NewWashington-007'],
            [343, 'NewWashington-008'],
            [344, 'NewWashington-009'],
            [345, 'NewWashington-010'],
            [346, 'NewWashington-011'],
            [347, 'NewWashington-012'],
            [348, 'NewWashington-013'],
            [349, 'NewWashington-014'],
            [350, 'NewWashington-015'],
            [351, 'NewWashington-016'],
            [352, 'NewWashington-017'],
            [353, 'NewWashington-018'],
            [354, 'NewWashington-019'],
            [355, 'NewWashington-020'],
            [356, 'NewWashington-021'],
            [357, 'NewWashington-022'],

            [233, 'Cairo-001'],
            [255, 'Cairo-002'],
            [256, 'Cairo-003'],
            [257, 'Cairo-004'],
            [258, 'Cairo-005'],
            [259, 'Cairo-006'],
            [260, 'Cairo-007'],
            [261, 'Cairo-008'],
            [262, 'Cairo-009'],
            [263, 'Cairo-010'],
            [264, 'Cairo-011'],
            [265, 'Cairo-012'],
            [266, 'Cairo-013'],
            [267, 'Cairo-014'],
            [268, 'Cairo-015'],
            [269, 'Cairo-016'],
            [270, 'Cairo-017'],
            [271, 'Cairo-018'],
            [272, 'Cairo-019'],
            [273, 'Cairo-020'],
            [274, 'Cairo-021'],
            [275, 'Cairo-022'],

            [230, 'Yara-001'],
            [232, 'Athens-001'],

            [229, 'Cyberia-001'],
            [234, 'Cyberia-002'],
            [235, 'Cyberia-003'],
            [236, 'Cyberia-004'],
            [237, 'Cyberia-005'],
            [238, 'Cyberia-006'],
            [239, 'Cyberia-007'],
            [240, 'Cyberia-008'],
            [241, 'Cyberia-009'],
            [242, 'Cyberia-010'],
            [243, 'Cyberia-011'],
            [244, 'Cyberia-012'],
            [245, 'Cyberia-013'],
            [246, 'Cyberia-014'],
            [247, 'Cyberia-015'],
            [248, 'Cyberia-016'],
            [249, 'Cyberia-017'],
            [250, 'Cyberia-018'],
            [251, 'Cyberia-019'],
            [252, 'Cyberia-020'],
            [253, 'Cyberia-021'],
            [254, 'Cyberia-022'],
            [358, 'Cyberia-023'],
            [359, 'Cyberia-024'],
            [360, 'Cyberia-025'],

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

function deliver(req: any, res: { send: (arg0: string) => void; }) {
    res.send(__dirname + 'game/dist/index.html');
    globalEmitter.emit('log_message', { time: Date.now(), message: 'A message' })
    globalEmitter.emit('heartbeat', { time: Date.now(), message: 'A Heartbeat' })
}
