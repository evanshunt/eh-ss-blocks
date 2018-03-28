<div class="col-12 col-sm-6 col-md-4 text-center bucket-w-icon">
    <div class="bucket-content">

    $Image

    <% if $ShowTitle %>
        <h3 class="bucket-title">$Title</h3>
    <% end_if %>

    $Copy
    </div><!-- /.bucket-content -->


    <% with CTA %>
        <% if $LinkType %>
            <a href="$Link" target="$Target" class="btn blue-btn">$Title</a>
        <% end_if %>
    <% end_with %>

</div>
