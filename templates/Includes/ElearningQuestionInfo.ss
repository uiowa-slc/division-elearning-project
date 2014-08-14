<% if $AdditionalInformation || $QuestionAudioClip %>
	<div class="well caption-nav">
		<% if $AdditionalInformation %>
			$AdditionalInformation<hr />
		<% end_if %>
		<% if $QuestionAudioClip %>
			<audio src="$QuestionAudioClip.Filename" controls="controls" <% if $isAudioEnabled %>autoplay<% end_if %>></audio>
		<% end_if %>
	</div>
<% end_if %>