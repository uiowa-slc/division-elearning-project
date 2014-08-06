<section class="sec-content hide-print" data-spy="affix">
	

	<% with Course %>
		<h3 class="section-title"><a href="$Link">$MenuTitle</a></h3>
	<% end_with %>



<nav class="sec-nav">
	<ul class="first-level">
			<% with $Course %>
				<% include ElearningNavLink %>
			<% end_with %>
			<% loop $Course.Children %>
				<% include ElearningNavLink %>
				<%-- third level nav option 1 --%>
					<% if $LinkOrSection = "section" && $Children %>
						<ul class="second-level">
							<% loop $Children %>
								<% include ElearningNavLink %>
							<% end_loop %>
						</ul>
					<% end_if %>
				<%-- end third level nav option 1 --%>
				</li>
			<% end_loop %>
	</ul>
</nav>

	<nav class="sec-nav additional-nav">
		<h2>Additional Resources</h2>
		<ul class="first-level">
			<li><a href="#">Code of Student Life</a></li>
			<li><a href="#">Judicial Procedure and Resources</a></li>
			<li><a href="#">Mandatory Reporter</a></li>
		</ul>		
	</nav>
	<div class="playback-options">
	<% if $isAudioEnabled %>
		<a href="{$Link}disableAudioInSession" class="btn narration">Disable Auto Narration <span class="glyphicon glyphicon-volume-off"></span></a>
	<% else %>
		<a href="{$Link}enableAudioInSession" class="btn narration">Enable Auto Narration <span class="glyphicon glyphicon-volume-up"></span></a>
	<% end_if %>
	</div>

	<% if $CurrentMember %>
	<nav class="sec-nav additional-nav">
		<h2>Administrative Tools</h2>
			<ul class="first-level">
				<li><a href="{$CMSEditLink}">Edit this Page</a></li>
				<li><a href="{$Link}Clear">Reset Course Progress</a></li>
			</ul>
		</nav>
	<% end_if %>

	

</section>
