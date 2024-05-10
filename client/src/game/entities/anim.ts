/**
 * ------- Anim ---------
 */

import Phaser from 'phaser'

const createCharacterAnims = (anims: Phaser.Animations.AnimationManager, entity, tag) => {

    if (tag == 'default') {

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
            key: 'hurt_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [260, 261, 262, 263, 264, 265] }),
            frameRate: 12,
            repeat: 0
        });
    }

    if (tag == 'slash_oversize') {

        anims.create({
            key: 'walkLeft_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [162, 163, 164, 165, 166, 166, 167, 168, 169] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkUp_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [144, 145, 146, 147, 148, 149, 150, 151, 152] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkRight_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [198, 199, 200, 201, 202, 203, 204, 205, 206] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkDown_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [180, 181, 182, 183, 184, 185, 186, 187, 188] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'stop_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [180, 180, 180, 180, 180, 180, 180, 180, 180] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'thrustUp_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [43, 44, 45, 48, 46, 47, 43] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: 'thrustLeft_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [48, 49, 50, 51, 52, 53, 48] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: 'thrustDown_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [54, 55, 56, 57, 58, 59, 54] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: 'thrustRight_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [60, 61, 62, 63, 64, 65, 60] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: 'hurt_' + entity,
            frames: anims.generateFrameNumbers(entity, { frames: [360, 361, 362, 363, 364, 365] }),
            frameRate: 12,
            repeat: 0
        });
    }
}

const createSwitchesAnims = (anims: Phaser.Animations.AnimationManager,
    entity,
    texture,
    switchType,
    repeat) => {

    let OnArr = [];
    let OffArr = [];

    if (switchType == 1) {
        OnArr = [0];
        OffArr = [1];
    }

    if (switchType == 2) {
        OnArr = [1];
        OffArr = [1, 4, 7, 10];
    }

    if (switchType == 3) {
        OnArr = [0, 1, 2, 3, 4, 5, 6, 7, 8];
        OffArr = [11];
    }

    if (switchType == 4) {
        OnArr = [0];
        OffArr = [0, 3, 6, 9];
    }

    if (switchType == 5) {
        OnArr = [0, 3, 6, 10];
        OffArr = [3];
    }

    if (switchType == 6) {
        OnArr = [0, 1, 2, 3, 4, 5];
        OffArr = [4];
    }

    if (switchType == 7) {
        OnArr = [0, 3, 6]
        OffArr = [6]
    }
   if (switchType == 8) {
        OnArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        OffArr = [11];
    }

    console.log('create ' + entity);
    OnArr = [0, 1, 2, 3, 4, 5, 6, 7, 8];
    OffArr = [11];
    anims.create({
        key: texture + 'On',
        frames: anims.generateFrameNumbers(entity, { frames: OnArr }),
        frameRate: 12,
        repeat: -1
    });

    anims.create({
        key: texture + 'Off',
        frames: anims.generateFrameNumbers(entity, { frames: OffArr }),
        frameRate: 12,
        repeat: -1
    });

}

export {
    createCharacterAnims,
    createSwitchesAnims
}
