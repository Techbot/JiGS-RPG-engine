const config = require("../config");
var mysql = require("mysql2");

var con = mysql.createConnection({
  host: "xxx.xxx.xxx.xxx",
  user: "xxxxxxxx",
  password: "xxxxxxxxx",
  database: "xxxxxxxxx",
});

function getPortals(NodeNumber) {
  return new Promise(function (resolve, reject) {
    con.connect(function (err) {
      if (err) throw err;
      con.query(
        `SELECT node__field_portals.field_portals_target_id,
     paragraph__field_destination.field_destination_target_id,
     paragraph__field_tiled.field_tiled_value,
     paragraph__field_destination_x.field_destination_x_value,
     paragraph__field_destination_y.field_destination_y_value,
     paragraph__field_x.field_x_value,
     paragraph__field_y.field_y_value
     FROM node__field_portals Left
     Join paragraph__field_destination
      On node__field_portals.field_portals_target_id = paragraph__field_destination.entity_id
      Left Join paragraph__field_tiled
      On node__field_portals.field_portals_target_id = paragraph__field_tiled.entity_id
      Left Join paragraph__field_destination_x
      On node__field_portals.field_portals_target_id = paragraph__field_destination_x.entity_id
      Left Join paragraph__field_destination_y
      On node__field_portals.field_portals_target_id = paragraph__field_destination_y.entity_id
      Left Join paragraph__field_x
      On node__field_portals.field_portals_target_id = paragraph__field_x.entity_id
      Left Join paragraph__field_y
      On node__field_portals.field_portals_target_id = paragraph__field_y.entity_id
      where node__field_portals.entity_id = ` + NodeNumber,
        function (err, result) {
          if (err) throw err;
          // console.log("portalIDs:");
          // console.log(result);
          resolve(result);
        }
      );
    });
  });
}

function getNpcs(NodeNumber) {
  return new Promise(function (resolve, reject) {
    con.connect(function (err) {
      if (err) throw err;
      con.query(
        `SELECT
     node__field_npc.field_npc_target_id,
     paragraph__field_name.field_name_target_id,
     node_field_data.title,
     paragraph__field_x.field_x_value ,
     paragraph__field_y.field_y_value
     FROM node__field_npc Left Join paragraph__field_name
     On node__field_npc.field_npc_target_id =paragraph__field_name.entity_id
     Left Join node_field_data
     On node_field_data.nid = paragraph__field_name.field_name_target_id
     Left Join paragraph__field_x
     On paragraph__field_x.entity_id = paragraph__field_name.entity_id
     Left Join paragraph__field_y
     On paragraph__field_y.entity_id = paragraph__field_name.entity_id
     WHERE node__field_npc.entity_id = ` + NodeNumber,
        function (err, result) {
          if (err) throw err;
          // console.log("portalIDs:");
          // console.log(result);
          resolve(result);
        }
      );
    });
  });
}

function getRewards(NodeNumber) {
  return new Promise(function (resolve, reject) {
    con.connect(function (err) {
      if (err) throw err;
      con.query(
        `SELECT
     node__field_rewards.field_rewards_target_id,
     paragraph__field_x.field_x_value,
     paragraph__field_y.field_y_value,
     paragraph__field_ref.field_ref_value
     FROM node__field_rewards
     LEFT JOIN paragraph__field_x
     ON paragraph__field_x.entity_id = node__field_rewards.field_rewards_target_id
     LEFT JOIN paragraph__field_y
     ON paragraph__field_y.entity_id = node__field_rewards.field_rewards_target_id
     LEFT JOIN paragraph__field_ref
     ON paragraph__field_ref.entity_id = node__field_rewards.field_rewards_target_id

     WHERE node__field_rewards.entity_id = ` + NodeNumber,
        function (err, result) {
          if (err) throw err;
          // console.log("portalIDs:");
          // console.log(result);
          resolve(result);
        }
      );
    });
  });
}

function getPortals2() {
  // offset = helper.getOffset(page, config.listPerPage);
  console.log("getPortal");

  con.connect(function (err) {
    if (err) throw err;
    con.query(
      "SELECT ID FROM paragraphs_item WHERE type = 'portal'",
      function (err, result) {
        if (err) throw err;
        // console.log("portalIDs:");
        //  console.log(result);
        return result;
      }
    );
  });
}

function portalDetails(portal) {
  con.connect(function (err) {
    if (err) throw err;
    con.query(
      "SELECT paragraph__field_destination.field_destination_target_id, paragraph__field_destination_x.field_destination_x_value, paragraph__field_destination_y.field_destination_y_value, paragraph__field_x.field_x_value, paragraph__field_y.field_y_value FROM paragraph__field_destination INNER JOIN paragraph__field_destination_x ON  paragraph__field_destination.entity_id = paragraph__field_destination_x.entity_id INNER JOIN paragraph__field_destination_y ON  paragraph__field_destination.entity_id = paragraph__field_destination_x.entity_id INNER JOIN paragraph__field_x ON  paragraph__field_destination.entity_id = paragraph__field_x.entity_id INNER JOIN paragraph__field_y ON  paragraph__field_destination.entity_id = paragraph__field_y.entity_id WHERE paragraph__field_destination.entity_id = " +
        portal.ID,
      function (err, result, fields) {
        if (err) throw err;
        console.log("result:" + result.length);
        return result;
      }
    );
  });
}

function updateMap(id, map) {
  // const result = con.query(`UPDATE user__field_map_grid SET field_map_grid_target_id =` + map);
  con.connect(function (err) {
    if (err) throw err;
    con.query(
      "UPDATE user__field_map_grid SET field_map_grid_target_id = " +
        map +
        " WHERE user__field_map_grid.entity_id = " +
        id,
      function (err, result, fields) {
        if (err) throw err;
        return true;
      }
    );
  });
  return;
}

function updatePlayer(id, stat, value) {
  // const result = con.query(`UPDATE user__field_map_grid SET field_map_grid_target_id =` + map);
  con.connect(function (err) {
    if (err) throw err;
    con.query(
      "UPDATE user__field_" + stat + 'map_grid SET field_map_grid_target_id = " +
        map +
        " WHERE user__field_map_grid.entity_id = " +
        id,
      function (err, result, fields) {
        if (err) throw err;
        return true;
      }
    );
  });
  return;
}

module.exports = {
  getPortals,
  updateMap,
  portalDetails,
  getNpcs,
  getRewards,
};
