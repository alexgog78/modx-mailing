<?php

require_once dirname(__FILE__) . '/config.inc.php';

class sampleData
{
    const USERS_COUNT = 50;

    /** @var modX */
    protected $modx;

    /**
     * sampleData constructor.
     * @param modX $modx
     */
    public function __construct(modX &$modx)
    {
        $this->modx = &$modx;
    }

    /**
     * return void
     */
    public function process()
    {
        $this->removeTestUsers();
        for ($i = 1; $i <= self::USERS_COUNT; $i++) {
            $userData = $this->prepareUser($i);
            $this->saveUser($userData);
        }
    }

    /**
     * return void
     */
    public function removeTestUsers()
    {
        $collection = $this->modx->getCollection('modUser', array(
            'username:LIKE' => '%mailing_test_%',
        ));
        foreach ($collection as $user) {
            $this->deleteUser($user);
        }
        $this->resetAutoIncrement('modUser');
        $this->resetAutoIncrement('modUserProfile');
        $this->resetAutoIncrement('modUserGroupMember');
    }

    /**
     * @param int $idx
     * @return array
     */
    private function prepareUser(int $idx)
    {
        return [
            'fullname' => 'Mailing Test (' . $idx . ')',
            'username' => 'mailing_test_' . $idx,
            'email' => 'mailing_test_' . $idx . '@test.ru',
            'comment' => 'Mailing Test User',
            'active' => rand(0, 1),
            'blocked' => rand(0, 1),
            'passwordgenmethod' => 'spec',
            'passwordnotifymethod' => 's',
            'specifiedpassword' => '00000000',
            'confirmpassword' => '00000000',
            'groups' => $this->modx->toJSON([[
                'usergroup' => rand(2,4),
                'role' => 1
            ]])
        ];
    }

    /**
     * @param array $userData
     * @return bool
     */
    private function saveUser(array $userData)
    {
        if ($this->modx->error) {
            $this->modx->error->reset();
        }
        $response = $this->modx->runProcessor('user/create', $userData, [
            'processors_path' => MODX_PROCESSORS_PATH . 'security/'
        ]);
        if ($response->isError()) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r([
                $response->getAllErrors(),
                $userData
            ], true));
            return false;
        }
        $this->modx->log(modX::LOG_LEVEL_INFO, $userData['email'] . 'successfully created');
        return true;
    }

    /**
     * @param modUser $user
     * @return bool
     */
    private function deleteUser(modUser $user)
    {
        if ($this->modx->error) {
            $this->modx->error->reset();
        }
        $response = $this->modx->runProcessor('user/delete', [
            'id' => $user->get('id')
        ], [
            'processors_path' => MODX_PROCESSORS_PATH . 'security/'
        ]);
        if ($response->isError()) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($response->getAllErrors(), true));
            return false;
        }
        return true;
    }

    /**
     * @param $classKey
     * @return bool
     */
    private function resetAutoIncrement($classKey) {
        $query = 'ALTER TABLE ' . $this->modx->getTableName($classKey) . ' AUTO_INCREMENT = 1;';
        if (!$this->modx->query($query)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $query);
            return false;
        }
        return true;
    }
}

echo '<pre>';
$sampleData = new sampleData($modx);
$sampleData->process();
echo '</pre>';

exit();
