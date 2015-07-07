<!DOCTYPE HTML>
<html>
<head>
     <title><?=$seo_title;?></title>
     <?=$this->layouts->print_styles();?>
     <?=$this->layouts->print_scripts();?>
</head>
<body>
     <header>
       <nav class="top-nav">
         <div class="container">
           <div class="nav-wrapper">
             <a class="page-title"><?=$page_title;?></a>
           </div>
         </div>
       </nav>
       <div class="container">
         <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
           <i class="mdi-navigation-menu"></i>
         </a>
       </div>
       <?=$this->layouts->print_menu(null, null, 0, '<div id="menu">', '</div>'); ?>
     </header>

     <main>
          <div id="content" class="container">
               <?=$content;?>
          </div>
     </main>
</body>
</html>
