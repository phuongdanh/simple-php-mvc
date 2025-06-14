<?php

namespace App\Test;

use App\Controller\HomeController;
use App\Model\UserModel;
use PHPUnit\Framework\TestCase;

/**
 * HomeTest - Tests for HomeController functionality
 */
final class HomeTest extends TestCase
{
    private HomeController $homeController;

    /**
     * Set up test environment
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->homeController = new HomeController();
    }

    /**
     * Test the index method returns correct data structure
     * @test
     */
    public function testIndexMethodReturnsCorrectData(): void
    {
        // Start output buffering to capture render output
        ob_start();
        $this->homeController->index();
        $output = ob_get_clean();

        // Assert that the output contains expected content
        $this->assertStringContainsString('Welcome to Simple PHP MVC', $output);
        $this->assertStringContainsString('Hello World!', $output);
    }

    /**
     * Test the index method with custom ID parameter
     * @test
     */
    public function testIndexMethodWithCustomId(): void
    {
        // Start output buffering to capture render output
        ob_start();
        $this->homeController->index(123);
        $output = ob_get_clean();

        // Assert that the output contains expected content
        $this->assertStringContainsString('Welcome to Simple PHP MVC', $output);
    }

    /**
     * Test that the controller extends the base Controller class
     * @test
     */
    public function testControllerInheritance(): void
    {
        $this->assertInstanceOf(
            \App\Core\Controller::class,
            $this->homeController,
            'HomeController should extend the base Controller class'
        );
    }

    /**
     * Test that the controller has required methods
     * @test
     */
    public function testControllerHasRequiredMethods(): void
    {
        $this->assertTrue(
            method_exists($this->homeController, 'index'),
            'HomeController should have an index method'
        );
    }

    /**
     * Test that the controller can handle null ID parameter
     * @test
     */
    public function testControllerHandlesNullId(): void
    {
        // Start output buffering to capture render output
        ob_start();
        $this->homeController->index(null);
        $output = ob_get_clean();

        // Assert that the output contains expected content
        $this->assertStringContainsString('Welcome to Simple PHP MVC', $output);
    }

    /**
     * Test that the controller renders a valid HTML document
     * @test
     */
    public function testControllerRendersValidHtml(): void
    {
        // Start output buffering to capture render output
        ob_start();
        $this->homeController->index();
        $output = ob_get_clean();

        // Assert that the output contains basic HTML structure
        $this->assertStringContainsString('<!DOCTYPE html>', $output);
        $this->assertStringContainsString('<html', $output);
        $this->assertStringContainsString('</html>', $output);
    }

  /**
   * Undocumented function
   * @test
   * @return void
   */
  public function testPushAndPop() {

    $stack = [];
    $this->assertSame(0, count($stack), "count array");

    array_push($stack, 'foo');
    $this->assertSame('foo', $stack[count($stack) - 1]);
    $this->assertSame(1, count($stack));

    $this->assertSame('foo', array_pop($stack));
    $this->assertSame(0, count($stack));
  }

  // public function testGetTtem() {
  //   $homeController = new HomeController;
  //   $this->assertSame('1', $homeController->getItem('1'));
  // }

  public function testGetOne() {
    $userModel = new UserModel;
    $this->assertSame('1', $userModel->get('1'));
  }
}