<?php

/**
 * 'Payments' sidebar element
 * 
 * Sidebar part that renders info about payment methods inside the clinic.
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 * 
 */
//$sidebar_group = $args['sidebar_group'] ?? null;
?>
<div class="sidebar__item dental-office">
    <div class="sidebar__item--office">
        <h5 class="headline headline--xs"><?php pi_e('Nasz gabinet', 'pi'); ?></h5>

        <?php
        $sidebar_group = get_field('sidebar_group', 'options');
        $gabinet = $sidebar_group['gabinet_zdjecie'];
        $about = get_field('blog_about', 'options');
        $permalink = get_the_permalink(1177); ?>
        <div class="row">
            <?php if ($gabinet) :
            ?>

                <div class="sidebar__office col-lg-4">
                    <img src="<?php echo wp_get_attachment_image_url($gabinet, 'hd'); ?>" class="sidebar_img" alt="Zdjęcie gabinetu">
                </div>

            <?php endif;
            ?>

            <?php if ($about) :
            ?>
                <div class="sidebar__about col-lg-8">
                    <div class="standard-format"> <?php echo $about; ?></div>
                </div>
            <?php endif;
            ?>
        </div>

        <div class="standard-format">

            <div class="d-flex mb-3">
                <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Więcej o nas', 'pi'); ?> </a>
            </div>
        </div>

    </div>
</div>