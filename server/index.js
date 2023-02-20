const fs = require('fs');
const path = require('path');
const jsdom = require('jsdom');
const express = require('express');
const app = express();
import loaders from '../loaders';
import globalEmitter from './loaders/eventEmitter';

const Datauri = require('datauri/parser');
const datauri = new Datauri();
const { JSDOM } = jsdom;
const Bridge = require ('./game/services/bridge.js');
const cors = require("cors");
const privateKey1 = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/privkey.pem', 'utf8');
const certificate1 = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/cert.pem', 'utf8');
const ca1 = fs.readFileSync('/etc/letsencrypt/live/www.eclecticmeme.com/chain.pem', 'utf8');
const credentials = {
	key: privateKey1,
	cert: certificate1,
	ca: ca1
};
const server = require('http').Server(app);
const secure_server = require('https').Server(credentials,app);
const io = require('socket.io')(secure_server, {
  cors: {
    origin: "https://www.eclecticmeme.com",
    methods: ["GET", "POST"],
    allowedHeaders: ["my-custom-header"],
    credentials: true
  }
});

async function startServer(){
  await loaders({ app });
  app.use(cors());
  app.use(express.static(__dirname + '/public')); // Is this needed?
  app.get('/', deliver);
}

function deliver(req, res) {
 res.send(__dirname + 'game/dist/index.html');
 globalEmitter.emit('log_message', { time: Date.now(), message: 'A message' })
 globalEmitter.emit('heartbeat', { time: Date.now(), message: 'A Heartbeat' })

}

function setupAuthoritativePhaser() {
  JSDOM.fromFile(path.join(__dirname, 'game/dist/index.html'), {
    // To run the scripts in the html file
    runScripts: "dangerously",
    // Also load supported external resources
    resources: "usable",
    // So requestAnimatinFrame events fire
    pretendToBeVisual: true
  }).then((dom) => {
    dom.window.URL.createObjectURL = (blob) => {
      if (blob){
        return datauri.format(blob.type, blob[Object.getOwnPropertySymbols(blob)[0]]._buffer).content;
      }
    };
    dom.window.URL.revokeObjectURL = (objectURL) => {};

    dom.window.mapJump = (user,map) =>{

     Bridge.updateMap(user,map);
      console.log(map);
     //mysql save map   goes here

    }

    dom.window.gameLoaded = () => {
      secure_server.listen(8082, function () {
    //    console.log(`Listening on ${secure_server.address().port}`);
      });
	};
    dom.window.io = io;
  }).catch((error) => {
 //   console.log(error.message);
  });
}

startServer();
setupAuthoritativePhaser();
