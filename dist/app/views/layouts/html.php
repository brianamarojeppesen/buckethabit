<!DOCTYPE HTML>
<html>
<head>
     <title><?=$seo_title;?></title>
     <?=$this->layouts->print_styles();?>
     <?=$this->layouts->print_scripts();?>
</head>
<body>
     <header>
          <h1 id="site_title" class="site_title"><?=$site_title;?></h1>
          <?=$this->layouts->print_menu(null, null, 0, '<div id="menu">', '</div>'); ?>
     </header>

     <section id="body" class="body">
          <h2 id="page_title" class="page_title"><?=$page_title;?></h2>
          <div id="content" class="content">
               <?=$content;?>
          </div>
     </section>
</body>
</html>
