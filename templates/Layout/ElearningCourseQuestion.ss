<div class="col-md-8 col-lg-9 main-content">
	<div id="chapter-question">

		<h1>$Title</h1>
		$Content		
		<div class="question-form-container <% if $CompletionStatus == "completed" %>answered<% end_if %>">
			$ChapterQuestionForm
		</div>

		<% if $QuestionStatus == "Correct" %>
			<p class="bg-success question-status">Correct!</p>
		<% else_if $QuestionStatus == "Incorrect" %>
			<p class="bg-danger question-status">That's incorrect. The answer is <strong> $CorrectAnswer.Answer </strong></p>
		<% end_if %>
	</div>
	<% if $CompletionStatus == "completed" %>
		<article class="slide-content">
			$AnswerAdditionalInfo
		</article>
	<% end_if %>
	<% if $CompletionStatus == "completed" %>
		<% include ElearningContentNav %>
	<% else %>
		<% include ElearningQuestionInfo %>
	<% end_if %>

	<% include ElearningCourseCredits %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>
