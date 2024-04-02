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
$sidebar_group = $args['sidebar_group'] ?? null;
?>
<div class="sidebar__item">
    <div class="sidebar__item--office">
        <h5 class="headline headline--xs"><?php pi_e('Gabinet', 'pi'); ?></h5>

        <?php
        // $sidebar_group = get_field('sidebar_group', 'options');

        $gabinet = $sidebar_group['gabinet'];
        //var_dump($gabinet);
        if ($sidebar_group) : ?>
            <div class="sidebar__office">

            </div>
        <?php endif; ?>
        <div class="standard-format">

            <div class="d-flex justify-content-center mb-3">
                <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Cennik', 'pi'); ?> </a>
            </div>
        </div>

    </div>
</div>