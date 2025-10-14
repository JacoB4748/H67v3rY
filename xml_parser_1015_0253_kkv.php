<?php
// 代码生成时间: 2025-10-15 02:53:20
// 引入CAKEPHP框架的相关类
use Cake\Core\Configure;
use Cake\View\Helper\Xml;
use SimpleXMLElement;

class XmlParser {
    /**
     * 解析XML数据
     *
     * @param string $xmlData XML数据字符串
     * @return SimpleXMLElement|false 返回解析后的SimpleXMLElement对象，或在解析失败时返回false
     */
    public function parseXml($xmlData) {
        try {
            // 尝试解析XML数据
            $xml = new SimpleXMLElement($xmlData);

            // 返回解析后的SimpleXMLElement对象
            return $xml;
        } catch (Exception $e) {
            // 错误处理：记录错误日志并返回错误信息
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 获取XML节点数据
     *
     * @param SimpleXMLElement $xml SimpleXMLElement对象
     * @param string $nodeName 节点名称
     * @return string|null 返回节点的值，或在节点不存在时返回null
     */
    public function getNodeValue(SimpleXMLElement $xml, $nodeName) {
        // 检查节点是否存在
        if ($xml->$nodeName) {
            // 返回节点的值
            return (string)$xml->$nodeName;
        } else {
            // 节点不存在，返回null
            return null;
        }
    }
}

// 示例用法
$xmlParser = new XmlParser();
$xmlData = "<root><name>John</name><age>30</age></root>";
$xmlObject = $xmlParser->parseXml($xmlData);

if ($xmlObject) {
    $name = $xmlParser->getNodeValue($xmlObject, 'name');
    $age = $xmlParser->getNodeValue($xmlObject, 'age');

    echo "Name: $name
";
    echo "Age: $age
";
} else {
    echo "XML解析失败";
}