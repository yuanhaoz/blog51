<?php
/**
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/10
 * Time: 12:59
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller{

    /**
     * 使用DB facedes实现CURD
     */
    public function test1() {

//        添加数据
//        $bool = DB::insert('insert into student (name, age) values (?, ?)', ['mooc', 19]);
//        var_dump($bool);

//        修改数据
//        $num = DB::update('update student set age = ? where name = ?', [20, 'sean']);
//        var_dump($num);

        // 查找数据
        $students = DB::select('select * from student where id > ?', [1]);
//        var_dump($students);
        dd($students);

//        删除数据
//        $num1 = DB::delete('delete from student where id > ?', [1]);
//        var_dump($num1);

    }

    /**
     * 查询构造器：新增数据
     */
    public function query1(){
//        $bool = DB::table('student')->insert(['name' => 'imooc', 'age' => 18]);
//        var_dump($bool);

//        $id = DB::table('student')->insertGetId(['name' => 'sean', 'age' => 19]);
//        var_dump($id);

        $bool2 = DB::table('student')->insert([
            ['name' => 'name1', 'age' => 20],
            ['name' => 'name2', 'age' => 21]
        ]);
        var_dump($bool2);

    }

    /**
     * 查询构造器：更新数据
     */
    public function query2(){
//        带条件的更新语句
//        $num = DB::table('student')
//            ->where('age', 18)
//            ->update(['age' => 30]);
//        var_dump($num);

//        年龄自增1，或者指定的数目
//        DB::table('student')->increment('age');
//        DB::table('student')->increment('age', 3);

//        年龄自减1，或者指定的数目
//        DB::table('student')->decrement('age');
//        DB::table('student')->decrement('age', 3);

        // 带条件的减少和修改
        $num = DB::table('student')
            ->where('id',3)
            ->decrement('age', 3, ['name' => 'll']);
        var_dump($num);

    }

    /**
     * 查询构造器：删除数据
     */
    public function query3(){
//        $num = DB::table('student')
//            ->where('id', 5)
//            ->delete();
//
//        $num = DB::table('student')
//            ->where('id', '>=', 5)
//            ->delete();
//
//        var_dump($num);

        DB::table('student')->truncate();
    }

    /**
     * 查询构造器：查询数据
     */
    public function query4(){

//        $bool2 = DB::table('student')->insert([
//            ['id' => 1001, 'name' => 'name1', 'age' => 18],
//            ['id' => 1002, 'name' => 'name2', 'age' => 18],
//            ['id' => 1003, 'name' => 'name3', 'age' => 19],
//            ['id' => 1004, 'name' => 'name4', 'age' => 20],
//            ['id' => 1005, 'name' => 'name5', 'age' => 21]
//        ]);
//        var_dump($bool2);

        // get方法
//        $students = DB::table('student')->get();

        // first方法
//        $students = DB::table('student')
//            ->orderBy('id', 'desc')
//            ->first();

        // where方法
//        $students = DB::table('student')
//            ->where('id', '>=', 1002)
//            ->get();

//        $students = DB::table('student')
//            ->whereRaw('id >= ? and age > ?', [1002, 18])
//            ->get();

        // pluck方法：返回某一列属性
//        $names = DB::table('student')->pluck('name');

        // lists方法：返回某一列两列属性为键值对的形式
//        $names = DB::table('student')->lists('name', 'id');

        // selet方法：选择指定的数据列返回
//        $students = DB::table('student')
//            ->select('id', 'name', 'age')
//            ->get();

        // chunk方法：查询的时候每次返回指定数目的数据
        echo '<pre>';
         DB::table('student')->chunk(2, function ($students){
             var_dump($students);
         });


//        dd($students);
    }


    /**
     * Eloquent ORM简介：查找数据
     */
    public function orm1(){
        // all方法：查找所有数据
//        $students = Student::all();

        // find方法：查找指定id对应的数据
//        $students = Student::find(1001);

        // findOrFail方法：查找失败则报错
//        $students = Student::findOrFail(1006);


//        $students = Student::where('id', '>', 1001)
//            ->orderBy('age', 'desc')
//            ->first();

//        echo '<pre>';
//        Student::chunk(2, function ($students){
//            dd($students);
//        });

        // 聚合函数
         $num = Student::count();
         var_dump($num);
//        $max = Student::where('id', '>', 1001) -> max('age');
//        var_dump($max);

//        dd($students);
    }


    /**
     * 新增数据
     */
    public function orm2(){

        // 使用模型新增数据
//        $student = new Student();
//        $student->name = 'sean2';
//        $student->age = 22;
//        $bool = $student->save();
//        dd($bool);

//        $students = Student::find(1007);
//        echo $students->created_at;
//        echo date('Y-m-d H:i:s', $students->created_at);

        // 使用模型的Create方法新增数据
//        $student = Student::create(['name' => 'imooc', 'age' => 18]);
//        dd($student);

        // firstOrCreate方法
//        $student = Student::firstOrCreate(
//            ['name' => 'immoocs']
//        );

        // firstOrNew方法
        $student = Student::firstOrNew(
            ['name' => 'immoocss']
        );
        $student -> save();
        dd($student);

    }

    /**
     * 更新数据
     */
    public function orm3(){
//        $student = Student::find(1010);
//        $student -> name = 'hello';
//        $bool = $student -> save();
//        var_dump($bool);

        $bool = Student::where('id', '>', 1008) -> update(
            ['age' => 37]
        );
        var_dump($bool);

    }

    /**
     * 删除数据
     */
    public function orm4(){
//        $student = Student::find(1010);
//        $bool = $student -> delete();
//        var_dump($bool);

//        $num = Student::destroy(1010);
//        $num = Student::destroy(1009, 1008);
//        $num = Student::destroy([1009, 1008]);
//        var_dump($num);

        $num = Student::where('id', '>', 1005) -> delete();
        var_dump($num);
    }

    public function request1(Request $request) {

        // 1. 取值
//        $name = $request->input('name');
//        $name = $request->input('age', 'default');
//        $name = $request->all();

//        if ($request->has('name')){
//            $name = $request->input('name');
//            echo $name;
//        } else {
//            echo '没有name参数';
//        }

        // 2. 判断请求类型
//        echo $request->method();

//        if ($request->isMethod('Get')){
//            echo 'yes';
//        } else {
//            echo 'no';
//        }
//        var_dump($request->ajax());

        var_dump($request->is('student/*'));
        echo $request->url();
        

    }

}