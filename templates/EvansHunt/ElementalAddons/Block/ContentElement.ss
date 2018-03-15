<% if $Background %>
    <section class="image-behind-content-block" style="background-image: url($Background.URL);">
        <div class="container">
            <% if $ShowTitle %>
            <h2 class="content-title light-title">$Title</h2>
            <% end_if %>

            $Copy

            <%-- Add a CallToActionLink if available --%>
            <% with $CTA %>
                <% if $LinkType %>
                <a href="$Link" class="btn blue-btn mt-5"
                    <% if $Target %>target="$Target"<% end_if %>
                    <% if $Title %>title="$Title"<% end_if %>>
                    $Title
                    <% if $LinkType == "file" %><i class="icon icon-download-report"></i><% end_if %>
                </a>
                <% end_if %>
            <% end_with %>
        </div><!-- /.block-content -->
    </section><!-- /.image-behind-content-block -->

<% else %>

    <section class="block-wrapper">
        <div class="container">
            <div class="row centred-content-block justify-content-center">
                <div class="col">
                    <% if $ShowTitle %>
                    <h2 class="content-title dark-title">$Title</h2>
                    <% end_if %>

                    $Copy

                    <%-- Add a CallToActionLink if available --%>
                    <% with $CTA %>
                        <% if $LinkType %>
                        <a href="$Link" class="btn blue-btn mt-5"
                            <% if $Target %>target="$Target"<% end_if %>
                            <% if $Title %>title="$Title"<% end_if %>>
                            $Title
                            <% if $LinkType == "file" %><i class="icon icon-download-report"></i><% end_if %>
                        </a>
                        <% end_if %>
                    <% end_with %>
                </div>
            </div><!-- /.centered-content-block -->
        </div><!-- /.container -->
    </section>
<% end_if %>
