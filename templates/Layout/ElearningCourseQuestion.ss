<div class="col-sm-8">
	$Content
	<hr />

	<div id="chapter-question">
		<h4>Question</h4>
		$ChapterQuestionForm
	</div>

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
</aside>
	</section>
</div>
