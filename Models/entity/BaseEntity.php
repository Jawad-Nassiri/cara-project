<?php

namespace Models\entity;

abstract class BaseEntity {

    protected int $id; // Type hinting for id

    public function getId(): int { // Return type declaration
        return $this->id;
    }

    public function setId(int $id): void { // Type hinting for parameter
        $this->id = $id;
    }
}
