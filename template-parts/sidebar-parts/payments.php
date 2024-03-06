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
<div class="sidebar__item">
  <div class="doctors-carousel">
    <h5 class="headline headline--xs center"><?php pi_e('Płatność', 'pi'); ?></h5>

    <div class="standard-format">
      <p class="center"><?php pi_e('Oferujemy możliwość płatności przy pomocy kart debetowych VISA, Mastercard, płatności gotówką oraz dogodne finansowanie MediRaty.', 'pi'); ?> </p>

      <?php
      // btn only for single offer
      if(is_singular('offer')):
        $pricetables = detect_pricetables(get_the_ID());
        $permalink = get_the_permalink(83);
        if($pricetables):
          $permalink = '#cennik';
        endif; ?>

        <div class="d-flex justify-content-center mb-3">
          <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Cennik', 'pi'); ?> </a>
        </div> <?php
      endif; ?>
    </div>

  </div>
</div>
