import logMessage from './log_message';
import updateJail from './update_jail';
import updateParliament from './update_parliament';


export default function loadListeners(emitter) {
  emitter.on('log_message', logMessage());
  emitter.on('heatbeat', updateJail());
  emitter.on('heatbeat', updateBank());
  emitter.on('heatbeat', updateParliament());


  return emitter;
};
