<?php
namespace Kylewm;

class BrevityTest extends \PHPUnit_Framework_TestCase
{

    private static function getTestData()
    {
        $contents = file_get_contents(__DIR__ . '/../tests.json');
        $contents = utf8_encode($contents);
        $testdata = json_decode($contents, true);
        return $testdata;
    }


    function shortenProvider()
    {
        $testdata = self::getTestData();
        $result = [];
        foreach ($testdata['shorten'] as $testcase) {
            $result[] = [$testcase];
        }
        return $result;
    }

    /**
     * @dataProvider shortenProvider
     */
    function testShorten($testcase)
    {
        $brevity = new Brevity();

        if (isset($testcase['target_length'])) {
            $brevity->setTargetLength($testcase['target_length']);
        }
        if (isset($testcase['link_length'])) {
            $brevity->setLinkLength($testcase['link_length']);
        }


        $result = $brevity->shorten(
            $testcase['text'],
            isset($testcase['permalink']) ? $testcase['permalink'] : false,
            isset($testcase['permashortlink']) ? $testcase['permashortlink'] : false,
            isset($testcase['permashortcitation']) ? $testcase['permashortcitation'] : false,
            isset($testcase['format_as_title']) ? $testcase['format_as_title'] : false);
        $this->assertEquals($testcase['expected'], $result);
    }

    function autolinkProvider()
    {
        $testdata = self::getTestData();
        return array_map(
            function ($testcase) { return [$testcase]; },
            $testdata['autolink']);
    }

    /**
     * @dataProvider autolinkProvider
     */
    function testAutolink($testcase)
    {
        $brevity = new Brevity();
        $result = $brevity->autolink($testcase['text']);
        $this->assertEquals($testcase['expected'], $result);
    }

}
