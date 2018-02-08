'use strict';

$(function() {
    $('a.color-source').click(function(event) {
        event.preventDefault();
        $('a.color-source').removeClass('active');
        $(this).addClass('active');
        updateSource($(this).index() + 1);
    });
    $('.preset').click(function(event) {
        event.preventDefault();
        choosePreset($(this).index());
    });
});

var lines = [];
var colors = [];
var src, canvas, art;
var ui = {};

function choosePreset(id) {
    switch (id) {
        case 0:
            ui.numberOfLines.value(100);
            ui.easing.value(0.25);
            ui.easingJitter.value(0.1);
            ui.speed.value(0.3);
            ui.speedJitter.value(0.1);
            ui.vertices.value(8);
            ui.verticesJitter.value(1);
            break;
        case 1:
            ui.numberOfLines.value(11);
            ui.easing.value(0.1);
            ui.easingJitter.value(0);
            ui.speed.value(0.1);
            ui.speedJitter.value(0);
            ui.vertices.value(30);
            ui.verticesJitter.value(1);
            break;
        case 2:
            ui.numberOfLines.value(10);
            ui.easing.value(0.67);
            ui.easingJitter.value(0);
            ui.speed.value(0.18);
            ui.speedJitter.value(0.1);
            ui.vertices.value(25);
            ui.verticesJitter.value(4);
            break;
        case 3:
            ui.numberOfLines.value(25);
            ui.easing.value(0.42);
            ui.easingJitter.value(0.1);
            ui.speed.value(0.45);
            ui.speedJitter.value(0.02);
            ui.vertices.value(8);
            ui.verticesJitter.value(1);
            break;
        case 4:
            ui.numberOfLines.value(200);
            ui.easing.value(0.28);
            ui.easingJitter.value(0.19);
            ui.speed.value(0.12);
            ui.speedJitter.value(0.47);
            ui.vertices.value(11);
            ui.verticesJitter.value(2);
            break;
    }
}

function setup() {
    background(0);
    updateSource(1);
    canvas = createCanvas(975, 700);
    canvas.parent('neobrush');

    art = createGraphics(canvas.width, canvas.height);
    art.background(0);

    ui.numberOfLines = getElement('number-of-lines');
    ui.easing = getElement('easing');
    ui.easingJitter = getElement('easing-jitter');
    ui.speed = getElement('speed');
    ui.speedJitter = getElement('speed-jitter');
    ui.vertices = getElement('vertices');
    ui.verticesJitter = getElement('vertices-jitter');
    ui.clear = getElement('clear');
    ui.clear.mousePressed(clearme);
    ui.save = getElement('save');
    ui.save.mousePressed(saveme);

    ui.preset = getElement('save-preset');
}

function draw() {
    background(0);
    for (var i = 0; i < lines.length; i++) {
        lines[i].update();
        lines[i].render();
    }
    image(art, 0, 0, canvas.width, canvas.height);
}

function updateSource(index) {
    colors = [];
    src = loadImage('img/source-' + index + '.jpg', function(img) {
        for (var x = 0; x < src.width; x++) {
            for (var y = 0; y < src.height; y++) {
                colors.push(img.get(x, y));
            }
        }
    });
}

function mousePressed() {
    for (var i = 0; i < ui.numberOfLines.value(); i++) {
        var easing = ui.easing.value() + random(-ui.easingJitter.value(), ui.easingJitter.value());
        var speed = ui.speed.value() + random(-ui.speedJitter.value(), ui.speedJitter.value());
        var vertices = ui.vertices.value() + random(-ui.verticesJitter.value(), ui.verticesJitter.value());
        var line = new SketchLine(vertices, easing, speed, colors);
        lines.push(line);
    }
}

function mouseReleased() {
    lines = [];
}

function clearme() {
    art.background(0);
}

function saveme() {
    art.get().save('png');
}
