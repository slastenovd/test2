<?php /* Smarty version 2.6.28, created on 2016-02-07 20:57:06
         compiled from table_row.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'table_row.tpl.html', 3, false),array('modifier', 'escape', 'table_row.tpl.html', 4, false),)), $this); ?>
<tr>
    <td style="display: none;"><?php echo $this->_tpl_vars['ad']->getId(); ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->getDate_change())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M %d.%m.%Y") : smarty_modifier_date_format($_tmp, "%H:%M %d.%m.%Y")); ?>
</td>
    <td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?id=<?php echo $this->_tpl_vars['ad']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->getPrice())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 руб.</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->getSeller_name())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ad']->getPhone())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
    <!--<td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?del_id=<?php echo $this->_tpl_vars['ad']->getId; ?>
">удалить</a></td>-->
    <td><a class="delete btn btn-warning"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
</tr>