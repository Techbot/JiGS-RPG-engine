<!DOCTYPE html>
<html>

<head>
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
</head>
<body>

<script type="text/x-handlebars">
<div class="navbar">
<div class="navbar-inner">
{{#link-to 'index' class='brand'}}Ember.js{{/link-to}}
<ul class="nav">
<li>{{#link-to 'posts'}}Posts{{/link-to}}</li>
<li>{{#link-to 'about'}}About{{/link-to}}</li>
</ul>
</div>
</div>
{{outlet}}
</script>

<script type="text/x-handlebars" id="posts">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <table class='table'>
                <thead>
                <tr><th>Recent</th></tr>
                </thead>
                <tbody>

                    {{#each model}}
                        <tr>
                            <td>


                            {{#link-to 'post' this}} {{name}} <small class='muted'>by {{name}}</small>{{/link-to}}



                            </td>
                        </tr>
                    {{/each}}

                </tbody>

            </table>
        </div>

        <div class="span9">
            {{outlet}}
        </div>
    </div>
</div>
</script>



<!--script type="text/x-handlebars" id="posts/index">
<p class="text-warning">Please select a post</p>
</script-->
<!-- <script type="text/x-handlebars" id="post">
   {{#if isEditing}}
{{partial 'post/edit'}}
<button {{action 'doneEditing'}}>Done</button>
{{else}}
<button {{action 'edit'}}>Edit</button>
{{/if}}

-->

<script type="text/x-handlebars" id="post">
<h1>{{name}}</h1>
<h2>by {{name}} <small class='muted'>({{name}})</small></h2>
<hr>
<div class='intro'>
{{ name}}
</div>
<div class='below-the-fold'>
{{ name}}
</div>
</script>

<!--script type="text/x-handlebars" id="post/_edit">
<p>{{input type="text" value=title}}</p>
<p>{{input type="text" value=excerpt}}</p>
<p>{{textarea value=body}}</p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat turpis, dignissim sed dictum vitae, egestas eu dui. Etiam nisl purus, efficitur vitae odio quis, rutrum vulputate lectus. Vivamus pulvinar vehicula porta. Nullam tempus ex ac massa maximus, at tristique odio bibendum. Integer vel risus eget diam laoreet elementum. Ut eget enim ut velit accumsan commodo ac sed felis. Curabitur imperdiet justo turpis, vel pellentesque risus porta non. Mauris fringilla quis metus in finibus. Duis luctus, leo eu fermentum pulvinar, lacus arcu efficitur odio, sed volutpat lectus dolor et purus. Duis aliquet non neque a laoreet.
</script-->

<script type="text/x-handlebars" id="about">
<div class='about'>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat turpis, dignissim sed dictum vitae, egestas eu dui. Etiam nisl purus, efficitur vitae odio quis, rutrum vulputate lectus. Vivamus pulvinar vehicula porta. Nullam tempus ex ac massa maximus, at tristique odio bibendum. Integer vel risus eget diam laoreet elementum. Ut eget enim ut velit accumsan commodo ac sed felis. Curabitur imperdiet justo turpis, vel pellentesque risus porta non. Mauris fringilla quis metus in finibus. Duis luctus, leo eu fermentum pulvinar, lacus arcu efficitur odio, sed volutpat lectus dolor et purus. Duis aliquet non neque a laoreet.
</div>
</script>
  <!--script src="/components/com_battle/views/ember/tmpl/js/libs/jquery-1.10.2.js"></script-->


  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<!--
  <script src="/components/com_battle/views/ember/tmpl/js/libs/handlebars-v1.3.0.js"></script>
  <script src="/components/com_battle/views/ember/tmpl/js/libs/ember-1.8.1.js"></script>
  <script src="/components/com_battle/views/ember/tmpl/js/app.js"></script>
-->


<script src="js/libs/handlebars-v1.3.0.js"></script>
<script src="js/libs/ember-1.8.1.js"></script>
<script src="js/app.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>

  <!-- to activate the test runner, add the "?test" query string parameter -->

</body>

</html>