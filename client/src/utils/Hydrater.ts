/**
 * ------- Hydrator ---------
 */
import Phaser from "phaser";
import { useJigsStore } from '../stores/jigs.js';

export default class Hydrater {
  jigs: any;
  profileId: number;
  playerName: any;
  playerSwitches: any;
  tiled: number;

  constructor() {
    this.jigs = useJigsStore();
  }

  hydratePlayer(response) {
    this.jigs.playerStats = response.data[0].value["player"];
    this.jigs.health = response.data[0].value["health"];
    this.jigs.energy = response.data[0].value["energy"];
    this.jigs.playerId = parseInt(response.data[0].value["player"]["id"]);
    this.jigs.profileId = parseInt(response.data[0].value["player"]["profileId"]);
    this.jigs.playerName = response.data[0].value["player"]["name"];
    this.jigs.playerSwitches = response.data[0].value["player"]["flickedSwitches"];
    this.jigs.userMapGrid = response.data[0].value["player"]["userMG"];
    return response;
  }

  hydrateMap(response, incMob) {
    this.jigs.tiled = parseInt(response.data[0].value["MapGrid"]["tiled"]);
    this.jigs.soundtrack = response.data[0].value["MapGrid"]["soundtrack"];
    this.jigs.mapWidth = parseInt(response.data[0].value["MapGrid"]["mapWidth"]);
    this.jigs.mapHeight = parseInt(response.data[0].value["MapGrid"]["mapHeight"]);
    this.jigs.portalsArray = response.data[0].value["MapGrid"]["portalsArray"];
    if (response.data[0].value["MapGrid"]["switchesArray"]) {
      this.jigs.switchesArray = response.data[0].value["MapGrid"]["switchesArray"];
    }
    this.jigs.dialogueArray = response.data[0].value["MapGrid"]["dialogueArray"];
    this.jigs.fireArray = response.data[0].value["MapGrid"]["fireArray"];
    this.jigs.fireBarrelsArray = response.data[0].value["MapGrid"]["fireBarrelsArray"];
    this.jigs.leverArray = response.data[0].value["MapGrid"]["leverArray"];
    this.jigs.machineArray = response.data[0].value["MapGrid"]["machineArray"];
    this.jigs.crystalArray = response.data[0].value["MapGrid"]["crystalArray"];
    this.jigs.foliosArray = response.data[0].value["MapGrid"]["foliosArray"];
    this.jigs.wallsArray = response.data[0].value["MapGrid"]["wallsArray"];
    this.jigs.npcArray = response.data[0].value["MapGrid"]["npcArray"];
    if (incMob) {
      this.jigs.mobArray = response.data[0].value["MapGrid"]["mobArray"];
    }
    this.jigs.bossesArray = response.data[0].value["MapGrid"]["bossesArray"];
    this.jigs.rewardsArray = response.data[0].value["MapGrid"]["rewardsArray"];
    this.jigs.nodeTitle = response.data[0].value["MapGrid"]["name"];
    this.jigs.tilesetArray_1 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_1"];
    this.jigs.tilesetArray_2 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_2"];
    this.jigs.tilesetArray_3 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_3"];
    this.jigs.tilesetArray_4 = response.data[0].value["MapGrid"]["tileset"]["tilesetArray_4"];
    this.jigs.city = response.data[0].value["City"];
    // Regex replaces close/open p with \n new line
    // And replaces all other html tags with null.
    this.jigs.debug = parseInt(response.data[0].value["gameConfig"]["Debug"]);
    this.jigs.content = response.data[0].value["gameConfig"]["Body"].replaceAll('</p><p>', '\n').replaceAll(/(<([^>]+)>)/ig, '');

    this.jigs.missionSwitchesArray = response.data[0].value["missionSwitches"];

    if (response.data[0].value["MapGrid"]["cutscene"]) {
      this.jigs.cutscene = response.data[0].value["MapGrid"]["cutscene"];
      this.jigs.cutscenePosition = 0;
    }
  }

  hydrateMission(response) {
    this.jigs.title = response.data[0].value["title"];
    this.jigs.missionHandlerDialog = response.data[0].value["handler_dialog"];
    let no = { text: 'No I am not ready.', value: 0 }
    let yes = { text: response.data[0].value["choice"], value: response.data[0].value["value"] };
    this.jigs.choice = new Array;
    this.jigs.choice.push(yes);
    this.jigs.choice.push(no);
    // console.log(this.jigs.choice);
  }

  hydrateSwitches(response, id) {
    this.jigs.switchesArray.push(id);
    //this.updatePhaser
  }

  hydrateCutscene(response) {
    this.jigs.content = response.data[0].value.dialog;

    if (response.data[0].value.missionCompleteDialog) {
      this.jigs.missionCompleteDialog = response.data[0].value.missionCompleteDialog[0];
    }
  }
}
