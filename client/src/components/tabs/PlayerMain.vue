<script>
import axios from 'axios'
export default {
  data() {
    return {
      posts: []
    }
  },
  mounted() {
    axios
      .get('/mydata?_wrapper_format=drupal_ajax')
      .then((response) => {
        this.posts = response.data[0].value
      })
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      axios.get('/mydata?_wrapper_format=drupal_ajax', {
        name: this.name,
        description: this.description
      })
        .then(function (response) {
          currentObj.posts = response.data[0].value
        })
        .catch(function (error) {
          currentObj.output = error;
        });
    }
  }
}
</script>

<template>
<div class="building">
  <img src = "/assets/images/System/player-top.png"/>
<div><h2>Player Journal</h2></div>
<img src = "/assets/images/System/player-journal.png"/>
</div>
</template>

<style >
#app >form{

  display: flex;
  flex-wrap: wrap;

}
.action-name{

  flex:1 0 100%;

}
#player, #npc {

  flex: 1 0 50%;
  width: 200px;
  border: 3px solid #73AD21;
  padding: 10px;

}
 #left, #right {
   width: 90px;
   flex: 1 0 50%;
   border: 3px solid #73AD21;
   padding: 10px;
 }
</style>
