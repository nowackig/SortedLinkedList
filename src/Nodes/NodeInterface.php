<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Nodes;

interface NodeInterface
{
    public function getValue(): mixed;

    public function getNextNode(): ?NodeInterface;

    public function setNextNode(?NodeInterface $node): void;
}
