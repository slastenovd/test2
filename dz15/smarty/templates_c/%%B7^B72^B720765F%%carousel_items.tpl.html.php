<?php /* Smarty version 2.6.28, created on 2016-01-26 18:41:13
         compiled from carousel_items.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'carousel_items.tpl.html', 4, false),)), $this); ?>
<div class="item<?php if ($this->_tpl_vars['SliderItemNumber'] == 0): ?> active<?php endif; ?>">
    <img src="http://lorempixel.com/1170/300/<?php if ($this->_tpl_vars['SliderItemNumber'] == 0): ?>people<?php endif; ?><?php if ($this->_tpl_vars['SliderItemNumber'] == 1): ?>transport<?php endif; ?><?php if ($this->_tpl_vars['SliderItemNumber'] == 2): ?>cats<?php endif; ?>" alt="Image">
    <div class="carousel-caption">
        <a href='<?php echo $this->_tpl_vars['href_self']; ?>
?id=<?php echo $this->_tpl_vars['ad']->getId(); ?>
#NewAd'><h1 class='text-center'><?php echo ((is_array($_tmp=$this->_tpl_vars['CarouselMsg'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1></a>
    </div>
</div>