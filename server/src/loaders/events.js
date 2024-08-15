import emitter from './eventEmitter';
import loadListeners from '../subscribers';

export default ({ app }) => {
  loadListeners(emitter);
  return app;
};
