<?php
// @section Text Content
// -----------------------------------------------------------------------------
// table (table)
// =============================================================================
//
// @styles _table.scss
//
// Section variables
// =============================================================================
$table_heading = get_sub_field('table_heading');
$heading_styles_in_left_column = get_sub_field('heading_styles_in_left_column');
$table = get_sub_field('table');
?>
<section class="table content-typography">


<?php if (! empty($table_heading)) : ?><h2 class="table-heading"><?php echo $table_heading; ?></h2><?php endif; ?>

<div class="table-wrapper">
  <?php if (! empty($table)) : ?>
    <table class="table__wrapper js-table<?php if ($heading_styles_in_left_column == 'yes') { echo ' left-column-as-header'; } ?>" cellspacing="0" cellpadding="0">

      <?php if ($table['header']) : ?>
        <thead class="table__thead">
          <tr>
	  <?php foreach ($table['header'] as $th) : ?>
            <th colspan="<?php echo count($table['header']); ?>"><?php echo $th['c']; ?></th>
	  <?php endforeach; ?>
          </tr>
        </thead>
      <?php endif; ?>

      <tbody>

        <?php foreach ($table['body'] as $tr) : ?>
          <tr>

            <?php foreach ($tr as $td) : ?>
              <td colspan="<?php echo count($table['header']); ?>"><?php echo $td['c']; ?></td>
            <?php endforeach; ?>

          </tr>
        <?php endforeach; ?>

      </tbody>

    </table>
  <?php endif; ?>
  </div>
</section>
