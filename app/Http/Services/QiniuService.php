<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuService
{
    protected $access_key;

    protected $secret_key;

    public function __construct()
    {
        $this->access_key = env('QINIU_ACCESS_KEY');
        $this->secret_key = env('QINIU_SECRET_KEY');
        $this->bucket = env('QINIU_BUCKET');
        $this->qiniu_domain = env('QINIU_STORAGE_DOMAIN_URL');
    }

    public function auth()
    {
        return new Auth($this->access_key,$this->secret_key);
    }

    public function getUploadToken($bucket = '')
    {
        $auth = $this->auth();
        return $auth->uploadToken($bucket);
    }

    public function upload($file,$key = '')
    {
        if (!is_file($file) || !$file->isValid())
        {
            return false;
        }
        $bucket = $this->bucket;
        $token = $this->getUploadToken($bucket);
        $filePath = $file->getRealPath();
        if (empty($key))
        {
            $file_name = Crypt::encrypt($file->getClientOriginalName());
            $key = 'demo/'.$file_name.'.'.$file->getClientOriginalExtension();
        }
        $uploadManager = new UploadManager();
        list($result['ret'],$result['error_msg']) = $uploadManager->putFile($token,$key,$filePath);
        $file_qiniu_url = '';
        if (empty($result['error_msg']))
        {
            $qiniu_domain = $this->qiniu_domain;
            $file_qiniu_url = $qiniu_domain.'/'.$key;
        }
        return $file_qiniu_url;
    }
}