
	<% if $ExplanatoryText %>
		<div class="well caption-nav">
			$ExplanatoryText
			<hr />
			<audio src="division-elearning-project/media/ido.mp3" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
		</div>
	<% else %>
		<hr />
	<% end_if %>

	<% if $NextPage %><p class="slide-nav"><a class="btn next-sec" href="$NextLink">$NextPage.Title <span class="glyphicon glyphicon-chevron-right"></span></a></p><% end_if %>
