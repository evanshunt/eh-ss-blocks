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
- `$ImageLeft` & `$ImageRight`: Left and Right image for carousel display
- `$ContentLeft` & `$ContentRight`: Content for Left and Right carousel display

### Default CarouselElement.ss implementation

```html

<% require javascript("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js") %>
<% require css("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css") %>
<% require css("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css") %>

<% if $CarouselItems.Count %>
  <div class="carousel-element">
    <%loop $CarouselItems %>
      <div class="carousel-item carousel-item-$Pos">
        <div class="carousel-item-left">
          <div class="carousel-item-image">$ImageLeft</div>
          <div class="carousel-item-title">$Title</div>
          <div class="carousel-item-content">$ContentLeft</div>
        </div>
        <div class="carousel-item-right">
          <div class="carousel-item-image">$ImageRight</div>
          <div class="carousel-item-content">$ContentRight</div>
        </div>
      </div>
    <% end_loop %>
  </div>
<% end_if %>

```

