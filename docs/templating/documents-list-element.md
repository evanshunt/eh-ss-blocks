## Documents List Element Block with List of documents (links to file)

### Template Convention:

`EvansHunt/Elements/DocumentsListElement.ss`

### Document List Variables:

- `$Title`: Document List Element title
- `$ShowTitle`: Is the title displayed or not?
- `$Content`: Document List Element Copy/Content
- `$DisplayType`: Display type as List or Icons
- `$DocumentFiles`: List of Document Files

### Document File Variables:

- `$Title`: File title
- `$URL`: File path
- `$Extension`: File type extension
- `$Size`: File size

### Read more CTA LinkItem
```
<% with ReadMoreLink %>
  <a href="$Link" target="$Target">$Title</a>
<% end_with %>
```
