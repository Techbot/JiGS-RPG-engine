function setup() {
   createCanvas(640, 480);
}

function draw2() {
   if (mouseIsPressed) {
      fill(0);
   } else {
      fill(255);
   }
   ellipse(mouseX, mouseY, 80, 80);
}

function draw() {
   float
   x = cos(angle) * random(amp + 20, amp + 80);
   float
   y = sin(angle) * amp / 2;


   noStroke();
   translate(random(width / 2 - 50, width / 2 + 50), height / 2);
   rotate(random(0, 100));

   fill(random(150, 250), random(0, 100), random(0, 100));
   rect(x, y, 25, 2);
   fill(random(0, 150), random(100, 200), random(0, 150));
   rect(x + 100, y, 1, 20);
   fill(random(0, 150), random(0, 150), random(150, 250));
   rect(x - 100, y, 7, 7);
   noFill();
   stroke(255, 100);
   float
   z = x * (random(2, 6));
   float
   q = y * 2;
   ellipse(0, 0, z, q);
   float
   b = sin(angle) * 200 / 2;
   float
   c = sin(angle) * 200 / 2;
   fill(255, 30);
   ellipse(b, c, b / 3, c / 3);

   angle = angle + 0.5;

}