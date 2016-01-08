<?php /* Smarty version 2.6.28, created on 2016-01-07 16:49:08
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header_template']).".tpl", 'smarty_include_vars' => array('var1' => 2014)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
Привет, <?php echo $this->_tpl_vars['name']; ?>
 как дела
<br>
<?php echo $this->_tpl_vars['items']['23']['no']; ?>


<ul>
    <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['href'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['href']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['myId'] => $this->_tpl_vars['i']):
        $this->_foreach['href']['iteration']++;
?>
    
        <li><a href="item.php?id=<?php echo $this->_tpl_vars['myId']; ?>
"><?php echo $this->_tpl_vars['i']['no']; ?>
 : <?php echo $this->_tpl_vars['i']['label']; ?>
 | <?php echo ($this->_foreach['href']['iteration']-1); ?>
 | <?php echo ($this->_foreach['href']['iteration'] == $this->_foreach['href']['total']); ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
    
</ul>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>