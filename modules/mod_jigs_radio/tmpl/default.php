<div id="radio">

  <!--div class="control play" onclick="VolumeSample.toggle();">
    <span class="left"></span><span class="right"></span>
  </div-->

    <span class="radio_stats">Now Playing</span>

  <input id="emcradioPlay" type="button" class="pulse" onclick="VolumeSample.toggle();" value="Play"/>
  <span class="label">Volume</span><input type="range" min="0" max="100" value="70" oninput="VolumeSample.changeVolume(this);" />
</div>
