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

		<% if $QuestionStatus == "Correct" %>
			<p class="bg-success question-status">Correct!</p>
		<% else_if $QuestionStatus == "Incorrect" %>
			<p class="bg-danger question-status">That's incorrect. The answer is <strong> $CorrectAnswer.Answer </strong></p>
		<% end_if %>
	</div>
		<% if $CompletionStatus == "completed" %>
			<article class="slide-content">
				<h2>All of the Above</h2>
				<p>OARS are techniques that help encourage change talk and are beneficial when using the elements of Motivational Interviewing.</p>
				<ul>
					<li>Open ended questions</li>
					<li>Affirmative statements</li>
					<li>Reflective Listening</li>
					<li>Summarize</li>
				</ul>
			<%--$AnswerContent--%>
			</article>
		<% end_if %>
		<% if $CompletionStatus == "completed" %>
			<% include ElearningContentNav %>
		<% end_if %>

	<% include ElearningCourseCredits %>
</div>
<div class="col-md-4 col-lg-3 side-content">
	<% include ElearningCourseNav %>
</div>
