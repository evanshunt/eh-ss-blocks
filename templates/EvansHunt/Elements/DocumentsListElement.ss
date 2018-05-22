<% if $ShowTitle %>$Title<% end_if %>
$Content

<% loop $DocumentFiles.Sort('Title') %>
  $Extension $Size <a href="$URL">$Title</a> <br />
<% end_loop %>

