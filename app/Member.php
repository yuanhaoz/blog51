<?php
/**
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/10
 * Time: 11:35
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    public static function getMember(){
        return 'This is the getMember() method of Member Class';
    }

}