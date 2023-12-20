import Phaser from "phaser";

export class ShardScene extends Phaser.Scene {
  constructor() {
    super({ key: "ShardScene" });
  }

  preload() {
    this.load.text('data', 'assets/test.txt');
  }

  create() {
    const data = this.cache.text.get('data');
    this.add.dom(400, 300, 'div', 'background-color: rgba(0, 0, 80); width: 600px; height: 500px; font: 12px Courier; color: white; overflow: hidden', data);
  }
}
