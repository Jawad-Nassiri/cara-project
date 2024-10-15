<?php

namespace Models\entity;

abstract class BaseEntity {

    protected int $id;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void { 
        $this->id = $id;
    }
}
