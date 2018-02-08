var lines, markov, data1, data2, x = 160, y = 240, img, iterator ;
var myVoice = new p5.Speech(3); // new P5.Speech object
/*
 p5.midi.onInput= function() {
 console.log( this.event);
 var note = p5.midi.event[1];
 var velocity = p5.midi.event[2];
 //   console.log(note);
 //  console.log(velocity);
 }
 */
var listbutton; // button

function preload() {
    data1 = loadStrings('/texts/stocker.txt');
    // data2 = loadStrings('kafka.txt');
    data2 = loadStrings('/texts/stocker.txt');
    // img = loadImage("sito/000-f.jpg");
}

function setup() {
    // listbutton = createButton('List Voices');
    // listbutton.position(180, 430);
    // listbutton.mousePressed(doList);
    // say hello:

    var world = createCanvas(330, 200);
    world.parent('world');
    //world.position(300, 50);
    textFont('times', 22);
    textAlign(LEFT);
    drums  = EDrums('x*o*x*o-')
    follow = Follow( drums )

    // lines = ["click to (re)generate!"];

    slider = createSlider(0,10,0);
    slider.parent('world');
    slider.position(340, 50);
    var text2 = createDiv('Volume');
    text2.parent('world');
    text2.position(340, 20);
    // create a markov model w' n=4
    markov = new RiMarkov(4);
    // image(img, 0, 0);
    // load text into the model
    markov.loadText(data1.join(' '));
    markov.loadText(data2.join(' '));
    drawText();

    //myVoice.listVoices(); // debug printer for voice options
    //myVoice.setVoice(myVoice.listVoices()[4]);
    // textSize(72);
    //    textAlign(CENTER);
    //  text("click me", width/2, height/2);
    // button:
    // myVoice.speak( markov.generateSentences(10));

    sampler = Sampler().record( drums, 1 )
        .note.seq( [.25,.5,1,2].rnd(), [1/4,1/8,1/2].rnd() )
        .fx.add( Delay(1/64))
        .pan.seq( Rndf(-1,1) );

    bass = Mono('bass')
        .note.seq( [0,7], 1/8 );
    Gibber.scale.root.seq( ['c4','eb4'], 1 );


    sampler.amp(0);
    //drums.stop();
    drums.amp(0);
    bass.amp(0);


    follow = Follow( Gibber.Master, 1024 );
    //    p5.midi.init();
    //fader(1000, 0);
}
function drawText() {
    //  img = loadImage("sito/001-f.jpg");
    background(250);
    lines = markov.generateSentences(2);
    //text(lines.join(' '), x, y, 330, 200);
    // image(img, 0, 0);
    //  myVoice.speak(lines.join(' '));

}
function mousePressed()
{
    // if in bounds:
    if(mouseX<width && mouseY<height) {
        ellipse(mouseX, mouseY, 50, 50); // circle
        // randomize voice and speak word:
        // myVoice.setVoice(myVoice.listVoices()[4]);
        //   myVoice.speak(words[iptr]);
        // iptr = (iptr+1) % words.length; // increment
    }
}

function mouseClicked() {
    // if in bounds:
    if(mouseX<width && mouseY<height) {
        ellipse(mouseX, mouseY, 50, 50); // circle
        // randomize voice and speak word:
        // myVoice.setVoice('Google UK English Male');
        // myVoice.speak(words[iptr]);
        // myVoice.speak( markov.generateSentences(10));
        // +3iptr = (iptr+1) % words.length; // increment
        x = y = 50;
        //sampler.kill();
        //drums.stop();
        drums.amp(0);
        //bass.kill();
        // drawText();
    }
}

function onInput(event){
    console.log(event);
}

function draw() {
    var val = slider.value();
    sampler.amp(val);
    //drums.stop();
    drums.amp(val);
    bass.amp(val);
    background(follow.getValue() * 5)
    iterator++;
    // console.log ('hi');
    if (iterator == 60) {

        iterator = 0;
        //  image(img, 0, 0);
    }
    if (mouseIsPressed) {
        //  image(img, 0, 0);
        //   myVoice.speak( markov.generateSentences(10));

    }
    var x = mouseX / windowWidth,
        y = mouseY / windowHeight,
        ww2 = windowWidth / 2,
        wh2 = windowHeight / 2,
        value = follow.getValue(),
        radius = ( ww2 > wh2 ? wh2 : ww2 ) * value
    //bass.resonance = (1 - x) * 5
    //bass.cutoff = (1 - y) / 2
    // sampler.fx[0].feedback = x < .99 ? x : .99
    strokeWeight(value * 50)
    background(64, 64, 64, 10)
    ellipse(ww2, wh2, radius, radius)
    ellipse(width/2, height/2, 100, 100);
    ellipse(width/4, height/2, 50, 50);
}

function doList()
{
    myVoice.listVoices(); // debug printer for voice options
}
function keyPressed()
{
    background(255, 0, 0); // clear screen
}
function fader(_time, endLevel, startLevel) {

    if(isNaN( startLevel )){
        startLevel = this.amp.value
    }

    var time = Audio.Clock.time( _time ),
        decay = new Audio.Core.ExponentialDecay({ decayCoefficient:.0005,
            length:time }),
        //ramp = Mul( decay, this.amp() )
        line = new Audio.Core.Line( startLevel, endLevel, Audio.Clock.time(
            time ) )

    this.amp( line )

    future( function() { this.amp = endLevel }.bind( this ), time )

    return this
}
