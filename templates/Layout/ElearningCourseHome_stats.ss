<div class="col-md-8 col-lg-9 main-content">
	<h1> stat page! </h1>
	<% loop $Questions %>
	<section>
		<h3>$Content</h3>
		<ul class="ecourse-stats">
			<% loop $Answers() %>		
			<li class="answer-well" style="background: linear-gradient(to right, #DFF0D8 0%, #DFF0D8 {$PercentAnswered}%, rgba(255,255,255,1) {$PercentAnswered}%);">

				<!--
				<% if $ID == Up.CorrectAnswer.ID %>
				<span class="stats-bar" data-percent="$PercentAnswered" style="width: {$PercentAnswered}%;"></span>
				<% else %>
				<span class="stats-bar" data-percent="$PercentAnswered" style="width: {$PercentAnswered}%;"></span>
				<% end_if %>
				-->

				<div class="answer-info">
					<p>$Answer</p>
					<ul>
						<li> Times Selected: $TimesAnswered </li>
						<li> Percentage Correct: $PercentAnswered </li>
					</ul>	
				</div>	
			</li>
			<% end_loop %>
		</ul>
	</section>
	<% end_loop %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>