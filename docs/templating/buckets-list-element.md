## Buckets List Element Block

This is extended ElementList Block with additional fields for content and background class/colour


This element list is only holding buckets elements at this time.

TO DO!!! To review if hide Elemental List element as those are basically the same, this one has 2 more fields
TO DO!!! disallowed_elements: DNADesign\ElementalList\Model\ElementList in elements.yml?

### Template Convention:

`EvansHunt/Elements/BucketsListElement.ss`

### Variables:

- `$Title`: Document List Element title
- `$ShowTitle`: Is the title displayed or not?
- `$Content`: Buckets List Element Copy/Content
- `$BackgroundClass`: Background class name from yml configuration - lowercase
- `$Elements`: Child elements, buckets

### BackgroundClass configuration in application elements.yml file:

```
EvansHunt\Elements\BucketsListElement:
  - White
  - Dark
  - Light
  - Your Class
  - Another Class
```
