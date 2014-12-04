
  <script type="text/x-handlebars">
    <h2>Welcome to Ember.js</h2>

    {{outlet}}
  </script>

  <script type="text/x-handlebars" id="index">
    <ul>
    {{#each item in model}}
      <li>{{item}}</li>
    {{/each}}
    </ul>
  </script>

  <script src="/components/com_battle/views/ember/tmpl/js/libs/jquery-1.10.2.js"></script>
  <script src="/components/com_battle/views/ember/tmpl/js/libs/handlebars-v1.3.0.js"></script>
  <script src="/components/com_battle/views/ember/tmpl/js/libs/ember-1.8.1.js"></script>
  <script src="/components/com_battle/views/ember/tmpl/js/app.js"></script>
  <!-- to activate the test runner, add the "?test" query string parameter -->
  <script src="/components/com_battle/views/ember/tmpl/tests/runner.js"></script>
