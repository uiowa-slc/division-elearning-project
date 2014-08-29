<div class="row">

	<div class="col-sm-10">
		<article class="statistics">
			<p>Number of times the course has been completed: <strong>$TimesCompleted</strong></p>
			<% loop $Questions %>
			<section>
				<h3>$Content.Summary</h3>
				<ul class="question-list">
					<% loop $Answers() %>	
					<%--	
					<li class="answer-well" data-percent="$PercentAnswered" <% if $ID == Up.CorrectAnswer.ID %> data-iscorrect="correct" <% else %> data-iscorrect="incorrect" <% end_if %> <%include Style %> >
					--%>
					<li class="answer-well" style="<% if $ID == Up.CorrectAnswer.ID %> <% include DataStylesC %> <% else %> <% include DataStylesI %> <% end_if %>">
						<div class="answer-info">
							<span>$Answer</span>
							<ul>
								<li> Times Chosen: <strong> $TimesAnswered </strong></li>
								<li> Percent Chosen: <strong> $PercentAnswered.Nice() </strong></li>
							</ul>	
						</div>	
					</li>
					<% end_loop %>
				</ul>
			</section>
			<% end_loop %>
		</article>
	</div>
</div>
