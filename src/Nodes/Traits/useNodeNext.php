<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Nodes\Traits;

use Cleverg\SortedLinkedList\Nodes\NodeInterface;

trait useNodeNext
{
    private ?NodeInterface $next = null;

    public function setNextNode(?NodeInterface $node): void
    {
        $this->next = $node;
    }

    public function getNextNode(): ?NodeInterface
    {
        return $this->next;
    }
}
