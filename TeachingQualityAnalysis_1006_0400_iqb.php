<?php
// 代码生成时间: 2025-10-06 04:00:19
// TeachingQualityAnalysis.php
// 教学质量分析程序

use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;

class TeachingQualityAnalysis {

    private $courseTable;
    private $teacherTable;
    private $studentTable;

    // 构造函数，注入课程、教师和学生表
    public function __construct() {
        $this->courseTable = TableRegistry::getTableLocator()->get('Courses');
        $this->teacherTable = TableRegistry::getTableLocator()->get('Teachers');
        $this->studentTable = TableRegistry::getTableLocator()->get('Students');
    }

    // 获取教学质量分析数据
    public function getAnalysisData($courseId) {
        try {
            // 检查课程是否存在
            if (!$this->courseTable->exists(['id' => $courseId])) {
                throw new RecordNotFoundException('课程不存在');
            }

            // 获取课程信息
            $course = $this->courseTable->get($courseId);

            // 获取参与该课程的学生列表
            $students = $this->studentTable->find('all')
                ->where(['course_id' => $courseId])
                ->all();

            // 获取学生的评分和反馈
            $analysisData = [];
            foreach ($students as $student) {
                $analysisData[$student->id] = [
                    'score' => $student->score,
                    'feedback' => $student->feedback
                ];
            }

            // 返回教学质量分析数据
            return $analysisData;

        } catch (RecordNotFoundException $e) {
            // 处理课程不存在的情况
            return ['error' => $e->getMessage()];
        } catch (Exception $e) {
            // 处理其他异常
            return ['error' => '发生未知错误: ' . $e->getMessage()];
        }
    }

}
