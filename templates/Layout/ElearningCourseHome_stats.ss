<div class="col-md-8 col-lg-9 main-content">
	<h1> stat page! </h1>
	<% loop $Questions %>
	<section>
		<h3>$Content.Summary</h3>
		<ul class="ecourse-stats">
			<% loop $Answers() %>	
			<%--	
			<li class="answer-well" data-percent="$PercentAnswered" <% if $ID == Up.CorrectAnswer.ID %> data-iscorrect="correct" <% else %> data-iscorrect="incorrect" <% end_if %> <%include Style %> >
			--%>
			<li class="answer-well" style="<% if $ID == Up.CorrectAnswer.ID %> <% include DataStylesC %> <% else %> <% include DataStylesI %> <% end_if %>">
				<div class="answer-info">
					<span>$Answer</span>
					<ul>
						<li> Times Selected: <strong> $TimesAnswered </strong> </li>
						<li> Percent Choosen: <strong> $PercentAnswered.Nice() </strong></li>
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