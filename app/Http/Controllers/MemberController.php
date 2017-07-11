<?php
/**
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/7
 * Time: 19:23
 */
namespace App\Http\Controllers;

use App\Member;

class MemberController extends Controller {

    public function info($id) {

//        return 'member-info-id-' . $id;

//        return Route('memberinfo');

//        return view('member/memberInfo');

//        return view('member/memberTest', [
//            'name' => 'zhengyuanhao',
//            'age' => '24'
//        ]);
        return Member::getMember();

    }

}