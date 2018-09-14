<main class="main-content__container" id="main-content__container">

	<!-- Background Image Feature -->
	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>
	$Breadcrumbs
	
	<% if not $BackgroundImage %>
		<div class="column row">
			<div class="main-content__header">
				<h1>$Title</h1>
			</div>
		</div>
	<% end_if %>

	$BlockArea(BeforeContent)

	<div class="row">

		<article role="main" class="main-content main-content--with-padding <% if $SiteConfig.ShowExitButton %>main-content--with-exit-button-padding<% end_if %> <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
			$BlockArea(BeforeContentConstrained)
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
			$BlockArea(AfterContentConstrained)
			$Form
		</article>
		<aside class="sidebar dp-sticky">
			<% include ElearningCourseNav %>
			<% if $SideBarView %>
				$SideBarView
			<% end_if %>
			$BlockArea(Sidebar)
		</aside>
	</div>
	$BlockArea(AfterContent)

</main>

