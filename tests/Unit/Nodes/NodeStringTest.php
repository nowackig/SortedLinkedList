<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Tests\Unit\Nodes;

use Cleverg\SortedLinkedList\Nodes\NodeInterface;
use Cleverg\SortedLinkedList\Nodes\NodeString;
use PHPUnit\Framework\TestCase;

class NodeStringTest extends TestCase
{
    public function test_implements_interface()
    {
        // arrange
        $node = new NodeString('aaa');

        // assert
        $this->assertInstanceOf(NodeInterface::class, $node);
    }

    public function test_node_next()
    {
        // arrange
        $node = new NodeString('aaa');
        $nodeNext = new NodeString('bbb');

        // act
        $node->setNextNode($nodeNext);

        // assert
        $this->assertInstanceOf(NodeInterface::class, $nodeNext);
        $this->assertEquals($nodeNext, $node->getNextNode());
    }

    public function test_node_value()
    {
        // arrange
        $node = new NodeString('aaa');

        // assert
        $this->assertEquals('string', gettype($node->getValue()));
        $this->assertEquals('aaa', $node->getValue());
    }
}
