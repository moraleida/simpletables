<?php
/**
 * simpletables Tests
 */

class simpletablesTest extends WP_UnitTestCase {
    public $plugin_slug = 'simpletables';
    public $simpletables;



    public function setUp() {
        parent::setUp();
        $this->simpletables = $GLOBALS['simpletables'];
        $this->user_id = $this->factory->user->create();
        // 
        // var_dump($this->user_id);

        include_once('/simpletables.php');

        $simpletables = new SimpleTables();
        $this->assertInstanceOf('SimpleTables', $simpletables);
        $this->assertInternalType('int', $this->user_id);

        return $simpletables;
    }

    public function testActivate() {
    	$simpletables = self::setUp();

        // wp_set_auth_cookie( $simpletables->user_id );

    	$this->assertInstanceOf('SimpleTables', $simpletables);
    	$active = $simpletables->activate();

        $this->assertTrue($active);
    }

    public function testBuildTableGrid() {
		$simpletables = self::setUp();

		$grid = $simpletables->buildTableGrid(39,121,'array');
        $table = $simpletables->buildTableGrid(38,120,'string');
        $false = $simpletables->buildTableGrid(3,1,'object');

		$this->assertInternalType('array', $grid);
        $this->assertInternalType('string', $table);
        $this->assertFalse($false);
    }

    public function test_renderTableMetaBox() {
        $simpletables = self::setUp();

        $table = $simpletables->renderTableMetaBox();

        $this->assertInternalType('string', $table);
    }
/*
    public function testSaveGridValues() {
        $simpletables = self::setUp();

        add_filter( 'simpletables_grid', & )
        $grid = $simpletables->buildTableGrid(39,121,'array');

    }
*/
}