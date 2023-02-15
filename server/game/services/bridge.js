const db = require('./db');
const helper = require('../helper');
const config = require('../config');

 function getMultiple(page = 1){
  const offset = helper.getOffset(page, config.listPerPage);
  const rows =  db.query(
    `SELECT id, name, released_year, githut_rank, pypl_rank, tiobe_rank
    FROM programming_languages LIMIT ${offset},${config.listPerPage}`
  );
  const data = helper.emptyOrRows(rows);
  const meta = {page};

  return {
    data,
    meta
  }
}

async function updateMap(id, map){
  const result = await db.query(
    `UPDATE user__field_map
    SET field_map_value ="${map}"
    WHERE entity_id=${id}`
  );

  let message = 'Error in updating programming language';

  if (result.affectedRows) {
    message = 'Programming language updated successfully';
  }

  return {message};
}

async function createGame(programmingLanguage){
  const result = await db.query(
    `INSERT INTO programming_languages
    (name, released_year, githut_rank, pypl_rank, tiobe_rank)
    VALUES
    (${programmingLanguage.name}, ${programmingLanguage.released_year}, ${programmingLanguage.githut_rank}, ${programmingLanguage.pypl_rank}, ${programmingLanguage.tiobe_rank})`
  );

  let message = 'Error in creating programming language';

  if (result.affectedRows) {
    message = 'Programming language created successfully';
  }

  return {message};
}

async function removeGame(id){
  const result = await db.query(
    `DELETE FROM programming_languages WHERE id=${id}`
  );

  let message = 'Error in deleting programming language';

  if (result.affectedRows) {
    message = 'Programming language deleted successfully';
  }

  return {message};
}

module.exports = {
  getMultiple,
  createGame,
  updateMap,
  removeGame
};
