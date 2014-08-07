<div class="col-md-8 col-lg-9 main-content">
	<div id="chapter-question" class="slide-content">
		<h1>$Title</h1>
		<p>Status: $QuestionStatus</p>

		$Content
		$ChapterQuestionForm
	</div>
		<% if $CompletionStatus == "completed" %>
			<% include ElearningContentNav %>
		<% end_if %>
	<% include ElearningCourseCredits %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>
