<% if $ExplanatoryText %>
	<div class="well caption-nav">
		$ExplanatoryText
		<% if $AudioClip %>
			<hr />
			<audio src="$AudioClip.Filename" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
		<% end_if %>
	</div>
<% else %>
		<hr />
<% end_if %>
<% if $NextPage %><p class="slide-nav"><a class="btn next-sec" href="$NextLink">$NextPage.Title <span class="glyphicon glyphicon-chevron-right"></span></a></p><% end_if %>