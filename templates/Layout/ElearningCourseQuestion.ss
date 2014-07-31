<div class="col-sm-8">
	$Content
	<hr />
	<p>
		<a class="btn">Begin the course </a>
	</p>
</div>
<div class="col-sm-4">
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
