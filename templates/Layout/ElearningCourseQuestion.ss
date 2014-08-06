<div class="col-md-8 main-content">
	<div id="chapter-question">

		<p>Status: $QuestionStatus</p>

			$Content
			<hr />
		$ChapterQuestionForm
	</div>
		<% if $CompletionStatus == "completed" %>
			<% include ElearningContentNav %>
		<% end_if %>
	<% include ElearningCourseCredits %>
</div>
<div class="col-md-4 side-content">
	<% include ElearningCourseNav %>
</div>
