<?php

class Todo
{
    public $id;
    public string $description;
    public string $dueDate;
    public bool $isCompleted = false;
    
    public function __construct(string $description, string $dueDate)
    {
        $this->description = $description;
        $this->dueDate = $dueDate;
    }
    
    public function markAsCompleted()
    {
        $this->isCompleted = true;
        return $this;
    }

    public function formatDueDate()
    {
        return date('F jS, Y', strtotime($this->dueDate));
    }
}