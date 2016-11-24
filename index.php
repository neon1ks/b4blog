<?php
/**
 * @package     Templates.b4blog
 *
 * @copyright   Copyright (c) 2016 Maksim Demyanov (neon1ks)
 * @license     MIT License; see LICENSE
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css');

// Use of Google Font
if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}

// Adjusting content width
if ($this->countModules('position-7'))
{
	$classMainWidth = 'col-xl-9 col-lg-9';
}
else
{
	$classMainWidth = 'col-xl-12 col-lg-12';
}

// Logo img file
if ($this->params->get('logoFile'))
{
	$logoImg = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" class="imgCenter" />';
}
else
{
	$logoImg = '<img src="' . $this->baseurl . '/templates/' . $this->template . '/images/logoImg.png' . '" alt="' . $sitename . '" class="imgCenter" />';
}

// Site title param
if ($this->params->get('sitetitle'))
{
	$siteTitle = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$siteTitle = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}

// Site description param
if ($this->params->get('sitedescription'))
{
	$siteDescription = '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>';
}
else
{
	$siteDescription = '<div class="site-description">Статьи про ОС Ubuntu. Языки программирования Си&nbsp;и&nbsp;C++<br>Инструменты разработки и многое другое.</div>';
}


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<jdoc:include type="head" />
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
	<div class="body">
		<div class="container">
			<div class="row">
				<!-- Header -->
				<header class="header" role="banner">
					<div class="col-xl-9 col-lg-9">
						<div class="row blog-outer">
							<div class="col-xl-3 col-lg-3 col-md-3 hidden-sm-down blog-inner">
								<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
									<?php echo $logoImg; ?>
								</a>
							</div>
							<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
									<p class="h1 site-name"><?php echo $siteTitle; ?> <sup class="tag tag-warning" style="font-size: 1rem; top: -1rem;">В разработке</sup></p>
								</a>
								<?php echo $siteDescription; ?>
							</div>
						</div>
					</div>
				</header>
			</div>
		</div>


		<?php if ($this->countModules('position-1')) : ?>
		<nav class="navbar navbar-light bg-faded">
			<div class="container">
				<button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse"
					data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				</button>
				<div class="collapse navbar-toggleable-sm" id="navbarResponsive">
					<jdoc:include type="modules" name="position-1" style="none" />
					<?php if ($this->countModules('position-0')) : ?>
						<jdoc:include type="modules" name="position-0" style="none" />
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<?php endif; ?>

		<div class="container md-center">
			<div class="row">
				<jdoc:include type="modules" name="banner" style="xhtml" />
			</div>
			<div class="row">
		
				<div class="<?php echo $classMainWidth; ?>">
					<main id="content" role="main" class="<?php echo $span; ?>">
						<!-- Begin Content -->
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="position-2" style="none" />
						<!-- End Content -->
					</main>
				</div>
				<?php if ($this->countModules('position-7')) : ?>
					<div class="col-xl-3 col-lg-3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container">
			<hr />
			<div class="blog-footer">
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#" id="back-top">
					<?php echo JText::_('TPL_B4BLOG_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				Copyright &copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>, <?php echo JText::_('TPL_B4BLOG_COPYRIGHT'); ?>
			</p>
			</div>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
