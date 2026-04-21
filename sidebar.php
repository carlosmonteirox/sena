<?php
/**
 * Sidebar template.
 *
 * @package sena
 */

if (! is_active_sidebar('primary-sidebar')) {
    return;
}
?>
<div class="sidebar-stack">
    <?php dynamic_sidebar('primary-sidebar'); ?>
</div>
