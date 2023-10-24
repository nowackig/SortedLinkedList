<?php

declare(strict_types=1);

namespace Cleverg\SortedLinkedList\Tests\Unit;

use Cleverg\SortedLinkedList\SortedLinkedList;
use Cleverg\SortedLinkedList\SortedLinkedListNodeType;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{
    public function test_add_throw_wrong_type_exception()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('Given value should be type of %s.', SortedLinkedListNodeType::INT->value));

        // act
        $list->add(value: '1');
    }

    public function test_contains_throw_wrong_type_exception()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);

        // assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('Given value should be type of %s.', SortedLinkedListNodeType::INT->value));

        // act
        $list->contains(value: '1');
    }

    public function test_remove_throw_wrong_type_exception()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);

        // assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('Given value should be type of %s.', SortedLinkedListNodeType::INT->value));

        // act
        $list->remove(value: '1');
    }

    public function test_contains_on_empty_list()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // assert
        $this->assertFalse(condition: $list->contains(1));
    }

    public function test_add_and_contains_integer()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // act
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // assert
        $this->assertTrue(condition: $list->contains(1));
        $this->assertTrue(condition: $list->contains(2));
        $this->assertTrue(condition: $list->contains(3));
        $this->assertFalse(condition: $list->contains(4));
    }

    public function test_order_integer()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        $order = [];
        foreach ($list as $node) {
            $order[] = $node->getValue();
        }

        // assert
        $this->assertEquals([1, 2, 3], $order);
    }

    public function test_add_and_contains_string()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::STRING);

        // act
        $list->add(value: 'ccc');
        $list->add(value: 'aaa');
        $list->add(value: 'bbb');

        // assert
        $this->assertTrue(condition: $list->contains('aaa'));
        $this->assertTrue(condition: $list->contains('bbb'));
        $this->assertTrue(condition: $list->contains('ccc'));
        $this->assertFalse(condition: $list->contains('ddd'));
    }

    public function test_order_string()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::STRING);
        $list->add(value: 'ccc');
        $list->add(value: 'aaa');
        $list->add(value: 'bbb');

        $order = [];
        foreach ($list as $node) {
            $order[] = $node->getValue();
        }

        // assert
        $this->assertEquals(['aaa', 'bbb', 'ccc'], $order);
    }

    public function test_remove_first_integer()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // act
        $list->remove(value: 1);

        // assert
        $this->assertFalse(condition: $list->contains(value: 1));
    }

    public function test_remove_first_string()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::STRING);

        $list->add(value: 'ccc');
        $list->add(value: 'aaa');
        $list->add(value: 'bbb');

        // act
        $list->remove(value: 'aaa');

        // assert
        $this->assertFalse(condition: $list->contains(value: 'aaa'));
    }

    public function test_remove_middle_integer()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // act
        $list->remove(value: 2);

        // assert
        $this->assertFalse(condition: $list->contains(value: 2));
    }

    public function test_remove_middle_string()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::STRING);

        $list->add(value: 'ccc');
        $list->add(value: 'aaa');
        $list->add(value: 'bbb');

        // act
        $list->remove(value: 'bbb');

        // assert
        $this->assertFalse(condition: $list->contains(value: 'bbb'));
    }

    public function test_remove_last_integer()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // act
        $list->remove(value: 3);

        // assert
        $this->assertFalse(condition: $list->contains(value: 3));
    }

    public function test_remove_last_string()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::STRING);

        $list->add(value: 'ccc');
        $list->add(value: 'aaa');
        $list->add(value: 'bbb');

        // act
        $list->remove(value: 'ccc');

        // assert
        $this->assertFalse(condition: $list->contains(value: 'ccc'));
    }

    public function test_remove_not_existing_value()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // act
        $list->remove(value: 4);

        // assert
        $this->assertTrue(condition: $list->contains(value: 1));
        $this->assertTrue(condition: $list->contains(value: 2));
        $this->assertTrue(condition: $list->contains(value: 3));
    }

    public function test_initial_list_length()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // assert
        $this->assertEquals(0, $list->length());
    }

    public function test_list_length_after_add()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);
        $list->add(value: 2);
        $list->add(value: 3);

        // assert
        $this->assertEquals(3, $list->length());
    }

    public function test_list_length_after_remove()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);
        $list->add(value: 2);
        $list->add(value: 3);

        // act
        $list->remove(value: 2);

        // assert
        $this->assertEquals(2, $list->length());
    }

    public function test_list_length_after_remove_not_existing_value()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);
        $list->add(value: 2);
        $list->add(value: 3);

        // act
        $list->remove(value: 4);

        // assert
        $this->assertEquals(3, $list->length());
    }

    public function test_list_length_after_remove_all()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);
        $list->add(value: 2);
        $list->add(value: 3);

        // act
        $list->remove(value: 1);
        $list->remove(value: 2);
        $list->remove(value: 3);

        // assert
        $this->assertEquals(0, $list->length());
    }

    public function test_initial_list_current()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // assert
        $this->assertNull($list->current());
    }

    public function test_list_current_after_add()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // act
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // assert
        $this->assertEquals(2, $list->current()->getValue());
    }

    public function test_list_current_after_remove()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 4);
        $list->add(value: 2);
        $list->add(value: 5);

        // act
        $list->remove(4);

        // assert
        $this->assertEquals(3, $list->current()->getValue());
    }

    public function test_list_current_after_remove_not_existing_value()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);
        $list->add(value: 5);
        $list->add(value: 6);

        // act
        $list->remove(4);

        // assert
        $this->assertEquals(6, $list->current()->getValue());
    }

    public function test_list_current_after_remove_all()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);

        // act
        $list->remove(1);

        // assert
        $this->assertNull($list->current());
    }

    public function test_initial_list_key()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // assert
        $this->assertNull($list->key());
    }

    public function test_list_key_after_add()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);

        // act
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 2);

        // assert
        $this->assertEquals(1, $list->key());
    }

    public function test_list_key_after_remove()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 4);
        $list->add(value: 2);
        $list->add(value: 5);

        // act
        $list->remove(4);

        // assert
        $this->assertEquals(2, $list->key());
    }

    public function test_list_key_after_remove_not_existing_value()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 3);
        $list->add(value: 1);
        $list->add(value: 4);
        $list->add(value: 2);
        $list->add(value: 5);

        // act
        $list->remove(6);

        // assert
        $this->assertEquals(4, $list->key());
    }

    public function test_list_key_after_remove_all()
    {
        // arrange
        $list = new SortedLinkedList(SortedLinkedListNodeType::INT);
        $list->add(value: 1);

        // act
        $list->remove(1);

        // assert
        $this->assertNull($list->key());
    }
}
