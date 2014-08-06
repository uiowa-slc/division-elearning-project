<li class="<% if $LinkOrCurrent = "current" %>active<% end_if %> $CompletionStatus">
	<% if $CompletionStatus %>
	<a href="$Link"><% if $CompletionStatus == "completed" %><span class="glyphicon glyphicon-ok"></span><% end_if %><% if $IntroductionTitle %>$IntroductionTitle<% else %>$MenuTitle<% end_if %></a>
	<% else %>
	<span class="inactive"><% if $IntroductionTitle %>$IntroductionTitle<% else %>$MenuTitle<% end_if %></span>
	<% end_if %>
</li>