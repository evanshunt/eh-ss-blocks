
test here: $slickOptionsJs

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

<script>
  var jq = jQuery.noConflict();
  jq(document).ready(function(){
  alert(GLOBAL_SLICK_OPTIONS);
    jq('.carousel-element').slick({
      autoplay: true
    });
  });
</script>