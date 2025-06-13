<script>
import { useJigsStore } from '../../stores/jigs';

export default {
  name: 'AudioController',
  data() {
    return {
      showVolume: false,
      jigs: useJigsStore()
    }
  },
  computed: {
    volume: {
      get() {
        return this.jigs.audioVolume;
      },
      set(value) {
        this.jigs.audioVolume = value;
        localStorage.setItem('audioVolume', value.toString());
        this.applyVolume(value);
      }
    },
    muted() {
      return this.volume === 0;
    },
    volumeTitle() {
      return `Volume (${this.volume}%)`;
    }
  },
  watch: {
    'jigs.room': {
      handler() {
        this.$nextTick(() => {
          this.applyVolume(this.volume);
        });
      },
      immediate: true
    }
  },
  methods: {
    mute() {
      if (this.muted) {
        this.volume = this.jigs.audioPreviousVolume;
      } else {
        this.jigs.audioPreviousVolume = this.volume;
        this.volume = 0;
      }
    },
    applyVolume(value) {
      if (this.jigs.scene?.soundtrack) {
        this.jigs.scene.soundtrack.setVolume(value / 100);
      }
    },
    loadStateFromStorage() {
      const storedVolume = localStorage.getItem('audioVolume');
      const storedPreviousVolume = localStorage.getItem('audioPreviousVolume');

      if (storedVolume !== null) {
        this.jigs.audioVolume = parseInt(storedVolume);
      }
      if (storedPreviousVolume !== null) {
        this.jigs.audioPreviousVolume = parseInt(storedPreviousVolume);
      }
    }
  },
  mounted() {
    this.loadStateFromStorage();
    this.applyVolume(this.volume);
  }
}
</script>

<template>
  <div class="audio-player">
    <div class="audio-player-controls">
      <div id="mute">
        <button v-on:click.prevent="mute" class="audio-player-control" title="Mute">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path v-if="!muted" fill="currentColor" d="M5.312,4.566C4.19,5.685-0.715,12.681,3.523,16.918c4.236,4.238,11.23-0.668,12.354-1.789c1.121-1.119-0.335-4.395-3.252-7.312C9.706,4.898,6.434,3.441,5.312,4.566z M14.576,14.156c-0.332,0.328-2.895-0.457-5.364-2.928C6.745,8.759,5.956,6.195,6.288,5.865c0.328-0.332,2.894,0.457,5.36,2.926C14.119,11.258,14.906,13.824,14.576,14.156zM15.434,5.982l1.904-1.906c0.391-0.391,0.391-1.023,0-1.414c-0.39-0.391-1.023-0.391-1.414,0L14.02,4.568c-0.391,0.391-0.391,1.024,0,1.414C14.41,6.372,15.043,6.372,15.434,5.982z M11.124,3.8c0.483,0.268,1.091,0.095,1.36-0.388l1.087-1.926c0.268-0.483,0.095-1.091-0.388-1.36c-0.482-0.269-1.091-0.095-1.36,0.388L10.736,2.44C10.468,2.924,10.642,3.533,11.124,3.8z M19.872,6.816c-0.267-0.483-0.877-0.657-1.36-0.388l-1.94,1.061c-0.483,0.268-0.657,0.878-0.388,1.36c0.268,0.483,0.877,0.657,1.36,0.388l1.94-1.061C19.967,7.907,20.141,7.299,19.872,6.816z"/>
            <path v-else fill="currentColor" d="M14.201,9.194c1.389,1.883,1.818,3.517,1.559,3.777c-0.26,0.258-1.893-0.17-3.778-1.559l-5.526,5.527c4.186,1.838,9.627-2.018,10.605-2.996c0.925-0.922,0.097-3.309-1.856-5.754L14.201,9.194z M8.667,7.941c-1.099-1.658-1.431-3.023-1.194-3.26c0.233-0.234,1.6,0.096,3.257,1.197l1.023-1.025C9.489,3.179,7.358,2.519,6.496,3.384C5.568,4.31,2.048,9.261,3.265,13.341L8.667,7.941z M18.521,1.478c-0.39-0.391-1.023-0.391-1.414,0L1.478,17.108c-0.391,0.391-0.391,1.024,0,1.414c0.391,0.391,1.023,0.391,1.414,0l15.629-15.63C18.912,2.501,18.912,1.868,18.521,1.478z"/>
          </svg>
        </button>
      </div>
      <div id="volume">
        <button v-on:click.prevent="" v-on:mouseenter="showVolume = true" v-on:mouseleave="showVolume = false" :title="volumeTitle" class="audio-player-control">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="currentColor" d="M19,13.805C19,14.462,18.462,15,17.805,15H1.533c-0.88,0-0.982-0.371-0.229-0.822l16.323-9.055C18.382,4.67,19,5.019,19,5.9V13.805z"/>
          </svg>
          <input v-model.lazy.number="volume" v-show="showVolume" class="audio-player-volume" type="range" min="0" max="100"/>
        </button>
      </div>
    </div>
  </div>
</template>

<style>
  :root {
    --audio-player-bg: #111;
    --audio-player-control-bg: #111;
    --audio-player-border-color: #111;
    --audio-player-link-color: #FFC43D;
    --audio-player-text-color: #fff;
  }

  .audio-player {
    background-color: var(--audio-player-bg);
    border-radius: 0.3125rem;
    border: 1px solid var(--audio-player-border-color);
    box-shadow: 0 5px 8px rgba(0, 0, 0, 0.15);
    color: var(--audio-player-text-color);
    display: inline-block;
    line-height: 1.5625;
    position: relative;
    max-width: 280px;
  }

  .audio-player-controls {
    display: grid;
    grid-template-areas: "a b";
    max-width: 31.25rem;
  }

  .audio-player-controls > div {
    border-right: 1px solid var(--audio-player-border-color);
  }

  .audio-player-controls > div:last-child {
    border-right: none;
  }

  .audio-player-control {
    background-color: var(--audio-player-control-bg);
    border: none;
    color: var(--audio-player-link-color);
    cursor: pointer;
    display: flex;
    line-height: 0;
    margin: 0;
    padding: 0.5em;
    text-decoration: none;
  }

  .audio-player-control svg {
    width: 1.125rem;
  }

  .audio-player-volume {
    display: inline-block;
    height: 1.1rem;
    margin: 0 0 0 0.625rem;
    width: 7.925rem;
  }
</style>
