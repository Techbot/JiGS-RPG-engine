<script>
import { useJigsStore } from "../../stores/jigs";
import * as coreui from '@coreui/coreui'
export default {
  components: {
    coreui
  }
}
</script>

<template>
  <div>
    QUESTS
    <img src="/assets/images/header2.png" />

    <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button"
            data-coreui-toggle="collapse" data-coreui-target="#flush-collapseOne"
            aria-expanded="false" aria-controls="flush-collapseOne">
            Accordion Item #1
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse"
          data-coreui-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion,
            which is intended to demonstrate the <code>.accordion-flush</code>
            class. This is the first item's accordion body.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button"
            data-coreui-toggle="collapse" data-coreui-target="#flush-collapseTwo"
            aria-expanded="false" aria-controls="flush-collapseTwo">
            Accordion Item #2
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse"
          data-coreui-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion,
            which is intended to demonstrate the <code>.accordion-flush</code>
            class. This is the second item's accordion body. Let's imagine
            this
            being filled with some actual content.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button"
            data-coreui-toggle="collapse"
            data-coreui-target="#flush-collapseThree" aria-expanded="false"
            aria-controls="flush-collapseThree">
            Accordion Item #3
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse"
          data-coreui-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion,
            which is intended to demonstrate the <code>.accordion-flush</code>
            class. This is the third item's accordion body. Nothing more
            exciting happening here in terms of content, but just filling up
            the
            space to make it look, at least at first glance, a bit more
            representative of how this would look in a real-world application.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
