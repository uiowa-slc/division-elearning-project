				<li class="<% if $LinkOrCurrent = "current" %>active<% end_if %> <% if $IsCompleted %>complete<% end_if %>">
					<% if $IsCompleted %>
					<a href="$Link">$MenuTitle</a>
					<% else %>
					<span>$MenuTitle</span>
					<% end_if %>
				</li>