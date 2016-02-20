<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Hello';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Hello page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
    <h2>ARRAY</h2>
        
    <div>
        <ul>
            <?php foreach($arrayInView as $item):?>
            <li><?php echo $item?></li>
            <?php endforeach;?>
            
        </ul>
    
</div>
