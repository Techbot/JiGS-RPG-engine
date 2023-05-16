/**
 * -------Anim ---------
 */

import Phaser from 'phaser'

const createCharacterAnims = (anims: Phaser.Animations.AnimationManager, entity) => {

    console.log('adding entity:' + entity);

    anims.create({
        key: 'walkLeft_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [117, 118, 119, 120, 121, 122, 123, 124, 125] }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: 'walkRight_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [143, 144, 145, 146, 147, 148, 149, 150, 151] }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: 'walkUp_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [104, 105, 106, 107, 108, 109, 110, 110, 112] }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: 'walkDown_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [130, 131, 132, 133, 134, 135, 136, 137, 138] }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: 'stop_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [130, 130, 130, 130, 130, 130, 130, 130, 138] }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: 'kick_' + entity,
        frames: anims.generateFrameNumbers(entity, { frames: [10, 11, 12, 13, 10] }),
        frameRate: 12,
        repeat: -1,
        repeatDelay: 2000
    });

}

export {
    createCharacterAnims
}
