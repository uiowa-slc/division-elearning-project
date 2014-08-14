<div class="col-md-8 col-lg-9 main-content">
	<h1> stat page! </h1>
	<% loop $Questions %>
	<section>
		<h3>$Content</h3>
		<ul class="ecourse-stats">
			<% loop $Answers() %>
			<% if $ID == Up.CorrectAnswer.ID %>
			<li class="correct">
				<p>$Answer</p>
				<div style="width: {$PercentAnswered}%; background-color: #3F3F3F; height: 20px;"></div>
				<p> Times Selected: {$TimesAnswered} Percentage Correct: $PercentAnswered</p>
			</li>
			<% else %>
			<li class="incorrect">
				<p>$Answer</p>
				<div style="width: {$PercentAnswered}%; background-color: #3F3F3F; height: 20px;"></div>
				<p> Times Selected: {$TimesAnswered} Percentage Correct: $PercentAnswered</p> 
				
			</li>
			<% end_if %>
			<% end_loop %>
		</ul>
	</section>
	<% end_loop %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>