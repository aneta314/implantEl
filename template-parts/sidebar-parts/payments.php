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
 * @todo wrong wrapper class?
 */
?>
<div class="sidebar__item d-none d-lg-block">
  <div class="sidebar__item--payments">
    <h5 class="headline headline--xs"><?php pi_e('Rodzaje płatności', 'pi'); ?></h5>

    <?php
    $sidebar_group = get_field('sidebar_group', 'options');
    $payments = $sidebar_group['payments'];
    if ($sidebar_group) : ?>
      <div class="sidebar__payments">
        <?php foreach ($payments as $payment) : ?>
          <?php
          if ($payment) :
            echo wp_get_attachment_image($payment['img'], 'hd', false, array('class' => 'payments-img'));
          endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <div class="standard-format">
      <p class=""><?php pi_e('Przyjmujemy płatności gotówką, kartą (również zbliżeniowo) oraz BLIKiem. Oferujemy również usługi kredytowe poprzez MediRaty. Ceny każdego zabiegu ustalane są indywidualnie. By poznać orientacyjne ceny, zapraszamy do podstrony cennik. ', 'pi'); ?> </p>

      <?php
      // btn only for single offer
      if (is_singular('offer')) :
        $pricetables = detect_pricetables(get_the_ID());
        $permalink = get_the_permalink(83);
        if ($pricetables) :
          $permalink = '#cennik';
        endif; ?>

        <div class="d-flex mb-3">
          <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Zobacz cennik', 'pi'); ?> </a>
        </div> <?php
              endif; ?>
    </div>

  </div>
</div>