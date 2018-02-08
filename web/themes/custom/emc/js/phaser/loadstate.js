game.state.add('login', playState[3]);
game.state.add('next', playState[3]);
game.state.add('terminal', playState[2]);
getGrid();
//All parameters are optional but you usually want to set width and height
//Remember that the game object inherits many properties and methods!

//////////////////////////////

if (grid==1){

}
else {
    var conn = new autobahn.Session('ws://www.eclecticmeme.com:8080', function () {
            conn.subscribe('monstersCategory', function (topic, data) {
                data.article.forEach(function (articleObj) {
                    var incomingId = articleObj.id;
                    monsters_list.forEach(function (monsterObj, index) {
                        if (monsterObj.id == incomingId) {
                            monsterObj.x = parseInt(articleObj.x);
                            monsterObj.y = parseInt(articleObj.y);
                            if (monsters[incomingId] !== undefined) {

                                //   console.log('moved');
                                game.physics.arcade.moveToXY(monsters[incomingId], parseInt(monsterObj.x), parseInt(monsterObj.y), 100);
                            }
                        }
                    });
                });
            });
            conn.subscribe('monsterHealthCategory', function (topic, data) {
                //    console.log(data);
            });

            conn.subscribe('halflingsCategory', function (topic, data) {
                data.article.forEach(function (articleObj) {
                    var incomingId = articleObj.id;
                    halfling_list.forEach(function (halflingObj, index) {
                        if (halflingObj.id == incomingId) {
                            halflingObj.x = parseInt(articleObj.x);
                            halflingObj.y = parseInt(articleObj.y);
                            if (halflings[incomingId] !== undefined) {
                                game.physics.arcade.moveToXY(halflings[incomingId], parseInt(halflingObj.x), parseInt(halflingObj.y), 100);
                            }
                        }
                    });
                });
            });
            conn.subscribe('playersCategory', function (topic, data) {
                for (var iterate = 0; iterate <= data.article.length - 1; iterate++) {
                    var incomingId = data.article[iterate].id;
                    players_list.forEach(function (playerObj, index) {
                        if (playerObj.id == incomingId) {
                            playerObj.posx = parseInt(data.article[iterate].posx);
                            playerObj.posy = parseInt(data.article[iterate].posy);
                            players[incomingId].body.velocity.x = 1000;
                            players[incomingId].body.velocity.y = 1000;
                            game.physics.arcade.moveToXY(players[incomingId], parseInt(playerObj.posx), parseInt(playerObj.posy), 100);
                        }
                    });
                }
                ;
            });
        },

        function () {
            console.warn('WebSocket connection closed');
        },
        {'skipSubprotocolCheck': true}
    );
///
    jQuery('#world').focus().blur(function () {
        jQuery('#world').focus();
    })
}
