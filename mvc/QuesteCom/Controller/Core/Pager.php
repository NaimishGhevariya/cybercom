<?php

namespace Controller\Core;

class Pager
{
    protected $totalRecords = null;
    protected $recordsPerPage = null;
    protected $noOfPages = null;
    protected $currentPage = null;
    protected $start = 1;
    protected $end = null;
    protected $previous = null;
    protected $next = null;

    public function setTotalRecords($record)
    {
        $this->totalRecords = $record;
        return $this;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }


    public function setRecordPerPage($record)
    {
        $this->recordsPerPage = $record;
        return $this;
    }

    public function getRecordPerPage()
    {
        return $this->recordsPerPage;
    }

    protected function setNoOfPages($page)
    {
        $this->noOfPages = $page;
        return $this;
    }

    public function getNoOfPages()
    {
        return $this->noOfPages;
    }

    protected function setEnd($offset)
    {
        $this->end = $offset;
        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }
    protected function setStart($offset)
    {
        $this->start = $offset;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setCurrentPage($offset)
    {
        $this->currentPage = $offset;
        return $this;
    }
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    protected function setPrevious($offset)
    {
        $this->previous = $offset;
        return $this;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    protected function setNext($offset)
    {
        $this->next = $offset;
        return $this;
    }
    public function getNext()
    {
        return $this->next;
    }

    public function calculate()
    {
        if ($this->getTotalRecords() <= $this->getRecordPerPage()) {
            $this->setNoOfPages(1);
            $this->setStart(1);
            $this->setEnd(null);
            $this->setPrevious(null);
            $this->setNext(null);
            return $this;
        }

        $page = ceil($this->getTotalRecords() / $this->getRecordPerPage());
        $this->setNoOfPages($page);
        $this->setEnd($page);

        if ($this->getCurrentPage() > $this->getNoOfPages()) {
            $this->setCurrentPage($this->getNoOfPages());
            return $this;
        }

        if ($this->getCurrentPage() < $this->getStart()) {
            $this->setCurrentPage($this->getStart());
            return $this;
        }

        if ($this->getCurrentPage() == $this->getStart()) {
            $this->setPrevious(null);
            $this->setStart(null);
            if ($this->getCurrentPage() < $this->getNoOfPages()) {
                $this->setNext($this->getCurrentPage() + 1);
            }
            return $this;
        }
        if ($this->getCurrentPage() == $this->getEnd()) {
            $this->setNext(null);
            $this->setEnd(null);
            if ($this->getCurrentPage() >= $this->getNoOfPages()) {
                $this->setPrevious($this->getCurrentPage() - 1);
            }
            return $this;
        }

        if ($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd()) {
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);
        }
        return $this;
    }
}
