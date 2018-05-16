## Carousel Element Block with Carousel Items

### Template Convention:

`EvansHunt/Elements/CarouselElement.ss`

### Carousel Variables:

- `$Title`: Carousel Element title
- `$ShowTitle`: Is the title displayed or not?
- `$Copy`: Carousel Element Copy
- `$CarouselItems`: List of Carousel Items

### Carousel Item Variables:

- `$Title`: Carousel Item title
- `$SlideImage`: Image for carousel display
- `$Content`: Content for carousel display

### Slick configuration
You can use slick configuration parameters within yml configuration file (see example below).
All parameters should be supported: <a href="http://kenwheeler.github.io/slick#settings" target="_blank">http://kenwheeler.github.io/slick</a>

```
EvansHunt\Elements\CarouselElement:
  slick_options:
    fade: true
    speed: 100
```