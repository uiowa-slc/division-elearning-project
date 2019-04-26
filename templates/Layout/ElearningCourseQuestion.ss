<main class="main-content__container" id="main-content__container">

	<!-- Background Image Feature -->
	<% include ElearningCourseHeader %>
	$BeforeContent
	

	<div class="row">

		<article role="main" class="main-content main-content--with-padding <% if $SiteConfig.ShowExitButton %>main-content--with-exit-button-padding<% end_if %> <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
			$BeforeContentConstrained
			<% if $MainImage %>
				<img class="main-content__main-img" src="$MainImage.ScaleMaxWidth(500).URL" alt="" role="presentation"/>
			<% end_if %>
			<div  class="main-content__text" >
					$Content		
					$ChapterQuestionForm

					<% if $QuestionStatus == "Correct" %>
						<p class="correct" >Correct!</p>
					<% else_if $QuestionStatus == "Incorrect" %>
						<p class="incorrect">That's incorrect. The answer is <strong> $CorrectAnswer.Answer </strong></p>
					<% end_if %>

				<% if $CompletionStatus == "completed" %>
					$AnswerAdditionalInfo
					<% include ElearningContentNav %>
				<% else %>
					<% include ElearningQuestionInfo %>
				<% end_if %>

				<% include ElearningCourseCredits %>
			</div>
			$AfterContentConstrained
			$Form
		</article>
		<aside class="sidebar dp-sticky">
			<% include ElearningCourseNav %>
			<% if $SideBarView %>
				$SideBarView
			<% end_if %>
			$Sidebar
		</aside>
	</div>
	$AfterContent

</main>

