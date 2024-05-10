<?php

namespace App\Controllers\Service;

use App\Models\UserActivityModel;

class UserActivityLogger
{
    protected $userActivityModel;

    public function __construct(UserActivityModel $userActivityModel)
    {
        $this->userActivityModel = $userActivityModel;
    }

    public function logActivity($name, $action, $additionalInfo = '')
    {
        return $this->userActivityModel->insert([
            'name' => $name,
            'action' => $action,
            'additional_info' => $additionalInfo,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
