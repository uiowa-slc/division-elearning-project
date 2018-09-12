

<% if $ExplanatoryText %>
	<div class="well caption-nav">
		$ExplanatoryText
		<h3> Audio Narration</h3>
		<% if $AudioClip %>
			<hr />
			<audio src="$AudioClip.Filename" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
		<% end_if %>
	</div>
<% else %>
		<hr />
<% end_if %>
<% if $NextPage %><p class="slide-nav"><a class="button button--next-sec" href="$NextLink">$NextPage.Title <span class="fa fa-chevron-right"></span></a></p><% end_if %>