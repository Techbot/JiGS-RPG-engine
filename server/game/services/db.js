const mysql = require('mysql2');
const config = require('../config');

 function query(sql, params) {
  const connection =  mysql.createConnection(config.db);
  return  connection.execute(sql, params);

}

module.exports = {
  query
}
