<?php

namespace app\models;
class MyList extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'list';
    }
    public static function getAll(){
        $array = [
            1=>'Первый',
            2=>'Второй',
            3=>'Третий'
        ];
        
        return $array;
    }
    
}