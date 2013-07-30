<?php ?>

<script type ="text/javascript">


var JS_SNAKE = {};


JS_SNAKE.equalCoordinates = function (coord1, coord2) {
  return coord1[0] === coord2[0] && coord1[1] === coord2[1];
}

JS_SNAKE.checkCoordinateInArray = function (coord, arr) {
  var isInArray = false;
  $.each(arr, function (index, item) {
    if (JS_SNAKE.equalCoordinates(coord, item)) {
      isInArray = true;
    }
  });
  return isInArray;
};

JS_SNAKE.game = (function () {
  var canvas, ctx;
  var frameLength;
  var snake;
  var apple;
  var score;
  var timeout;
  JS_SNAKE.width = 200;
  JS_SNAKE.height = 200;
  JS_SNAKE.blockSize = 10;
  JS_SNAKE.widthInBlocks = JS_SNAKE.width / JS_SNAKE.blockSize;
  JS_SNAKE.heightInBlocks = JS_SNAKE.height / JS_SNAKE.blockSize;

  function init() {
    var $canvas = $('#jsSnake');
    if ($canvas.length === 0) {
      $('body').append('<canvas id="jsSnake">');
    }
    $canvas = $('#jsSnake');
    $canvas.attr('width', JS_SNAKE.width);
    $canvas.attr('height', JS_SNAKE.height);
    canvas = $canvas[0];
    ctx = canvas.getContext('2d');
    score = 0;
    frameLength = 500;
    snake = JS_SNAKE.snake();
    apple = JS_SNAKE.apple();
    bindEvents();
    gameLoop();
  }

  function gameLoop() {
    ctx.clearRect(0, 0, JS_SNAKE.width, JS_SNAKE.height);
    snake.advance(apple);
    draw();

    if (snake.checkCollision()) {
      snake.retreat(); //move snake back to previous position
      snake.draw(ctx); //draw snake in its previous position
      gameOver();
    }
    else {
      timeout = setTimeout(gameLoop, frameLength);
    }
  }

  function draw() {
    snake.draw(ctx);
    drawBorder();
    apple.draw(ctx);
    drawScore();
  }

  function drawScore() {
    ctx.save();
    ctx.font = 'bold 102px sans-serif';
    ctx.fillStyle = 'rgba(0, 0, 0, 0.3)';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    var centreX = JS_SNAKE.width / 2;
    var centreY = JS_SNAKE.width / 2;
    ctx.fillText(score.toString(), centreX, centreY);
    ctx.restore();
  }

  function gameOver() {
    ctx.save();
    ctx.font = 'bold 30px sans-serif';
    ctx.fillStyle = '#000';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.strokeStyle = 'white';
    ctx.lineWidth = 2;
    var centreX = JS_SNAKE.width / 2;
    var centreY = JS_SNAKE.width / 2;
    ctx.strokeText('Game Over', centreX, centreY - 10);
    ctx.fillText('Game Over', centreX, centreY - 10);
    ctx.font = 'bold 15px sans-serif';
    ctx.strokeText('Press space to restart', centreX, centreY + 15);
    ctx.fillText('Press space to restart', centreX, centreY + 15);
    ctx.restore();
  }

  function drawBorder() {
    ctx.save();
    ctx.strokeStyle = 'gray';
    ctx.lineWidth = JS_SNAKE.blockSize;
    ctx.lineCap = 'square';
    var offset = ctx.lineWidth / 2;
    var corners = [
      [offset, offset],
      [JS_SNAKE.width - offset, offset],
      [JS_SNAKE.width - offset, JS_SNAKE.height - offset],
      [offset, JS_SNAKE.height - offset]
    ];
    ctx.beginPath();
    ctx.moveTo(corners[3][0], corners[3][1]);
    $.each(corners, function (index, corner) {
      ctx.lineTo(corner[0], corner[1]);
    });
    ctx.stroke();
    ctx.restore();
  }

  function restart() {
    clearTimeout(timeout);
    $('body').unbind('keydown');
    $(JS_SNAKE).unbind('appleEaten');
    $(canvas).unbind('click');
    JS_SNAKE.game.init();
  }
  
  function bindEvents() {
    var keysToDirections = {
      37: 'left',
      38: 'up',
      39: 'right',
      40: 'down'
    };

    $(document).keydown(function (event) {
      var key = event.which;
      var direction = keysToDirections[key];

      if (direction) {
        snake.setDirection(direction);
        event.preventDefault();
      }
      else if (key === 32) {
        restart();
      }
    });

    $(JS_SNAKE).bind('appleEaten', function (event, snakePositions) {
      apple.setNewPosition(snakePositions);
      score++;
      frameLength *= 0.99; //subtle speed-up
    });

    $(canvas).click(restart);
  }

  return {
    init: init
  };
})();

JS_SNAKE.apple = function () {
  var position = [6, 6];

  function draw(ctx) {
    ctx.save();
    ctx.fillStyle = '#0a0'; //apple green
    ctx.beginPath();
    var radius = JS_SNAKE.blockSize / 2;
    var x = position[0] * JS_SNAKE.blockSize + radius;
    var y = position[1] * JS_SNAKE.blockSize + radius;
    ctx.arc(x, y, radius, 0, Math.PI * 2, true);
    ctx.fill();
    ctx.restore();
  }

  function random(low, high) {
    return Math.floor(Math.random() * (high - low + 1) + low);
  }

  //get a random position within the game bounds
  function getRandomPosition() {
    var x = random(1, JS_SNAKE.widthInBlocks - 2);
    var y = random(1, JS_SNAKE.heightInBlocks - 2);
    return [x, y];
  }

  function setNewPosition(snakeArray) {
    var newPosition = getRandomPosition();
    //if new position is already covered by the snake, try again
    if (JS_SNAKE.checkCoordinateInArray(newPosition, snakeArray)) {
      return setNewPosition(snakeArray);
    }
    //otherwise set position to the new position
    else {
      position = newPosition;
    }
  }

  function getPosition() {
    return position;
  }

  return {
    draw: draw,
    setNewPosition: setNewPosition,
    getPosition: getPosition
  };
};

JS_SNAKE.snake = function () {
  var previousPosArray;
  var posArray = [];
  posArray.push([6, 4]);
  posArray.push([5, 4]);
  var direction = 'right';
  var nextDirection = direction;

  function setDirection(newDirection) {
    var allowedDirections;

    switch (direction) {
    case 'left':
    case 'right':
      allowedDirections = ['up', 'down'];
      break;
    case 'up':
    case 'down':
      allowedDirections = ['left', 'right'];
      break;
    default:
      throw('Invalid direction');
    }
    if (allowedDirections.indexOf(newDirection) > -1) {
      nextDirection = newDirection;
    }
  }

  function drawSection(ctx, position) {
    var x = JS_SNAKE.blockSize * position[0];
    var y = JS_SNAKE.blockSize * position[1];
    ctx.fillRect(x, y, JS_SNAKE.blockSize, JS_SNAKE.blockSize);
  }

  function draw(ctx) {
    ctx.save();
    ctx.fillStyle = '#33a';
    for(var i = 0; i < posArray.length; i++) {
      drawSection(ctx, posArray[i]);
    }
    ctx.restore();
  }

  function checkCollision() {
    var wallCollision = false;
    var snakeCollision = false;
    var head = posArray[0]; //just the head
    var rest = posArray.slice(1); //the rest of the snake
    var snakeX = head[0];
    var snakeY = head[1];
    var minX = 1;
    var minY = 1;
    var maxX = JS_SNAKE.widthInBlocks - 1;
    var maxY = JS_SNAKE.heightInBlocks - 1;
    var outsideHorizontalBounds = snakeX < minX || snakeX >= maxX;
    var outsideVerticalBounds = snakeY < minY || snakeY >= maxY;

    if (outsideHorizontalBounds || outsideVerticalBounds) {
      wallCollision = true;
    }
    //check if the snake head coords overlap the rest of the snake
    snakeCollision = JS_SNAKE.checkCoordinateInArray(head, rest);
    return wallCollision || snakeCollision;
  }

  function advance(apple) {
    //make a copy of the head of the snake otherwise
    //the changes below would affect the head of the snake
    var nextPosition = posArray[0].slice();
    direction = nextDirection;
    switch (direction) {
    case 'left':
      nextPosition[0] -= 1;
      break;
    case 'up':
      nextPosition[1] -= 1;
      break;
    case 'right':
      nextPosition[0] += 1;
      break;
    case 'down':
      nextPosition[1] += 1;
      break;
    default:
      throw('Invalid direction');
    }

    previousPosArray = posArray.slice(); //save previous array
    posArray.unshift(nextPosition);
    if (isEatingApple(posArray[0], apple)) {
      $(JS_SNAKE).trigger('appleEaten', [posArray]);
    }
    else {
      posArray.pop();
    }
  }

  function isEatingApple(head, apple) {
    return JS_SNAKE.equalCoordinates(head, apple.getPosition());
  }

  function retreat() {
    posArray = previousPosArray;
  }

  return {
    draw: draw,
    advance: advance,
    retreat: retreat,
    setDirection: setDirection,
    checkCollision: checkCollision
  };
};


JS_SNAKE.game.init();
</script>
