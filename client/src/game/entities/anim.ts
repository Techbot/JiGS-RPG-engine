/**
 * ------- Anim ---------
 */

import Phaser from 'phaser'

const createCharacterAnims = (anims: Phaser.Animations.AnimationManager, entityType, npcSheet) => {

    if (entityType == 'player') {
        console.log('load player anims');

        walkAnim('rapier', 'rapier');
        walkAnim('glowsword', 'glowsword');
        walkAnim('axe', 'axe');

        hurtAnim('rapier', 'rapier');
        hurtAnim('glowsword', 'default')
        hurtAnim('axe', 'axe')

        spellAnim('default');


        slashAnim('axe', 'slash-oversize');
        slashAnim('rapier', 'slash-oversize');
        slashAnim('glowsword', 'slash-oversize');

        stopAnim('axe', 'axe');
        stopAnim('rapier', 'rapier');
        stopAnim('glowsword', 'glowsword');
    }

    ////////////////////////////////////// Walk Anim 4 Directions //////////////////////////////
    function walkAnim(weapon, type) {

        console.log(entityType + '-walk-' + type)

        anims.create({
            key: entityType + '-walkUp-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-walk-' + type, { frames: [0, 1, 2, 3, 4, 5, 6, 7, 8] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-walkLeft-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-walk-' + type, { frames: [9, 10, 11, 12, 13, 14, 15, 16, 17] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-walkDown-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-walk-' + type, { frames: [18, 19, 20, 21, 22, 23, 24, 25, 26] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-walkRight-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-walk-' + type, { frames: [27, 28, 29, 30, 31, 32, 33, 34, 35] }),
            frameRate: 12,
            repeat: -1
        });
    }

    ////////////////////////////////////// Stop Anim 1 Direction //////////////////////////////
    function stopAnim(weapon, type) {
        anims.create({
            key: entityType + '-stop-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-walk-' + type, { frames: [18, 18, 18, 18] }),
            frameRate: 12,
            repeat: -1
        });
    }
    ////////////////////////////////////// Spell Anim 4 Directions //////////////////////////////
    function spellAnim(weapon) {
        anims.create({
            key: entityType + '-spellUp-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-spell-' + weapon, { frames: [0, 1, 2, 3, 4, 5, 6] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-spellLeft-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-spell-' + weapon, { frames: [7, 8, 9, 10, 11, 12, 13] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-spellDown-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-spell-' + weapon, { frames: [14, 15, 16, 17, 18, 19, 20] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-spellRight-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-spell-' + weapon, { frames: [21, 22, 23, 24, 25, 26, 27] }),
            frameRate: 12,
            repeat: -1
        });
    }
    ////////////////////////////////////// Thrust Anim 4 Directions //////////////////////////////
    function thrustAnim(weapon, type) {
        anims.create({
            key: entityType + '-thrustUp-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-thrust-' + type, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-thrustLeft-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-thrust-' + type, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-thrustDown-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-thrust-' + type, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-thrustRight-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-thrust-' + type, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });
    }

    ////////////////////////////////////// Hurt Anim 1 Direction //////////////////////////////
    function hurtAnim(weapon, type) {
        anims.create({
            key: entityType + '-hurt-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-hurt-' + type, { frames: [0, 1, 2, 3, 4, 5] }),
            frameRate: 12,
            repeat: 0
        });
    }
    ////////////////////////////////////// Shoot Anim 4 Directions //////////////////////////////
    function shootAnim(weapon) {
        anims.create({
            key: entityType + '-shootUp-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-shoot-' + weapon, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-shootLeft-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-shoot-' + weapon, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-shootDown-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-shoot-' + weapon, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-shootRight-' + entityType,
            frames: anims.generateFrameNumbers(entityType + '-shoot-' + weapon, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });
    }
    ////////////////////////////////////////////////////////////////////////////////////
    function slashAnim(weapon, type) {
        console.log(entityType + '-slash-' + weapon)
        anims.create({
            key: entityType + '-slashUp-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-' + type + '-' + weapon, { frames: [0, 1, 2, 3, 4, 5, 0] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: entityType + '-slashLeft-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-' + type + '-' + weapon, { frames: [6, 7, 8, 9, 10, 11, 6] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: entityType + '-slashDown-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-' + type + '-' + weapon, { frames: [12, 13, 14, 15, 16, 17, 12] }),
            frameRate: 12,
            repeat: 0
        });

        anims.create({
            key: entityType + '-slashRight-' + weapon,
            frames: anims.generateFrameNumbers(entityType + '-' + type + '-' + weapon, { frames: [18, 19, 20, 21, 22, 23, 18] }),
            frameRate: 12,
            repeat: 0
        });
    }

    function toolWhipAnim(weapon) {
        anims.create({
            key: entityType + '-toolWhipUp_' + weapon,
            frames: anims.generateFrameNumbers(entityType, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-toolWhipLeft_' + weapon,
            frames: anims.generateFrameNumbers(entityType, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-toolWhipDown_' + weapon,
            frames: anims.generateFrameNumbers(entityType, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: entityType + '-toolWhipRight_' + weapon,
            frames: anims.generateFrameNumbers(entityType, { frames: [0] }),
            frameRate: 12,
            repeat: -1
        });
    }



///////////////////////////////////////////////////////////////////////
/*
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
        }); */
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
        OnArr = [0, 1, 2, 3, 4, 5, 6, 7, 8];
        OffArr = [11];
    }

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
