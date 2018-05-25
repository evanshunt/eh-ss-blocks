<% if $ShowTitle %>$Title<% end_if %>
$Content <br />

Display Type: $DisplayType <br />

<% loop $DocumentFiles.Sort('Title') %>
  $Extension $Size <a href="$URL">$Title</a> <br />
<% end_loop %>

<% with ReadMoreLink %>
  <a href="$Link" target="$Target">$Title</a>
<% end_with %>

