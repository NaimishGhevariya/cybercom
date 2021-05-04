<?php

namespace Model\Admin;

\Mage::loadFileByClassName('Model\Admin\Session');

class Filter extends \Model\Admin\Session
{

    public function setFilters(array $filters)
    {
        if (!is_array($this->filters)) {
            $this->filters = $filters;
            return $this;
        }
        if (in_array($filters, $this->filters)) {
            $this->filters = $filters;
            return $this;
        }

        $this->filters = $filters + $this->filters;
        return $this;
    }

    public function getFilters($tableName = null, $key = null)
    {
        // echo __METHOD__ . "<br>" . $tableName . " " . $key . "<br>";
        if (is_array($this->filters)) {
            if ($tableName) {
                if (array_key_exists($tableName, $this->filters) && is_array($this->filter[$tableName])) {
                    if ($key) {
                        if (array_key_exists($key, $this->filter[$tableName])) {
                            return $this->filters[$tableName][$key];
                        } else {
                            return null;
                        }
                    }
                } else {
                    if (array_key_exists($tableName, $this->filters)) {
                        return $this->filters[$tableName];
                    }
                }
            }
        }
        return null;
        //     if (is_array($this->filters)) {
        //     if ($tableName && $key) {
        //         if (array_key_exists($tableName, $this->filters) && is_array($this->filter[$tableName])) {
        //             if (array_key_exists($key, $this->filter[$tableName])) {
        //                 return $this->filters[$tableName][$key];
        //             } else {
        //                 return null;
        //             }
        //         }
        //     }

        //     if ($tableName) {
        //         if (array_key_exists($tableName, $this->filters) && is_array($this->filter[$tableName])) {
        //             echo '<pre>';
        //             print_r('hello');
        //             die();
        //             return $this->filters[$tableName];
        //         }
        //     }
        // }

        // return null;
    }

    public function clearFilters($tableName = null)
    {
        if ($tableName) {
            unset($_SESSION[$this->getNameSpace()]['filters'][$tableName]);
            return $this;
        }
        unset($this->filters);
        return;
    }
}
