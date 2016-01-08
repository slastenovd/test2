<?php /* Smarty version 2.6.28, created on 2016-01-08 11:29:58
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'index.tpl', 8, false),array('modifier', 'date_format', 'index.tpl', 41, false),array('function', 'mailto', 'index.tpl', 35, false),array('function', 'html_options', 'index.tpl', 61, false),array('function', 'html_table', 'index.tpl', 63, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header_template']).".tpl", 'smarty_include_vars' => array('var1' => '2014')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<?php $this->assign('time', '555'); ?>

    привет, <?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 ,как дела

<?php if ($this->_tpl_vars['name'] == 'Антон'): ?>
  Мое имя Антон
  <?php else: ?>
      Мое имя Не Антон
      <?php endif; ?>

<br>
            

Текушее время: <?php echo $this->_tpl_vars['time']; ?>

<br>
Server name: <?php echo $_SERVER['SERVER_NAME']; ?>
 
<h3><a href="<?php echo $this->_tpl_vars['href_self']; ?>
">Подать новое объявление</a></h3>


<br>
<?php if (isset ( $_GET['id'] )): ?>
Get: <?php echo $_GET['id']; ?>
 <?php else: ?>
    not get
<?php endif; ?>   
<br>
Name: <?php echo $this->_tpl_vars['names']['first']; ?>
, <?php echo $this->_tpl_vars['names'][1]; ?>

<br>
<?php echo smarty_function_mailto(array('address' => 'smarty@example.com'), $this);?>

<br>
Operation: <?php echo $this->_tpl_vars['raz']*$this->_tpl_vars['dva']; ?>

<br>
Home phone: <?php echo $this->_tpl_vars['Contacts']['fax']; ?>

<br>
Time: <?php echo ((is_array($_tmp=$this->_tpl_vars['raz'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>


<ul>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['href'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['href']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['myId'] => $this->_tpl_vars['i']):
        $this->_foreach['href']['iteration']++;
?>    <li><a href="item.php?id=<?php echo $this->_tpl_vars['myId']; ?>
"><?php echo $this->_tpl_vars['i']['no']; ?>
: <?php echo $this->_tpl_vars['i']['label']; ?>
 | <?php echo $this->_foreach['href']['iteration']; ?>
 | <?php echo ($this->_foreach['href']['iteration'] == $this->_foreach['href']['total']); ?>
</a></li>
<?php endforeach; else: ?> Ничего не найдено
<?php endif; unset($_from); ?>

</ul>

<?php 

   // global $not_smarty;
   // echo $not_smarty;

  //  $file = file_get_contents('http://weather.ru');
  //  echo $file;

 ?>

<?php echo smarty_function_html_options(array('name' => 'customer_id','options' => $this->_tpl_vars['cust_options'],'selected' => $this->_tpl_vars['customer_id']), $this);?>


<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data']), $this);?>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => 4,'table_attr' => 'border="0"'), $this);?>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => "first,second,third,fourth",'tr_attr' => $this->_tpl_vars['tr']), $this);?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>