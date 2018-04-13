<% require javascript("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js") %>
<% require css("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css") %>
<% require css("//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css") %>

<% if $CarouselItems.Count %>
  <div class="element-carousel">
    <%loop $CarouselItems %>
      <div class="element-carousel-item carousel-item-$Pos">
        <div class="carousel-item-left">
          <div class="carousel-item-image">$ImageLeft</div>
          <div class="carousel-item-title">$Title</div>
          <div class="carousel-item-content">$Content</div>
        </div>
        <div class="carousel-item-right">
          <div class="carousel-item-image">$ImageRight</div>
          <div class="carousel-item-content">$AdditionalContent</div>
        </div>
      </div>
    <% end_loop %>
  </div>
<% end_if %>

<script>
  var jq = jQuery.noConflict();
  jq(document).ready(function(){
    jq('.element-carousel').slick({
      autoplay: true
    });
  });
</script>