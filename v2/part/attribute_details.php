<?php BeginForm(); ?>

<?php AddTextBox($row, 'attribute', 'Attribut', ''); ?>

<div class="checkbox">
  <label>
    <input type=checkbox name="for_contact" <?php echo (strcasecmp($row["for_contact"], '1') == 0 ? 'checked' : ''); ?>>
    Attribut contact
  </label>
</div>

<div class="checkbox">
  <label>
    <input type=checkbox name="for_company" <?php echo (strcasecmp($row["for_company"], '1') == 0 ? 'checked' : ''); ?>>
    Attribut entreprise
  </label>
</div>
<?php EndForm(); ?>
