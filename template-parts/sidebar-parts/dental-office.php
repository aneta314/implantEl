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
<div class="sidebar__item">
    <div class="sidebar__item--office">
        <h5 class="headline headline--xs"><?php pi_e('Nasz gabinet', 'pi'); ?></h5>

        <?php
        $sidebar_group = get_field('sidebar_group', 'options');
        $gabinet = $sidebar_group['gabinet_zdjecie'];

        $blog_about = get_field('blog_about', 'options');
        //var_dump($blog_about);
        $permalink = get_the_permalink(1177);

        if ($gabinet) :
            //$gabinet = $sidebar_group['zdjecie_gabinet'];
        ?>
            <div class="sidebar__office">
                <?php wp_get_attachment_image($gabinet, 'mobile', false, array('class' => 'sidebar_img')); ?>
            </div>

        <?php endif; ?>

        <?php if ($blog_about) : ?>
            <p>
                <php echo $blog_about ; ?>
            </p>
        <?php endif; ?>

        <div class="standard-format">

            <div class="d-flex mb-3">
                <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Więcej o nas', 'pi'); ?> </a>
            </div>
        </div>

    </div>
</div>