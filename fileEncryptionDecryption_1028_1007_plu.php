<?php
// 代码生成时间: 2025-10-28 10:07:04
// File: fileEncryptionDecryption.php
// CakePHP 框架下的文件加密解密工具

require_once 'vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Core\Exception\CakeException;
use Cake\Utility\Crypto\CipherTrait;

class FileEncryptionDecryption {
    use CipherTrait;

    private $secretKey;
    private $cipherSeed;

    public function __construct() {
        // 从配置文件中获取密钥和种子值
        $this->secretKey = Configure::read('Security.salt');
        $this->cipherSeed = Configure::read('Security.cipherSeed');
    }

    // 加密文件内容
    public function encryptFileContent($content) {
        try {
            // 使用 CakePHP 的 CipherTrait 进行加密
            $encryptedContent = $this->encrypt($content, $this->secretKey, $this->cipherSeed);
            return $encryptedContent;
        } catch (CakeException $e) {
            // 错误处理
            return ['error' => $e->getMessage()];
        }
    }

    // 解密文件内容
    public function decryptFileContent($content) {
        try {
            // 使用 CakePHP 的 CipherTrait 进行解密
            $decryptedContent = $this->decrypt($content, $this->secretKey, $this->cipherSeed);
            return $decryptedContent;
        } catch (CakeException $e) {
            // 错误处理
            return ['error' => $e->getMessage()];
        }
    }
}
