<?php
defined('_JEXEC') or die('Restricted access');

// First we do a reverse lookup of the articles in each category
$rlu = array();
foreach ($this->items as $i => $item) :
    if (!isset($rlu[$item->catid])) :
        $rlu[$item->catid] = array();
    endif;
    $rlu[$item->catid][] = &$this->items[$i];
endforeach;
?>

<?php if ($this->params->get('show_page_title', 1)) : ?>
<h1 class="componentheading<?php echo $this->params->get('pageclass_sfx');?>">
    <?php echo $this->escape($this->params->get('page_title')); ?>
</h1>
<?php endif; ?>
<div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ($this->params->get('show_description') && $this->section->description) : ?>
	<?php echo $this->section->description; ?>
<?php endif; ?>
</div>

<?php foreach ($this->categories as $category) : ?>
    <h2><?php echo $category->title;?></h2>
    <?php if ($category->description) : ?>
    <?php echo $category->description; ?>
    <?php endif; ?>
    <?php if (!empty($rlu[$category->id])) : ?>
    <ul class="toc">
        <?php foreach ($rlu[$category->id] as $article) : ?>
        <li>
            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug, $article->sectionid)); ?>">
                <?php echo $article->title; ?></a>
            <?php if ($article->access == 0) : ?>
                <small></small>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
<?php endforeach; ?>
