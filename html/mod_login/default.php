<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>


<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-signin">

	
		
		<label for="inputUserName" class="sr-only"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
		<input id="inputUserName" type="text" name="username" class="form-control" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" required autofocus>
	
		<label for="inputPassword" class="sr-only"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
		<input id="inputPassword" type="password" name="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" required>
		

		<?php if (count($twofactormethods) > 1): ?>
		<div id="form-login-secretkey" class="control-group">
			<div class="controls">
				<?php if (!$params->get('usetext')) : ?>
					<div class="input-prepend input-append">
						<span class="add-on">
							<span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
							</span>
								<label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
							</label>
						</span>
						<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
						<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="icon-help"></span>
						</span>
				</div>
				<?php else: ?>
					<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
					<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
					<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
						<span class="icon-help"></span>
					</span>
				<?php endif; ?>

			</div>
		</div>
		<?php endif; ?>
		
		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="remember" value="yes"> <?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
			</label>
		</div>
		<?php endif; ?>
		
		<button class="btn btn-primary btn-block" type="submit" tabindex="0" name="Submit"><?php echo JText::_('JLOGIN') ?></button>
		

		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	

</form>

