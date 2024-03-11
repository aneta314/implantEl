<?php

/**
 * Text section
 * 
 * Renders a text section. This section is flexible with optional image in a side-by-side layout,
 * with an option to position the image before or after the text.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */
//flex section data
$group = get_sub_field('group');
$layout = $group['layout'];
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
$class = $group['class'];
$col_class = 'col';

//layout, width, positioning etc determines the classes that will be used on the wrappers
if ($layout == 'photo-left') {
    $col_class = 'col-lg-7';
} elseif ($layout == 'photo-right') {
    $col_class = 'col-lg-7 order-lg-2';
} ?>

<div class="text-section <?php echo $class; ?> text-section-cta section-margin-bottom">
    <div class="container container-text-section-cta">
        <div class="row">
            <?php
            // COL PHOTO
            if ($layout != 'simple') : ?>
                <div class="<?php echo $col_class; ?>">
                    <div class="row">
                        <?php
                        if ($group['photo']) :
                            echo wp_get_attachment_image($group['photo'], 'hd', false, array('class' => 'text-section__photo', 'loading' => 'lazy'));
                        endif; ?>
                        <?php
                        if ($group['photo_2']) :
                            echo wp_get_attachment_image($group['photo_2'], 'hd', false, array('class' => 'text-section__photo', 'loading' => 'lazy'));
                        endif; ?>
                    </div>
                </div>
            <?php
            endif;

            // COL CONTENT
            ?>
            <div class="col col-text">
                <?php
                // INTRO
                if ($intro) : ?>
                    <p class="intro"><?php echo $intro; ?></p>
                <?php
                endif;

                // TITLE
                if ($title) :
                    echo '<' . $markup . ' class="headline">' . $title . '</' . $markup . '>';
                endif;

                // TEXT EDITOR
                ?>
                <div class="standard-format standard-format--post"><?php echo $group['content']; ?></div>
            </div>
        </div>
    </div>
</div>