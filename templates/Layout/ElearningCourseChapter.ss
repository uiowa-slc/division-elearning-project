<div class="col-md-8">
	$Content
	<hr />
	<p>
		<a class="btn">Begin the course </a>
	</p>
</div>
<div class="col-md-4">
	<section class="sec-content hide-print" data-spy="affix">
		<h2>
			Course Overview
		</h2>
		<nav class="sec-nav">
			<ul class="first-level">

				<% loop Menu(3) %>
				<li <% if $isCurrent %>class="active"<% end_if %>>
					<a href="$Link">$Title</a>
				</li>
				<% end_loop %>
			</ul>
		</nav>
		<aside>
</aside>
	</section>
</div>
<div class="col-md-12">
	<hr>
	<p>write funciton to return which part this chapter is under and dispaly graphically</p>
</div>