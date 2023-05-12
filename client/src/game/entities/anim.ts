/**
 * -------Anim ---------
 */

import Phaser from 'phaser'

const createCharacterAnims = (anims: Phaser.Animations.AnimationManager) => {

        anims.create({
            key: 'walkLeft',
            frames: anims.generateFrameNumbers('brawler', { frames: [117, 118, 119, 120, 121, 122, 123, 124, 125] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkRight',
            frames: anims.generateFrameNumbers('brawler', { frames: [143, 144, 145, 146, 147, 148, 149, 150, 151] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkUp',
            frames: anims.generateFrameNumbers('brawler', { frames: [104, 105, 106, 107, 108, 109, 110, 110, 112] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'walkDown',
            frames: anims.generateFrameNumbers('brawler', { frames: [130, 131, 132, 133, 134, 135, 136, 137, 138] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'stop',
            frames: anims.generateFrameNumbers('brawler', { frames: [130, 130, 130, 130, 130, 130, 130, 130, 138] }),
            frameRate: 12,
            repeat: -1
        });

        anims.create({
            key: 'kick',
            frames: anims.generateFrameNumbers('brawler', { frames: [10, 11, 12, 13, 10] }),
            frameRate: 12,
            repeat: -1,
            repeatDelay: 2000
        });

        }

export {
    createCharacterAnims
}
