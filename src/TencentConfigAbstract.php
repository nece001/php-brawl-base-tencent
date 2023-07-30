<?php

namespace Nece\Brawl\Base\Tencent;

use Nece\Brawl\ConfigAbstract;

/**
 * 腾讯配置基类
 *
 * @Author nece001@163.com
 * @DateTime 2023-07-30
 */
abstract class TencentConfigAbstract extends ConfigAbstract
{
    /**
     * 构建证书选项
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return void
     */
    protected function buildCredentialTemplate()
    {
        $this->addTemplate(true, 'secret_id', 'SecretId', 'SecretId 从腾讯云控制台的访问控制获取');
        $this->addTemplate(true, 'secret_key', 'SecretKey', 'SecretKey 从腾讯云控制台的访问控制获取');
    }

    /**
     * 构建http选项
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return void
     */
    protected function buildHttpTemplate()
    {
        $this->addTemplate(false, 'reqTimeout', '请求超时时间', '单位为秒(默认60秒)');
        $this->addTemplate(false, 'endpoint', '指定接入地域域名', '默认就近接入');
        $this->addTemplate(false, 'reqMethod', '设置http请求方法', '目前支持POST GET,默认为post请求');
        $this->addTemplate(false, 'rootDomain', '主域名', '默认：tencentcloudapi.com');
        $this->addTemplate(false, 'keepAlive', '保持连接', '默认不保持');
        $this->addTemplate(false, 'proxy', '代理', '例：http(s)://xxx.com:xxxx');
    }

    /**
     * 构建客户端选项
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return void
     */
    protected function buildClientTemplate()
    {
        $this->addTemplate(false, 'signMethod', '签名算法', '不填写默认为HmacSHA256', 'TC3-HMAC-SHA256', array('TC3-HMAC-SHA256' => 'TC3-HMAC-SHA256', 'HmacSHA256' => 'HmacSHA256'));
        $this->addTemplate(false, 'unsignedPayload', '忽略内容签名', '设置是否忽略内容签名，0：不忽略，1：忽略。不填写默认0');
        $this->addTemplate(false, 'checkPHPVersion', '是否验证PHP版本', '0：不验证，1：验证。不填写默认：1');
        $this->addTemplate(false, 'regionBreakerProfile', '地域容灾相关参数', '设置地域容灾相关参数');
        $this->addTemplate(false, 'language', '语言', '可选值：zh-CN, en-US');
    }
}
