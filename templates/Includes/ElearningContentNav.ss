<% if not $Answers %>
	<% if $ExplanatoryText %>
		<div class="well caption-nav">
			$ExplanatoryText
			<hr />
			<audio src="division-elearning-project/media/ido.mp3" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
		</div>
	<% else %>
		<hr />
	<% end_if %>

	<% if $NextPage %><p class="slide-nav"><% with $NextPage %><a class="btn next-sec" href="$Link">$Title <span class="glyphicon glyphicon-chevron-right"></span></a><% end_with %></p><% end_if %>


<% end_if %>