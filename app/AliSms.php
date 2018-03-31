<?php
namespace App;

class AliSms
{
    private $accessKeyId;
    private $accessKeySecret;

    public function __construct(string $accessKeyId, string $accessKeySecret)
    {
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
    }

    public function send(array $params)
    {
        $domain = 'dysmsapi.aliyuncs.com';
        $security = true;

        $apiParams = array_merge(array (
            'RegionId' => 'cn-hangzhou',
            'Action' => 'SendSms',
            'Version' => '2017-05-25',
            "SignatureMethod" => "HMAC-SHA1",
            "SignatureNonce" => uniqid(mt_rand(0,0xffff), true),
            "SignatureVersion" => "1.0",
            "AccessKeyId" => $this->accessKeyId,
            "Timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
            "Format" => "JSON",
        ), $params);
        ksort($apiParams);

        $sortedQueryStringTmp = "";
        foreach ($apiParams as $key => $value) {
            $sortedQueryStringTmp .= "&" . $this->encode($key) . "=" . $this->encode($value);
        }

        $stringToSign = "GET&%2F&" . $this->encode(substr($sortedQueryStringTmp, 1));

        $sign = base64_encode(hash_hmac("sha1", $stringToSign, $this->accessKeySecret . "&",true));

        $signature = $this->encode($sign);

        $url = ($security ? 'https' : 'http')."://{$domain}/?Signature={$signature}{$sortedQueryStringTmp}";

        try {
            $content = $this->fetchContent($url);
            $content = json_decode($content, true);

            return isset($content['Code']) && $content['Code'] == 'OK';
        } catch( \Exception $e) {
            return false;
        }
    }

    public function send0($phone, $code)
    {
        $params = [
            'PhoneNumbers' => $phone,
            'SignName' => 'LDBC糖果',
            'TemplateCode' => 'SMS_127166782',
            'TemplateParam' => json_encode([
                'code' => $code,
            ])
        ];

        return $this->send($params);
    }

    private function encode($str)
    {
        $res = urlencode($str);
        $res = preg_replace("/\+/", "%20", $res);
        $res = preg_replace("/\*/", "%2A", $res);
        $res = preg_replace("/%7E/", "~", $res);
        return $res;
    }

    private function fetchContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-sdk-client" => "php/2.0.0"
        ));

        if(substr($url, 0,5) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $rtn = curl_exec($ch);

        if($rtn === false) {
            trigger_error("[CURL_" . curl_errno($ch) . "]: " . curl_error($ch), E_USER_ERROR);
        }
        curl_close($ch);

        return $rtn;
    }
}
