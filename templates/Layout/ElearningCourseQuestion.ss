<div class="col-md-8 col-lg-9 main-content">
	<div id="chapter-question">
		<h1>$Title</h1>
		$Content		
		<% if $QuestionAudioClip %>
		<audio src="$QuestionAudioClip.Filename" controls="controls"></audio>
		<% end_if %>
		<hr />
		<div class="question-form-container <% if $QuestionStatus == "Correct" || $QuestionStatus == "Incorrect" %>answered<% end_if %>">
			$ChapterQuestionForm
		</div>
		<%-- "Correct" and "Incorrect" are case sensitive --%>
		<% if $QuestionStatus == "Correct" %>
		<div class="correct well">
			<p>Correct! Here's why: </p>
		</div>
		<% else_if $QuestionStatus == "Incorrect" %>
		<div >
			<p class="incorrect well">That's incorrect. The answer is <strong> $CorrectAnswer.Answer </strong> Here's why: </p>
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
