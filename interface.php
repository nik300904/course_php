<?php

interface Sorter
{
    public function __construct();

    public function getFieldNames();

    public function addHashtag(string $name);

    public function addTable(string $name);

    public function getFieldId(): string;

    public function getHashtagId(string $name): string;
}