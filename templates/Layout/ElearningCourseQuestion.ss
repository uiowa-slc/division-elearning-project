<div class="col-md-8 col-lg-9 main-content">
	<div id="chapter-question">
		<h1>$Title</h1>
		$Content
		<hr />
		<div class="question-form-container <% if $QuestionStatus == "Correct" || $QuestionStatus == "Incorrect" %>answered<% end_if %>">
			$ChapterQuestionForm
		</div>
		<% if $QuestionStatus == "correct" %>
		<div class="bg-success">
			<h3>Correct! Here's why: </h3>
		</div>
		<% else_if $QuestionStatus == "Incorrect" %>
		<div >
			<p class="bg-danger">That's incorrect. The answer is <strong> $CorrectAnswer.Answer </strong> Here's why: </p>
		</div>
		<% end_if %>
	</div>
		<% if $CompletionStatus == "completed" %>
			<% include ElearningContentNav %>
		<% end_if %>
	<% include ElearningCourseCredits %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>
