<?php

use PHPUnit\Framework\TestCase;
require_once '../modules.php';

class ModulesTests extends TestCase {

    /**
     * @dataProvider loiNormaleProvider
     */
    public function testLoiNormale($point_median, $moyenne, $ecart_type, $expectedResult, $delta) {
        $result = loi_normale($point_median, $moyenne, $ecart_type);
        $this->assertEquals($expectedResult, $result, '', $delta);
    }

    /**
     * @dataProvider methodeRectanglesProvider
     */
    public function testMethodeRectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle, $expectedMin, $expectedMax) {
        $result = methode_rectangles($moyenne, $ecart_type, $borne_sup, $nb_rectangle);
        $this->assertIsFloat($result);
    }

    public function testLoiNormale_Return0WhenEcartTypeZero() {
        $result = loi_normale(10, 10, 0);
        $this->assertEquals(0, $result);
    }

    public function testMethodeRectangles_ReturnErrorIfInvalidEcartType() {
        $result = methode_rectangles(0, -1, 5, 10000);
        $this->assertEquals("valeurs_non_cohérentes", $result);
    }


    public function loiNormaleProvider() {
        return [
            [0, 0, 1, 0.3989, 0.0001],
            [1, 0, 1, 0.2419, 0.0001],
            [2, 0, 2, 0.1209, 0.0001],
        ];
    }

    public function methodeRectanglesProvider() {
        return [
            [0, 1, 5, 10000, 0.99, 1.0],   // should approximate 1
            [0, 1, 2, 5000, 0.84, 0.86],   // area under curve from -5σ to 2
        ];
    }
}
