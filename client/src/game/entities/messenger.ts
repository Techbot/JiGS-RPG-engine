export default class Messenger {
  room: any;
  self: any;

  initMessages(self) {

    self.room.onMessage("portal", (message) => {
      const promise1 = Promise.resolve(self.jump());
      self.jigs.tiled = message;
      //  hide(this.localPlayer);
    });

    self.room.onMessage("collide", (message) => {
    //  self.currentPlayer.y = self.remoteRef.y;
    //  self.currentPlayer.x = self.remoteRef.x;
      let i = 0;
      while (i < self.jigs.mobArray.length) {
        self.MobContainerArray[i].x = self.jigs.mobArray[i][1];
        self.MobContainerArray[i].y = self.jigs.mobArray[i][2];
        i++;
      }
    });

    self.room.onMessage("dead", (message) => {
      console.log('dead');
      self.jigs.playerState = "dead";
      self.currentPlayer.anims.play('hurt_' + self.jigs.playerStats.sprite_sheet);
    });

    self.room.onMessage("reward", (message) => {
   //   self.currentPlayer.y = self.remoteRef.y;
   //   self.currentPlayer.x = self.remoteRef.x;
      self.jigs.playerStats.credits++;
      //   this.incrementReward();
    });

    self.room.onMessage("player hit", (message) => {
      self.updateState();
    });

    self.room.onMessage("struck", (message) => {
      console.log('struck:' + message);
      self.jigs.playerStats.health = message;
    });

    self.room.onMessage("zombie dead", (message) => {
      let i = 0;
      while (i < self.jigs.mobArray.length) {
        if (self.jigs.mobArray[i][0] == message) {
          self.SceneMobArray[i].play('hurt_mob' + self.jigs.mobArray[i][3]);
          self.SceneMobArray[i].body.setPosition(parseInt(self.jigs.mobArray[i]['x']), parseInt(self.jigs.mobArray[i]['y']));
        }
        i++;
      }
      self.updateState();
    });

    self.room.onMessage("remove-reward", (message) => {
   //   self.currentPlayer.y = self.remoteRef.y;
   //   self.currentPlayer.x = self.remoteRef.x;
      //    this.incrementReward();
      let i = 0;
      while (i < self.rewardsArray.length) {
        if (self.rewardsArray[i].ref == message) {
          self.rewardsArray[i].disableBody(true, true);
        }
        i++;
      }
    });

    self.room.onStateChange((state) => {
//
    });

    self.room.onStateChange.once((state) => {
     // console.log("the room state has been updated:", state);
    });

    self.room.state.listen("MobResult", (currentValue, previousValue) => {
      //  console.log(`currentTurn is now ${currentValue}`);
      //  console.log(`previous value was: ${previousValue}`);
    });

    self.room.state.MobResult.onChange((value, key) => {

      let i = 0;
      while (i < self.jigs.mobArray.length) {

        /* console.log(self.jigs.mobArray[i][0]);
        console.log(self.jigs.mobArray[i][1]);
        console.log(self.jigs.mobArray[i][2]);
        console.log(self.jigs.mobArray[i][3]);
        console.log(self.jigs.mobArray[i][4]); */

        if (self.jigs.mobArray[i][1] == key) {
          self.jigs.mobArray[i][2] = parseInt(value.field_x_value);
          self.jigs.mobArray[i][3] = parseInt(value.field_y_value);
          self.jigs.mobArray[i][6] = parseInt(value.health);
        }
        i++;
      }
    });
  }
}
