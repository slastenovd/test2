<?php /* Smarty version 2.6.28, created on 2016-01-24 19:47:20
         compiled from table.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'table.tpl.html', 17, false),array('modifier', 'escape', 'table.tpl.html', 18, false),)), $this); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Время и Дата</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Действие</th>
        </tr>
    </thead>

    <?php $_from = $this->_tpl_vars['ads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foreach_ads'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_ads']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['foreach_ads']['iteration']++;
?>
        <tr>
            <td><?php echo ($this->_foreach['foreach_ads']['iteration']-1)+1; ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->date_change)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S %d.%m.%Y") : smarty_modifier_date_format($_tmp, "%H:%M:%S %d.%m.%Y")); ?>
</td>
            <td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?id=<?php echo $this->_tpl_vars['k']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->title)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->price)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 руб.</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->seller_name)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['v']->phone)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
            <td><a href="<?php echo $this->_tpl_vars['href_self']; ?>
?del_id=<?php echo $this->_tpl_vars['k']; ?>
">удалить</a></td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>        
</table>