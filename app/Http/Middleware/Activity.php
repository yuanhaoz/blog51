<?php
/**
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/16
 * Time: 16:43
 */

namespace App\Http\Middleware;
use Closure;

class Activity {
    public function handle($request, Closure $next){

        // 前置操作
//        if (time() > strtotime('2017-07-15')){
//            return redirect('activity0');
//        }
//        return $next($request);

        // 后置操作
        $response = $next($request);
        echo $response;
        echo '我是后置操作';

    }
}