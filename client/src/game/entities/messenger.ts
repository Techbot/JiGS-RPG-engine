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
      let i = 0;
      while (i < self.jigs.mobArray.length) {
      //  self.MobContainerArray[i].x = self.jigs.mobArray[i][1];
      //  self.MobContainerArray[i].y = self.jigs.mobArray[i][2];
        i++;
      }
    });

    self.room.onMessage("dead", (message) => {
      console.log('dead');
      if (self.jigs.playerState != "dead") {
        self.currentPlayer.anims.play('hurt_' + self.jigs.playerStats.sprite_sheet);
      }
      self.jigs.playerState = "dead";
    });

    self.room.onMessage("reward", (message) => {
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
        if (self.jigs.mobArray[i][1] == message) {
          self.Mobs.SceneMobArray[i].play('hurt_mob' + self.jigs.mobArray[i][4]);
          self.Mobs.SceneMobArray[i].body.setPosition(parseInt(self.jigs.mobArray[i]['x']), parseInt(self.jigs.mobArray[i]['y']));
        }
        i++;
      }
      self.updateState();
    });

    self.room.onMessage("remove-reward", (message) => {
      let i = 0;
      while (i < self.rewardsArray.length) {
        if (self.rewardsArray[i].ref == message) {
          //  self.rewardsArray[i].disableBody(true, true);
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

    self.room.state.mobResult.onChange((value, key) => {

      let i = 0;
      while (i < self.jigs.mobArray.length) {
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
