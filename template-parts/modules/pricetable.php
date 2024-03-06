<?php 
/**
 * Pricetable module
 * 
 * Generates a pricetable based on the provided array. Implementation depends on the project needs,
 * but generally it's a table of procedure-price pairs, with optional old price and subservices.
 * Used by a pricelist section.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//array of pricetable data 
$pricetable = $args['pricetable']; ?>

<!-- TABLE -->
<div class="pricetable">
  <?php
  foreach($pricetable as $row): ?>
    <div class="pricetable__row">
      <div class="pricetable__service">
        <p class="pricetable__service__title"><?php echo $row['service']; ?></p>
        <?php if($row['service_desc']): ?>
          <p class="pricetable__service__desc"><?php echo $row['service_desc']; ?></p>
        <?php endif; ?>
      </div>
      <div class="pricetable__price">
        <?php $old_price = $row['price_old'];
        if($old_price): ?>
          <span class="pricetable__price__old"><?php echo $old_price; ?></span> <br>
        <?php endif; ?>
        <?php echo $row['price']; ?>
      </div>
      <!-- SUB SERVICES -->
      <?php
      if($row['services']): ?>
        <div class="pricetable__sub-row">
          <?php
          foreach($row['services'] as $sub_row): ?>
            <div class="pricetable__service">
              <?php echo $sub_row['service']; ?>
            </div>
            <div class="pricetable__price">
              <?php echo $sub_row['price']; ?>
            </div>
          <?php
          endforeach; ?>
        </div>
        <?php
      endif; ?>
      <!-- END SUB SERVICES -->
    </div>
  <?php
  endforeach; ?>
</div>
