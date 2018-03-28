<section class="half-and-half">
    <div class="row">
        <div class="one-half col-lg-6" style="background-image: url($LeftBackground.URL);">
            <div class="centred-content-block">
                <div>
                    <h2 class="content-title light-title">$LeftTitle</h2>
                    $LeftCopy
                </div>

                <% if $LeftCTA.Link %>
                    <% with LeftCTA %>
                        <a href="$Link" target="$Target" class="btn white-btn">$Title</a>
                    <% end_with %>
                <% end_if %>
            </div><!-- /.centered-content-block -->
        </div><!-- /.col-6 -->
        <div class="one-half col-lg-6" style="background-image: url($RightBackground.URL);">
            <div class="centred-content-block">
                <div>
                    <h2 class="content-title light-title">$RightTitle</h2>
                    $RightCopy
                </div>
                <% if $RightCTA.Link %>
                    <% with RightCTA %>
                        <a href="$Link" target="$Target" class="btn white-btn">$Title</a>
                    <% end_with %>
                <% end_if %>
            </div><!-- /.centered-content-block -->
        </div><!-- /.col-6 -->
    </div><!-- /.row -->
</section><!-- /.half-and-half -->
