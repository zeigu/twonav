<?php
    require_once View::getView('module');
    $adminInfo = $DATA->getAdminInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <title><?php echo $webTitle; ?></title>
  <meta name="keywords" content="<?php echo $webKeywords; ?>">
  <meta name="description" content="<?php echo $webDescription; ?>">
  <link rel="shortcut icon" type="images/x-icon" href="<?php echo OZDAO_URL; ?>favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="<?php echo OZDAO_URL; ?>assets/css/font-awesome-4.7.0/css/font-awesome.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo OZDAO_URL; ?>assets/css/ozui.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo OZDAO_URL; ?>assets/layer/css/layui.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/style.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>css/dhcat.css"/>
</head>
 <body>
<header class="header <?php echo Page::isHome() ? '' : 'fixed'; ?>">
  <div class="container">
    <div class="nav-bar">
      <span></span>
    </div>
    <a class="logo" href="<?php echo OZDAO_URL; ?>">
      <img src="<?php echo IMAGES_URL; ?>logo.png" alt="<?php echo $CONFIG['name']; ?>">
    </a>
    <ul class="nav">
        <?php
            $navs = $DATA->getNavs();
            foreach($navs as $nav) { ?>
              <li>
                <a href="<?php echo $nav['url']; ?>" <?php echo $nav['newTab'] == 1 ? ' target="_blank"' : ''; ?>>
                  <i class="<?php echo $nav['icon']; ?>"></i> <?php echo $nav['name']; ?>
                </a>
              </li>
            <?php } ?>
    </ul>
  </div>
</header>