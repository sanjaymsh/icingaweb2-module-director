<?php

namespace Icinga\Module\Director\Import;

use Icinga\Data\ResourceFactory;
use Icinga\Module\Director\Hook\ImportSourceHook;
use Icinga\Module\Director\Util;
use Icinga\Module\Director\Web\Form\QuickForm;

class ImportSourceLdap extends ImportSourceHook
{
    protected $connection;

    public function fetchData()
    {
        $columns = $this->listColumns();
        $query = $this->connection()->select()->from($this->settings['objectclass'], $columns);

        if ($base = $this->settings['base']) {
            $query->setBase($base);
        }
        if ($filter = $this->settings['filter']) {
            $query->setNativeFilter($filter);
        }

        if (in_array('dn', $columns)) {
            $result = $query->fetchAll();
            foreach ($result as $dn => $row) {
                $row->dn = $dn;
            }

            return $result;
        } else {
            return $query->fetchAll();
        }
    }

    public function listColumns()
    {
        return preg_split('/,\s*/', $this->settings['query'], -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function addSettingsFormFields(QuickForm $form)
    {
        Util::addLDAPResourceFormElement($form, 'resource');
        $form->addElement('text', 'base', array(
            'label'    => 'LDAP Search Base',
        ));
        $form->addElement('text', 'objectclass', array(
            'label'    => 'Object class',
        ));
        $form->addElement('text', 'filter', array(
            'label'    => 'LDAP filter',
        ));
        $form->addElement('textarea', 'query', array(
            'label'    => 'Properties',
            //'required' => true,
            'rows'     => 5,
        ));
        return $form;
    }

    protected function connection()
    {
        if ($this->connection === null) {
            $this->connection = ResourceFactory::create($this->settings['resource']);
        }

        return $this->connection;
    }
}
