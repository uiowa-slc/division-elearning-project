				<li class="<% if $LinkOrCurrent = "current" %>active<% end_if %> $CompletionStatus">
					<% if $CompletionStatus %>
					<a href="$Link">$MenuTitle</a>
					<% else %>
					<span>$MenuTitle</span>
					<% end_if %>
				</li>