<?
/**
 * Todo - a Joomla example extension built with Nooku Framework.
 *
 * @package     Todo
 * @copyright   Copyright (C) 2011 - 2014 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/joomla-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>

<? // No items message ?>
<? if ($total == 0): ?>
    <p class="alert alert-info">
        <?= translate('You do not have any items yet.'); ?>
    </p>
<? else: ?>

<div class="koowa mod_todo mod_todo--items">
    <ul>
    <? foreach ($items as $item): ?>
        <li class="module_item">

            <p class="koowa_header">
                <? // Header title ?>
                <span class="koowa_header__item">
                    <a href="<?= route('option=com_todo&view=item&id='.$item->id); ?>"
                       class="koowa_header__title_link"
                       data-title="<?= escape($item->title); ?>"
                       data-id="<?= $item->id; ?>">
                        <?= escape($item->title);?></a>

                </span>
            </p>


            <p class="module_item__info">

                <? // Created ?>
                <? if ($module->params->show_created): ?>
                <span class="module_item__date">
                    <?= helper('date.format', array('date' => $item->created_on)); ?>
                </span>
                <? endif; ?>
            </p>
        </li>
    <? endforeach; ?>
    </ul>
</div>

<? endif; ?>