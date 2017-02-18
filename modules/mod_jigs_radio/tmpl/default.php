<style>
    #radio{
        background:url(http://www.eclecticmeme.com/images/emcRadio-bg.png) no-repeat 50% 50%;
        background-size:contain;
        position:relative;
        height:120px;
        width:auto;
        padding:30px 40px 0;
    }

</style>


<script type="text/javascript">
  function changeText() {
    console.log('change text');
  }
</script>


<div id="radio">

  <!--div class="control play" onclick="VolumeSample.toggle();">
    <span class="left"></span><span class="right"></span>
  </div-->


    <input id="emcradioPlay" type="button" class="pulse" onclick="VolumeSample.toggle();" value="Play"/>
  <span class="label">Volume</span><input type="range" min="0" max="100" value="100" oninput="VolumeSample.changeVolume(this);" />
</div>



















