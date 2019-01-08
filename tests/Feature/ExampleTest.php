<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\State;

class ExampleTest extends TestCase
{
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $state = factory(State::class)->create();

        // $response = $this->get('/register');

        // $response->assertSee('reg');

        // $response->assertStatus(200);
        //  $this->assertE(,$state);

//        $directive = $this->prophesize(BladeDirective::class);
//
//        $directive->foo('bar')->shouldBeCalled()->willReturn('foobar');
//
//        //   die(var_dump($directive->reveal()));
//        $response = $directive->reveal()->foo('bar');
//
//        $this->assertEquals('foobar', $response);
//
//        $str = "test";
//        $this->assertEquals("test", $str, 'String not matched!');
        $this->assertTrue(true);
    }
//
//
//    /** @test */
//    function it_normalizes_a_string_for_the_cache_key()
//    {
//
//        $cache = $this->prophesize(RussianCache::class);
//
//        $directive = new BladeDirective($cache->reveal());
//
//        $cache->has('cache-key')->shouldBeCalled();
//
//        $directive->setUp('cache-key');
//
//    }
//
//    /** @test */
//    function it_normalizes_a_cacheable_model_for_the_cache_key()
//    {
//
//        $cache = $this->prophesize(RussianCache::class);
//
//        $directive = new BladeDirective($cache->reveal());
//
//        $cache->has('stub-cache-key')->shouldBeCalled();
//
//        $directive->setUp(new ModelStub);
//
//    }
//
//    /** @test */
//    function it_normalizes_an_array_for_the_cache_key()
//    {
//
//        $cache = $this->prophesize(RussianCache::class);
//
//        $directive = new BladeDirective($cache->reveal());
//
//        $cache->has(md5('foobar'))->shouldBeCalled();
//
//        $item = ['foo', 'bar'];
//
//        $directive->setUp($item);
//
//    }
    }
//
//
//class BladeDirective
//{
//
//    public function __construct(RussianCache $cache)
//    {
//        $this->cache = $cache;
//    }
//
//    public function foo()
//    {
//
//    }
//
//    public function setUp($key)
//    {
//        $this->cache->has(
//            $this->normalizeKey($key)
//        );
//    }
//
//    protected function normalizeKey($item)
//    {
//
//        if(is_array($item)){
//            return md5(implode($item));
//        }
//        else if(is_object($item) && method_exists($item, 'getCacheKey')){
//                return $item->getCacheKey();
//        }
//        else{
//            return $item;
//        }
//
//
//    }
//}
//
//class RussianCache
//{
//
//    public function has()
//    {
//
//    }
//}
//
//class ModelStub
//{
//    public function getCacheKey()
//    {
//        return 'stub-cache-key';
//    }
//
//}