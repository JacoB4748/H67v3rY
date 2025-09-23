<?php
// 代码生成时间: 2025-09-23 17:14:52
// MathUtility.php
// 该类提供一个数学计算工具集，包含基本的数学运算功能

class MathUtility {
    // 加法运算
    public function add($a, $b) {
        $this->validateNumbers($a, $b);
        return $a + $b;
    }

    // 减法运算
    public function subtract($a, $b) {
        $this->validateNumbers($a, $b);
        return $a - $b;
    }

    // 乘法运算
    public function multiply($a, $b) {
        $this->validateNumbers($a, $b);
        return $a * $b;
    }

    // 除法运算
    public function divide($a, $b) {
        $this->validateNumbers($a, $b);
        if ($b == 0) {
            throw new InvalidArgumentException('除数不能为零。');
        }
        return $a / $b;
    }

    // 验证输入是否为数字
    private function validateNumbers($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('输入必须是数字。');
        }
    }
}
