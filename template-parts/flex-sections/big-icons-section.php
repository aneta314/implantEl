<?php

/**
 * Icons flex section
 * 
 * Renders an icons section, which is a collection of infographics,
 * most commonly about the clinic.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

//flex section content
$group = get_sub_field('group');
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';

?>
<div class="big-icons-section section-margin-bottom">
    <div class="container">
        <?php

        // DESC
        ?>
        <div class="icons-section__intro standard-format">
            <p><?php echo $group['desc']; ?></p>
        </div>
        <?php
        // REPEATER
        if ($group['icons']) : ?>
            <div class="row">
                <?php
                foreach ($group['icons'] as $infographic) : ?>
                    <div class="col-md-4">
                        <div class="infographic">
                            <?php $photo_id = $infographic['icon'];
                            if ($photo_id) : ?>
                                <div class="infographic__icon-wrapper">
                                    <?php echo wp_get_attachment_image($photo_id, '', true, array('class' => ' inject-me')); ?>
                                </div>
                            <?php
                            endif; ?>
                            <h6 class="infographic__title headline headline--xs center"><?php echo $infographic['title']; ?></h6>
                            <div class="infographic__desc standard-format">
                                <p class="center"><?php echo $infographic['desc']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
            </div>
        <?php
        endif; ?>
    </div>
</div>