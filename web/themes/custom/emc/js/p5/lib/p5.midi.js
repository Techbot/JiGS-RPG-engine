/**
 *  NOTE: you may need to restart your browser
 *  if midi input/output devices were not connected
 *  when you opened the browser session.
 *
 *  p5.midi.event 
 *  
 *  methods:
 *
 *  p5.midi.init()
 *
 *  p5.midi.onInput(e) {
 *    // do something with
 *    // p5.midi.event
 *    // which is the same thing as "e"
 *  }
 *  
 *  p5.midi.send(channel, val)
 *  
 */

(function() {
  var ___MIDI = {

    inputs: undefined,
    outputs: undefined,
    outputArray: [],
    inputArray: [],

    /**
     *  the p5.midi.event holds the most recent midi input event.
     *  
     *  
     *  @property A Uint8Array containing the MIDI data bytes of a single MIDI message
     */
    event: undefined,

    /**
     *  initialize - request midi access
     *
     *  @method  init
     */
    init: function() {
      try {
        navigator.requestMIDIAccess().then(this._midiSuccess, this._midiError);
      }
      catch(e) {
        console.warn('This browser does not support the WebMIDI API')
        throw(e);
      }
    },

    /**
     *  list available midi inputs and outputs
     *  
     *  @method list
     */
    list: function() {

      this.inputArray.forEach(function(item) {
        console.log('p5.MIDI input: ' + item.name + ', ID: ' + item.id);

      });

      this.outputArray.forEach(function(item) {
        console.log('p5.MIDI output: ' + item.name + ', ID: ' + item.id);
      });
    },

    // private callback
    _midiSuccess: function (midiAccess) {
      ___MIDI.inputs = midiAccess.inputs.values();
      ___MIDI.outputs = midiAccess.outputs.values();
      ___MIDI._setupMidiIn();
      ___MIDI._setupMidiOut();
    },

    // private callback
    _midiError: function(message) {
      console.log('Error: ' + message);
    },


    // create array of possible inputs
    _setupMidiIn: function() {
      var inputs = this.inputs;
      var hasAtLeastOneDevice = false;

      // setup input
      for ( var input = inputs.next(); input && !input.done; input = inputs.next()) {
        console.log('p5.MIDI input: connecting to ' + input.value.name + ', ID: ' + input.value.id);
        input.value.onmidimessage = this.MIDIMessageEventHandler;
        this.input = input.value;
        this.inputArray.push(input.value);
        hasAtLeastOneDevice = true;
      }
      if (!hasAtLeastOneDevice) { this._midiError('No MIDI Input'); }
    },

    // create array of possible outputs
    _setupMidiOut: function() {
      var outputs = this.outputs;
      var hasMidiOutput = false;
      for ( var output = outputs.next(); output && !output.done; output = output.next()) {
        console.log('p5.MIDI output: connecting to ' + output.value.name + ', ID: ' + output.value.id);
        this.output = output.value;
        this.outputArray.push(output.value);
        hasMidiOutput = true;

        // added this to avoid throwing an error, which is probably a bug in web midi
        if (typeof(output.next) === 'undefined') { return; }
      }

      if (!hasMidiOutput) { this._midiError('No MIDI Output'); }
    },

    /**
     *  this method is called when a midi message is received
     */
    MIDIMessageEventHandler: function(event) {
      ___MIDI.event = event;
      ___MIDI.onInput(event);
    },


    /**
     *  Callback from midi input event.
     *  
     *  Should be overwritten by the user, similar to mouseClicked(), like this:
     *  p5.midi.onInput(){
     *    var note = p5.midi.event[1];
     *    var velocity = p5.midi.event[2];
     *    
     *    // do something with note and velocity
     *  }
     *
     *  @method  onInput
     *  @param  {Array} event Event will be passed in automatically
     *                        or can be referenced as p5.midi.event
     */
    onInput: function(event) {
      console.log('input: ', this.event);
    },

    /**
     *  Format MIDI data to be sent to midi output.
     *  
     *  Examples:
     *    MIDI.send('attack', 60, 127) --> triggers attack on middle C
     *    MIDI.send('release', 60, 0) --> triggers release of middle C
     *  
     *  @param  {String} message  'attack', 'release' or # betw 0 to 127
     *  @param  {Number} note     0 to 127
     *  @param  {Number} velocity 0 to 127
     */
    send : function(message, note, velocity) {
      var msg = [message, note, velocity];

      switch(message) {
        case 'attack':
          msg[0] = 0x90;
          break;
        case 'release':
          msg[0] = 0x80;
          velocity = 0;
          break;
        default:
          // console.log('midi error, did not recognize ' + message)
          // return;
      }

      if (typeof(note) !== 'number' || typeof(velocity) !== 'number') {
        console.log('midi error, did not recognize ' + note + ' or ' + velocity);
        return;
      }
      msg[1] = note;

      msg[2] = velocity;

      // send the message to all connected outputs
      this.outputArray.forEach(function(output) {
        output.send(msg);
      });

     }
  }

  // initialize midi and create p5 object if one doesn't exist on the page
  if (!window.p5) {
    p5 = {};
  }
  p5.midi = ___MIDI;
  window.addEventListener('load', p5.midi.init() );

})();
