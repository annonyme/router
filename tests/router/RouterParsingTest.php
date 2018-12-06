<?php
class RouterParsingTest extends  \PHPUnit\Framework\TestCase{
    public function test_basicGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'group' => 3, 'onempty' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url);

        $this->assertEquals(3, count($results));
    }

    public function test_simpleGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'group' => 3, 'onempty' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url);

        $this->assertEquals(23, $results[0]);
    }

    public function test_staticGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'group' => 3, 'onempty' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url);

        $this->assertEquals('blubb', $results[1]);
    }

    public function test_onemptyGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'group' => 3, 'onempty' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url);

        $this->assertEquals('xxx', $results[2]);
    }

    public function test_onnullGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'requestvalue' => 'true', 'pattern' => 'val', 'onnull' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url);

        $this->assertEquals('xxx', $results[2]);
    }

    public function test_requestvalueGroupParsing(){
        $args = [
            ['type' => 'int', 'group' => 1],
            ['type' => 'string', 'staticvalue' => 'blubb'],
            ['type' => 'string', 'requestvalue' => 'true', 'pattern' => 'val', 'onnull' => 'xxx']
        ];

        $url = '/api/test/23';
        $pattern = "/\/api\/test\/(\d+)(\/)?(name)?/i";

        $results = \de\hannespries\router\ArgumentResolver::resolve($args, $pattern, $url, ['val' => 'yyy']);

        $this->assertEquals('yyy', $results[2]);
    }
}