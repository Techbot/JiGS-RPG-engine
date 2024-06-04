/**
 * -------tilesetLoader ---------
 */

import { useJigsStore } from '../../stores/jigs';

export default class TilesetLoader {

  jigs: any;

  constructor() {
    this.jigs = useJigsStore();

  }

  add(scene) {
    console.log("------------Tileset Loader---------------")

    this.jigs.tilesetArray_1.forEach(function loader(image) {
      if (!scene.textures.exists(image)) {
        scene.load.image(image, '/assets/images/System/' + image + '.png');
      }
    }, this);

    this.jigs.tilesetArray_2.forEach(function loader(image) {
      if (!scene.textures.exists(image)) {
        scene.load.image(image, '/assets/images/System/' + image + '.png');
      }
    }, this);

    this.jigs.tilesetArray_3.forEach(function loader(image) {
      if (!scene.textures.exists(image)) {
        scene.load.image(image, '/assets/images/System/' + image + '.png');
      }
    }, this);

    if (this.jigs.tilesetArray_4 !== undefined) {
      this.jigs.tilesetArray_4.forEach(function loader(image) {
        if (!scene.textures.exists(image)) {
          scene.load.image(image, '/assets/images/System/' + image + '.png');
        }
      }, this);


    }
  }
}
