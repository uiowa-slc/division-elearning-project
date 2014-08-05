				<li class="<% if $LinkOrCurrent = "current" %>active<% end_if %> $CompletionStatus">
					<% if $CompletionStatus %>
					<a href="$Link">$MenuTitle<% if $CompletionStatus == "completed" %><span class="glyphicon glyphicon-ok"></span><% end_if %></a>
					<% else %>
					<span class="inactive">$MenuTitle</span>
					<% end_if %>
				</li>