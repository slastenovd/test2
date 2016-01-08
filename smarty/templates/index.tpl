{include file="$header_template.tpl" var1='2014'}


{* индексный шаблон *}

{assign var=time value='555'}

привет, {$name|upper} ,как дела

{if $name eq 'Антон'}
  Мое имя Антон
  {else}
      Мое имя Не Антон
      {/if}

<br>
Текушее время: {$time}
<br>
Server name: {$smarty.server.SERVER_NAME} {* $_SERVER['SERVER_NAME'] *}
<br>
{if isset($smarty.get.id)}
Get: {$smarty.get.id} {* $_GET['id'] *}
{else}
    not get
{/if}   
<br>
Name: {$names.first}, {$names[1]}
<br>
{mailto address='smarty@example.com'}
<br>
Operation: {$raz*$dva}
<br>
Home phone: {$Contacts.fax}
<br>
Time: {$raz|date_format:"%d.%m.%Y"}

<ul>
{foreach from=$items key=myId item=i name='href'}  {* foreach($items as $myId => $i)*}
  <li><a href="item.php?id={$myId}">{$i.no}: {$i.label} | {$smarty.foreach.href.iteration} | {$smarty.foreach.href.last}</a></li>
{foreachelse} Ничего не найдено
{/foreach}

</ul>

{php}

   // global $not_smarty;
   // echo $not_smarty;

  //  $file = file_get_contents('http://weather.ru');
  //  echo $file;

{/php}

{html_options name=customer_id options=$cust_options selected=$customer_id}

{html_table loop=$data}
{html_table loop=$data cols=4 table_attr='border="0"'}
{html_table loop=$data cols="first,second,third,fourth" tr_attr=$tr}


{include file='footer.tpl'}