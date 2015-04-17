<?php
$x="<link rel=stylesheet href=styles.css>
<style>
#container {
position:relative;
}
#content {
position:absolute;
top:0;
left:0;
}
</style>
<div id='page1'>
 <iframe src='http://www." . $this->page[0]->details . "' width ='598' height = '600'>

				<div id='container1'>
			<canvas id='myCanvas' width='600' height='482' style='border:1px solid red;'>
			<div id='content1'>
					<p>So much depends</p>
					<p>upon an empty container</p>
					<p>containe</p>
			</div><!-- end content -->
			<div id='content1'>
					<p>I</p>
					<p>like</p>
					<p>stuff</p>
			</div><!-- end content -->


			</iframe>
			</canvas>
		</div><!-- end container -->
</div><!-- end twine -->

<script src=/components/com_battle/views/twines/tmpl/script.js></script>
	
";

//echo json_encode($this->twine[0]->details);
//exit();
echo json_encode($x);
