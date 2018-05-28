## Bucket Element Block

This element is only available inside a list element.

### Template Convention:

`EvansHunt/Elements/BucketElement.ss`

### Variables:

- `$Image`: Icon or image within content bucket
- `$Title`: Bucket title
- `$Copy`: Bucket content

### CTA LinkItem
```
<% with CTALink %>
  <a href="$Link" target="$Target">$Title</a>
<% end_with %>
```