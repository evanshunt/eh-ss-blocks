<% if $ImageCarouselItems.Count %>
    $loadCarouselRequirements
    <section class="image-carousel">
        <div class="carousel-items">
        <% loop $ImageCarouselItems %>
            <div class="carousel-item carousel-item-$Pos">
            <div class="carousel-item-image">$SlideImage</div>
            <h3 class="carousel-item-title">$Title</h3>
            <div class="carousel-item-content">$Content</div>
            </div><!-- /.carousel-item -->
        <% end_loop %>
        </div><!-- /.carousel-items -->
    </section><!-- /.image-carousel -->
<% end_if %>