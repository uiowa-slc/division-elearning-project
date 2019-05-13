<div class="elearning-audio">		
		<% if $AudioClip %>
			<hr />
			<h3> Audio Narration</h3>
			<audio src="$AudioClip.URL" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
				<div class="playback-options">
				<% if $isAudioEnabled %>
					<a href="{$DisableAudioLink}" class="btn narration"><i class="fa fa-volume-off" aria-hidden="true"></i> Disable Auto Narration <span class="glyphicon glyphicon-volume-off"></span></a>
				<% else %>
					<a href="{$EnableAudioLink}" class="btn narration"><i class="fa fa-volume-up" aria-hidden="true"></i> Enable Auto Narration <span class="glyphicon glyphicon-volume-up"></span></a>
				<% end_if %>
				</div>
		<% end_if %>
</div>