<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

$iTag = 0;
$nTag = 0;
foreach ($displayData as $i => $tag) :
	if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) :
		$nTag++;
	endif;
endforeach;

?>

<?php if (!empty($displayData)) : ?>
	<ul class="tags inline">
		<i class="fa fa-tag" aria-hidden="true"></i>
		<?php foreach ($displayData as $i => $tag) : ?>
			<?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
				<?php $iTag++ ?>
				<?php if ($iTag != $nTag): ?>
					<?php $tagParams = new Registry($tag->params); ?>
					<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
					<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>" class="<?php echo $link_class; ?>">
						<?php echo $this->escape($tag->title); ?></a><?php echo ', '; ?>
				<?php endif; ?>
				<?php if ($iTag == $nTag): ?>
					<?php $tagParams = new Registry($tag->params); ?>
					<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
					<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>" class="<?php echo $link_class; ?>">
						<?php echo $this->escape($tag->title); ?></a>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
