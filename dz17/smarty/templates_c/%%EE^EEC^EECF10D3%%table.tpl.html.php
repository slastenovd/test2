<?php /* Smarty version 2.6.28, created on 2016-02-09 16:09:01
         compiled from table.tpl.html */ ?>
<table class="table table-striped" id="table-ads">
    <thead>
        <tr>
            <th style="display: none;">#</th>
            <th>Время и Дата</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $this->_tpl_vars['ads_rows']; ?>

    </tbody>
</table>