var mysql = require("mysql2");
import config from '../services/db';

var con = mysql.createPool({
  connectionLimit: 10,
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

function getRooms() {
  return new Promise(function (resolve, reject) {
    con.query(`SELECT
    node.type,
    node.nid,
    node__field_city.field_city_target_id,
    node_field_data.title,
    node__field_tiled.field_tiled_value

    FROM node
    LEFT JOIN  node__field_city
    ON  node__field_city.entity_id = node.nid

    LEFT JOIN node_field_data
    On node_field_data.nid = node__field_city.field_city_target_id

    LEFT JOIN node__field_tiled
    On node__field_tiled.entity_id = node.nid

    WHERE node.type ='map_grid'` ,
      function (err, result) {
        if (err) throw err;
        // console.log(result);
        resolve(result);
      }
    );
  })
}


module.exports = {
  getRooms,
}
