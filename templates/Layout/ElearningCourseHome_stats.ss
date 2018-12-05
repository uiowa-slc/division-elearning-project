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

	$BeforeContent

	<div class="row">

		<article role="main" class="main-content main-content--with-padding <% if $SiteConfig.ShowExitButton %>main-content--with-exit-button-padding<% end_if %> <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
			$BeforeContentConstrained
			<% if $MainImage %>
				<img class="main-content__main-img" src="$MainImage.ScaleMaxWidth(500).URL" alt="" role="presentation"/>
			<% end_if %>
			<div class="main-content__text">
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
								<ul class="answer-list">
									<li class="times-chosen" ;> Times Chosen: <strong> $TimesAnswered </strong></li>
									<li class= "percent-chosen";> Percent Chosen: <strong> $PercentAnswered.Nice() </strong></li>
								</ul>	
							</div>	
						</li>
						<% end_loop %>
					</ul>
				</section>
				<% end_loop %>
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

