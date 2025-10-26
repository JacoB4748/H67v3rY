<?php
// 代码生成时间: 2025-10-26 15:15:38
// TestEnvironmentManager.php
// 负责管理测试环境的类
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;
use Cake\Core\App;

class TestEnvironmentManager {
    // 依赖注入的测试环境表
    private $testEnvironmentTable;

    public function __construct() {
        // 从CakePHP的表注册表中获取TestEnvironment表
        $this->testEnvironmentTable = TableRegistry::getTableLocator()->get('TestEnvironments');
    }

    // 创建新的测试环境
    public function create($data) {
        // 验证数据
        $errors = $this->validateData($data);
        if (!empty($errors)) {
            // 如果有错误，返回错误信息
            return ['success' => false, 'errors' => $errors];
        }

        // 尝试创建测试环境
        try {
            $testEnvironment = $this->testEnvironmentTable->newEntity($data);
            $result = $this->testEnvironmentTable->save($testEnvironment);
            if ($result) {
                return ['success' => true, 'message' => 'Test environment created successfully'];
            } else {
                return ['success' => false, 'message' => 'Failed to create test environment'];
            }
        } catch (Exception $e) {
            // 捕获并返回异常信息
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // 更新测试环境
    public function update($id, $data) {
        // 查找测试环境
        $testEnvironment = $this->testEnvironmentTable->get($id);
        if (!$testEnvironment) {
            return ['success' => false, 'message' => 'Test environment not found'];
        }

        // 验证数据
        $errors = $this->validateData($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // 尝试更新测试环境
        try {
            $testEnvironment = $this->testEnvironmentTable->patchEntity($testEnvironment, $data);
            $result = $this->testEnvironmentTable->save($testEnvironment);
            if ($result) {
                return ['success' => true, 'message' => 'Test environment updated successfully'];
            } else {
                return ['success' => false, 'message' => 'Failed to update test environment'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // 验证测试环境数据
    protected function validateData($data) {
        // 创建验证器
        $validator = Validation::build();
        $validator->add('name', 'notBlank', ['rule' => 'notBlank', 'message' => 'Name cannot be empty']);
        $validator->add('description', 'notBlank', ['rule' => 'notBlank', 'message' => 'Description cannot be empty']);

        // 应用验证规则
        $errors = $validator->errors($data);
        return $errors;
    }
}
