<?php

require_once __DIR__ . '/cli.class.php';

class SampleData extends CLI
{
    const GROUPS_COUNT = 2;
    const USERS_COUNT = 50;

    /** @var array */
    private $groupsIds = [];

    public function run()
    {
        $this->removeTestGroups();
        $this->removeTestUsers();
        $this->createTestGroups(self::GROUPS_COUNT);
        $this->createTestUsers(self::USERS_COUNT);
    }

    private function removeTestGroups()
    {
        $collection = $this->modx->getCollection('modUserGroup', [
            'name:LIKE' => 'MailingGroup Test (%)',
        ]);
        foreach ($collection as $group) {
            $this->runProcessor('group/remove', [
                'id' => $group->get('id'),
            ]);
        }
        $this->resetAutoIncrement('modUserGroup');
        $this->success('Old test groups removed');
    }

    private function removeTestUsers()
    {
        $collection = $this->modx->getCollection('modUser', [
            'username:LIKE' => 'mailing_user_test_%',
        ]);
        foreach ($collection as $user) {
            /**
             * Returns error "Could not get table class for class: modAccess"
             * https://github.com/modxcms/revolution/issues/11276
             */
            $this->runProcessor('user/delete', [
                'id' => $user->get('id'),
            ]);
        }
        $this->resetAutoIncrement('modUser');
        $this->resetAutoIncrement('modUserProfile');
        $this->resetAutoIncrement('modUserGroupMember');
        $this->success('Old test users removed');
    }

    /**
     * @param int $count
     */
    private function createTestGroups(int $count)
    {
        for ($idx = 1; $idx <= $count; $idx++) {
            $groupData = [
                'name' => 'MailingGroup Test (' . $idx . ')',
            ];
            $group = $this->runProcessor('group/create', $groupData);
            $this->groupsIds[] = $group['id'];
        }
        $this->success($count . ' test groups created');
    }

    /**
     * @param int $count
     */
    private function createTestUsers(int $count)
    {
        for ($idx = 1; $idx <= $count; $idx++) {
            $userGroup = $this->groupsIds[array_rand($this->groupsIds)];
            $userData = [
                'fullname' => 'MailingUser Test (' . $idx . ')',
                'username' => 'mailing_user_test_' . $idx,
                'email' => 'mailing_user_test_' . $idx . '@' . $this->modx->getOption('http_host'),
                'comment' => 'Mailing User Test',
                'active' => rand(0, 1),
                'blocked' => rand(0, 1),
                'passwordgenmethod' => 'spec',
                'passwordnotifymethod' => 's',
                'specifiedpassword' => '00000000',
                'confirmpassword' => '00000000',
                'groups' => $this->modx->toJSON([
                    [
                        'usergroup' => $userGroup,
                        'role' => 1,
                    ],
                ]),
            ];
            $user = $this->runProcessor('user/create', $userData);
        }
        $this->success($count . ' test users created');
    }

    /**
     * @param string $action
     * @param array $data
     * @param string[] $config
     * @return mixed
     */
    private function runProcessor(string $action, array $data = [], $config = ['processors_path' => MODX_PROCESSORS_PATH . 'security/',])
    {
        if ($this->modx->error) {
            $this->modx->error->reset();
        }
        $response = $this->modx->runProcessor($action, $data, $config);
        if ($response->isError()) {
            $this->error([
                'responce' => $response->getAllErrors(),
                'data' => $data,
            ]);
        }
        return $response->getObject();
    }

    /**
     * @param $classKey
     */
    private function resetAutoIncrement($classKey)
    {
        $query = 'ALTER TABLE ' . $this->modx->getTableName($classKey) . ' AUTO_INCREMENT = 1;';
        if (!$this->modx->query($query)) {
            $this->error($query);
        }
        $this->success($classKey . ' AUTO_INCREMENT reset');
    }
}
