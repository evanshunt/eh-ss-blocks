## Image Carousel Element Block with Carousel Items

### Template Convention:

`Elements/ImageCarouselElement.ss`

### Carousel Variables:

- `$Title`: Carousel Element title
- `$ShowTitle`: Is the title displayed or not?
- `$Copy`: Carousel Element Copy
- `$ImageCarouselItems`: List of Carousel Items

### Carousel Item Variables:

- `$Title`: Carousel Item title
- `$SlideImage`: Image for carousel display
- `$Content`: Content for carousel display

### Slick configuration
You can use slick configuration parameters within yml configuration file (see example below).
All parameters should be supported: <a href="http://kenwheeler.github.io/slick#settings" target="_blank">http://kenwheeler.github.io/slick</a>

```
EvansHunt\Elements\ImageCarouselElement:
  image_carousel_options:
    fade: true
    speed: 100
```