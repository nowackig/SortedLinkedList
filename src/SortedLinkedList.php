<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList;

use Cleverg\SortedLinkedList\Nodes\NodeInterface;
use PHPUnit\Logging\Exception;

final class SortedLinkedList implements SortedLinkedListInterface
{
    private ?NodeInterface $head = null;

    private ?NodeInterface $currentNode = null;

    private int $length = 0;

    private ?int $currentKey = null;

    private readonly string $nodeClass;

    public function __construct(readonly private SortedLinkedListNodeType $type)
    {
        $this->nodeClass = $this->type->nodeClass();
    }

    public function add(mixed $value): void
    {
        $this->checkType(value: $value);

        /** @var NodeInterface $newNode */
        $newNode = new $this->nodeClass(value: $value);
        $currentKey = 0;

        if (!$this->head instanceof NodeInterface) {
            $this->head = $newNode;
        } else {
            /** @var NodeInterface $current */
            $current = $this->head;
            $prev = null;

            while ($current && $current->getValue() < $value) {
                $prev = $current;
                $current = $current->getNextNode();
                ++$currentKey;
            }

            if (null === $prev) {
                $newNode->setNextNode(node: $this->head);
                $this->head = $newNode;
            } else {
                $newNode->setNextNode(node: $current);
                $prev->setNextNode(node: $newNode);
            }
        }

        $this->currentKey = $currentKey;
        $this->currentNode = $newNode;
        ++$this->length;
    }

    public function remove(mixed $value): void
    {
        if ($this->listIsEmpty() || !$this->contains(value: $value)) {
            return;
        }

        $this->checkType(value: $value);

        /** @var NodeInterface $current */
        $current = $this->head;
        $prev = null;
        $currentKey = 0;

        while ($current) {
            if ($current->getValue() === $value) {
                if (null === $prev) {
                    $this->head = $current->getNextNode();
                    $this->currentNode = $current->getNextNode();
                } else {
                    $prev->setNextNode(node: $current->getNextNode());
                    $this->currentNode = $prev;
                }

                --$this->length;
                --$currentKey;

                break;
            }

            $prev = $current;
            $current = $current->getNextNode();
            ++$currentKey;
        }

        $this->currentKey = $currentKey <= 0 ? null : $currentKey;
    }

    public function contains(mixed $value): bool
    {
        if ($this->listIsEmpty()) {
            return false;
        }

        $this->checkType(value: $value);

        /** @var NodeInterface $current */
        $current = $this->head;

        while ($current) {
            if ($current->getValue() === $value) {
                return true;
            }

            $current = $current->getNextNode();
        }

        return false;
    }

    public function current(): ?NodeInterface
    {
        return $this->currentNode;
    }

    public function next(): void
    {
        if ($this->currentNode instanceof \Cleverg\SortedLinkedList\Nodes\NodeInterface) {
            $this->currentNode = $this->currentNode->getNextNode();
            ++$this->currentKey;
        }
    }

    public function key(): ?int
    {
        return $this->currentKey;
    }

    public function valid(): bool
    {
        return $this->currentNode instanceof \Cleverg\SortedLinkedList\Nodes\NodeInterface;
    }

    public function rewind(): void
    {
        $this->currentNode = $this->head;
        $this->currentKey = 0;
    }

    public function length(): int
    {
        return $this->length;
    }

    private function checkType(mixed $value): void
    {
        if (gettype($value) !== $this->type->value) {
            throw new Exception(sprintf('Given value should be type of %s.', $this->type->value));
        }
    }

    private function listIsEmpty(): bool
    {
        return 0 === $this->length;
    }
}
