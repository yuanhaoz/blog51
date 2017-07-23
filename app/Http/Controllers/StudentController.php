<?php
/**
 * 该学习程序包括
 * 数据增删改查基本功能，表单验证，数据保持，自定义错误信息，中间件原理等等
 * 静态资源加载，模板文件复用
 * Created by PhpStorm.
 * User: 18710
 * Date: 2017/7/16
 * Time: 17:27
 */

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;


class StudentController extends Controller {

    public function index() {

        // orm方式读取数据，paginate是每次读取3条数据并分页显示
        $students = Student::paginate(5);

        return view('student.index', [
            'students' => $students
        ]);
    }

    // 新增数据
    public function create(Request $request) {

        $student = new Student();

        // 如果是post方法说明是新增数的页面
        if ($request->isMethod('post')){


            // 1. 控制器验证
            // 如果验证通过继续执行，否则重定向上一个页面并抛出错误信息到session的errors全局变量中
            // 之后可以通过对错误信息进行处理
            /**$this->validate($request, [
                'Student.name' => 'required|min:2|max:20', // 姓名是必须的，长度最短为2最长是20
                'Student.age' => 'required|integer', // 年龄是必须的，是整数
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项', // 说明required的含义，打印的时候就会打印后面的“必填项”而不是required
                'min' => ':attribute 长度不符合要求', // 说明min的含义，打印的时候就会打印后面的“长度不符合要求”而不是min
                'max' => ':attribute 长度不符合要求', // 说明max的含义，打印的时候就会打印后面的“长度不符合要求”而不是max
                'integer' => ':attribute 必须是整数' // 说明integer的含义，打印的时候就会打印后面的“必须是整数”而不是integer
            ], [
                'Student.name' => '姓名', // 说明字段对应的具体含义
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);**/


            // 2. Validator类验证（是一个全部类，直接调用即可）   数据保持（添加错误跳转回原页面时显示之前填写的信息）
            $validate = \Validator::make($request->input(), [ // 使用make函数，第一个参数不太一样
                'Student.name' => 'required|min:2|max:20', // 姓名是必须的，长度最短为2最长是20
                'Student.age' => 'required|integer', // 年龄是必须的，是整数
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项', // 说明required的含义，打印的时候就会打印后面的“必填项”而不是required
                'min' => ':attribute 长度不符合要求', // 说明min的含义，打印的时候就会打印后面的“长度不符合要求”而不是min
                'max' => ':attribute 长度不符合要求', // 说明max的含义，打印的时候就会打印后面的“长度不符合要求”而不是max
                'integer' => ':attribute 必须是整数' // 说明integer的含义，打印的时候就会打印后面的“必须是整数”而不是integer
            ], [
                'Student.name' => '姓名', // 说明字段对应的具体含义
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            if ($validate->fails()) { // 调用fails()函数判断是否验证成功
                // 错误不会自动注册，需要将$validate的错误信息传递回去
                // 数据保持：withInput() 会将$request中的所有参数传递过去
                return redirect()->back()->withErrors($validate)->withInput();
            }


            $data = $request->input('Student');
            if (Student::create($data)){
                // 重定向回主页并且将创建成功的信息通过一个flash传到session会话中
                return redirect('student/index')->with('success', '新增数据成功');
            } else {
                return redirect()->back()->with('fail','新增数据失败');
            }

        }


        return view('student.create', [
            'student' => $student
        ]);
    }

    // 保存数据
    public function save(Request $request) {
        $data = $request->input('Student');
//        var_dump($data);
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if ($student->save()){
            return redirect('student/index');
        } else {
            return redirect()->back();
        }

    }

    public function update(Request $request, $id) {

        $student = Student::find($id);

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'Student.name' => 'required|min:2|max:20', // 姓名是必须的，长度最短为2最长是20
                'Student.age' => 'required|integer', // 年龄是必须的，是整数
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项', // 说明required的含义，打印的时候就会打印后面的“必填项”而不是required
                'min' => ':attribute 长度不符合要求', // 说明min的含义，打印的时候就会打印后面的“长度不符合要求”而不是min
                'max' => ':attribute 长度不符合要求', // 说明max的含义，打印的时候就会打印后面的“长度不符合要求”而不是max
                'integer' => ':attribute 必须是整数' // 说明integer的含义，打印的时候就会打印后面的“必须是整数”而不是integer
            ], [
                'Student.name' => '姓名', // 说明字段对应的具体含义
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];
            if ($student->save()){
                return redirect('student/index')->with('success', '修改成功-' . $id);
            } else {
                return redirect()->back();
            }
        }

        return view('student.update', [
            'student' => $student
        ]);
    }

    public function detail($id) {

        $student = Student::find($id);

        return view('student.detail', [
            'student' => $student
        ]);

    }

    public function delete($id) {
        $student = Student::find($id);

        if ($student->delete()) {
            return redirect('student/index')->with('success', '删除成功-' . $id);
        } else {
            return redirect('student/index')->with('fail', '删除失败-' . $id);
        }

    }

}