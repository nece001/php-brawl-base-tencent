<?php

namespace Nece\Brawl\Base\Tencent;

use Nece\Brawl\ClientAbstract;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;

/**
 * 腾讯客户端基类
 *
 * @Author nece001@163.com
 * @DateTime 2023-07-30
 */
abstract class TencentClientAbstract extends ClientAbstract
{
    /**
     * 构建证书
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return Credential
     */
    public function buildCredential()
    {
        $secret_id = $this->getConfigValue('secret_id');
        $secret_key = $this->getConfigValue('secret_key');
        return new Credential($secret_id, $secret_key);
    }

    /**
     * 构建客户端设置
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return ClientProfile
     */
    protected function buildClientProfile()
    {
        $signMethod = $this->getConfigValue('signMethod');
        $unsignedPayload = $this->getConfigValue('unsignedPayload');
        $checkPHPVersion = $this->getConfigValue('checkPHPVersion');
        $language = $this->getConfigValue('language');
        $regionBreakerProfile = $this->getConfigValue('regionBreakerProfile');

        // 实例化一个http选项
        $httpProfile = $this->buildHttpProfile();

        // 实例化一个client选项，可选的，没有特殊需求可以跳过
        $clientProfile = new ClientProfile();
        $clientProfile->setHttpProfile($httpProfile);

        if ($signMethod) {
            $clientProfile->setSignMethod($signMethod);  // 指定签名算法(默认为HmacSHA256)
        }

        if ($unsignedPayload) {
            $clientProfile->setUnsignedPayload($unsignedPayload);
        }

        if ($checkPHPVersion) {
            $clientProfile->setCheckPHPVersion($checkPHPVersion);
        }

        if ($language) {
            $clientProfile->setLanguage($language);
        }

        if ($regionBreakerProfile) {
            $clientProfile->setRegionBreakerProfile($regionBreakerProfile);
        }

        return $clientProfile;
    }


    /**
     * 构建http选项
     *
     * @Author nece001@163.com
     * @DateTime 2023-07-30
     *
     * @return HttpProfile
     */
    protected function buildHttpProfile()
    {
        $proxy = $this->getConfigValue('proxy');
        $reqTimeout = $this->getConfigValue('reqTimeout');
        $endpoint = $this->getConfigValue('endpoint');
        $reqMethod = $this->getConfigValue('reqMethod');
        $rootDomain = $this->getConfigValue('rootDomain');
        $keepAlive = $this->getConfigValue('keepAlive');

        $httpProfile = new HttpProfile();
        if ($proxy) {
            $httpProfile->setProxy($proxy);
        }

        if ($reqMethod) {
            $httpProfile->setReqMethod($reqMethod);  // post请求(默认为post请求)
        }

        if ($reqTimeout) {
            $httpProfile->setReqTimeout($reqTimeout);    // 请求超时时间，单位为秒(默认60秒)
        }

        if ($endpoint) {
            $httpProfile->setEndpoint($endpoint);  // 指定接入地域域名(默认就近接入)
        }

        if ($rootDomain) {
            $httpProfile->setRootDomain($rootDomain);
        }

        if ($keepAlive) {
            $httpProfile->setKeepAlive($keepAlive);
        }

        return $httpProfile;
    }
}
