<?php
/**
 * Created by PhpStorm.
 * User: man0sions
 * Date: 16/9/12
 * Time: 下午3:23
 */
namespace Luciferp\Url;

/**
 * Class ScanUrl
 * @package Luciferp\Url
 */
class ScanUrl
{
    /**
     * @var array 一个由url组成的数组
     */
    protected $urls;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * ScanUrl constructor.
     * @param array $urls 需要扫描的url数组
     */
    public function __construct(array $urls = [])
    {
        $this->urls = $urls;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * 获取死链
     * @return array
     */
    public function getInvalidUrl()
    {
        $invalidUrls = [];

        foreach ($this->urls as $url) {
            try {
                $statusCode = $this->getStatusCodeFromUrl($url);

            } catch (\Exception $e) {
                $statusCode = 500;
            }
            if ($statusCode >= 400) {
                array_push($invalidUrls, [
                    'url' => $url,
                    'statusCode' => $statusCode
                ]);
            }
        }
        return $invalidUrls;
    }

    /**
     * 获取指定url的http状态码
     * @param $url 远程的url地址
     * @return int HTTP状态码
     */
    protected function getStatusCodeFromUrl($url)
    {
        $res = $this->httpClient->request('GET', $url);
        return $res->getStatusCode();
    }
}