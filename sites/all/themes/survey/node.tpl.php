<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>

<!----------- begin post --------------------------->
<div class="row node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>">

    <div class="col-md-6">

        <?php print render($title_prefix); ?>

        <?php if (!$page && $title): ?>
            <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>

            <?php if ($display_submitted): ?>
                <p class="submitted">
                    <?php // print $user_picture; ?>
                    <small><?php print $submitted; ?></small>
                </p>
            <?php endif; ?>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php print $content_src ?>

        <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);

        print render($content);
        ?>

        <?php // print render($content['links']); ?>

        <br />
        <!--
        <small><a href="">share</a> <a href="">save</a> <a href="">report</a></small>

        <div>
            <div class="row">
                <div class="col-md-4">
                    <a href="#"><img width="105px" src="img/placeholder_similarThumb.jpg" /></a>
                </div>

                <div class="col-md-4">
                    <a href="#"><img width="105px" src="img/placeholder_similarThumb2.jpg" /></a>
                </div>

                <div class="col-md-4">
                    <a href="#"><img width="105px" src="img/placeholder_similarThumb3.gif" /></a>
                </div>
            </div>
        </div>
        -->
    </div>

    <div class="col-md-6">
        <!--
        <div class="btn-group btn-group-xs">
            <button type="button" class="btn btn-default active">Top</button>
            <button type="button" class="btn btn-default">Newest</button>
            <button type="button" class="btn btn-default">Facebook</button>
        </div>
        -->

        <?php print render($content['comments']); ?>
    </div>

</div><!-- level 2 -->

<hr />

<!------------------------------------- end post ----------------------------------------------->
