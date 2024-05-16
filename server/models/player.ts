var mysql = require("mysql2");
import config from '../services/db';

var con = mysql.createPool({
  connectionLimit: 10,
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

function getPlayer(player) {
  return new Promise(function (resolve, reject) {
    con.query(
      `SELECT
      users_field_data.name,
      users_field_data.login,
      profile.profile_id,
      profile__field_x.field_x_value,
      profile__field_y.field_y_value,
      profile__field_health.field_health_value,
      profile__field_missions.field_missions_target_id as missions
      FROM users_field_data
      LEFT JOIN profile
      ON  profile.uid                     =  users_field_data.uid
      AND type                            = 'player'
      INNER JOIN profile__field_x
      ON  profile__field_x.entity_id      =  profile.profile_id
      INNER JOIN profile__field_y
      ON  profile__field_y.entity_id      =  profile.profile_id
      INNER JOIN profile__field_health
      ON  profile__field_health.entity_id =  profile.profile_id
      LEFT JOIN profile__field_missions
      ON profile__field_missions.entity_id = profile.profile_id
      WHERE  users_field_data.uid         = ` + player
      ,
      function (err, result) {
        if (err) throw err;
        resolve(result);
      }
    );
  })
}

function updateFlag(flag, player, key) {
  return new Promise(function (resolve, reject) {

    var http = require('https');
    var options = {
      host: 'localhost',
      port: 80,
      path: '/updateFlag?_wrapper_format=drupal_ajax&id=' + flag + 'id=' + player + 'key=' + key
    };
    var req = http.get(options, function (response) {
      // handle the response
      var res_data = '';
      response.on('data', function (chunk) {
        res_data += chunk;
      });
      response.on('end', function () {
        console.log(res_data);
      });
    });
    req.on('error', function (err) {
      console.log("Request error: " + err.message);
    });
  })
}

function updateMap(id, map) {

  con.query(
    `UPDATE profile__field_map_grid SET field_map_grid_target_id = ` +
    map + ` WHERE profile__field_map_grid.entity_id = ` + id,
    function (err, result, fields) {
      if (err) throw err;
      return true;
    }
  );
}

function updatePlayer(id, stat, value, replace) {
  console.log("stat:" + id);
  if (replace) {

    con.query(
      `UPDATE profile__field_` + stat +
      ` SET field_` + stat + `_value = ` + value +
      ` WHERE profile__field_` + stat + `.entity_id = ` + id,
      function (err, result, fields) {
        if (err) throw err;
        return true;
      }
    );

  } else {

    con.query(
      `UPDATE profile__field_` + stat +
      ` SET field_` + stat + `_value = field_` + stat + `_value + ` + value +
      ` WHERE profile__field_` + stat + `.entity_id = ` + id,
      function (err, result, fields) {
        if (err) throw err;
        return true;
      }
    );
  }
}

module.exports = {
  getPlayer,
  updateMap,
  updatePlayer,
  updateFlag
}
