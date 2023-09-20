
import { Scene } from 'phaser'
import { useJigsStore } from '../../stores/jigs'

export class HudScene extends Scene {
    jigs: any;
    score: number;
    x: string;
    y: string;
    add: any;
    scene: any;
    hud2: any;
    hud3: any;
    hud4: any;
    hud5: any;
    hud11: any;
    hud12: any;
    hud6: any;
    hud7: any;
    hud8: any;
    hud9: any;
    hud10: any;
    credits: any;
    content: string;
    thing: any;

    constructor() {
        super({ key: 'HudScene', active: true });
        this.jigs = useJigsStore();
        this.content = `Phaser is a fast, free, and fun open source HTML5 game framework that offers WebGL and Canvas rendering across desktop and mobile web browsers. Games can be compiled to iOS, Android and native apps by using 3rd party tools. You can use JavaScript or TypeScript for development.`;

        this.credits = this.jigs.playerStats.credits;
        const COLOR_PRIMARY = 0x4e342e;
        const COLOR_LIGHT = 0x7b5e57;
        const COLOR_DARK = 0x260e04;
    }
    preload() {
        this.load.image('nextPage', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/images/arrow-down-left.png');
        this.load.script('webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
        this.load.image('cursor', '/assets/images/cursors/blank.cur');
        this.load.image('cursor2', '/assets/images/cursors/attack.cur');
        this.load.image('cursor3', '/assets/images/cursors/speak.cur');
        this.load.image('cursor4', '/assets/images/cursors/blank.cur');
        this.load.image('cursor4', '/assets/images/cursors/point.cur');
    }
    create() {

        this.thing = this.createTextBox(this, 10, 380, {
            wrapWidth: 500,
        }).start(this.jigs.content, 50).setDepth(7);


        var r1 = this.add.rectangle(80, 60, 260, 100, 0x6666ff).setBlendMode(Phaser.BlendModes.MULTIPLY);
        var r2 = this.add.rectangle(560, 60, 260, 100, 0x6666ff).setBlendMode(Phaser.BlendModes.MULTIPLY);

        //  Our Text object to display the Score
        let info = this.add.text(10, 10, 'Credits: ', { font: '12px Arial', fill: '#ffffff' });

        //  Grab a reference to the Game Scene
        let ourGame = this.scene.get('main');
        //  Listen for events from it

        ourGame.events.on('addScore', function () {
            this.score += 10;
        }, this);

        ourGame.events.on('content', function () {
            this.thing.destroy();
            this.thing = this.createTextBox(this, 10, 380, {
                wrapWidth: 500,
            }).start(this.jigs.content, 50).setDepth(7)


        }, this);

        ourGame.events.on('position', function (x: number, y: number) {
            this.x = x;
            this.y = y;
            info.setText('Credits: ' + this.jigs.playerStats.credits);

        }, this);

        // this.hud1 = this.add.text(10, 16, '', { fontSize: '24px', fill: '#111111' });
        this.hud2 = this.add.text(10, 28, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud3 = this.add.text(10, 46, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud4 = this.add.text(10, 66, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud5 = this.add.text(10, 86, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud11 = this.add.text(10, 106, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud12 = this.add.text(10, 126, '', { font: '12px Arial', fill: '#ffffff' });

        this.hud6 = this.add.text(460, 28, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud7 = this.add.text(460, 46, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud8 = this.add.text(460, 66, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud9 = this.add.text(460, 86, '', { font: '12px Arial', fill: '#ffffff' });
        this.hud10 = this.add.text(460, 106, '', { font: '12px Arial', fill: '#ffffff' });

    }
    update() {
        // this.hud1.setText('Blue: ' +  this.jigs.Blobby);
        this.hud2.setText('State: ' + this.jigs.gameState);
        this.hud3.setText('Node: ' + this.jigs.userMapGrid);
        this.hud4.setText('TileMap: ' + this.jigs.tiled);
        this.hud5.setText('Title: ' + this.jigs.nodeTitle);
        this.hud6.setText('X: ' + this.x + 'Y: ' + this.y);

        if (this.jigs.portalsArray[0]) {
            this.hud7.setText('P1 X: ' + this.jigs.portalsArray[0].x + 'P1 Y: ' + this.jigs.portalsArray[0].y);
        }

        if (this.jigs.portalsArray[1]) {
            this.hud8.setText('P2 X: ' + this.jigs.portalsArray[1].x + 'P2 Y: ' + this.jigs.portalsArray[1].y);
        }

        if (this.jigs.portalsArray[2]) {
            this.hud9.setText('P3 X: ' + this.jigs.portalsArray[2].x + 'P3 Y: ' + this.jigs.portalsArray[2].y);
        }

        this.hud10.setText('City: ' + this.jigs.city);
        this.hud11.setText('Name: ' + this.jigs.playerName);
        this.hud12.setText('Id: ' + this.jigs.playerId);
    }


    GetValue = Phaser.Utils.Objects.GetValue;

    createTextBox = function (scene, x, y, config) {
        var wrapWidth = this.GetValue(config, 'wrapWidth', 0);
        var fixedWidth = this.GetValue(config, 'fixedWidth', 0);
        var fixedHeight = this.GetValue(config, 'fixedHeight', 0);
        var titleText = this.GetValue(config, 'title', undefined);


        var textBox = scene.rexUI.add.textBox({
            x: x,
            y: y,

            background: scene.rexUI.add.roundRectangle({ radius: 20, color: this.COLOR_PRIMARY, strokeColor: this.COLOR_LIGHT, strokeWidth: 2 }),

            icon: scene.rexUI.add.roundRectangle({ radius: 20, color: this.COLOR_DARK }),

            // text: getBuiltInText(scene, wrapWidth, fixedWidth, fixedHeight),
            text: this.getBBcodeText(scene, wrapWidth, fixedWidth, fixedHeight),

            action: scene.add.image(0, 0, 'nextPage').setTint(this.COLOR_LIGHT).setVisible(false),

            title: (titleText) ? scene.add.text(0, 0, titleText, { fontSize: '24px', }) : undefined,

            separator: (titleText) ? scene.rexUI.add.roundRectangle({ height: 3, color: this.COLOR_DARK }) : undefined,

            space: {
                left: 20, right: 20, top: 20, bottom: 20,

                icon: 10, text: 10,

                separator: 6,
            },

            align: {
                title: 'center'
            }
        })
            .setOrigin(0)
            .layout();

        textBox
            .setInteractive()
            .on('pointerdown', function () {
                var icon = this.getElement('action').setVisible(false);
                this.resetChildVisibleState(icon);
                if (this.isTyping) {
                    this.stop(true);
                } else if (!this.isLastPage) {
                    this.typeNextPage();
                } else {
                    textBox.destroy();
                }
            }, textBox)
            .on('pageend', function () {
                if (this.isLastPage) {
                    return;
                }

                var icon = this.getElement('action').setVisible(true);
                this.resetChildVisibleState(icon);
                icon.y -= 30;
                var tween = scene.tweens.add({
                    targets: icon,
                    y: '+=30', // '+=100'
                    ease: 'Bounce', // 'Cubic', 'Elastic', 'Bounce', 'Back'
                    duration: 500,
                    repeat: 0, // -1: infinity
                    yoyo: false
                });
            }, textBox)
            .on('complete', function () {
                console.log('all pages typing complete')
            })
        //.on('type', function () {
        //})

        return textBox;
    }

    getBuiltInText = function (scene, wrapWidth, fixedWidth, fixedHeight) {
        return scene.add.text(0, 0, '', {
            fontSize: '20px',
            wordWrap: {
                width: wrapWidth
            },
            maxLines: 3
        })
            .setFixedSize(fixedWidth, fixedHeight);
    }

    getBBcodeText = function (scene, wrapWidth, fixedWidth, fixedHeight) {
        return scene.rexUI.add.BBCodeText(0, 0, '', {
            fixedWidth: fixedWidth,
            fixedHeight: fixedHeight,

            fontSize: '20px',
            wrap: {
                mode: 'word',
                width: wrapWidth
            },
            maxLines: 3
        })
    }

    CreateDialog = function (scene, content) {
        return scene.rexUI.add.textArea({
            x: 400,
            y: 300,
            width: 300,
            height: 400,

            background: scene.rexUI.add.roundRectangle({
                color: this.COLOR_PRIMARY,
                radius: 20
            }),

            // text: scene.add.text(),
            text: scene.rexUI.add.BBCodeText(),
            // textMask: true,

            slider: {
                track: scene.rexUI.add.roundRectangle(0, 0, 20, 10, 10, this.COLOR_DARK),
                thumb: scene.rexUI.add.roundRectangle(0, 0, 0, 0, 13, this.COLOR_LIGHT),
            },

            space: {
                left: 20, right: 20, top: 20, bottom: 20,

                text: 10,
                // text: {
                //     top: 20,
                //     bottom: 20,
                //     left: 20,
                //     right: 20,
                // },
                header: 20,
                footer: 20,
            },

            scroller: {
                // pointerOutRelease: false,
            },

            mouseWheelScroller: {
                focus: false,
                speed: 0.1
            },

            header: scene.rexUI.add.label({
                space: { left: 10, right: 10, top: 10, bottom: 10 },

                orientation: 0,
                background: scene.rexUI.add.roundRectangle(0, 0, 20, 20, 0, this.COLOR_DARK),
                text: scene.add.text(0, 0, 'Title'),
            }),

            footer: scene.rexUI.add.label({
                space: { left: 10, right: 10, top: 10, bottom: 10 },

                orientation: 0,
                background: scene.rexUI.add.roundRectangle({
                    radius: 10,
                    color: this.COLOR_DARK,
                    strokeColor: this.COLOR_LIGHT
                }),
                text: scene.add.text(0, 0, 'Close'),
            }).onClick(function (button, gameObject, pointer, event) {
                gameObject.getTopmostSizer().modalClose();
            }),

            content: this.jigs.content,

            expand: {
                footer: false
            }
        })
    }

    CreateContent = function (linesCount) {
        var numbers = [];
        for (var i = 0; i < linesCount; i++) {
            numbers.push('[color=' + ((i % 2) ? 'green' : 'yellow') + ']' + i.toString() + '[/color]');
        }
        return this.jigs.content + '\n' + numbers.join('\n');
    }
}
