<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList;

interface SortedLinkedListInterface extends \Iterator
{
    public function contains(mixed $value): bool;

    public function remove(mixed $value): void;

    public function add(mixed $value): void;

    public function length(): int;
}
