<?php
namespace App\Helpers;

class Constant
{
    static function getProvinces($value = '')
    {
    	$provinces = [
    		1 => 'Hồ Chí Minh',
    		2 => 'Hà Nội'
    	];
    	if ($value != '' && isset($provinces[$value])) {
    		return $provinces[$value];
    	}
    	return $provinces;
    }

    static function getSalaryRange($value = '')
    {
    	$salary = [
    		0 => 'Chọn mức lương',
	        1 => 'Thỏa thuận',
	        2 => '1 - 3 triệu',
	        3 => '3 - 5 triệu',
	        4 => '5 - 7 triệu',
	        5 => '7 – 10 triệu',
	        6 => '10 – 15 triệu',
	        7 => '15 – 20 triệu',
	        8 => '20 – 30 triệu',
	        9 => 'Trên 30 triệu'
    	];
    	if ($value != '' && isset($salary[$value])) {
    		return $salary[$value];
    	}
    	return $salary;
    }

    static function getScale($value = '')
    {
        $salary = [
            0 => 'Chọn quy mô công ty',
            1 => 'Ít hơn 10 nhân viên',
            2 => 'Từ 10 - 24 nhân viên',
            3 => 'Từ 25 - 99 nhân viên',
            4 => 'Từ 100 - 499 nhân viên',
            5 => 'Từ 500 - 999 nhân viên',
            6 => 'Trên 1000 nhân viên'
        ];
        if ($value != '' && isset($salary[$value])) {
            return $salary[$value];
        }
        return $salary;
    }
}
