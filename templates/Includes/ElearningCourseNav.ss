
	
	<nav class="sidenav">
		<ul class="sidenav__menu">
				<% with $Course %>
					<li class="sidenav__item sidenav__item--$LinkingMode $CompletionStatus">
						<a class="sidenav__link" href="$Link"><% if $CompletionStatus == "completed" %><span class="fa fa-check"></span><% end_if %> $MenuTitle</a>
				<% end_with %>
				<% loop $Course.Children %>
					<ul class="sidenav__second-level">
					<li class="sidenav__item sidenav__item--second-level sidenav__item--$LinkingMode $CompletionStatus"><a class="sidenav__link" href="$Link"><% if $CompletionStatus == "completed" %><span class="fa fa-check"></span><% end_if %> $MenuTitle</a>
					<%-- third level nav option 1 --%>
						<% if $LinkOrSection = "section" && $Children %>
							<ul class="sidenav__third-level">
								<% loop $Children %>
									<li class="sidenav__item sidenav__item--third-level sidenav__item--$LinkingMode $CompletionStatus">
										<a class="sidenav__link" href="$Link"><% if $CompletionStatus == "completed" %><span class="fa fa-check"></span><% end_if %> $MenuTitle</a>
								<% end_loop %>
							</ul>
						<% end_if %>
					<%-- end third level nav option 1 --%>
					</li>
				<% end_loop %>
		</ul>
	</nav>



	<% if $CurrentMember %>
	<nav>
		<h2>Course Admin</h2>
			<ul class="first-level">
				<li><a href="{$CMSEditLink}">Edit this Page</a></li>
				<li><a href="{$Course.Link}stats/">Course Statistics</a></li>
				<li><a href="{$Link}Clear">Reset Current Progress in Course</a></li>
			</ul>
		</nav>
	<% end_if %>
