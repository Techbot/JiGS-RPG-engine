import Phaser from "phaser";

export class Message extends Phaser.Scene {




    constructor() {
        super({ key: "Message" });
    }

    image;
    preload() {
        this.load.plugin('rextextplayerplugin', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/dist/rextextplayerplugin.min.js', true);

        this.load.image('dude', 'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/images/phaser-dude.png');
        this.load.audio('explosion', [
            'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/audio/soundeffect/explosion.mp3'
        ]);
        this.load.audio('theme0', [
            'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/audio/oedipus_wizball_highscore.ogg',
            'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/audio/oedipus_wizball_highscore.mp3'
        ]);
        this.load.audio('theme1', [
            'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/audio/jungle.ogg',
            'https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/assets/audio/jungle.mp3'
        ]);
    }

    create() {
        var content = `\
[custom=10,20][/custom][bgm=theme0][color=#FFF8DC][b][space=30]Pha[shadow]ser[/b][/shadow] [img=dude] is a [i][stroke]fa[stroke=red]st[/stroke][/i],
[se=explosion][wait=se][size=24][shadow=yellow]free[/shadow][/size], a[y=-8]n[y=-16]d[/y] f[wait=1000]un
[bgm.pause][click][/bgm.pause][color=green]open[/color] source HTML5 game framework[r][bgm=theme1]

[color=#008B8B][wait=enter|click]that offers WebGL and Canvas [wait=custom]rendering across desktop and mobile web browsers[r]
[color=#FF7F50][speed=0][align=left]Games can be compiled to iOS, Android and native apps by using 3rd party tools[r]
[color=#F8F8FF][align=center]You can use JavaScript or TypeScript for development.`;


        const helloButton = this.add.text(100, 100, 'Hello Phaser!', { fill: '#0f0' });
        helloButton.setInteractive();
        helloButton.on('pointerover', () => { this.scene.stop(); });

        var Cubic = Phaser.Math.Easing.Cubic.Out;
        var Linear = Phaser.Math.Linear;
        var text = this.add.rexTextPlayer(
            {
                x: 400, y: 300,
                width: 400, height: 200,  // Fixed width and height

                background: {
                    stroke: 'white',
                    cornerRadius: -20,  // 20
                },

                innerBounds: {
                    stroke: '#A52A2A'
                },

                padding: 20,

                style: {
                    fontSize: '16px',
                    stroke: 'green',
                    strokeThickness: 3,

                    shadowColor: 'red',
                    shadowOffsetX: 5,
                    shadowOffsetY: 5,
                    shadowBlur: 3
                },

                wrap: {
                    maxLines: 5,
                    padding: { bottom: 10 },
                },

                typing: {
                    speed: 200,  // 0: no-typing
                    animation: {
                        duration: 1000,
                        yoyo: true,
                        onStart: function (char) {
                            char
                                .setVisible()
                                .setData('y', char.y);
                        },
                        onProgress: function (char, t) {
                            var p0 = char.getData('y');
                            var p1 = p0 - 20;
                            var value = Linear(p0, p1, Cubic(t));
                            char.setY(value);
                        }
                    },

                    // minSizeEnable: true
                },

                images: {
                    'dude': {
                        height: 24
                    }
                },

                sounds: {
                    bgm: {
                        loop: true,
                        fade: 1000
                    }
                },

                clickTarget: this,
                nextPageInput: 'click|2000'
                // nextPageInput: function(callback) {
                //     console.log('Custom next-page-input')
                //     callback();
                // }

            }
        )
        // .setToMinSize()

        var print = this.add.text(0, 580, 'Click to start');

            text.playPromise(content)
                .then(function () {
                    console.log('Play complete');

                })

            // text.showPage();  // Show all characters in this page


        // Parse custom tag, execute custom tag
        text
            .on('parser.+custom', function (parser, a, b) {
                console.log('Parse +custom tag:', a, b)
            })
            .on('parser.-custom', function () {
                console.log('Parse -custom tag')
            })
            .on('tag.+custom', function (a, b) {
                console.log('Execute +custom tag:', a, b)
            })
            .on('tag.-custom', function () {
                console.log('Execute -custom tag')
            })

        // Events
        text
            .on('typing', function (child) {
                if (child.type === 'text') {
                    print.setText(`Typing ${child.text}`);
                } else {
                    print.setText(`Typing image ${child.key}`);
                }
            })
            .on('wait.click', function () {
                print.setText('Wait click');
            })
            .on('wait.keydown', function (keyName) {
                print.setText(`Wait ${keyName} keydown`);
            })
            .on('wait.time', function (time) {
                print.setText(`Wait time ${time}`);
            })
            .on('wait.music', function (music) {
                print.setText(`Wait music ${music.key}`);
            })
            .on('wait.custom', function (callback) {
                print.setText(`Wait custom`);
                callback();
            })
            .on('page.start', function () {
                console.log('page.start')
            })
            .on('page.complete', function () {
                this.scene.stop();
                console.log('page.complete')
            })

    }



    update() { }



}
