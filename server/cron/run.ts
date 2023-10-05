import cron from 'node-cron';
import fs from 'fs';
const db = require("../services/db");
var Bridge = require('../services/bridge.ts');
import { EVERY_30_SECONDS, EVERY_MINUTE, EVERY_30_MINUTES, EVERY_HOUR } from './scheduleConstants';

const generateReport = (interval = '') => {
  if (!fs.existsSync('reports')) {
    fs.mkdirSync('reports');
  }

  const existingReports = fs.readdirSync('reports');
  const reportsOfType = existingReports?.filter((existingReport) => existingReport.includes(interval));
  fs.writeFileSync(`reports/${interval}_${new Date().toISOString()}.txt`, `Existing Reports: ${reportsOfType?.length}`);
};

export default () => {
  cron.schedule(EVERY_30_SECONDS, () => {
 //   generateReport('thirty-seconds');

  });

  cron.schedule(EVERY_MINUTE, () => {
    console.log('Banks');
    const promise1 = Promise.resolve(Bridge.updateBanks());
    promise1.then(() => {
      console.log('cool');
    }).catch((e) => {
      console.log('fuck');
    });
  //  generateReport('minute');
  });




  cron.schedule(EVERY_30_MINUTES, () => {
    generateReport('thirty-minutes');
  });

  cron.schedule(EVERY_HOUR, () => {
    generateReport('hour');
  });
}
